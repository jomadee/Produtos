<?php
/**
*
* Gerenciador de produtos | lliure 6.x
*
* @vers�o 4.0
* @Desenvolvedor Jeison Frasson <jomadee@lliure.com.br>
* @Cooperador Rodrigo Dechen <mestri.rodrigo@gmail.com>
* @entre em contato com o desenvolvedor <jomadee@lliure.com.br> http://www.lliure.com.br/
* @licen�a http://opensource.org/licenses/gpl-license.php GNU Public License
*
*/

switch(isset($_GET['ac']) ? $_GET['ac'] : ''){
case 'new':
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
	break;
}