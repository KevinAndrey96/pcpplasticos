@extends('layouts.dashboard')
@section('content')

<div class="card">
    <div class="card-header"> 
       Detalle de la transferencia
    </div>
    <div class="card-body">
        
        <div class="row justify-content-center" >

            <div class="col-auto mt-5">
                <table class="table table-bordered table-responsive"  style="margin:0px auto !important" id="datatable" width="100%" cellspacing="0">
                    <thead class="thead-light">
                        <tr>
                            <th>Nombre</th>
                            <th>Cantidad</th>
                            <th>Precio</th>
                            <th>Divisa</th>
                        </tr>
                    </thead>
                    <tbody>
                    <div style="display:none;"> {{$i=0}} </div>
                        @foreach($orders as $order)

                            <tr>
                                <td>{{ $products[$i]->name }}</td>
                                <td>{{ $order->quantity }}</td>
                                <td>${{number_format($order->price , 2, ',', '.')}}</td>
                                <td>{{ $order->currency }}</td>
                            </tr> 
                            
                            <div style="display:none;"> {{$i++}} </div>

                        @endforeach
                        
                    </tbody>
                
                </table>
            </div>
           
          
        </div>
        <div id="stateChange" class="row d-flex justify-content-center" style="display:block;margin-top:50px;">
            
            <form action="{{ url('/changeStatus?id=').$id}}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="status">Estado: </label>
                    <select class="form-control" style="margin-bottom:30px;" name="status">
            
                    <option value="Iniciado" selected>Iniciado</option>
                    <option value="En proceso">En proceso</option>
                    <option value="Cancelado">Cancelado</option>
            
                    </select>
                </div>
            
                <input type="submit" style="display:inline-block;" class="btn btn-info" value="Cambiar estado">
            </form>  
        </div>
        
    </div>
</div>

@endsection