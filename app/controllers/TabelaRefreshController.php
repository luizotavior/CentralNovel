<?php 

//----------------------------------//
require 'app/dao/conexaoDao.php';
require 'app/dao/guardar_feedDao.php';
require 'app/dao/gruposDao.php';
require 'app/dao/timeDao.php';
require 'app/dao/novelsDao.php';
$conexaoDao = new conexaoDao;
$centro = "app/views/sistemaView.php";
$con = $conexaoDao->conexao();
$timeDao = new timeDao;
//----------------------------------------//
echo "Sistema, Iniciando... <br> <br>";
function remove_emoji($text){
    return preg_replace('/([0-9|#][\x{20E3}])|[\x{00ae}|\x{00a9}|\x{203C}|\x{2047}|\x{2048}|\x{2049}|\x{3030}|\x{303D}|\x{2139}|\x{2122}|\x{3297}|\x{3299}][\x{FE00}-\x{FEFF}]?|[\x{2190}-\x{21FF}][\x{FE00}-\x{FEFF}]?|[\x{2300}-\x{23FF}][\x{FE00}-\x{FEFF}]?|[\x{2460}-\x{24FF}][\x{FE00}-\x{FEFF}]?|[\x{25A0}-\x{25FF}][\x{FE00}-\x{FEFF}]?|[\x{2600}-\x{27BF}][\x{FE00}-\x{FEFF}]?|[\x{2900}-\x{297F}][\x{FE00}-\x{FEFF}]?|[\x{2B00}-\x{2BF0}][\x{FE00}-\x{FEFF}]?|[\x{1F000}-\x{1F6FF}][\x{FE00}-\x{FEFF}]?/u', '', $text);
}

function pubdatetotime($pubDate) {

    $months = array('Jan' => '01', 'Feb' => '02', 'Mar' => '03', 
        'Apr' => '04', 'May' => '05', 'Jun' => '06', 
        'Jul' => '07', 'Aug' => '08', 'Sep' => '09', 
        'Oct' => '10', 'Nov' => '11', 'Dec' => '12');

    $date = substr($pubDate, 5,11);
    $year = substr($date, 7,4); 
    $month = substr($date, 3,3);
    $d =  substr($date, 0,2);

    $time = substr($pubDate, 17,8);

    return $year."-".$months[$month]."-".$d." ".$time;  
}
//-----------------------------------------------------------//

//$timeDao->reset($con);

$gruposDao = new gruposDao;
$grupos = $gruposDao->buscarAtivos($con);
foreach ($grupos as $grupo) {
    try {
        $contador = 0;
        $feed = file_get_contents($grupo->getFeed());
        echo $grupo->nome."[".$grupo->id."] ... ";
        $rss = new SimpleXmlElement($feed);
        if (is_array($rss) || is_object($rss)){
            foreach($rss->channel->item as $entrada) {

//utf8_decode();
                $titulo = remove_emoji($entrada->title);
//$descricao = $entrada->description;
                $Data = $entrada ->pubDate;
                $link = $entrada->link;

                $dados[] =
                [
                "Tradutora"         =>$grupo->getId(),
                "Título"          => $titulo,
                "Data"          => $Data,
                "link"          => $link,
                ];
                $contador++;

            }
        }
        echo "OK!<br>";
    } catch (Exception $e) {
        echo "Failed! <br>".$e."<br>";
    }
}
// Array com o nome de todas as colunas ("nome", "Data", etc.)
$cols = array_keys($dados[0]);

//Ordenador

function sortByDate($a, $b) {
    $a['Data'] = strtotime($a['Data']);
    $b['Data'] = strtotime($b['Data']);
    if ($a['Data'] == $b['Data']) {
        return 0;
    }
    return ($a['Data'] > $b['Data']) ? -1 : 1;
}


usort($dados, 'sortByDate');


// Mostrar o resultados em uma tabela HTML

?>





