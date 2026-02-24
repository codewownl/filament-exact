<?php

namespace CodeWOW\FilamentExact\Jobs;

use CodeWOW\FilamentExact\Models\ExactQueue;
use CodeWOW\FilamentExact\Services\ExactService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\Middleware\RateLimited;
use Illuminate\Queue\SerializesModels;

abstract class ExactQueueJob implements ShouldQueue
{
    use Queueable;
    use SerializesModels;

    public ?ExactQueue $exactQueue = null;

    /**
     * Define job middleware.
     */
    public function middleware(): array
    {
        return [
            new RateLimited('exact'),
        ];
    }

    /**
     * Your custom job must implement this method
     */
    abstract public function handle(ExactService $service): void;

    /**
     * Execute the job and set division if available.
     */
    public function execute(ExactService $service): void
    {
        if ($this->exactQueue && $this->exactQueue->division) {
            $service->setDivision($this->exactQueue->division);
        }

        $this->handle($service);
    }
}
