<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use App\Models\UserProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class UserController extends Controller
{
    public function index(Request $request)
    {
        Gate::authorize('viewUsers', User::class);
        // O método query() retorna uma nova instância do Query Builder do Laravel
        // O Query Builder é uma interface fluente para criar consultas SQL de forma orientada a objetos
        // Ele permite construir consultas complexas de forma mais simples e legível
        // Neste caso, estamos iniciando uma consulta na tabela 'users' que pode ser 
        // encadeada com outros métodos como where(), orderBy(), paginate(), etc
        //
        // A principal diferença entre o Query Builder e o Eloquent é que:
        // - O Query Builder trabalha diretamente com as tabelas do banco de dados e gera SQL puro
        // - O Eloquent é um ORM (Object-Relational Mapping) que mapeia registros do banco para objetos PHP
        // - Com Eloquent temos acesso a recursos como relacionamentos, eventos, mutators/accessors
        // - Query Builder é mais performático por não ter overhead de criar objetos
        // - Eloquent é mais conveniente para operações CRUD simples e relacionamentos
        $users = User::query();

        $users->when($request->keyword, function ($query, $keyword) {
            $query->where(function ($q) use ($keyword) {
                $q->where('name', 'like', '%' . $keyword . '%')
                    ->orWhere('email', 'like', '%' . $keyword . '%');
            });
        });

        $users = $users->paginate(20);

        return view('users.index', compact('users'));
    }

    public function create()
    {
        return view('users.create');
    }

    public function store(Request $request)
    {
        // Validação dos dados do formulário:
        // - name: campo obrigatório
        // - email: campo obrigatório, deve ser um email válido e único na tabela users
        // - password: campo obrigatório com mínimo de 8 caracteres
        $input = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8',
        ]);

        User::create($input);

        return redirect()->route('users.index')->with('status', 'Usuário adicionado com sucesso');
    }

    public function edit(User $user)
    {
        Gate::authorize('edit', User::class);
        $user->load('profile', 'interests');
        $roles = Role::orderBy('name')->get();
        return view('users.edit', compact('user', 'roles'));
    }

    public function update(Request $request, User $user)
    {
        Gate::authorize('edit', User::class);
        // Validação dos dados do formulário:
        // - name: campo obrigatório
        // - email: campo obrigatório, deve ser um email válido e único na tabela users 
        //         (exceto para o próprio usuário sendo editado)
        // - password: campo não obrigatório na edição com mínimo de 8 caracteres
        $input = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'exclude_if:password,null|min:8',
        ]);

        // Eu também poderia ter usado $user->fill($input)->save();
        $user->update($input);

        // Eu também poderia ter redirecionado para a página de edição do usuário e ficaria assim:
        // return back()->with('status', 'Usuário atualizado com sucesso');
        // Inserindo a @session no edit.blade.php
        return redirect()->route('users.index')->with('status', 'Usuário atualizado com sucesso');
    }

    public function updateProfile(Request $request, User $user)
    {
        Gate::authorize('edit', User::class);
        $input = $request->validate([
            'person_type' => 'required',
            'address' => 'required',
        ]);

        UserProfile::updateOrCreate(
            ['user_id' => $user->id],
            $input
        );

        return back()->with('status', 'Perfil atualizado com sucesso');
    }

    public function updateInterests(Request $request, User $user)
    {
        Gate::authorize('edit', User::class);
        $input = $request->validate([
            'interests' => 'nullable|array',
        ]);

        $user->interests()->delete();
        if (!empty($input['interests'])) {
            $user->interests()->createMany($input['interests']);
        }

        return back()->with('status', 'Interesses atualizados com sucesso');
    }

    public function updateRoles(Request $request, User $user)
    {
        Gate::authorize('edit', User::class);
        $input = $request->validate([
            'roles' => 'required|array',
        ], [
            'roles.required' => 'Por favor, selecione pelo menos um cargo',
            'roles.array' => 'O formato dos cargos é inválido'
        ]);

        // Anexando um model no outro model dentro da tabela pivot (role_user)
        // O sync() substitui todos os registros existentes pelos novos
        $user->roles()->sync($input['roles']);

        return back()->with('status', 'Cargos atualizados com sucesso');
    }

    public function destroy(User $user)
    {
        Gate::authorize('destroy', User::class);
        $user->delete();
        return redirect()->route('users.index')->with('status', 'Usuário deletado com sucesso');
    }
}
