<?php

namespace App\Http\Controllers;

//use Request;
use Illuminate\Support\Facades\Input;
use Auth;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use App\Repositories\ImageRepository;
use Illuminate\Validation\Rule;
class NovelController extends Controller
{
    public function index(){
        $populares = \App\Novel::withCount('clique')
        ->with('genero')
        ->with('avgRating')
        ->orderBy('clique_count','DESC')
        ->take(5)
        ->get();
            
        $orderby = Input::get('classificacao', '0');
        $order = 'asc';
        if($orderby == 1){
            //cliquecount
            $orderby= 'clique_count';
            $order = 'desc';
        }elseif($orderby == 2){
            $orderby = 'created_at';
            $order = 'desc';
        }else{
            $orderby = 'titulo';
        }
        if(Input::get('genero', null) != null){
            $novels = \App\Novel::withCount('clique')
                ->where('titulo','like',Input::get('letra', '').'%')
                ->where('titulo','like','%'.Input::get('titulo', '').'%')
                ->where('linguagem_id',(Input::get('linguagem', null) == null ? '<>':'='),Input::get('linguagem',null))
                ->where('tipo_id',(Input::get('tipo', null) == null ? '<>':'='),Input::get('tipo',null))
                ->with('genero')
                ->whereHas('genero', function ($query) {
                    $genero_param01 = '<>';
                    $genero_param02 = Input::get('genero', null);
                    if($genero_param02 != null){
                        $genero_param01 = '=';
                        $query->where('genero_id', $genero_param01, $genero_param02);
                    }
                })
                ->orderBy($orderby,$order)
                ->paginate((Input::get('qntp', '12')) ? Input::get('qntp', '12') : '12');
        }else{
            $novels = \App\Novel::withCount('clique')
                ->where('titulo','like',Input::get('letra', '').'%')
                ->where('titulo','like','%'.Input::get('titulo', '').'%')
                ->where('linguagem_id',(Input::get('linguagem', null) == null ? '<>':'='),Input::get('linguagem',null))
                ->where('tipo_id',(Input::get('tipo', null) == null ? '<>':'='),Input::get('tipo',null))
                ->with('genero')
                ->orderBy($orderby,$order)
                ->paginate((Input::get('qntp', '12')) ? Input::get('qntp', '12') : '12');
        }
        $novels = $novels->appends(Input::except('page'));
        $generos = \App\Genero::orderBy('nome','asc')->get();
        $linguagens = \App\Linguagem::orderBy('nome','asc')->get();
        $tipos = \App\Tipo::orderBy('nome','asc')->get();
        return view('novels',compact('novels','similares','populares','generos','linguagens','tipos'));
    }
    
