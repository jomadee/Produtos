<?php
/**
*
* Gerenciador de produtos | lliure 6.x
*
* @versão 4.1
* @Desenvolvedor Jeison Frasson <jomadee@lliure.com.br>
* @Cooperador Rodrigo Dechen <mestri.rodrigo@gmail.com>
* @entre em contato com o desenvolvedor <jomadee@lliure.com.br> http://www.lliure.com.br/
* @licença http://opensource.org/licenses/gpl-license.php GNU Public License
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

		$data = array('nome' => 'Nova categoria', 'tipo' => 1, 'idCat' => $idCat, 'permicao' => $permicao);
	} else{		
		$data = array('nome' => 'Novo produto', 'tipo' => 2, 'idCat' => $idCat);
	}

	
	jf_insert(PREFIXO.'produtos', $data);
	break;
}