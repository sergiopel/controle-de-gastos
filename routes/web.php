<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// O middleware 'auth' protege as rotas dentro deste grupo, garantindo que apenas
// usuários autenticados possam acessá-las. Se um usuário não autenticado tentar
// acessar qualquer rota deste grupo, será redirecionado para a página de login.
Route::middleware(['auth'])->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');

    // Listagem de usuários
    Route::get('/users', [UserController::class, 'index'])->name('users.index');

    // Criação de usuário (exibir o formulário)
    Route::get('/users/create', [UserController::class, 'create'])->name('users.create');

    // Armazenamento de usuário (processar o formulário)
    Route::post('/users/create', [UserController::class, 'store'])->name('users.store');

    // Edição de usuário (exibir o formulário)
    Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');

    // Atualização de usuário (processar o formulário)
    Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');

    // Atualização de perfil de usuário (processar o formulário)
    Route::put('/users/{user}/profile', [UserController::class, 'updateProfile'])->name('users.updateProfile');

    // Atualização de interesses de usuário (processar o formulário)
    Route::put('/users/{user}/interests', [UserController::class, 'updateInterests'])->name('users.updateInterests');

    // Atualização de cargos de usuário (processar o formulário)
    Route::put('/users/{user}/roles', [UserController::class, 'updateRoles'])->name('users.updateRoles');

    // Exclusão de usuário
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');

    // Listagem de categorias
    Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');

    // Incluir categoria (exibir o formulário)
    Route::get('/categories/create', [CategoryController::class, 'create'])->name('categories.create');

    // Armazenamento de categoria (processar o formulário)
    Route::post('/categories/create', [CategoryController::class, 'store'])->name('categories.store');

    // Edição de categoria (exibir o formulário)
    Route::get('/categories/{category}/edit', [CategoryController::class, 'edit'])->name('categories.edit');

    // Atualização de categoria (processar o formulário)
    Route::put('/categories/{category}', [CategoryController::class, 'update'])->name('categories.update');

    // Exclusão de categoria
    Route::delete('/categories/{category}', [CategoryController::class, 'destroy'])->name('categories.destroy');

    // // Visualização de usuário
    // Route::get('/users/{user}', [UserController::class, 'show'])->name('users.show');


});
