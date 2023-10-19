<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produtos;

class ProductController extends Controller
{
    public function listProducts() {
    // Obtenha o usuário logado
        $user = auth()->user();

        // Verifique se o usuário está autenticado
        if ($user) {
            $search = request('search');
            $query = Produtos::where('user_id', $user->id);

            if ($search) {
                $query->where('nome', 'like', '%' . $search . '%');
            }

            $produtos = $query->get();

            return view('produtos.productList', ['produtos' => $produtos, 'search' => $search]);
        } else {
            // O usuário não está autenticado, redirecione para a página de login
            return redirect()->route('login');
        }
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

    public function productShow($id) {
    // Obtenha o produto pelo ID
    $produto = Produtos::findOrFail($id);
    $user = auth()->user();

    // Verifique se o produto pertence ao usuário logado
    if ($produto->user_id == $user->id) {
        return view('produtos.productShow', ['produto' => $produto]);
    } else {
        // Redirecione ou exiba uma mensagem de erro, pois o produto não pertence ao usuário logado
        return redirect()->route('login');
    }
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
               
            if($produto->image != 'null.png'){
                unlink(public_path('img/products/' . $produto->image));
            }            
            $requestImage = $request->image;
            $extension = $requestImage->extension();
            $imageName = md5($requestImage->getClientOriginalName() . strtotime("now") . "." . $extension);
            $requestImage->move(public_path('img/products'), $imageName);

            $data['image'] = $imageName;
        }
        Produtos::findOrFail($request->id)->update($data);

        return redirect('/produtos')->with('msg', 'Produto editado com sucesso');

    }

}
