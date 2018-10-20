<?php

namespace sisLaravel;

use Illuminate\Database\Eloquent\Model;

class Articulo extends Model
{
    protected $table='ARTICULO';
    protected $primaryKey='	idarticulo';
    public $timestamps=false;//decimos que no se activa las columnas de triggers

    protected $fillable = [
        'idcategoria',
        'codigo',
        'nombrearti',
        'stock',
        'descripcionarti',
        'imagen',
        'estadoarti'
    ];

    protected $guarded = [

    ];
}
