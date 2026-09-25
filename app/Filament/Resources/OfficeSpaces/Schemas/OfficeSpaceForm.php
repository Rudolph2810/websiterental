<?php

namespace App\Filament\Resources\OfficeSpaces\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;

class OfficeSpaceForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Textarea::make('about')
                    ->required()
                    ->rows(10)
                    ->cols(20),

                FileUpload::make('thumbnail')
                    ->required()
                    ->image()
                    ->maxSize(2048), // 2MB
                TextInput::make('address')
                    ->required()
                    ->maxLength(255),
                Repeater::make('benefits')
                ->relationship('benefits')
                // relationship('benefits') digunakan untuk menghubungkan repeater dengan relasi benefits pada model OfficeSpace tanpa terhubung langsung ke fillable, sehingga data yang diinputkan pada repeater akan disimpan ke tabel benefits melalui relasi many-to-many.
                ->schema([
                    TextInput::make('name')
                        ->required()
                        ->maxLength(255),
                ]),
                Repeater::make('photos')
                ->relationship('photos')
                // relationship('photos') digunakan untuk menghubungkan repeater dengan relasi photos pada model OfficeSpace tanpa terhubung langsung ke fillable, sehingga data yang diinputkan pada repeater akan disimpan ke tabel photos melalui relasi one-to-many.
                ->schema([
                    FileUpload::make('photo')
                        ->image()
                        ->required()
                        ->maxSize(2048) // 2MB 
                ]),
                Select::make('city_id')
                    ->relationship('city', 'Name')
                    //fungsinya untuk menampilkan beberapa data pada tabel city untuk memberikan kota kepada office yang sedang dibuat. dan tersimpan pada fillable city_id pada model OfficeSpace. dan menampilkan nama kota pada select optionnya.
                    ->required()
                    ->searchable()
                    ->preload(),
                TextInput::make('price')
                    ->numeric()
                    ->required()
                    ->prefix('IDR'),
                TextInput::make('duration')
                    ->numeric()
                    ->required()
                    ->prefix('Days'),
                Select::make('is_open')
                    ->options([
                        true => 'Open',
                        false => 'Closed',
                    ])
                    ->required(),
                Select::make('is_full_booked')
                    ->options([
                        true => 'Full Booked',
                        false => 'Available',
                    ])
                    ->required(),
                


                //
            ]);
    }
}