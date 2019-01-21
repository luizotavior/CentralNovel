<?php

use Illuminate\Database\Seeder;
use App\Role;
class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Criando Regra Grupo Administrador
        $administrator = new Role();
        $administrator->name = 'admin';
        $administrator->label = 'Administrador';
        $administrator->save();
        //Atribuindo Grupo ao Usuário
        $user = \App\User::find(1);
        $user->roles()->save($administrator);
        //
        $Moderador = new Role();
        $Moderador->name = 'mod';
        $Moderador->label = 'Moderador';
        $Moderador->save();
        //

        //Criando Regra Permissão de Edição de Novels
        //Para Atribuir Permissão ao Usuário, adicione-o na Tabela [permission_novel]
        $permission = new \App\Permission();
        $permission->name = "novels.edit";
        $permission->label = "Editar Novels";
        $permission->closure = function ($user, $novel) {
            return ((boolean) $novel->permission()->find($user->id)) || $user->hasRole('admin') || $user->hasRole('mod');
        };
        $permission->save();
        //Criando Regra Permissão de Edição de Grupos
        //Para Atribuir Permissão ao Usuário, adicione-o na Tabela [permission_grupo]
        $permission = new \App\Permission();
        $permission->name = "grupos.edit";
        $permission->label = "Editar Grupo";
        $permission->closure = function ($user, $grupo) {
            return ((boolean) $grupo->permission()->find($user->id)) || $user->hasRole('admin') || $user->hasRole('mod');
        };
        $permission->save();
        //
    }
}
