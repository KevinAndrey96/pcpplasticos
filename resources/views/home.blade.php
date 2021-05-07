@extends('layouts.dashboard')
@section('content')





<div class="row">
    @if(Auth::user()->role=='Distribuidor')
       <img class="img-responsive" src="/assets/images/encabezado_distribuidor.jpg" width="100%" height="auto" style="margin:auto;">
       <div id="acciones" style="margin: 0px auto; margin-top:40px; width:48%;">
          <h1 class="" style="font-family: Arial, Helvetica, sans-serif; text-align:center; color:#1F5AA5;">Bienvenido Distribuidor PCP!<h1>
          <h1 style="font-family: Arial, Helvetica, sans-serif; text-align:center; color:#1F5AA5; font-weight: bolder;">Qué desea hacer?</h1>  
          <div id="imagenes" style="margin: 0px auto; text-align:center; margin-top:40px;">
             <a href="{{url('/orders')}}"><img class="img-responsive" src="/assets/images/hacerOrdenDISTRI.PNG" style="display:inline-block; margin:3px;"></a>
             <a href="{{url('/showOrders?role=Distribuidor')}}"><img class="img-responsive" src="/assets/images/ferreAsocDISTRI.PNG" style="display:inline-block; margin:3px;"></a>
             <a href="#"><img class="img-responsive" src="/assets/images/ordenesCompra.PNG" style="display:inline-block; margin:3px;"></a>
             <a href="#"><img class="img-responsive" src="/assets/images/capacitacionesDISTRI.PNG" style="display:inline-block; margin:3px;"></a>
          </div>
       </div>


    @elseif(Auth::user()->role=='Ferretero')
       <img class="img-responsive" src="/assets/images/encabezado_ferretero.jpg" width="100%" height="auto" style="margin:auto;">
       <div id="acciones" style="margin: 0px auto; margin-top:40px; width:48%;">
          <h1 class="" style="font-family: Arial, Helvetica, sans-serif; text-align:center; color:#067072;">Bienvenido Ferretero PCP!<h1>
          <h1 style="font-family: Arial, Helvetica, sans-serif; text-align:center; color:#067072; font-weight: bolder;">Qué desea hacer?</h1>  
          <div id="imagenes" style="margin: 0px auto; text-align:center; margin-top:40px;">
             <a href="{{url('/orders')}}"><img class="img-responsive" src="/assets/images/hacerOrdenFERRE.png" style="display:inline-block; margin:3px;"></a>
             <a href="/myOrders"><img class="img-responsive" src="/assets/images/misPedidosFERRE.png" style="display:inline-block; margin:3px;"></a>
             <a href="#"><img class="img-responsive" src="/assets/images/capacitacionesFERRE.png" style="display:inline-block; margin:3px;"></a>
          </div>
       </div>
    
    @endif
    <img class="img-responsive" src="/assets/images/footer.jpg" width="100%" height="auto" style="display:block; margin-left:auto; margin-right:auto; margin-top:150px;">
   


   </div>
@endsection 

