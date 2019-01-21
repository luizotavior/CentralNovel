@extends('layouts.default')
@push('HeaderScripts')
<!-- Header Personalizado [Modelo] -->
    <link href="{{asset(mix('css/termosPolitica.min.css'))}}" rel="stylesheet" type="text/css">
<!-- /Header Personalizado [Modelo] -->
@endpush

@section('content')
    <!-- Conteudo Principal [Modelo] -->
    <main id="termos">
        <div id="principal" class="painel">
            <h1 class="titulo" >Termos e Condições</h1>
            <div class="conteudo">
            <p>
            Nosso servi&ccedil;o &eacute; oferecido para pessoas capazes de firmar um acordo conosco. O Usu&aacute;rio deve conhecer e seguir as regras deste site, bem como estar de acordo com a jurisdi&ccedil;&atilde;o a que pertence e as leis do seu pa&iacute;s.<br />
            <h2>Servi&ccedil;os</h2> Concordamos em oferecer v&aacute;rios servi&ccedil;os ao Usu&aacute;rio. Nos reservamos ao direto de alterar ou remover qualquer servi&ccedil;o a qualquer momento sem qualquer justificativa, ou reduzir seu tr&aacute;fego de acordo com nossa viabilidade, para assegurar o bom funcionamento do sistema. <br /><br />
            <h2>Conta de Usu&aacute;rio</h2> A conta de Usu&aacute;rio &eacute; somente para uso pessoal em computadores pessoais em redes residenciais. N&atilde;o ser&aacute; permitida a utiliza&ccedil;&atilde;o da conta em Servidores Dedicados, VPS (Virtual Private Server) ou Similares. <br /> Somente o Usu&aacute;rio que fisicamente possui a conta est&aacute; autorizado a logar e utiliz&aacute;-la. Os logins nas contas dos Usu&aacute;rios s&atilde;o registrados para que possamos identificar o compartilhamento de contas. O Usu&aacute;rio concorda em manter seus dados de login em sigilo.<br /><br />
            <h2>Uso dos Servi&ccedil;os</h2> O Usu&aacute;rio confirma em n&atilde;o usar nossos servi&ccedil;os para download de arquivos considerados ilegais pelas leis deste e do(s) pa&iacute;s (es) onde nossos servidores est&atilde;o geograficamente localizados. <br /> O Usu&aacute;rio tem conhecimento que n&atilde;o pode utilizar nossos servi&ccedil;os para downloads de arquivos que envolvam crian&ccedil;as, sendo punidos com a suspens&atilde;o da sua conta e reportados &agrave;s autoridades e organiza&ccedil;&otilde;es competentes. <br /> N&atilde;o somos donos dos arquivos que os Usu&aacute;rios fazem download, n&atilde;o podemos verificar seu conte&uacute;do ou ser responsabilizados por eles. Somos apenas um intermedi&aacute;rio, assim como um ISP. Nossos servi&ccedil;os se baseiam puramente em tr&aacute;fego de dados. N&atilde;o hospedamos ou armazenamos nenhum arquivo. <br /> O Usu&aacute;rio confirma que n&atilde;o utilizar&aacute; nossos servi&ccedil;os em Redes N&atilde;o Residenciais, Servidores Dedicados, VPS (Virtual Private Server) ou Similares ou para fazer "Upload Remoto" sob pena de ter sua conta suspensa. <br /> Qualquer compartilhamento de conta ou de links gerados ocasionar&aacute; na suspens&atilde;o da conta do Usu&aacute;rio sem qualquer aviso pr&eacute;vio.<br /><br />
            <h2>Infra&ccedil;&otilde;es</h2> O Usu&aacute;rio confirma em n&atilde;o tentar parar nossos servi&ccedil;os de qualquer forma, como um ataque de servidor. A reprodu&ccedil;&atilde;o, parcial ou completa, do conte&uacute;do deste site &eacute; proibida sem o consentimento do seu dono.<br /><br />
            <h2>Termos de Servi&ccedil;o</h2> Os termos de servi&ccedil;o podem ser atualizados a qualquer momento e sem qualquer aviso pr&eacute;vio.<br /><br />
            </p>
            </div>
        </div>
    </main>
    <!-- /Conteudo Principal [Modelo] -->
@endsection

@push('FooterScripts')
<!-- Footer Personalizado [Modelo] -->

<!-- /Footer Personalizado [Modelo] -->
@endpush