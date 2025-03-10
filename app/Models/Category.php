<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['name', 'type', 'description', 'is_system'];

    /**
     * Define o relacionamento muitos-para-muitos com usuários.
     * 
     * Esta função estabelece uma relação onde uma categoria pode pertencer a vários usuários
     * e um usuário pode ter várias categorias, utilizando a tabela pivot 'category_user'.
     * Isso é implementado através do método belongsToMany do Eloquent.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
