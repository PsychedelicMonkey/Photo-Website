<?php

namespace App\Filament\Resources\Portfolio\ModelResource\Pages;

use App\Filament\Resources\Portfolio\ModelResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditModel extends EditRecord
{
    protected static string $resource = ModelResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
