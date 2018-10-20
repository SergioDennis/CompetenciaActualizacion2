@extends ('layouts.admin')
@section ('contenido')
<div class="row">
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <h3>Editar categoria: {{$categoria->nombrecate}}</h3>
        @if (count($errors)>0)
        <div class="alert alert-danger">
            <ul>
            @foreach ($errors->all() as $error)    
                <li>{{$error}}</li>
            @endforeach    
            </ul>
        </div>
        @endif

        {!!Form::model(@categoria,['method'=>'PATCH','route'=>['almacen.categoria.update',$categoria->idcategoria]])!!}
        {{Form::token()}}
        <div class="form-group">
            <label for="nombre">Nombre</label>
            <input type="text" name="nombrecate" class="form-control" value="{{$categoria->nombrecate}}" placeholder="Nombre...">
        </div>
        <div class="form-group">
            <label for="descripcion">Descripcion</label>
            <input type="text" name="descripcioncate" class="form-control" value="{{$categoria->descripcioncate}}" placeholder="Descripcion...">
        </div>
        <div class="form-group">
            <button class="btn btn-primary" type="submit">Guardar</button>
            <button class="btn btn-danger" type="reset">Cancelar</button>
        </div>

         
        {!!Form::close()!!}
    </div>
</div>
@endsection