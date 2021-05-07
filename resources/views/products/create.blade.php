@extends('layouts.dashboard')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    
  @if(Session::has('messageSuccess'))

    <div class="alert alert-success" role="alert">

      {{ Session::get('messageSuccess') }}

    </div>
  
      
  
  @endif
      
</div>

@if(count($errors)>0)

  <div class="alert alert-danger" role="alert">
    <ul>

       @foreach($errors->all() as $error)
          <li>{{ $error }}</li> 
        @endforeach

    </ul>
  </div>

@endif



<div class="card">
  <div class="card-header">
    Crear Producto
  </div>
  <div class="card-body">
  <form action="{{url('/products')}}" method="POST" enctype="multipart/form-data">
    {{csrf_field()}}
    <div class="form-group">
      <label for="name">Nombre: </label>
      <input class="form-control" type="text" name="name" id="name">
    </div>
    <div class="form-group">
      <label for="price">Precio: </label>
      <input class="form-control" type="number" name="price" id="price">
    </div>
    <div class="form-group">
      <label for="image">Imagen: </label>
      <input class="form-control" type="text" name="image" id="images">
    </div>
    <div class="form-group">
      <label for="url">Ruta: </label>
      <input class="form-control" type="text" name="url" id="url">
    </div>
    <div class="form-group">
      <label for="code">Código: </label>
      <input class="form-control" type="text" name="code" id="code">
    </div>

    <input type="hidden" name="list_id"  value="{{ $list->id }}">

    <input type="submit" class="btn btn-info" value="Crear">
   
    
  </form>
</div>
</div>
@endsection