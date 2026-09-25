<?php

namespace App\Filament\Resources\OfficeSpaces\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ForceDeleteBulkAction;
use Filament\Actions\RestoreBulkAction;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Filters\SelectFilter;

class OfficeSpacesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                //
                TextColumn::make('name')
                    ->label('Nama Office Space')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('city.name')
                    ->label('Kota')
                    ->searchable(),
                TextColumn::make('price')
                    ->label('Harga')
                    ->money('idr', true),
                ImageColumn::make('thumbnail')
                    ->label('Thumbnail'),
                TextColumn::make('duration')
                    ->label('Durasi')
                    ->searchable()
                    ->date('Y-m-d'),
                IconColumn::make('is_fully_booked')
                    ->label('Fully Booked')
                    ->boolean()
                    ->trueIcon('heroicon-o-check-circle')
                    ->falseIcon('heroicon-o-x-circle')
                    ->trueColor('success')
                    ->falseColor('danger'),

            ])
            ->filters([
                SelectFilter::make('city_id')
                    ->label('Filter berdasarkan Kota')
                    ->relationship('city', 'name')
                    ->placeholder('Pilih Kota'),
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                    ForceDeleteBulkAction::make(),
                    RestoreBulkAction::make(),
                ]),
            ]);
    }
}