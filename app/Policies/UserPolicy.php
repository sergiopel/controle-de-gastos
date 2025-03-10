<?php

namespace App\Policies;

use App\Models\User;

class UserPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    // Verifica se o usuário logado tem o papel de 'admin' ou não
    // Caso sim, retorna true, caso não, retorna false
    // Essa verificação é para saber se o usuário pode ou não ver outros usuários (se for admin)
    public function viewUsers(User $user)
    {
        return $user->roles()->where('name', 'admin')->exists();
    }
    
    public function edit(User $user)
    {
        return $user->roles()->where('name', 'admin')->exists();
    }

    // Verifica se o usuário logado tem o papel de 'admin' ou não
    // Caso sim, retorna true, caso não, retorna false
    // Essa verificação é para saber se o usuário pode ou não deletar outro usuário (se for admin)
    public function destroy(User $user)
    {
        return $user->roles()->where('name', 'admin')->exists();
    }

}
