$(function(){
	//Iniciar
	var maxInicio = 5;
	var variancia = 5;
	var grupoId = $("div.esconde-id").text();
	var base = "https://centralnovel.com.br/";
	var tabela = "tabela2";
	carregar(0, maxInicio,grupoId, base+tabela);
	var sleep = false;
	$("a.carregar-mais").click(function(evento){
		evento.preventDefault();
		var init = $("table tr.conteudo-ajax").length;
		var sleep = true;
		//Clicar no Botão AÇÃO
		carregar(init, variancia,grupoId, base+tabela);

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
		carregar(init, variancia,grupoId, base+tabela);

	});
	function carregar(init, max,grupoId, url){
		var dados = { init : init, max : max , sleep : sleep, grupoId : grupoId};
		//Adiciona Gif
		$("div.carregar-gif").append('<div class="carregar-gif-aqui"><img src="'+base+'app/www/images/ajax-loader.gif" alt="Carregando..." /></div>');

		$.post(url, dados, function (data) {
			console.info(data);

			//Remove Gif
			$("div.carregar-gif-aqui").last().remove();

			for(i = 0; i < data.dados.length; i++){
				//Exibição
				$("table.carregar-aqui").append('<tr class="conteudo-ajax"><td class="col-md-6 align-center"><a href="'+base+'link?id='+data.dados[i].grupo_id+'&link='+data.dados[i].link+'" target="_blank">'+data.dados[i].titulo+'</a></td><td class="col-md-6 align-center">'+data.dados[i].data+'</td></tr>');
			}

			var conta = $("tr.conteudo-ajax").length;


			if(conta >= data.totalResults) {
				$("div.carregar-mais").hide();
				$("div.carregar-block").show();
			}

		}, "json");
	}

});