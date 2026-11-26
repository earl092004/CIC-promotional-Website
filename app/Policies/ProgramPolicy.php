<?php

namespace App\Policies;

use App\Models\Program;
use App\Models\User;

class ProgramPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->isAdministrator();
    }

    public function view(User $user, Program $program): bool
    {
        return $user->isAdministrator();
    }

    public function create(User $user): bool
    {
        return $user->isAdministrator();
    }

    public function update(User $user, Program $program): bool
    {
        return $user->isAdministrator();
    }

    public function delete(User $user, Program $program): bool
    {
        return $user->isAdministrator();
    }
}
