@extends('layouts.dashboard')
@section('content')

<div class="card">
    <div class="card-header">
        
        Productos
    
    </div>


    <div class="card-body">
        <div class="row justify-content-center" >
            <div class="col-auto mt-5">

                <table class="table table-bordered table-responsive justify-content-center" id="datatable" cellspacing="0">
                        <thead class="thead-light">
                            <tr>
                                <th>Id</th>
                                <th>Nombre</th>
                                <th>Precio</th>
                                <th>Imagen</th>
                                <th>Código</th>
                                
                
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($products as $product)
                            <tr>
                                <td>{{$product->id}}</td>
                                <td>{{$product->name}}</td>
                                <td>${{number_format($product->price, 2, ',', '.')}}</td> 
                                <td style="text-align:center;"><img class="img-thumbnail" src="{{ $product->image }}" width="70x" height="70px" onError="this.onerror=null;this.src='/assets/images/imagen-fallo.jpg';"></td>   
                                <td>{{$product->code}}</td>
                                
                            </tr>
                            @endforeach
                        </tbody>
                </table>
            
            </div>
        </div>
    </div>
</div>
@endsection