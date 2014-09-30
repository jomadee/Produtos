<?php
/**
*
* Aplicativo de Produtos para Plugin (CMS)
*
* @versão 2.0.9
* @Desenvolvedor Jeison Frasson <contato@newsmade.com.br>
* @entre em contato com o desenvolvedor <contato@newsmade.com.br> http://www.newsmade.com.br/
* @licença http://opensource.org/licenses/gpl-license.php GNU Public License
*
*/
$filtro = " where idCat = '0'";
$cat = '';

if(isset($_GET['cat'])){
	$filtro = " where idCat ='".$_GET['cat']."'";
	$cat = "&amp;c=".$_GET['cat'];
}
?>

<div id="boxGeral">
	
	<div class="menuLateral">
		<ul>	
			<li class="top">Opções de produtos</li>
			<?php 
			if(isset($_GET['cat']))
				echo '<li><a href="?plugin=produtos&amp;p=pesonalize&cat='.$_GET['cat'].'"><img src="imagens/icones/preto/brush.png" alt=""/>Personalizar</a></li>';
		
			echo '<li><a href="'.$pluginPasta.'new.php?n=cat'.$cat.'" class="criar" rel="Nova categoria criada com sucesso"><img src="imagens/icones/preto/cube.png" alt=""/>Cadastrar categoria</a>  </li>'
			?>
			
			<li><a href="<?=$pluginPasta?>new.php?n<?=$cat?>" class="criar" rel="Novo produto criado com sucesso"><img src="<?=$pluginPasta?>img/product.png" alt=""/>Cadastrar produto</a></li>
					
		</ul>
	</div>
	
	<div class="maxLatLoja">
	
		<?php
		if(isset($_GET['cat'])){
			$catHist = $_GET['cat'];
			while($catHist != 0){
				$sql = mysql_fetch_assoc(mysql_query('select idCat, nome, id from '.PREFIXO.'produtos where id = "'.$catHist.'" limit 1'));
				$arraCat[] = array('nome' => $sql['nome'], 'id' => $sql['id']);
				$catHist = $sql['idCat'];
			}
			echo '<a href="?plugin=produtos">Produtos</a>';
			
			foreach(array_reverse($arraCat) as $chave => $valor){
				echo ' > <a href="?plugin=produtos&cat='.$valor['id'].'">'.$valor['nome'].'</a>';
			}
		}

		$pastas['pp'] =  $pluginPasta;
		$pastas['plp'] =  '../uploads/produtos';

		$click['campo'] = 'tipo';

		$click['1']['link'] = $pluginHome."&amp;p=produtos&amp;cat=";
		$click['1']['ico'] = "img/cat.png";

		$click['2']['link'] = $pluginHome."&amp;p=editproduto&amp;produto=";
		$click['2']['ico'] = "img/produt.png";


		$query = "select * from ".$pluginTable.$filtro;
		//$query = mysql_query($consulta);

		$mensagemVazio = "Nenhuma categoria ou produto encontrado.";
		jNavigator($query, $pluginTable, $pastas, $mensagemVazio, $click);
		?>
	</div>
</div>

<script>
	$('.criar').jfbox({abreBox: false}, function(link){
		var mensagem = $(link).attr('rel');
		$(document).jfaviso(mensagem);
		$(document).jfnav();
	});
</script>