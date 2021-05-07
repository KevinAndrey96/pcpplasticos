@extends('layouts.dashboard')
@section('content')

@if(Session::has('messageSuccess'))

<div class="alert alert-success" role="alert">

  {{ Session::get('messageSuccess') }}

</div>

  

@endif

<div class="card">
    <div class="card-header">
        
        Productos
    
    </div>


    <div class="card-body">
        <div class="row justify-content-center" >
            <div class="col-auto mt-5">
                <form action="{{ url('/orderProducts') }}" method="POST">
                    @csrf
                    <table class="table table-bordered table-responsive justify-content-center" id="datatable" cellspacing="0">
                            <thead class="thead-light">
                                <tr>
                                    <th>Selección</th>
                                    <th>Imagen</th>
                                    <th>Id</th>
                                    <th>Nombre</th>
                                    <th>Precio</th>
                                    <th>Código</th>
                                    
                    
                                </tr>
                            </thead>
                            <tbody>
                            
                                @foreach($products as $product)
                                <tr>
                                    <td>
                                        <div class="form-group">
                                            
                                            
                                            <input type="checkbox" class="form-check-input " id="customCheck{{ $product->id }}" style="margin-left:40px;" name="customCheck[]" value="{{ $product->id }}" onclick="getIDS({{ $product->id }})">
                                            <label class="form-check-label" for="customCheck[]"></label>
                                            
                                        </div>
                                    </td>
                                    <td style="text-align:center;"><img class="img-thumbnail" src="{{ $product->image }}" width="70x" height="70px" onError="this.onerror=null;this.src='/assets/images/imagen-fallo.jpg';"></td>
                                    <td>{{$product->id}}</td>
                                    <td><a href="{{ $product->image }}">{{$product->name}}</a></td>
                                    <td>${{number_format($product->price, 2, ',', '.')}}</td>
                                    <td>{{$product->code}}</td>
                                    
                                </tr>
                                @endforeach

                            
                            </form>
                            </tbody>
                    
                    </table>
                    <!--EMMET-->
                    <input type="hidden" name="cart" id="cart">
                    <input type="submit" class="btn btn-info" width="300px" style="margin-top:40px; float:right;" value="Continuar al carrito">
                </form>
            </div>
        </div>
        </div>
        </div>

        <script type="text/javascript">
            var ids = new Array();
            function getIDS(productID)
            {
                var box = document.getElementById("customCheck"+productID);
                var cart = document.getElementById("cart");
                if (box.checked == true) {
                    ids.push(productID);
                } else {
                    ids.pop(productID);
                }
                var selections = Object.assign({},ids);
                cart.value = ids;
                
            }
            
            
        </script>

@endsection