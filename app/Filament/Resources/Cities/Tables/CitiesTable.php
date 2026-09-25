<?php

namespace App\Filament\Resources\Cities\Tables;

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
use App\Models\City as FilamentModel;

class CitiesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                //
            TextColumn::make('name')
                
                ->searchable(),
            ImageColumn::make('photo')
                ->label('Foto Kota')
            ])
            ->filters([
                SelectFilter::make('name')
                ->label('Filter Nama')
                ->options(
                    // Mengambil data nama unik yang tersimpan di database
                    FilamentModel::query()
                        ->pluck('name', 'name')
                        ->toArray()
                )
                ->searchable()
                ->placeholder('Pilih Nama Kota'),
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