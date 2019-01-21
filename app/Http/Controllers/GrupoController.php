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

class GrupoController extends Controller
{
    //
    public function index(){
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
            $orderby = 'nome';
        }
        
        $grupos = \App\Grupo::withCount('clique')
            ->where('nome','like',Input::get('letra', '').'%')
            ->where('nome','like','%'.Input::get('titulo', '').'%')
            ->orderBy($orderby,$order)
            ->paginate((is_int(Input::get('qntp', '12'))) ? Input::get('qntp', '12') : '12');
        $grupos = $grupos->appends(Input::except('page'));
        //Footer
        $populares = \App\Novel::withCount('clique')
            ->with('genero')
            ->with('avgRating')
            ->orderBy('clique_count','DESC')
            ->take(5)
            ->get();
        return view('grupos',compact('grupos','populares'));
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
            $grupo = \App\Grupo::where('url',$url)
                ->with('avgRating')
                ->withCount('nota')
                ->firstOrFail();
            $recomendados = \App\Novel::with('genero')->find(\App\Recomendado::find([1,2])->pluck('novel_id')->toArray());
            //Grupo CLique
                $GClique = new \App\GClique;
                $GClique->ip = $this->getIp();
                if(Auth::check()){
                    $GClique->user_id = Auth::user()->id;
                }
                $GClique->grupo_id = $grupo->id;
                $GClique->save();
            $noticia = \App\Feed::where('titulo','like','%'.$grupo->nome.'%')
            ->with('grupo')
            ->orderBy('published_at','desc')
            ->first();
                //Footer
            $populares = \App\Novel::withCount('clique')
            ->with('genero')
            ->with('avgRating')
            ->orderBy('clique_count','DESC')
            ->take(5)
            ->get();
            /*$noticia = \App\Feed::where('categoria_id','2')
                ->where('novel_id',$novel->id)
                ->orderBy('published_at','Desc')
                ->first();*/
            return view('grupo',compact('grupo','populares','noticia','recomendados'));
        }catch (ModelNotFoundException $ex) {
        // Error handling code
        }
    }
    //DashBoard

    protected function validator(array $data,$id){
        return Validator::make($data, [
            //Informações Pessoais
            'nome' => 'required|string|max:100|unique:grupos,nome,'.$id,
            'patrocinar' => 'nullable|string|max:200',
            'site' => 'required|string|max:200',
            'feed' => 'required|string|max:200',
            'descricao' => 'nullable|string|max:1500',
            'categoria' => 'required|exists:categorias,id',
            'status' => [
                'required',
                Rule::in(['pendente', 'ativado','desativado']),
            ],
            'capa' => 'nullable|mimes:jpeg,jpg,png|max:500',

        ]);
    }

    public function adicionarForm(){
        try{
            $categorias = \App\Categoria::orderBy('nome','asc')->get();
            $array_status = ['pendente', 'ativado','desativado'];
            return view('dashboard.grupo.form',compact('categorias','array_status'));
        }catch (ModelNotFoundException $ex) {
        // Error handling code
        }
    }

    public function alterarForm($id){
        try{
            $grupo = \App\Grupo::findOrFail($id);
            $categorias = \App\Categoria::orderBy('nome','asc')->get();
            $array_status = ['pendente', 'ativado','desativado'];
            return view('dashboard.grupo.form',compact('grupo','categorias','array_status'));
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
                $grupo = \App\Grupo::findOrFail($id);
            }else{
                $grupo = new \App\Grupo;
            }
            
            $grupo->nome = $request->input('nome');
            $grupo->patrocinar = $request->input('patrocinar');
            $grupo->site = $request->input('site');
            $grupo->feed = $request->input('feed');
            $grupo->descricao = $request->input('descricao');
            $grupo->categoria_id = $request->input('categoria');
            $grupo->status = $request->input('status');
            if(is_null($grupo->url) or $grupo->url == ""){
                $grupo->url = $grupo->nome;
            }
            $slug = false;
            //Gera URL Unica
            for($i=0;$slug == false;$i++){
                if(\App\Grupo::where('id','<>',$id)->where('url', str_slug($grupo->url))->count() == 0){
                    $grupo->url = str_slug($grupo->url);
                    $slug  = true;
                    break;
                }else{
                    if(\App\Grupo::where('id','<>',$id)->where('url', str_slug($grupo->url).'-'.$i)->count() == 0){
                        $grupo->url = str_slug($grupo->url).'-'.$i;
                        $slug  = true;
                        break;
                    }
                }
            }
            $grupo->save();
            if ($request->hasFile('capa')) {
                $grupo->capa = $repo->saveImage($request->capa,['300','300'],'grupos/',$grupo->url);
                $grupo->save();
            }
        }catch (ModelNotFoundException $ex) {

        }
    }
}
