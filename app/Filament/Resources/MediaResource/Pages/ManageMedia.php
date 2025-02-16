<?php

namespace App\Filament\Resources\MediaResource\Pages;

use App\Filament\Resources\MediaResource;
use Filament\Resources\Components\Tab;
use Filament\Resources\Pages\ManageRecords;
use Illuminate\Database\Eloquent\Builder;

class ManageMedia extends ManageRecords
{
    protected static string $resource = MediaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // Actions\CreateAction::make(),
        ];
    }

    /** @return Tab[] */
    public function getTabs(): array
    {
        return [
            'all' => Tab::make('All'),
            'avatars' => Tab::make('Avatars')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('collection_name', 'profile-avatars')),
        ];
    }
}
