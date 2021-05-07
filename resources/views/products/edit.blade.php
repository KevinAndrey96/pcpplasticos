@extends('layouts.dashboard')

@section('content')

@if(Session::has('message'))

 <div class="alert alert-success" role="alert">
      
      {{Session::get('message')}}
 
 </div>
   
@endif



<div class="card">
  <div class="card-header">
    Editar 
  </div>
  <div class="card-body">
  <form action="{{url('/products/'.$product->id)}}" method="POST" enctype="multipart/form-data">
    {{csrf_field()}}
    {{method_field('PATCH')}}
    <div class="form-group">
      <label for="name">Nombre: </label>
      <input class="form-control" type="text" name="name" id="name" value="{{ $product->name }}">
    </div>
    <div class="form-group">
        <label for="price">Precio: </label>
        <input class="form-control" type="number" name="price" id="price" value="{{ $product->price }}">
      </div>
      <div class="form-group">
        <label for="image">Imagen: </label>
        <input class="form-control" type="text" name="image" id="image" value="{{ $product->image }}">
      </div>
      <div class="form-group">
        <label for="url">Ruta: </label>
        <input class="form-control" type="text" name="url" id="url" value="{{ $product->url }}">
      </div>
      <div class="form-group">
        <label for="code">Código: </label>
        <input class="form-control" type="text" name="code" id="code" value="{{ $product->code }}">
      </div>

    <input type="submit" class="btn btn-info" value="Editar">
   
    
  </form>
</div>
</div>
@endsection