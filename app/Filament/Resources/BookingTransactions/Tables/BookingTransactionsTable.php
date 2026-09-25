<?php

namespace App\Filament\Resources\BookingTransactions\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ForceDeleteBulkAction;
use Filament\Actions\RestoreBulkAction;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\DateColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Columns\IconColumn;


class BookingTransactionsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                //
                TextColumn::make('name')
                    ->label('Nama Pemesan')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('booking_trx_id')
                    ->label('Booking Transaction ID')
                    ->searchable(),
                TextColumn::make('officeSpace.name')
                    ->label('Nama Office Space')
                    ->searchable(),
                TextColumn::make('started_date')
                    ->label('Tanggal Mulai')
                    ->date('d-M-Y'),
                TextColumn::make('ended_date')
                    ->label('Tanggal Selesai')
                    ->date('d-M-Y'),
                IconColumn::make('is_paid')
                    ->label('Status Pembayaran')
                    ->boolean()
                    ->trueIcon('heroicon-o-check-circle')
                    ->falseIcon('heroicon-o-x-circle')
                    ->trueColor('success')
                    ->falseColor('danger'),
                
                    
            ])
            ->filters([
                SelectFilter::make('is_paid')
                    ->label('Status Pembayaran')
                    ->options([
                        true => 'Belum Dibayar',
                        false => 'Sudah Dibayar',
                    ])
                    ->placeholder('Pilih Status Pembayaran'),
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