@extends('layouts.dashboard')

@section('content')

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    
  @if(Session::has('messageSuccess'))

    <div class="alert alert-success" role="alert">

      {{ Session::get('messageSuccess') }}

    </div>
  
  @endif
      
</div>

@if(Session::has('failChange'))
<div class="alert alert-danger" role="alert">
  {{ Session::get('failChange') }}
</div>
@endif

<div class="card">
  <div class="card-header">
   Cambiar contraseña
  </div>
  <div class="card-body">
  <form action="{{ url('/users/passwordUpda') }}" method="POST" enctype="multipart/form-data"> 
    {{csrf_field()}}
    <div class="form-group">
      <label for="oldPass">Digite la contraseña antigua: </label>
      <input class="form-control" type="password" name="oldPass" id="name" value="" required>
    </div>
    <div class="form-group">
      <label for="name">Digite la nueva contraseña: </label>
      <input class="form-control" type="password" name="newPass1" id="name" value="" required>
    </div>
    <div class="form-group">
      <label for="name">Digite otra vez la nueva contraseña: </label>
      <input class="form-control" type="password" name="newPass2" id="name" value="" required>
    </div>
    
    <input class="form-control" type="hidden" name="id" id="name" value="{{$user->id}}" >

    <input class="btn btn-info" type="submit" value="Cambiar">

  
  </form>
</div>
</div>
@endsection