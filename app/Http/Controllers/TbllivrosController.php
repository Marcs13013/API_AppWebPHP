<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Http\Support\Facades\Validator;

use App\Models\tbllivros;

class TbllivrosController extends Controller
{
    //construir o crud.

    //Mostrar todos os registros da tabela livros
    //Crud -> Read(leitura) Select/Visualizar

    public function index()
    {
        $regBook = tbllivros::All();
        $contador = $regBook->count();

        return 'Livros: ' . $contador . $regBook . Response()->json([], Response::HTTP_NO_CONTENT);
    }

    //Mostrar um tipo de registro especifico
    //Crud -> Read(leitura) Select/Visualizar

    //Função show busca o id, verifica se existe elementos dentro da variável e mostra os resultados encontrados e não encontrados 
    public function show(string $id)
    {
        $regBook = tbllivros::find($id);

        if ($regBook) {
            return 'Livros Localizados: ' . $regBook . Response()->json([], Response::HTTP_NO_CONTENT);
        } else {
            return 'Livros Não Localizados: ' . Response()->json([], Response::HTTP_NO_CONTENT);
        }
    }

    //Cadastrar registros
    //Crud -> Create(criar/cadastrar)
    public function store(Request $request)
    {
        $regBook = $request->All();

        $regVerify = Validator::make($regBook, [
            'nomeLivro' => 'required',
            'generoLivro' => 'required',
            'anoLivro' => 'required'
        ]);

        if ($regVerify->fails()) {
            return 'Registros Inválidos: ' . Response()->json([], Response::HTTP_NO_CONTENT);

        }
        $regBookCad = tbllivros::create($regBook);

        if ($regBookCad) {
            return 'Livros Cadastrados: ' . Response()->json([], Response::HTTP_NO_CONTENT);
        } else {
            return 'Livros Não Cadastrados: ' . Response()->json([], Response::HTTP_NO_CONTENT);

        }

    }

    //Alterar registros
    //Crud -> update(alterar)
    public function update(Request $request, string $id)
    {

        $regBook = $request::All();
        
        $regVerify = Validator::make($regBook, [
            'nomeLivro'=> 'required',
            'generoLivro'=> 'required',
            'anoLivro'=> 'required'
        ]);

        if ($regVerify->fails()) {
            return 'Registros não atualizados ' . Response()->json([], Response::HTTP_NO_CONTENT);

        }

        $regBookBanco = tbllivros::find($id);
        $regBookBanco->nomeLivro=['nomeLivro'];
        $regBookBanco->generoLivro=['generoLivro'];
        $regBookBanco->anoLivro=['anoLivro'];

        $retorno = $regBookBanco->save();

        if ($retorno) {
            return 'Livro atualizado com sucesso'.Response()->json([], Response::HTTP_NO_CONTENT);
        }else {
            return 'Houve um erro, o livro não foi atualizado'.Response()->json([], Response::HTTP_NO_CONTENT);
        }

        
    }

    //Deletar os registros
    //Crud -> delete(apagar)
    public function destroy(string $id)
    {

        $regBook = tbllivros::Find($id);

        if ($regBook->delete) {
            return "O livro foi deletado com sucesso" . response()->json([], Response::HTTP_NO_CONTENT);
        }
        return "Algo deu errado, o livro não foi deletado" . response()->json([], Response::HTTP_NO_CONTENT);
    }

    //Crud
    //C reate
    //r ead
    //u pdate
    //d elete

}
