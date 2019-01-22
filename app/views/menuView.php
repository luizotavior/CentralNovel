 <!-- Fixed navbar -->
<nav class="navbar navbar-inverse navbar-static-top " style="margin-top: -20px;">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="<?=$base?>Home" style="padding: 10px;"><img src="<?=$base?>app/www/images/logo.png" title="Central Novel Logo Branca"></a>
        </div>
        <div id="navbar" class="navbar-collapse collapse" aria-expanded="false">
          <ul class="nav navbar-nav">
          <?php
 
            //Define os Menus que o Site terá, caso tenha mais de 1 String por Array, será adicionado um DropDown,
            //Caso defina um DropDown com uma String 'separador', será adicionado um separador no Menu.
            $valor = array(
              array("Home"),
              array("Grupos"),
              array("Novels"),
              //array('DropDown','cat1','cat2','separador','joao','maria'),
              array("Forum"),
              array("Publicidade"),
              array("Sobre"),
              array("Contato"),
              );
            $target = array(
              array(false),
              array(false),
              array(false),
              //array(false,false,false,false,false,false),
              array(true),
              array(false),
              array(false),
              array(false),
              );
            //Verifica se na Url contem alguma informação, caso nao tenha´, é adicionado o 'home' como padrão.
            $url = isset( $_GET['url'] ) ? $_GET['url'] : 'home';
            $url = LinkAmigavel($url);
            for ($i=0; $i < count($valor); $i++) {
            $drop = false; 
              for ($j=0; $j < count($valor[$i])  ; $j++) { 


                if(isset($valor[$i][$j]) && !isset($valor[$i][1])){
                  //Bloco que pega a URL e ativa o Menu conrespondente.
                  $aux = $url == LinkAmigavel($valor[$i][$j]) ? 'class="active"' : '';
                  if($target[$i][$j]){
                    echo '
                        <li '.$aux.'><a href="'.$base.$valor[$i][$j].'" target="_blank">'.$valor[$i][$j].'</a></li>
                  ';
                  }else{echo '
                        <li '.$aux.'><a href="'.$base.$valor[$i][$j].'">'.$valor[$i][$j].'</a></li>
                  ';}
                  
                }

                //Abre o DropMenu
                if (count($valor[$i]) > 1 && $j == 0) {
                  echo '
                    <li class="dropdown">
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> '.$valor[$i][0].'<span class="caret"></span></a>
                      <ul class="dropdown-menu">
                  ';
                }else{
                  if($drop = true){
                    for ($x=1; $x < count($valor[$i]) ; $x++) { 
                      if($valor[$i][$x] == 'separador'){
                        echo '<li role="separator" class="divider"></li>';
                      }else{echo '<li><a href="#">'.$valor[$i][$x].'</a></li>';}
                     
                     //Finaliza o DropMenu
                     if($x == count($valor[$i])-1){
                      echo '
                            </ul>
                          </li>
                      ';
                     }
                    }
                  }
                  //Este Break tem a função de parar o For quando o DropMenu for escrito. Caso Remova ele ira escrever o DropMenu varias Vezes ($j).
                  break;
                }
              }
            }
           ?>
          <?php 



           ?>
        </div><!--/.nav-collapse -->
      </div>
    </nav>