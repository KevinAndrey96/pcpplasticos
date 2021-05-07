@extends('layouts.dashboard')
@section('content')

@if(Session::has('message'))
<div class="alert alert-success" role="alert">
     {{ Session::get('message') }} 
</div>                                    

@endif

@if(Session::has('deleteSuccess'))

    <div class="alert alert-success" role="alert">

      {{ Session::get('deleteSuccess') }}

    </div>
  
@endif

<!--
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"></h1>
    
</div>
-->

<div class="card">
    <div class="card-header">
       Usuarios
    </div>
    <div class="card-body">
    
        <div class="row justify-content-center" >
            <div class="col-auto mt-5">
    
            <table class="table-bordered table-responsive" id="datatable" width="100%" cellspacing="0">
                <thead class="thead-light">
                    <tr>
                        <th style="text-align: center;">Id</th>
                        <th style="text-align: center; padding:10px;">Nombre</th>
                        <th style="text-align: center; padding:10px;">Telefono</th>
                        <th style="text-align: center; padding:10px;">Email</th>
                        <th style="text-align: center; padding:10px;">Lista</th>
                        <th style="text-align: center; padding:10px;">Pais</th>
                        <th style="text-align: center; padding:10px;">Ciudad</th>
                        <th style="text-align: center; padding:10px;">Rol</th>
                        <th style="text-align: center; padding:10px;">Nombre del establecimiento</th>
                        <th style="text-align: center; padding:10px;">Acción</th>
                </tr>
                </thead>
                <tbody>
                    @foreach($admins as $admin)
                    <tr>
                        <td style="text-align: center; padding:10px">{{$admin->id}}</td>
                        <td style="text-align: center; padding:10px;">{{$admin->name}}</td>
                        <td style="text-align: center; padding:10px;">{{$admin->phone}}</td>
                        <td style="text-align: center; padding:10px;">{{$admin->email}}</td>
                        @if($admin->role == 'Administrador')
                        <td style="text-align: center; padding:10px;">{{'No aplica'}}</td>
                        @else
                        <td style="text-align: center; padding:10px;">{{$admin->price_list_id}}</td>
                        @endif
                        <td style="text-align: center; padding:10px;">{{$admin->country}}</td>
                        <td style="text-align: center; padding:10px;">{{$admin->city}}</td>
                        <td style="text-align: center; padding:10px;">{{$admin->role}}</td>
                        <td style="text-align: center; padding:10px;">{{$admin->establishment_name}}</td>
                        <td style="text-align: center; padding:10px;">
                            
                            <a class="btn btn-warning" href="{{ url('/users/'.$admin->id.'/edit') }}" style="margin:3px">Editar</a>
                            

                            <form method="post" action="{{ url('/users/'.$admin->id) }}" >
                                {{csrf_field()}}
                                {{method_field('DELETE')}}
                                
                                <button class = "btn btn-danger" type="submit" onclick="return confirm('¿Esta seguro que quiere borrar este usuario?');" style="margin:3px">Borrar</button>
                            
                            </form>
                    
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            </div>
        </div>
    </div>   
</div> 
  
@endsection