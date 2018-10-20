<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class UsersCanCreateCategoriasTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testUsersCanCreateCategorias()
    {
        $this->visit('almacen/categoria')//que visite la url
            ->type('Mi primer categoria','nombrecate')//que escriba Mi primer categoria
            ->type('Mi primer descripcion de categoria','descripcioncate')
            ->press('Guardar');
            //->seePageIs('');
            
    }
}
