@extends('layouts.dashboard')
@section('content')
<style>

</style>


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


<div class="card">
    <div class="card-header">
       Listas de precios
    </div>
    <div class="card-body">
 <div class="row justify-content-center">
     <div class="col-auto">
        <table class="table table-bordered table-responsive" style="width: 100% !important; margin: 0px auto !important;" id="datatable" width="100%" cellspacing="0">
            <thead class="thead-light">
                <tr>
                     <th style="text-align: center;">Id</th>
                     <th style="text-align: center;">Nombre</th>
                     <th style="text-align: center;">País</th>
                     <th style="text-align: center;">Divisa</th>
                     <th style="text-align: center;">Rol</th>
                     <th style="text-align: center;">Acción</th>
             </tr>
            </thead>
            <tbody>
                @foreach($lists as $list)
                <tr>
                    <td style="text-align: center;">{{$list->id}}</td>
                    <td style="text-align: center;">{{$list->name}}</td>
                    <td style="text-align: center;">{{$list->country}}</td>
                    <td style="text-align: center;">{{$list->currency}}</td>
                    <td style="text-align: center;">{{$list->role}}</td>
    
                    <td style="text-align: center;" >
                        <div class="row">
                            <a class="btn btn-warning form-control" title="Editar" alt="Editar" href="{{ url('/lists/'.$list->id.'/edit') }}" style="margin:3px; width:40px;"><i class="fas fa-pencil-alt"></i></a>
                            
    
                            <form method="POST" action="{{ url('lists/'.$list->id) }}" >
                                {{csrf_field()}}
                                {{method_field('DELETE')}}
                                
                                <button class = "btn btn-danger form-control" title="Borrar" type="submit" onclick="return confirm('¿Esta seguro que quiere borrar esta lista  ?');" style="margin:3px; width:40px;"><i class="fas fa-exclamation-triangle"></i></button>
                            
                            </form>
    
                            <a href="{{url('/products/'.$list->id)}}" class = "btn btn-success form-control"  title="Ver productos" style="margin:3px; width:40px;"><i class="fab fa-product-hunt"></i></a>
                            
                            <a href="{{url('exportProducts/'.$list->id)}}" class = "btn btn-secondary form-control" title="Exportar lista"  style="margin:3px; width:40px;"><i class="fas fa-file-upload"></i></a>
    
                            
                                <a href="{{ url('/chooseList?id=').$list->id }}" class = "btn btn-info form-control" title="Importar lista" style="margin:3px; width:40px;"><i class="fas fa-file-import"></i></a>
    
                               
                        
    
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
     </div>
    
</div>
</div>
</div> 
</div>    
@endsection

