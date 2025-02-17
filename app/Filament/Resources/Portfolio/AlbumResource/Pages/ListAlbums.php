<?php

namespace App\Filament\Resources\Portfolio\AlbumResource\Pages;

use App\Filament\Resources\Portfolio\AlbumResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListAlbums extends ListRecords
{
    protected static string $resource = AlbumResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
