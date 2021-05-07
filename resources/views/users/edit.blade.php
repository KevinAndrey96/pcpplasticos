@extends('layouts.dashboard')

@section('content')

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    
  @if(Session::has('messageSuccess'))

    <div class="alert alert-success" role="alert">

      {{ Session::get('messageSuccess') }}

    </div>
  
  @endif
      
</div>

<div class="card">
  <div class="card-header">
    Editar Usuario
  </div>
  <div class="card-body">
  <form action="{{url('/users/'.$user->id)}}" method="POST" enctype="multipart/form-data"> 
    {{csrf_field()}}
    {{method_field('PATCH')}}
    <div class="form-group">
      <label for="name">Nombre: </label>
      <input class="form-control" type="text" name="name" id="name" value="{{$user->name}}" ></input>
    </div>
    <div class="form-group">
      <label for="phone">Teléfono: </label>
      <input class="form-control" type="number"  name="phone" id="phone" value="{{$user->phone}}"></input>
    </div>
    <div class="form-group">
      <label for="email">Email: </label>
      <input class="form-control" type="email" name="email" id="email" value="{{$user->email}}"></input>
    </div>
    <div class="form-group">
      <label for="country">País: </label>
      <select class="form-control" name="country">
        <option value="{{ $user->country }}" selected disabled>{{ $user->country}}</option>
        <option value="Colombia" >Colombia</option>
        <option value="Peru">Perú</option>
        <option value="Mexico">Mexico</option>

      </select>
    </div>
    <div class="form-group">
      <label for="city">Ciudad: </label>
      <input class="form-control" type="text" name="city" id="city" value="{{$user->city}}"></input>
    </div>
    <div class="form-group">
      <label for="role">Rol: </label>
      <select class="form-control" name="role" onchange="selectTypeList()" id="role">
        <option value="{{ $user->role }}" selected disabled>{{ $user->role }}</option>
        <option value="Administrador">Administrador</option>
        <option value="Distribuidor">Distribuidor</option>
        <option value="Ferretero">Ferretero</option>

      </select>
    </div> 

    @if($user->role == 'Distribuidor')

    <div class="form-group" id="price_list_id_dist" style="display:block">
      <label for="price_list_id">Lista de precios para distribuidores: </label>
        <select class="form-control" name="price_list_id" id="select_dist">

             <option value="{{ $list->id }}" selected disabled>{{ $list->name }}</option>

             @foreach($distributorLists as $distributorList )

               <option value= {{ $distributorList->id }} >{{ $distributorList->name }}</option>
      
              @endforeach

        </select>
    </div>  
    <div class="form-group"  id="price_list_id_iron" style="display:none">
      <label for="price_list_id">Lista de precios para ferreteros: </label>
        <select class="form-control" name="price_list_id" id="select_iron">
            
                <option value="{{ $list->id }}" selected disabled>{{ $list->name }}</option>
            
              @foreach($ironmongerLists as $ironmongerList )

                <option value= {{ $ironmongerList->id }} >{{ $ironmongerList->name }}</option>
      
              @endforeach

        </select>
  </div>  
    @elseif($user->role == 'Ferretero')
   
    <div class="form-group" id="price_list_id_dist" style="display:none">
      <label for="price_list_id">Lista de precios para distribuidores: </label>
        <select class="form-control" name="price_list_id" id="select_dist">

             <option value="{{ $list->id }}" selected disabled>{{ $list->name }}</option>

             @foreach($distributorLists as $distributorList )

               <option value= {{ $distributorList->id }} >{{ $distributorList->name }}</option>
      
              @endforeach

        </select>
    </div>  

      <div class="form-group"  id="price_list_id_iron" style="display:block">
        <label for="price_list_id">Lista de precios para ferreteros: </label>
          <select class="form-control" name="price_list_id" id="select_iron">
              
                  <option value="{{ $list->id }}" selected disabled>{{ $list->name }}</option>
              
                @foreach($ironmongerLists as $ironmongerList )

                  <option value= {{ $ironmongerList->id }}>{{ $ironmongerList->name }}</option>
        
                @endforeach

          </select>
    </div>  

    @endif
    <div class="form-group">
      <label for="image">Seleccione una foto: </label>
      <input class="form-control" type="file" name="image" id="image" value="">
    </div>
    <div class="form-group">
      <label for="establishment_name">Nombre del establecimiento: </label>
      <input class="form-control" type="text" name="establishment_name" id="establishment_name" value="{{$user->establishment_name}}"> 
    </div>
    
    <div class="form-group">
      <label for="password">Contraseña: </label>
      <input class="form-control" type="password" name="password" id="password">
    </div>
  
    <input class="btn btn-info" type="submit" value="Modificar">
  
  </form>
</div>
</div>
<script language="javascript">

  function selectTypeList(){

        var selectRole = document.getElementById('role');
        var role = selectRole.value;
       

        
        var divDist = document.getElementById('price_list_id_dist'); 
        var divIron = document.getElementById('price_list_id_iron'); 
        console.log(divDist);

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