<?php

namespace App\Filament\Resources\Portfolio\ModelResource\Pages;

use App\Filament\Resources\Portfolio\ModelResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListModels extends ListRecords
{
    protected static string $resource = ModelResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
