@extends('layouts.dashboard')
@section('content')

<div class="card">
    <div class="card-header">
        @if(Auth::user()->role == "Distribuidor")
            Pedidos
        @else
        Transferencias
        @endif

    </div>
    <div class="card-body">
        <div class="row justify-content-center text-center" >
            <div class="col-auto mt-5">
                <table class="table table-bordered table-responsive" id="datatable" width="100%" cellspacing="0">
                    <thead class="thead-light">
                        <tr>
                            <th>Id</th>
                            <th>Id del comprador</th>
                            <th>Rol del vendedor</th>
                            <th>Rol del comprador</th>
                            <th>Divisa</th>
                            <th>Total</th>
                            <th>Dirección</th>
                            <th>Estado</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($orders as $order)
                            <tr>
                                
                                <td>{{ $order->id }}</td>
                                <td>{{ $order->buyer_id }}</td>
                                <td>{{ $order->seller_role }}</td>
                                <td>{{ $order->buyer_role }}</td>       
                                <td>{{ $order->currency }}</td>
                                <td>${{number_format($order->total, 2, ',', '.')}}</td>
                                <td>{{ $order->delivery_address }}</td>    
                                <td>
                                    @if($order->status == 'Iniciado')   
                                        <p style="background-color:#51C70E; color:white; padding:5px; border-radius: 5px;">{{ $order->status }}</p>
                                    @elseif($order->status == 'En proceso')
                                        <p style="background-color:#C7940E; color:white; padding:5px; border-radius: 5px;">{{ $order->status }}</p>
                                    @elseif($order->status == 'Cancelado')
                                        <p style="background-color:#C70E0E; color:white; padding:5px; border-radius: 5px;">{{ $order->status }}</p>
                                    @endif

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