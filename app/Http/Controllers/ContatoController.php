<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ContatoController extends Controller
{
    public function index()
    {
        $populares = \App\Novel::withCount('clique')
        ->with('genero')
        ->with('avgRating')
        ->orderBy('clique_count','DESC')
        ->take(5)
        ->get();
        return view('contato',compact('populares'));
    }
    protected function validator(array $data){
        return Validator::make($data, [
            //Informações Pessoais
            'nome' => 'required|string|max:100',
            'email' => 'required|email',
            'assunto' => 'required|string|max:100',
            'mensagem' => 'required|string|max:10000',

        ]);
    }

    public function sendEmail(Request $request){
        $validator = $this->validator($request->all());

        if ($validator->fails()) {
            $errors = $validator->errors();

            return back()
                ->withErrors($validator)
                ->withInput();
        }
        $this->send($request);
        return back();
    }

    public function send(Request $request){
        $beautymail = app()->make(\Snowfire\Beautymail\Beautymail::class);
        $beautymail->send('emails.obrigadoContato', [
            'nome' => $request->input('nome')
        ], function($message) use ($request){
            $message
                ->from('luiz@centralnovel.com.br')
                ->to($request->input('email'), $request->input('nome'))
                ->subject('Obrigado por entrar em Contato');
        });
        $beautymail->send('emails.envioContato', [
            'nome' => $request->input('nome'),
            'email' => $request->input('email'),
            'assunto' => $request->input('assunto'),
            'mensagem' => $request->input('mensagem')
        ], function($message) use ($request){
            $message
                ->from('luiz@centralnovel.com.br')
                ->to('luiz.otavior18@gmail.com', 'Luiz Otávio Rodrigues')
                ->subject('[CentralNovel] - '.$request->input('assunto'));
        });
    }
}
