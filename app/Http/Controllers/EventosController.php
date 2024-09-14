<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Models\Eventos;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class EventosController extends Controller
{
    //mostrar tela administrativa

    public function MostrarHome(){
        return view('homeadm');
    }

    //para mostrar tela de cadastro de eventos
    public function MostrarCadastroEvento(){
        return view('cadastroevento');
    }

    //para salvar os regristros na tabela eventos

    public function CadastrarEventos(request $request){ 
    $registros= $request-> validate([
        'nomeEvento' =>'string|required',
        'dataEvento' =>'date|required',
        'localEvento' =>'string|required',
        'imgEvento' =>'string|required',
    ]);

    Eventos::create ($registros);
    return Redirect::route('home-adm');
}

    //para apagar os registros da tabela de eventos
    public function destroy(Eventos $id){
        $id->delete();
        return Redirect::route('home-adm');
    }
    //para alterar os regristros
    
    public function uptade(Eventos $id){
        $registros= $request->validator([
            'nomeEvento' =>'string|required',
            'dataEvento' =>'date|required',
            'localEvento' =>'string|required',
            'imgEvento' =>'string|required',
        ]);
        $id->fill($registros);
        $id->save();

        return Redirect::route('home-adm');
    }

    //para mostrar somente os eventos por codigo
    public function MostrarEventoCodigo(Eventos $id){
        return view('altera-evento', ['registrosEvento'=>$id]);
    }

    //para buscar os eventos por nome
    public function MostrarEventoNome(){
        $registros = Eventos::query();
        $registros->when($request->nomeEvento,function($query,$valor){
            $query->where('nomeEvento', 'like','%');
        });
        $todosRegistros = $registros->get();
        return view('listEventos',['registroEvento'=>$todosRegistros]);
    }
}
