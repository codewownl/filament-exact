<?php

namespace CodeWOW\FilamentExact\Commands;

use CodeWOW\FilamentExact\Enums\QueueStatusEnum;
use CodeWOW\FilamentExact\Mail\ExactErrorMail;
use CodeWOW\FilamentExact\Models\ExactQueue;
use CodeWOW\FilamentExact\Models\ExactToken;
use CodeWOW\FilamentExact\Services\ExactService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class ProcessExactQueue extends Command
{
    protected $signature = 'exact:process-queue {environment=production}';

    protected $description = 'Process the ExactQueue table and dispatches job dynamically';

    public function handle(ExactService $exactService): void
    {
        $environment = $this->argument('environment');

        // Get pending queue item. First get the highest priority, otherwise get the lowest number.
        $queue = ExactQueue::where('status', QueueStatusEnum::PENDING)
            ->where('environment', $environment)
            ->orderBy('priority', 'desc')
            ->orderBy('id', 'asc')
            ->first();

        if (! $queue) {
            return;
        }

        $token = ExactToken::firstOrNew([]);
        if ($token->isLocked()) {
            Log::info('ExactQueue is locked, skipping processing', ['queue' => $queue->id]);

            return;
        }

        if (! $token->isAuthorized()) {
            Log::info('ExactQueue is not authorized, skipping processing', ['queue' => $queue->id]);

            return;
        }

        try {
            $queue->update(['status' => QueueStatusEnum::PROCESSING]);
            $token->lock();

            $jobClass = $queue->job;
            $parameters = $queue->parameters ?? [];

            // Instantiate the job; assuming parameters are passed as an associative array
            $job = new $jobClass(...array_values($parameters));
            $job->exactQueue = $queue;

            // Connect service to Exact Online
            $exactService->connect();

            // Execute the job's handle method with the connection (division will be set automatically)
            if (method_exists($job, 'execute')) {
                $job->execute($exactService);
            } else {
                $job->handle($exactService);
            }

            // Update queue status
            $queue->update([
                'status' => QueueStatusEnum::COMPLETED,
                'finished_at' => now(),
            ]);

            $token->unlock();

        } catch (\Exception $e) {
            Log::error('Error processing ExactQueue job', ['job' => $queue->id, 'error' => $e->getMessage()]);
            $queue->update([
                'status' => QueueStatusEnum::FAILED,
                'response' => $e->getMessage(),
                'finished_at' => now(),
            ]);

            $token->unlock();

            $recipients = config('filament-exact.notifications.mail.to');
            if ($recipients) {
                foreach ($recipients as $recipient) {
                    Mail::to($recipient)->send(new ExactErrorMail("Error in ExactQueue job $queue->id", $e->getMessage()));
                }
            }
        }
    }
}
