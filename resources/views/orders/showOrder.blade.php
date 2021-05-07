@extends('layouts.dashboard')
@section('content')

<div class="card">
    <div class="card-header">
       Transferencias
    </div>
    <div class="card-body">
        
        <div class="row justify-content-center" >
            <div class="col-auto mt-5">

                <table class="table table-bordered table-responsive" style="margin:0px auto !important;" id="datatable" width="100%" cellspacing="0">
                    <thead class="thead-light">
                        <tr>
                            <th style="text-align: center;">Id</th>
                            <th style="text-align: center;">Comprador</th>
                            <th style="text-align: center;">Rol del vendedor</th>
                            <th style="text-align: center;">Rol del comprador</th>
                            <th style="text-align: center;">Divisa</th>
                            <th style="text-align: center;">Total</th>
                            <th style="text-align: center;">Dirección</th>
                            <th style="text-align: center;">Comentario</th>
                            <th style="text-align: center;">Estado</th>
                            <th style="text-align: center;">Acción</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($orders as $order)
                            <tr>
                                
                                <td style="text-align: center;">{{ $order->id }}</td>
                                <td style="text-align: center;">{{ $order->buyer->name }}</td>
                                <td style="text-align: center;">{{ $order->seller_role }}</td>
                                <td style="text-align: center;">{{ $order->buyer_role }}</td>       
                                <td style="text-align: center;">{{ $order->currency }}</td>
                                <td style="text-align: center;">${{number_format($order->total, 2, ',', '.')}}</td> 
                                <td style="text-align: center;">{{ $order->delivery_address }}</td>    
                                <td style="text-align: center;">{{ $order->coment }}</td>
                                <td style="text-align: center;">

                                    @if($order->status == 'Iniciado')   
                                          <p style="background-color:#51C70E; color:white; padding:5px; border-radius: 5px;">{{ $order->status }}</p>
                                    @elseif($order->status == 'En proceso')
                                          <p style="background-color:#C7940E; color:white; padding:5px; border-radius: 5px;">{{ $order->status }}</p>
                                    @elseif($order->status == 'Cancelado')
                                          <p style="background-color:#C70E0E; color:white; padding:5px; border-radius: 5px;">{{ $order->status }}</p>
                                    @endif
                                </td>
                                <td style="text-align: center;">
                                    <a class="btn btn-success" href="{{ url('detailOrder?id=').$order->id }}" style="margin:3px">Detalle</a>
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