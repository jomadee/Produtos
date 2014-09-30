<?php
/**
*
* Aplicativo de Produtos para Plugin (CMS)
*
* @versão 2.1.0
* @Desenvolvedor Jeison Frasson <contato@newsmade.com.br>
* @Cooperador Rodrigo Dechen <rodrigo@grapestudio.com.br>
* @entre em contato com o desenvolvedor <contato@newsmade.com.br> http://www.newsmade.com.br/
* @licença http://opensource.org/licenses/gpl-license.php GNU Public License
*
*/
$pluginHome = "?plugin=produtos";
$pluginPasta = "plugins/produtos/";
$pluginTable = PREFIXO."produtos";


$botoes = array(
	array('href' => $backReal, 'img' => $plgIcones.'br_prev.png', 'title' => $backNome)
	);

echo app_bar('Produtos', $botoes);
?>
	
<div class="lojaInterno">
<?php
	if(isset($_GET['p'])){
		require_once($pluginPasta.$_GET['p'].".php");
	}else{
		require_once($pluginPasta."produtos.php");
	}
	?>
</div>