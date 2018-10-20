<?php
use PHPUnit\Framework\TestCase;
use sisLaravel\Http\Controllers\CategoriaController;
final class CreateCategoriaTest extends TestCase
{
    public function testCreate()
    {
        $categoria = new CategoriaController();
        $this->assertEquals(
            view("almacen.categoria.create"),$categoria->create()
        );
    }
}
?>