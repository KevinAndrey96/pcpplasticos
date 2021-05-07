<?php

namespace App\Http\Controllers;
use App\Models\Product;
use App\Models\PriceList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ProductsExport;
use App\Imports\ProductsImport;

class ProductsController extends Controller
{
    public function index(Request $request, $id)
    {
        $products = Product::where('list_id','=',$id)->get();
        $list = PriceList::findOrFail($request->id);

        return view('products.index',compact('products','list'));
    }

    public function create(Request $request, $id)
    {
        $list = PriceList::findOrFail($request->id);
        return view('products.create',compact('list'));
    }


    public function store(Request $request)
    {
        $fields = [
            'name'=>'required|string|max:100',
            'price'=>'required',
            //'image'=>'required',
            'code'=>'required',
        ];

        $message = ["required" => "El campo :attribute es requerido"];
        $this->validate($request, $fields, $message);
        $product = request()->except('_token');
        Product::insert($product);

        return redirect('/products/create/'.$request->list_id)->with('messageSuccess','Producto registrado con éxito');
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        return view('products.edit',compact('product'));
    }

    public function update( Request $request, $id)
    {
        $producttData = request()->except(['_token','_method']);
        Product::where('id','=',$id)->update($producttData);
        $product = Product::findOrFail($id);
        return redirect('/products/'.$id.'/edit')->with('message','El producto ha sido modificada con éxito');
    }

    public function destroy(Product $product)
    {
       // $product->delete();
        //$product = Product::findOrFail($id);
        //$list_id = $product->list_id;
        //if (Auth::user()->role == 'Administrador') {
        //    Product::destroy($id);
        //}

        //return redirect('/products/'.$list_id)->with('deleteSuccess','Producto eliminado');
        if (Auth::user()->role == 'Administrador') {
            $product = Product::find($product->id);
            $list = $product->list;
            $product->delete();
        }
        return redirect('/products/'.$list->id)->with('deleteSuccess','Producto eliminado');
    }

    public function productsDistriIron()
    {
        $listId = Auth::user()->price_list_id;
        $products = Product::where('list_id','=',$listId)->get();
        return view('productsDistIron.index', compact('products'));
    }

    

    public function chooseList(Request $request) 
    {
       if ($request->id == 'all') 
       {
            return view('lists.chooseList')->with('id', $request->id);
       } else {
            $list = PriceList::findOrFail($request->id);
            return view('lists.chooseList', compact('list'));
       }
    }
    
    public function export($id) 
    {
        if ($id == 'all') 
        {
            return Excel::download(new ProductsExport($id), 'LISTA DE PRECIOS GENERAL.xlsx');
        } else {
            $list = PriceList::findOrFail($id);
            return Excel::download(new ProductsExport($id), $list->name.'.xlsx');
        }
    }
    
    public function import(Request $request, $id)
    {
        $file = $request->file('list');
        Excel::import(new ProductsImport($id), $file);
        return back()->with('messageSuccess', 'Importación de productos satisfactoria');
    }
}
