<?php

namespace App\Filament\Resources\Cities\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;

class CityForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([

                //
            TextInput::make('name')
            ->helperText('Gunakan nama kota yang sesuai, misalnya "Jakarta" atau "Bandung".')
            ->required()
            ->maxLength(255),

            FileUpload::make('photo')
                ->image()
                ->required()
                ->maxSize(2048) // 2MB
                ->directory('cities'),
            ]);
    }
}