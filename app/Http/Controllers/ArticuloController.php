<?php

namespace sisLaravel\Http\Controllers;

use Illuminate\Http\Request;

use sisLaravel\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input; //para poder subir la imagen desde la maquina del cliente
use sisLaravel\Http\Requests\ArticuloFormRequest;
use sisLaravel\Articulo;
use DB;

class ArticuloController extends Controller
{
     //metodos para redireccionar a una vista o interactuan con el modelo para enviar o consultar informacion 
     public function __construct()
     {
 
     }
     public function index(Request $request)//creacmos un objeto de tipo request qque se encuentra en app/http/controllers/requests/request.php
     {
         if($request)//si existe existe el requiest entonces voy a obtener todos los registros de la tabla categoria
         {
             $query=trim($request->get('searchText'));//segun al searchText(es el objeto) se va a hacer la busqueda 
             $articulos=DB::table('ARTICULO as a')
             ->join('CATEGORIA as c','a.idcategoria','=','c.idcategoria')
             ->select('a.idarticulo','a.nombrearti','a.codigo','a.stock','c.nombrecate as categoria','a.descripcionarti','a.imagen','a.estadoarti')
             ->where('a.nombrearti','LIKE','%'.$query.'%')
             ->orwhere('a.codigo','LIKE','%'.$query.'%')//que busque por el nombre o por codigo
             ->orderBy('a.idarticulo','desc')
             ->paginate(7);//de cuantos numero de registros de haga la paginacion
             return view('almacen.articulo.index',["articulos"=>$articulos,"searchText"=>$query]);
         }
 
 
     }
     public function create()
     {  
         $categorias=DB::table('CATEGORIA')->where('condicion','=','1')->get();//selecccionamos las categoraias de la tabla categoria qeu sean = 1 ose las activas
         return view("almacen.articulo.create",["categorias"=>$categorias]);//$categorias le estamos enviando las categorias a la vista
     }
     public function store(ArticuloFormRequest $request)//store hace almacena el objeto del modelo categoria en la tabla orrecpondiente el la bd
     {
         $articulo = new Articulo;//creamos un objeto de tipo categoria que esta el app/Categoria.php segun sus propiedades
         $articulo->idcategoria=$request->get('idcategoria');//el ultimo 'nombrecate' es el que esta validado en CategoriaFormRequest
         $articulo->codigo=$request->get('codigo');
         $articulo->nombrearti=$request->get('nombrearti');
         $articulo->stock=$request->get('stock');
         $articulo->descripcionarti=$request->get('descripcionarti');
         $articulo->estadoarti='Activo';

         if(Input::hasFile('imagen')){
             $file=Input::file('imagen');//$file almacena la imagen que estamos reciviendo del formulario
             $file->move(public_path().'/imagenes/articulos',$file->getClientOrOriginalName());//si existe una imagen lo movemos a la carpeta publi y concatenamos la ruta con la carpeta imagenes
             //getClientOrOriginalName para obtener el nombre original que el cliente subio de su imagen
             $articulo->imagen=$file->getClientOrOriginalName();
         }

         $articulo->save();//para guardar en la base de datos
         return Redirect::to('almacen/articulo');//despues de guardar nos envie a la vista de las categorias
     }

     public function show($id)
     {
         return view("almacen.articulo.show",["articulo"=>Articulo::findOrFail($id)]);
     }

     public function edit($id)
     {
         $articulo=Articulo::findOrFail($id);
         $categorias=DB::table('CATEGORIA')->where('condicion','=','1')->get();
         return view("almacen.articulo.edit",["articulo"=>$articulo,"categorias"=>$categorias]);
     }
     public function update(ArticuloFormRequest $request,$id)
     {
        $articulo=Articulo::findOrFail($id);
        
        $articulo->idcategoria=$request->get('idcategoria');//el ultimo 'nombrecate' es el que esta validado en CategoriaFormRequest
         $articulo->codigo=$request->get('codigo');
         $articulo->nombrearti=$request->get('nombrearti');
         $articulo->stock=$request->get('stock');
         $articulo->descripcionarti=$request->get('descripcionarti');
        

         if(Input::hasFile('imagen')){
             $file=Input::file('imagen');//$file almacena la imagen que estamos reciviendo del formulario
             $file->move(public_path().'/imagenes/articulos',$file->getClientOrOriginalName());//si existe una imagen lo movemos a la carpeta publi y concatenamos la ruta con la carpeta imagenes
             //getClientOrOriginalName para obtener el nombre original que el cliente subio de su imagen
             $articulo->imagen=$file->getClientOrOriginalName();
         }
        $articulo->update();
        return Redirect::to('almacen/articulo');
     }

     public function destroy($id)
     {
         $articulo=Articulo::findOrFail($id);
         $articulo->estadoarti='Inactivo';
         $articulo->update();
         return Redirect::to('almacen/articulo');
     }
}
