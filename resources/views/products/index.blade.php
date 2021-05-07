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


<div class="card">
    <div class="card-header">
       Productos
    </div>

<div class="card-body">
    
    <div class="row justify-content-center" >
        <div class="col-auto mt-5">
            <div class="row">
                <a class = "btn btn-info" href={{ url('/products/create/'.$list->id) }} style="margin:15px;">Crear producto</a>
            </div>   
      
            <table class="table table-bordered table-responsive" id="datatable" cellspacing="0" >
                <thead class="thead-light">
                    <tr>
                        <th style="text-align: center;">Id</th>
                        <th style="text-align: center;">Nombre</th>
                        <th style="text-align: center;">Precio</th>
                        <th style="text-align: center;">Imagen</th>
                        <th style="text-align: center;">Ruta</th>
                        <th style="text-align: center;">Código</th>
                        <th style="text-align: center;">Modificar</th>

                </tr>
                </thead>
                <tbody>
                    @foreach($products as $product)
                    <tr>
                        <td style="text-align: center;">{{$product->id}}</td>
                        <td style="text-align: center;">{{$product->name}}</td>
                        <td style="text-align: center;">${{number_format($product->price, 2, ',', '.')}}</td> 
                        <td style="text-align: center;"><a href="{{$product->image}}" target="_blank"><img  class="img-thumbnail" src="{{$product->image}}" onError="this.onerror=null;this.src='/assets/images/imagen-fallo.jpg';" width="70px" height="70px"></a></td>
                        <td style="text-align: center;"><a href="{{$product->url}}">{{ $product->url }}</a></td>
                        <td style="text-align: center;">{{$product->code}}</td>

                        <td style="text-align: center;">
                            
                            <a class="btn btn-warning" href="{{ url('/products/'.$product->id.'/edit') }}" style="margin:3px" >Editar</a>
                            

                            <form method="POST" action="{{ url('products/'.$product->id) }}" >
                                {{csrf_field()}}
                                {{method_field('DELETE')}} 
                                
                                <button class = "btn btn-danger" type="submit" onclick="return confirm('¿Esta seguro que quiere borrar este producto?');" style="margin:3px">Borrar</button>
                            
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