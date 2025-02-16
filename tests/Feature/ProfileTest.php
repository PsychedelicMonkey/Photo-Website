<?php

use App\Models\User;

use function Pest\Laravel\assertModelExists;
use function Pest\Laravel\assertModelMissing;
use function Pest\Laravel\assertSoftDeleted;

test('profile is created when user is created', function () {
    $user = User::factory()->create();

    assertModelExists($user->profile);
});

test('profile still exists if user is soft deleted', function () {
    $user = User::factory()->create();

    $profile = $user->profile;

    $user->delete();

    assertSoftDeleted($user);
    assertModelExists($profile);
});

test('profile is deleted when user is force deleted', function () {
    $user = User::factory()->create();

    $profile = $user->profile;

    $user->forceDelete();

    assertModelMissing($profile);
});
