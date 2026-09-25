<?php

namespace App\Filament\Resources\BookingTransactions\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Datepicker;
use Filament\Forms\Components\Select;

class BookingTransactionForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                //

                TextInput::make('name')
                    ->label('Nama Pemesan')
                    ->required()
                    ->maxLength(255),
                TextInput::make('booking_trx_id')
                    ->label('Booking Transaction ID')
                    ->required()
                    ->maxLength(255),
                TextInput::make('phone_number')
                    ->label('Nomor Telepon')
                    ->required()
                    ->maxLength(255),
                TextInput::make('total_amount')
                    ->label('Total Amount')
                    ->required()
                    ->numeric()
                    ->prefix('IDR'),
                TextInput::make('duration')
                    ->label('Durasi')
                    ->required()
                    ->numeric()
                    ->prefix('Days'),
                Datepicker::make('started_date')
                    ->displayFormat('d-M-Y')
                    ->native(false)
                    // native false agar bisa menampilkan format yang kita mau bukan bawaan
                    ->label('Tanggal Mulai')
                    ->required(),
                Datepicker::make('ended_date')
                    ->native(false)
                    // native false agar bisa menampilkan format yang kita mau bukan bawaan
                    ->format('d-M-Y')
                    ->displayFormat('d-M-Y')
                    ->label('Tanggal Selesai')
                    ->required(),
                Select::make('office_space_id')
                    ->label('Office Space')
                    ->relationship('officeSpace', 'name')
                    ->required()
                    ->searchable(),
                Select::make('is_paid')
                    ->label('Status Pembayaran')
                    ->options([
                        true => 'Belum Dibayar',
                        false => 'Sudah Dibayar',
                    ])
                    ->required(),
                

            ]);
    }
}