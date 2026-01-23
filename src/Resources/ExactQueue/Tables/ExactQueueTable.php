<?php

namespace CreativeWork\FilamentExact\Resources\ExactQueue\Tables;

use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

final class ExactQueueTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->poll('5s')
            ->deferLoading()
            ->recordUrl(function ($record) {
                return route('filament.admin.resources.exact.view', $record);
            })
            ->defaultSort(fn (Builder $query): Builder => $query->orderBy('priority', 'desc')->orderBy('id', 'asc'))
            ->paginated(50, 100, 'all')
            ->columns([
                TextColumn::make('status')
                    ->label(__('Status'))
                    ->sortable()
                    ->searchable()
                    ->badge(),
                TextColumn::make('id')
                    ->label(__('Number'))
                    ->sortable()
                    ->searchable(),
                TextColumn::make('job')
                    ->label(__('Job'))
                    ->searchable(),
                TextColumn::make('division')
                    ->label(__('Division'))
                    ->sortable()
                    ->searchable(),
                TextColumn::make('parameters')
                    ->label(__('Parameters'))
                    ->searchable(),
                TextColumn::make('priority')
                    ->label(__('Priority'))
                    ->badge()
                    ->sortable()
                    ->searchable(),
            ])
            ->filters([
                SelectFilter::make('division')
                    ->label(__('Division'))
                    ->options(function () {
                        $divisions = config('filament-exact.exact.divisions', []);

                        return array_combine($divisions, $divisions);
                    }),
            ]);
    }
}
