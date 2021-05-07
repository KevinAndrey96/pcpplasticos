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
  <form action="{{url('/lists/'.$list->id)}}" method="POST" enctype="multipart/form-data">
    {{csrf_field()}}
    {{method_field('PATCH')}}
    <div class="form-group">
      <label for="name">Nombre: </label>
      <input class="form-control" type="text" name="name" id="name" value="{{ $list->name }}">
    </div>
    <div class="form-group">
      <label for="currency">Divisa: </label>

      
      <select class="form-control" class="form-control" name="currency">

        
        <option value="{{ $list->currency }}" selected disabled>{{ $list->currency }}</option>
        <option value="USD">USD</option>
        <option value="COP" selected>COP</option>
        <option value="MXN">MXN</option>
        <option value="PEN">PEN</option>

      </select>
    </div>
  
    <div class="form-group">
      <label for="country">País: </label>
      <select class="form-control" name="country">
      
        <option value="{{ $list->country }}" selected disabled>{{ $list->country }}</option>
        <option value="Colombia">Colombia</option>
        <option value="Peru">Perú</option>
        <option value="Mexico">Mexico</option>

      </select>
    </div>
    <input type="hidden" name="role"  value="{{ $list->role }}" >

    <input type="submit" class="btn btn-info" value="Editar">
   
    
  </form>
</div>
</div>
@endsection