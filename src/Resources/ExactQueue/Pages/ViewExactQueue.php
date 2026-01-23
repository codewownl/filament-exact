<?php

namespace CodeWOW\FilamentExact\Resources\ExactQueue\Pages;

use CodeWOW\FilamentExact\Actions\CancelJobAction;
use CodeWOW\FilamentExact\Actions\DuplicateTaskAction;
use CodeWOW\FilamentExact\Actions\PrioritizeJobAction;
use CodeWOW\FilamentExact\Resources\ExactQueue\ExactQueueResource;
use Filament\Resources\Pages\ViewRecord;

class ViewExactQueue extends ViewRecord
{
    public static function getResource(): string
    {
        return config('filament-exact.resource', ExactQueueResource::class);
    }

    public function getTitle(): string
    {
        return __('Job') . ' #' . $this->record->id;
    }

    public function getHeaderActions(): array
    {
        return [
            PrioritizeJobAction::make('general'),
            DuplicateTaskAction::make('general'),
            CancelJobAction::make('general'),
        ];
    }
}