    public function getIp(){
        foreach (array('HTTP_CLIENT_IP', 'HTTP_X_FORWARDED_FOR', 'HTTP_X_FORWARDED', 'HTTP_X_CLUSTER_CLIENT_IP', 'HTTP_FORWARDED_FOR', 'HTTP_FORWARDED', 'REMOTE_ADDR') as $key){
            if (array_key_exists($key, $_SERVER) === true){
                foreach (explode(',', $_SERVER[$key]) as $ip){
                    $ip = trim($ip); // just to be safe
                    if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE) !== false){
                        return $ip;
                    }
                }
            }
        }
    }

    public function perfil($url){
        try{
            $novel = \App\Novel::where('url',$url)
                ->with('genero')
                ->with('tipo')
                ->with('linguagem')
                ->with('avgRating')
                ->withCount('nota')
                ->firstOrFail();
            $recomendados = \App\Novel::with('genero')->find(\App\Recomendado::find([1,2])->pluck('novel_id')->toArray());
            //Novel CLique
            $NClique = new \App\NClique;
            $NClique->ip = $this->getIp();
            if(Auth::check()){
                $NClique->user_id = Auth::user()->id;
            }
            $NClique->novel_id = $novel->id;
            $NClique->save();
            //Footer
            $populares = \App\Novel::withCount('clique')
            ->with('genero')
            ->with('avgRating')
            ->orderBy('clique_count','DESC')
            ->take(5)
            ->get();
            $noticia = \App\Feed::where('categoria_id','2')
                ->with('grupo')
                ->where('novel_id',$novel->id)
                ->orderBy('published_at','Desc')
                ->first();
            return view('novel',compact('novel','recomendados','populares','noticia'));
        }catch (ModelNotFoundException $ex) {
        // Error handling code
        }
    }

    protected function validator(array $data,$id){
        return Validator::make($data, [
            //Informações Pessoais
            'titulo' => 'required|string|max:100|unique:novels,titulo,'.$id,
            'sigla' => 'nullable|string|max:20|unique:novels,sigla,'.$id,
            'autor' => 'nullable|string|max:100',
            'tradutor' => 'nullable|string|max:100',
            'editor' => 'nullable|string|max:100',
            'genero.*' => 'exists:generos,id',
            'linguagem' => 'required|exists:linguagens,id',
            'tipo' => 'required|exists:tipos,id',
            'status' => [
                'required',
                Rule::in(['pendente', 'ativado','desativado']),
            ],
            'capa' => 'nullable|mimes:jpeg,jpg,png|max:50',

        ]);
    }

    public function adicionarForm(){
        try{
            $linguagens = \App\Linguagem::orderBy('nome','asc')->get();
            $tipos = \App\Tipo::orderBy('nome','asc')->get();
            $generos = \App\Genero::orderBy('nome','asc')->get();
            $array_status = ['pendente', 'ativado','desativado'];
            return view('dashboard.novel.form',compact('linguagens','generos','array_status','tipos'));
        }catch (ModelNotFoundException $ex) {
        // Error handling code
        }
    }

    public function alterarForm($id){
        try{
            $linguagens = \App\Linguagem::orderBy('nome','asc')->get();
            $generos = \App\Genero::orderBy('nome','asc')->get();
            $tipos = \App\Tipo::orderBy('nome','asc')->get();
            $novel = \App\Novel::findOrFail($id);
            $array_status = ['pendente', 'ativado','desativado'];
            return view('dashboard.novel.form',compact('novel','linguagens','generos','array_status','tipos'));
        }catch (ModelNotFoundException $ex) {
        // Error handling code
        }
    }

    public function store(Request $request, $id = null){
        $validator = $this->validator($request->all(),$id);

        if ($validator->fails()) {
            $errors = $validator->errors();
            return back()
                ->withErrors($validator)
                ->withInput();
        }
        $this->create($request,new ImageRepository,$id);
        return back();
    }

    public function create(Request $request,ImageRepository $repo, $id = null){
        try{
            if(isset($id) and $id != null){
                $novel = \App\Novel::findOrFail($id);
            }else{
                $novel = new \App\Novel;
            }
            
            $novel->titulo = $request->input('titulo');
            $novel->sigla = $request->input('sigla');
            $novel->autor = $request->input('autor');
            $novel->tradutor = $request->input('tradutor');
            $novel->editor = $request->input('editor');
            $novel->sinopse = $request->input('sinopse');
            $novel->linguagem_id = $request->input('linguagem');
            $novel->status = $request->input('status');
            $novel->tipo_id = $request->input('tipo');
            $novel->genero()->sync($request->input('genero'));
            if(is_null($novel->url) or $novel->url == ""){
                $novel->url = $novel->titulo;
            }
            $slug = false;
            //Gera URL Unica
            for($i=0;$slug == false;$i++){
                if(\App\Novel::where('id','<>',$id)->where('url', str_slug($novel->url))->count() == 0){
                    $novel->url = str_slug($novel->url);
                    $slug  = true;
                    break;
                }else{
                    if(\App\Novel::where('id','<>',$id)->where('url', str_slug($novel->url).'-'.$i)->count() == 0){
                        $novel->url = str_slug($novel->url).'-'.$i;
                        $slug  = true;
                        break;
                    }
                }
            }
            $novel->save();
            if ($request->hasFile('capa')) {
                $novel->capa = $repo->saveImage($request->capa,['300','400'],'novels/',$novel->url);
                $novel->save();
            }
        }catch (ModelNotFoundException $ex) {

        }
    }
}
