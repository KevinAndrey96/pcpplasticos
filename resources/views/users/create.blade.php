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
    Crear Usuario
  </div>
  <div class="card-body">
  <form action="{{url('/users')}}" method="POST" enctype="multipart/form-data">
    {{csrf_field()}}
    <div class="form-group">
      <label for="name">Nombre: </label>
      <input class="form-control" type="text" name="name" id="name"></input>
    </div>
    <div class="form-group">
      <label for="phone">Teléfono: </label>
      <input class="form-control" type="number" name="phone" id="phone"></input>
    </div>
    <div class="form-group">
      <label for="email">Email: </label>
      <input class="form-control" type="email" name="email" id="email"></input>
    </div>
    <div class="form-group">
      <label for="country">País: </label>
      <select class="form-control" name="country">

        <option value="Colombia" selected>Colombia</option>
        <option value="Peru">Perú</option>
        <option value="México">Mexico</option>

      </select>
    </div>
    <div class="form-group">
      <label for="city">Ciudad: </label>
      <input class="form-control" type="text" name="city" id="city"></input>
    </div>
    <div class="form-group">
      <label for="role">Rol: </label>
      <select class="form-control" name="role" id="role" onchange="selectTypeList()">

        <option value="Administrador" selected>Administrador</option>
        <option value="Distribuidor">Distribuidor</option>
        <option value="Ferretero">Ferretero</option>

      </select>
  </div>  
  <div class="form-group" id="price_list_id_dist" style="display:none">
      <label for="price_list_id">Lista de precios para distribuidores: </label>
        <select class="form-control" name="price_list_id" id="select_dist">

             @foreach($distributorLists as $distributorList )

               <option value= {{ $distributorList->id }} >{{ $distributorList->name }}</option>
      
              @endforeach

        </select>
  </div>  

  <div class="form-group"  id="price_list_id_iron" style="display:none">
    <label for="price_list_id">Lista de precios para ferreteros: </label>
      <select class="form-control" name="price_list_id" id="select_iron">

           @foreach($ironmongerLists as $ironmongerList )

             <option value= {{ $ironmongerList->id }} >{{ $ironmongerList->name }}</option>
    
            @endforeach

      </select>
</div>  
    <div class="form-group">
      <label for="image">Seleccione una foto: </label>
      <input class="form-control" type="file" name="image" id="image" value="">
    </div>
    <div class="form-group">
      <label for="establishment_name">Nombre del establecimiento: </label>
      <input class="form-control" type="text" name="establishment_name" id="establishment_name"> 
    </div>
    <div class="form-group">
      <label for="password">Contraseña: </label>
      <input class="form-control" type="password" name="password" id="password">
    </div>
    <input class="btn btn-info" style="width:300px, background:cian;"type="submit" value="Agregar">
  
  </form>
</div>
</div>
<script language="javascript">

  function selectTypeList(){

        var selectRole = document.getElementById('role');
        var role = selectRole.value;
        var divDist = document.getElementById('price_list_id_dist'); 
        var divIron = document.getElementById('price_list_id_iron'); 
        var seleDist = document.getElementById('select_dist');
        var seleIron = document.getElementById('select_iron');


        if(role == 'Distribuidor'){ 
          divDist.style.display = "block";
          seleDist.disabled = false;
          divIron.style.display = "none";
          seleIron.disabled = true;
        }else if(role == 'Ferretero'){
          divDist.style.display = "none";
          seleDist.disabled = true;
          divIron.style.display = "block";
          seleIron.disabled = false;
        }else{
          divDist.style.display = "none";
          divIron.style.display = "none";
          seleDist.disabled = true;
          seleIron.disabled = true;
        }
        

      }

</script>
@endsection

