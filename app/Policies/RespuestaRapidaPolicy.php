<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\RespuestaRapida;
use Illuminate\Auth\Access\HandlesAuthorization;

class RespuestaRapidaPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:RespuestaRapida');
    }

    public function view(AuthUser $authUser, RespuestaRapida $respuestaRapida): bool
    {
        return $authUser->can('View:RespuestaRapida');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:RespuestaRapida');
    }

    public function update(AuthUser $authUser, RespuestaRapida $respuestaRapida): bool
    {
        return $authUser->can('Update:RespuestaRapida');
    }

    public function delete(AuthUser $authUser, RespuestaRapida $respuestaRapida): bool
    {
        return $authUser->can('Delete:RespuestaRapida');
    }

    public function deleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('DeleteAny:RespuestaRapida');
    }

    public function restore(AuthUser $authUser, RespuestaRapida $respuestaRapida): bool
    {
        return $authUser->can('Restore:RespuestaRapida');
    }

    public function forceDelete(AuthUser $authUser, RespuestaRapida $respuestaRapida): bool
    {
        return $authUser->can('ForceDelete:RespuestaRapida');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:RespuestaRapida');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:RespuestaRapida');
    }

    public function replicate(AuthUser $authUser, RespuestaRapida $respuestaRapida): bool
    {
        return $authUser->can('Replicate:RespuestaRapida');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:RespuestaRapida');
    }

}