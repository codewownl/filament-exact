<?php

namespace CreativeWork\FilamentExact\Resources\ExactQueue;

use CreativeWork\FilamentExact\Resources\ExactQueue\Pages\ListExactQueue;
use CreativeWork\FilamentExact\Resources\ExactQueue\Pages\ViewExactQueue;
use CreativeWork\FilamentExact\Resources\ExactQueue\Schemas\ExactQueueForm;
use CreativeWork\FilamentExact\Resources\ExactQueue\Tables\ExactQueueTable;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;

class ExactQueueResource extends Resource
{
    protected static ?string $slug = 'exact';

    protected static bool $isScopedToTenant = false;

    protected static bool $shouldRegisterNavigation = true;

    public static function getModel(): string
    {
        return config('filament-exact.model');
    }

    public static function getNavigationGroup(): ?string
    {
        return config('filament-exact.navigation.group', __('Exact'));
    }

    public static function getNavigationSort(): ?int
    {
        return config('filament-exact.navigation.sort', -1);
    }

    public static function getNavigationLabel(): string
    {
        return __('Exact') . ' ' . __('Queue');
    }

    public static function getLabel(): ?string
    {
        return __('Exact') . ' ' . __('Queue');
    }

    public static function getNavigationIcon(): string
    {
        return 'heroicon-o-queue-list';
    }

    public function getTitle(): string
    {
        return __('Exact') . ' ' . __('Queue');
    }

    public static function getModelLabel(): string
    {
        return __('Job');
    }

    public static function getPluralModelLabel(): string
    {
        return __('jobs');
    }

    public static function form(Schema $schema): Schema
    {
        return ExactQueueForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ExactQueueTable::configure($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListExactQueue::route('/'),
            'view' => ViewExactQueue::route('/{record}'),
        ];
    }
}
