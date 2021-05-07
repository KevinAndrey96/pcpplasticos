@extends('layouts.dashboard')
@section('content')

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
        
        Productos
    
    </div>


    <div class="card-body">
        @if(Auth::user()->role == 'Ferretero')
        <div id="message-iron">
            <p style="background-color:#2ab2e2; color: white; text-align:justify; width:100%; padding:10px; border-radius:10px;"> 
                Señor Ferretero recuerde que estos precios son precios de referencia, 
                el valor de su pedido puede aumentar o disminuir de acuerdo a la 
                negociación directa con el distribuidor de su preferencia. El distribuidor le
                enviara en breve una cotización con el valor final de su transferencia para que sea 
                aprobada por usted.
            </p>
        </div>
        @endif 
        <div class="row justify-content-center" >
           
            <div class="col-auto mt-5">
                
               
                
                <form method="POST" action="{{ route('bill') }}">
                    @csrf
                    {{ method_field('POST') }}
                    <input type="hidden" name="dataProduct" value="{{json_encode($dataProduct)}}">
                    <table class="table table-bordered table-responsive justify-content-center" id="datatable" cellspacing="0">
                            <thead class="thead-light">
                                <tr>
                                    <th>Imagen</th>
                                    <th>Nombre</th>
                                    <th>Precio</th>
                                    <th>Cantidad</th>
                                </tr>
                            </thead>
                            <tbody>
                            
                                
                                @foreach($dataProduct as $product)
                                
                                <tr>
                                    <td class="text-align:center;"><img class="img-thumbnail" src="{{ $product->image }}" width="70x" height="70px" onError="this.onerror=null;this.src='/assets/images/imagen-fallo.jpg';"></td>
                                    <td><a href="{{ $product->image }}">{{$product->name}}</a></td> 
                                    <td>${{number_format($product->price, 2, ',', '.')}}</td>
                                    <td>
                                        <div class="form-group">
                                            <input class="form-control" type="number" min="1" name="quantity[]"  style="width:80px; text-align:center; margin:0px auto;" required> 
                                        </div>
                                    </td>
                                
                                    
                                </tr>
                                @endforeach

                            </tbody>
                    
                    </table>
                    <br/>
                    @if(Auth::user()->role=='Ferretero')

                    <div id="divDistri"style="display: inline-block; float:left;" >

                        <div class="form-group">
                            <label for="seller_id">Distribuidor:</label>
                            <select class="form-control" name="seller_id" id="seller_id" >    
                                
                                @foreach($distributors as $distributor )

                                    <option value={{ $distributor->id }}>{{ $distributor->name }}</option>       

                                @endforeach


                            </select>
                        </div>
                    </div>
                    <div style="clear:both;"></div>

                    @endif
                    
                    <div id="addressComent" style="display: inline-block; float:left;">
                        <div class="form-group">
                            <label for="address">Dirección:</label>
                            <input class="form-control" type="text" name="address" required>
                        </div>
                        <div class="form-group">
                            <label for="coment">Comentario:</label>
                            <textarea  class="form-control" name="coment" ></textarea>
                        </div>
                    </div>
                    <!--
                    <div id="divTotal" style="display: inline-block; float:right; margin-top:0px" >
                        <label>Total:</label>
                        <span>2000000</span>
                    </div>
                    -->
                    <div style="clear:both;"></div>
                
                    <input type="hidden" name="_method" value="POST">
                    
                    <input type="submit" class="btn btn-info" width="300px" style="margin-top:30px; float:right;" value="Solicitar transferencia" 
                            @if(Auth::user()->role == 'Ferretero') onclick="return confirm('El distribuidor le enviara en breve una cotización con el valor final de su transferencia para que sea aprobada por usted');" @endif>
                    <div style="clear:both;"></div>
                </form>
            </div>
        </div>
    </div>

@endsection