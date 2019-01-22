$(function(){
	//Iniciar
	var maxInicio = 10;
	var variancia = 10;
	var base = "https://centralnovel.com.br/";
	var tabela = "tabela";
	carregar(0, maxInicio, base+tabela);

	var sleep = false;
	$("a.carregar-mais").click(function(evento){
		evento.preventDefault();
		var init = $("table tr.conteudo-ajax").length;
		var sleep = true;
		//Clicar no Botão AÇÃO
		carregar(init, variancia, base+tabela);

	});
	$("button.recarregar").click(function(evento){
		evento.preventDefault();
		var init = 0;
		var sleep = false;
		var conta = $("table tr").length;
		//Clicar no Botão AÇÃO
		for (var x = 0; x <= conta; x++) {
		$("tr.conteudo-ajax").last().remove();
		}
		carregar(init, variancia, base+tabela);

	});
	function carregar(init, max, url){
		var dados = { init : init, max : max , sleep : sleep};
		//Adiciona Gif
		$("div.carregar-gif").append('<div class="carregar-gif-aqui"><img src="'+base+'app/www/images/ajax-loader.gif" alt="Carregando..." /></div>');

		$.post(url, dados, function (data) {
			console.info(data);

			//Remove Gif
			$("div.carregar-gif-aqui").last().remove();

			for(i = 0; i < data.dados.length; i++){
				//Exibição
				$("table.carregar-aqui").append('<tr class="conteudo-ajax"><td><a href="'+base+'link?id='+data.dados[i].grupo_id+'&link='+data.dados[i].link+'" target="_blank">'+data.dados[i].titulo+'</a></td><td><a href="'+base+'grupos/'+data.dados[i].pagina+'">'+data.dados[i].nome+'</a> </td><td>'+data.dados[i].data+'</td><td><a href="'+base+'link?id='+data.dados[i].grupo_id+'&link='+data.dados[i].Glink+'" target="_blank"><small><i class="fa fa-external-link"></i></small></a></td></tr>');
			}

			var conta = $("tr.conteudo-ajax").length;

			if(conta >= data.totalResults) {
				$("div.carregar-mais").hide();
				$("div.carregar-block").show();
			}

		}, "json");
	}

});