<?php
$novelsDao = new novelsDao;
$novels = new novelsModel;
$novels = $novelsDao->buscarAll($con);
//$conexaoDao->sqlRun($con,"TRUNCATE guardar_feed");
foreach ($dados as $lin) {
    $postar = true;
    $guardar_feedDao = new guardar_feedDao;
    $noticia = new guardar_feedModel;
    $noticia->_setTitulo($lin['Título']);
    $noticia->_setGrupo($lin['Tradutora']);
    $noticia->_setLink($lin['link']);
    $noticia->_setData(pubdatetotime($lin['Data']));
    foreach ($guardar_feedDao->buscarAll($con) as $res) {
        if($res->getData() == $noticia->getData() && $res->getTitulo() == $noticia->getTitulo() ){
            echo 'Repetido <br>';
            $postar = false;
        }

    }

    if ($postar) {
        $texto = TextoAmigavel($lin['Título']);
        $titulo = explode(' ', $texto);
        $capitulo = "";
        $volume = 0;
        $parte = "";
        $capAlternativo = "";
        $encontrou = false;
        $id = 1;

        for ($i=0; $i < count($titulo) ; $i++) { 

            echo "$titulo[$i]|";
//Metodo de Reconhecimento de Novela

            foreach ($novels as $novel) {
                if($novel->getChave() != null){
                    $nome = explode(" ", TextoAmigavel($novel->getNome()));

                    if(isset($titulo[$i+count($nome)-1])){

                        $tamanho = true;
                    }else{$tamanho = false;}

                    $acerto = 0;
                    for ($k=0; $k < count($nome); $k++) { 
                        if ($tamanho) {
                            if($titulo[$i+$k] == $nome[$k]){
                                $acerto++;
                            }

                        }
                    }
                    if ($acerto == count($nome)) {
                        $id = $novel->getId();
                    }else{
                        $chaves = explode(";",TextoAmigavel($novel->getChave()));
                        foreach ($chaves as $chave) {
                            if($titulo[$i] == $chave){
                                $id = $novel->getId();
                            }
                        }
                        
                    }

                    

                }
            }
//Fim
// Metodo de Reconhecimento de Volumes/Capitulos/Partes
            if($titulo[$i] == "volume" or $titulo[$i] == "vol" or $titulo[$i] == "livro" or $titulo[$i] == "book"){
                $volume = $titulo[$i+1];
            }elseif(($titulo[$i] == "capitulo" or $titulo[$i] == "cap") and is_numeric($titulo[$i+1])){
                $capitulo = $titulo[$i+1];
                $encontrou = true;
            }elseif($titulo[$i] == "parte"){
                $parte = $titulo[$i+1];
            }elseif(($titulo[$i] == "e" or $titulo[$i] == "/")and (isset($titulo[$i+1]) and is_numeric($titulo[$i+1]))){
                if(isset($capitulo)){
                    $capitulo = $capAlternativo;
                }
                $capitulo = $capitulo."and".$titulo[$i+1];
                $encontrou = true;
            }
            if(is_numeric($titulo[$i])){
                if($capAlternativo == ""){
                    $capAlternativo = $titulo[$i];
                }else{
                    $capAlternativo = $capAlternativo."-".$titulo[$i];
                }
            }
//Fim


            $limite =  count($titulo) - 1;
            if($encontrou == false and $i == $limite){
                for ($x=0; $x < count($titulo) ; $x++) { 
                    $capitulo = $capAlternativo;
                    $encontrou = true;
                }
            }
        }
        echo '<b>   SISTEMA:   </b>';
        if($volume != ""){
            echo " Volume: $volume";
        }
        if($capitulo != ""){
            echo " Capitulo: $capitulo";
        }
        if($parte != ""){
            echo " Parte : $parte";
        }
        if ($volume == "" and $capitulo == "" and $parte == "") {
            echo "NULLO";
        }
        echo " ID: $id";
        echo "<BR>";

        $noticia->_setNovel($id);
        $noticia->_setVolume($volume);
        $noticia->_setCapitulo($capitulo);
        $noticia->_setParte($parte);
//$novelsDao->atualizarDataLast($con,$noticia->getGrupo());
        $guardar_feedDao->adicionarNoticia($con,$noticia);
    }
}

echo "<br> Sistema, Finalizado!";

//$timeDao->adicionarTime($con);

/*$dominio= $_SERVER['HTTP_HOST'];
$url = "http://" . $dominio. $_SERVER['REQUEST_URI'];
echo "<meta HTTP-EQUIV='refresh' CONTENT='5;URL=$url'>";*/
?>