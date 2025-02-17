<?php

namespace App\Filament\Resources\General\UserResource\Pages;

use App\Filament\Resources\General\UserResource;
use Filament\Resources\Pages\CreateRecord;

class CreateUser extends CreateRecord
{
    protected static string $resource = UserResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        unset($data['password_confirmation']);

        return $data;
    }
}
