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
header("Content-Type: text/html; charset=ISO-8859-1", true);
require_once("../../includes/conection.php"); 

$idCat = (isset($_GET['c'])?$_GET['c']:'0');

if($_GET['n'] == 'cat'){
	$categoria = mysql_fetch_assoc(mysql_query('select permicao from '.PREFIXO.'produtos where id = "'.$idCat.'" limit 1'));
	$permicao = explode(',', $categoria['permicao']);
	
	if(count($permicao) >= 2){
		$primeiro = array_shift($permicao);
		$permicao = '"'.implode(',', $permicao).'"';
	} else {
		$permicao = 'NULL';
	}

	$nome = "Nova categoria";
	$executa = "INSERT INTO ".PREFIXO."produtos (nome, tipo, idCat, permicao) values ('".$nome."', '1', '".$idCat."', ".$permicao.")";
} else{
	$nome = "Novo produto";		
	$executa = "INSERT INTO ".PREFIXO."produtos (nome, tipo, idCat) values ('".$nome."' , '2', '".$idCat."')";
}
$query = mysql_query($executa);
?>
<script type="text/javascript">
	jfnav_start();
</script>