<?php
/**
*
* Gerenciador de produtos | lliure 4.10.x
*
* @versão 3.0
* @Desenvolvedor Jeison Frasson <jomadee@lliure.com.br>
* @Cooperador Rodrigo Dechen <mestri.rodrigo@gmail.com>
* @entre em contato com o desenvolvedor <jomadee@lliure.com.br> http://www.lliure.com.br/
* @licença http://opensource.org/licenses/gpl-license.php GNU Public License
*
*/

$llAppTable = PREFIXO."produtos";


$botoes = array(
	array('href' => $backReal, 'img' => $plgIcones.'br_prev.png', 'title' => $backNome)
	);

echo app_bar('Produtos', $botoes);
?>
	
<div class="lojaInterno">
<?php
	if(isset($_GET['p'])){
		require_once($_ll['app']['pasta'].$_GET['p'].".php");
	}else{
		require_once($_ll['app']['pasta']."produtos.php");
	}
	?>
</div>
