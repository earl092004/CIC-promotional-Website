<?php

namespace App\Policies;

use App\Models\MediaAsset;
use App\Models\User;

class MediaAssetPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->isAdministrator() || $user->isContributor();
    }

    public function view(User $user, MediaAsset $mediaAsset): bool
    {
        return $user->isAdministrator() || $mediaAsset->uploaded_by === $user->id;
    }

    public function create(User $user): bool
    {
        return $this->viewAny($user);
    }

    public function update(User $user, MediaAsset $mediaAsset): bool
    {
        return $user->isAdministrator() || $mediaAsset->uploaded_by === $user->id;
    }

    public function delete(User $user, MediaAsset $mediaAsset): bool
    {
        return $user->isAdministrator();
    }
}
