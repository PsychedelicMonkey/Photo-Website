<?php

namespace App\Filament\Resources\Portfolio\AlbumResource\Pages;

use App\Filament\Resources\Portfolio\AlbumResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditAlbum extends EditRecord
{
    protected static string $resource = AlbumResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
