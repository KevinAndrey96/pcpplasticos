<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\PriceList;
use Facade\Ignition\Http\Controllers\ScriptController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;


class UsersController extends Controller
{
    //
    public function index(Request $request)
    {
        // si request input role == "all" entonces muestre Usr::all() si no, muestre la que ya está
        //$data['admins'] = User::where('role', $request->input('role'))->get();

        
        
        if($request->input('role')=='all'){
           
            $data['admins'] = User::all(); 
            return view('users.index',$data);

        }else{

            $data['admins'] = User::where('role', $request->input('role'))->get();
            return view('users.index',$data);
        
        }
        
       
        return $request;
        
        
    }

    
    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $distributorLists = PriceList::where('role', '=', 'Distribuidor')->get(); 
        $ironmongerLists = PriceList::where('role', '=', 'Ferretero')->get(); 

        return view('users.create',compact('distributorLists','ironmongerLists'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) 
    {  

    if(Auth::user()->role=='Administrador'){

        $fields = [
 
            'name' => 'required|string|max:100',
            'phone' => 'required|string|max:20',
            'email' => 'required|email',
            'country' => 'required|string|max:40',
            'city' => 'required|string|max:40',
            'establishment_name' => 'required|string|max:100',
            'password' => 'required',

         ];

         $message = ["required" => "El campo :attribute es requerido"];

         $this -> validate($request, $fields, $message);
        
         if($request->role == "Distribuidor"){

            $userData = request()->except('_token');

            
        if ($request->hasFile('image')) {
            $userData['image'] = $request->file('image')->store('images','public');
        }

        $userData['password'] = Hash::make($request->input('password'));
        User::insert($userData);  

        }elseif($request->role == "Ferretero"){

            $userData = request()->except('_token');

            if ($request->hasFile('image')) {
                $userData['image'] = $request->file('image')->store('images','public');
            }

            $userData['password'] = Hash::make($request->input('password'));
            User::insert($userData);  

        }else{
            
            $userData = request()->except(['_token','price_list_id']);

            if ($request->hasFile('image')) {
                $userData['image'] = $request->file('image')->store('images','public');
            }
            $userData['password'] = Hash::make($request->input('password'));
            User::insert($userData);    
       
        }
       return redirect('/users/create')->with('messageSuccess','Usuario registrado con éxito');
    }
        
      
     //return redirect('users.index',$role='all')->with('message','Usuario registrado con éxito');
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Users  $Users
     * @return \Illuminate\Http\Response
     */
    public function show(User $Users)
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
        
        $user = User::findOrFail($id);
        $distributorLists = PriceList::where('role', '=', 'Distribuidor')->get(); 
        $ironmongerLists = PriceList::where('role', '=', 'Ferretero')->get(); 
        $listID = $user->price_list_id;

        
        if(empty($listID)){
            $list=null;
            return view('users.edit', compact('user','distributorLists','ironmongerLists','list'));
        }else{

            $list = PriceList::findOrFail($listID);
            return view('users.edit', compact('user','distributorLists','ironmongerLists','list'));
        }
        
         

    }

    public function form(User $Users)
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

        if(Auth::user()->role=='Administrador'){

            if(isset($request->password)==false){

                $userData = request()->except(['_token','_method','password']);

                if ($request->hasFile('image')) {
                    $userData['image'] = $request->file('image')->store('images','public');
                }
        
                User::where('id','=',$id)->update($userData);
                return redirect('/users/'.$id.'/edit')->with('messageSuccess','Empleado Modificado con éxito'); 


            }else{

                $userData = request()->except(['_token','_method']);

                if($request->hasFile('image')){
                    $userData['image'] = $request->file('image')->store('images','public');
                }
        
                $userData['password'] = Hash::make($request->input('password'));
                User::where('id','=',$id)->update($userData);
        
                return redirect('/users/'.$id.'/edit')->with('messageSuccess','Empleado Modificado con éxito'); 


            }
       
       

    }

    }

    
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Users  $Users
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);

        $role = $user->role;


        if(Auth::user()->role=='Administrador'){

        User::destroy($id);

        }

        return redirect('/users?role='.$role)->with('deleteSuccess','El usuario ha sido eliminado');

    }

    public function passwordEdit($id)
    {

        $user = User::findOrFail($id);

        return view('users.passwordEdit', compact('user'));
    }

    
    
    public function passwordUpda(Request $request)
    {
        
        $user = User::findOrFail(Auth::user()->id);
        $id = $user->id;
        $oldPass = $request->oldPass;
        $oldPass2 = Auth::user()->password;

        if (Hash::check($oldPass, $oldPass2 )){
            if($request->input('newPass1') == $request->input('newPass2')){

                $user->password = Hash::make($request->input('newPass1'));
                $user->save();
                
                return redirect('/users/'.Auth::user()->id.'/passwordEdit')->with('messageSuccess','Contraseña modificada con éxito');

            }else{

                return redirect('/users/'.Auth::user()->id.'/passwordEdit')->with('failChange','No se pudo cambiar la contraseña');
            }
            }else{

            return redirect('/users/'.Auth::user()->id.'/passwordEdit')->with('failChange','No se pudo cambiar la contraseña');

        }
        
    }









}
