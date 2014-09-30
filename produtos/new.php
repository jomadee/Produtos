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
require_once("../../includes/conection.php"); 
require_once("../../api/jfnav/inicio.php"); 

header("Content-Type: text/html; charset=ISO-8859-1", true);

$idCat = (isset($_GET['c'])?$_GET['c']:'0');

if($_GET['n'] == 'cat'){
	$nome = "Nova categoria";
	$executa = "INSERT INTO ".PREFIXO."produtos (nome, tipo, idCat) values ('".$nome."', '1', '".$idCat."')";
} else{
	$nome = "Novo produto";		
	$executa = "INSERT INTO ".PREFIXO."produtos (nome, tipo, idCat) values ('".$nome."' , '2', '".$idCat."')";
}
$query = mysql_query($executa);
?>
<script type="text/javascript">
	jfnav_start();
</script>