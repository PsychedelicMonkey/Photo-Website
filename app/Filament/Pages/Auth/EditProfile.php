<?php

namespace App\Filament\Pages\Auth;

use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Pages\Auth\EditProfile as BaseEditProfile;
use Illuminate\Contracts\Support\Htmlable;

class EditProfile extends BaseEditProfile
{
    public function getTitle(): string|Htmlable
    {
        /** @var User $user */
        $user = auth()->user();

        return $user->name;
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make()
                    ->schema([
                        $this->getNameFormComponent(),
                        $this->getEmailFormComponent(),
                        $this->getPasswordFormComponent(),
                        $this->getPasswordConfirmationFormComponent(),
                    ]),

                Forms\Components\Section::make('Profile')
                    ->relationship('profile')
                    ->schema([
                        Forms\Components\SpatieMediaLibraryFileUpload::make('avatar')
                            ->avatar()
                            ->collection('profile-avatars')
                            ->image()
                            ->imageEditor(),

                        Forms\Components\Textarea::make('bio')
                            ->maxLength(1000),

                        Forms\Components\Toggle::make('is_public')
                            ->label('Visible to public'),
                    ]),
            ]);
    }
}
