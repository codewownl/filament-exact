<?php

namespace CreativeWork\FilamentExact\Resources\ExactQueue\Schemas;

use CreativeWork\FilamentExact\Enums\QueuePriorityEnum;
use CreativeWork\FilamentExact\Enums\QueueStatusEnum;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

final class ExactQueueForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Section::make(__('Job Details'))
                ->description(__('Details about the job.'))
                ->schema([
                    TextInput::make('id')
                        ->label(__('Number'))
                        ->columnSpan(1)
                        ->disabled(),
                    TextInput::make('job')
                        ->label(__('Job'))
                        ->columnSpan(1)
                        ->disabled(),
                    TextInput::make('division')
                        ->label(__('Division'))
                        ->columnSpan(1)
                        ->disabled(),
                    Select::make('status')
                        ->label(__('Status'))
                        ->options(QueueStatusEnum::class)
                        ->columnSpan(2)
                        ->disabled(),
                    Select::make('priority')
                        ->label(__('Priority'))
                        ->options(QueuePriorityEnum::class)
                        ->columnSpan(2)
                        ->disabled(),
                    Textarea::make('parameters')
                        ->label(__('Parameters'))
                        ->formatStateUsing(fn ($state) => json_encode($state, JSON_THROW_ON_ERROR))
                        ->columnSpan(2)
                        ->disabled(),
                    TextArea::make('response')
                        ->label(__('Response'))
                        ->columnSpan(2)
                        ->disabled(),
                    DateTimePicker::make('created_at')
                        ->label(__('Created at'))
                        ->columnSpan(1)
                        ->disabled(),
                    DateTimePicker::make('finished_at')
                        ->label(__('Finished at'))
                        ->columnSpan(1)
                        ->disabled(),
                ])
                ->columns(2),
        ]);
    }
}
