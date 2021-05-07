@extends('layouts.dashboard')
@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    
    @if(Session::has('messageSuccess'))
  
      <div class="alert alert-success" role="alert">
  
        {{ Session::get('messageSuccess') }}
  
      </div>
    
        
    
    @endif
        
  </div>

<div class="card">
    <div class="card-header">
       Elegir lista 
    </div>
    <div class="card-body">
        
        <div class="row d-flex justify-content-center">
                <div class="form-group">

                    

                    <form @if(isset($id)) action="{{ url('importProducts/'.$id) }}" @else action="{{ url('importProducts/'.$list->id) }}"  @endif  method="post" enctype="multipart/form-data">
                        @csrf
                        
                        <input class="form-control" type="file" name="list" id="list" style="margin:10px;">
                        <input class="btn btn-sm btn-info form-control"type="submit" value="Importar" width="70px !important" style="margin:10px; width:70px; float:right;"> 

                    </form>
                
                </div>    
                </div> 
                </div>
@endsection