<?php

namespace App\Http\Controllers;

use App\Models\PriceList;
use Facade\Ignition\Http\Controllers\ScriptController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PriceListController extends Controller
{
    public function index(Request $request)
    { 
      
        $data['lists'] = PriceList::where('role', $request->input('role'))->get();
        return view('lists.index',$data);
  
    }

    
    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $role =  $request;

       
        return view('lists.createList', $role);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) 
    {  

        $fields = [

            'name' =>'required|string|max:100',
            
        ];

        $message = ["required" => "El campo :attribute es requerido"];
        $this -> validate($request, $fields, $message);
        
         $listData = request()->except('_token');
        PriceList::insert($listData);  

        return redirect('/list/createList?role='.$request->role)->with('messageSuccess','Lista registrada con éxito');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Users  $Users
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Users  $Users
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
        
        $list = PriceList::findOrFail($id);

       

        
        
        return view('lists.editList',compact('list'));

    }

    public function form()
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Users  $Users
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        
        $listData = request()->except(['_token','_method']);
        PriceList::where('id','=',$id)->update($listData);

        return redirect('home')->with('Mensaje','La lista ha sido modificada con éxito');

    }

    
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Users  $Users
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $list = PriceList::findOrFail($id);
            
        $role = $list->role;

        if(Auth::user()->role=='Administrador'){

            PriceList::destroy($id);
    
            }
            
        return redirect('/lists?role='.$role)->with('deleteSuccess','Lista eliminada');
        

    }

    
} 
