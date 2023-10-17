<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produtos;

class ProductController extends Controller
{
    public function listProducts(){

        $produtos = Produtos::All();
        return view('produtos.productList', ['produtos' => $produtos]);
    }
    
    public function productCreate(){
        return view('produtos.create_product');
    }

    public function ProductStore(Request $request){

        $produto = new Produtos;

        $produto->nome = $request->nome;
        $produto->categoria = $request->categoria;
        $produto->sub_categoria = $request->sub_categoria;
        $produto->custo = $request->custo;
        $produto->preco = $request->preco;
        $produto->marca = $request->marca;
        $produto->ativo_site = $request->input('ativo_site');
        

        // Image Upload
        if($request->hasFile('image') && $request->file('image')->isValid()){
               
            $requestImage = $request->image;
            $extension = $requestImage->extension();
            $imageName = md5($requestImage->getClientOriginalName() . strtotime("now") . "." . $extension);
            $requestImage->move(public_path('img/products'), $imageName);

            $produto->image = $imageName;
        }else{
            $produto->image = 'null.png';
        }

        $user = auth()->user();
        $produto->user_id = $user->id;
        $produto->save();

        return redirect('/produtos')->with('msg', 'Produto Criado');
    }

    public function productShow($id){

        $produto = Produtos::findOrFail($id);

        return view('produtos.productShow', ['produto' => $produto]);
    }

    public function productEdit($id) {

        $user = auth()->user();
        $produto = Produtos::findOrFail($id);
        if($user->id != $produto->user_id){
            return redirect('/dashboard');
        }else{
            return view('produtos.productEdit', ['produto' => $produto]);
        }        
    }

    public function productUpdate(Request $request) {

        $produto = Produtos::findOrFail($request->id);
        $data = $request->all();
        if($request->hasFile('image') && $request->file('image')->isValid()){
               
            unlink(public_path('img/events/' . $produto->image));
            $requestImage = $request->image;
            $extension = $requestImage->extension();
            $imageName = md5($requestImage->getClientOriginalName() . strtotime("now") . "." . $extension);
            $requestImage->move(public_path('img/events'), $imageName);

            $data['image'] = $imageName;
        }
        Produtos::findOrFail($request->id)->update($data);

        return redirect('/produtos')->with('msg', 'Produto editado com sucesso');

    }

}
