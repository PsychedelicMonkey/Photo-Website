<?php

namespace App\Filament\Resources\General\MediaResource\Pages;

use App\Filament\Resources\General\MediaResource;
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
                ->modifyQueryUsing(fn (Builder $query) => $query
                    ->where('collection_name', 'profile-avatars')
                    ->orWhere('collection_name', 'model-avatars')),

            'album-photos' => Tab::make('Album Photos')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('collection_name', 'album-photos')),

            'post-images' => Tab::make('Post Images')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('collection_name', 'post-images')),
        ];
    }
}
