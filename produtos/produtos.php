<?php
/**
*
* Gerenciador de produtos
*
* @versão 5.0
* @Desenvolvedor Jeison Frasson <jomadee@lliure.com.br>
* @Cooperador Rodrigo Dechen <mestri.rodrigo@gmail.com>
* @entre em contato com o desenvolvedor <jomadee@lliure.com.br> http://www.lliure.com.br/
* @licença http://opensource.org/licenses/gpl-license.php GNU Public License
*
*/
$filtro = " where idCat = '0'";
$cat = '';
$caminho = null;
$permicao = '11';

if(isset($_GET['cat'])){
	$filtro = " where idCat ='".$_GET['cat']."'";
	$cat = "&amp;c=".$_GET['cat'];
}

if(isset($_GET['cat'])){
	$catHist = $_GET['cat'];
	while($catHist != 0){
		$categoria = mysql_fetch_assoc(mysql_query('select idCat, nome, id from '.PREFIXO.'produtos where id = "'.$catHist.'" limit 1'));
		$arraCat[] = array('nome' => $categoria['nome'], 'id' => $categoria['id']);
		$catHist = $categoria['idCat'];
	}
	$caminho = '<span class="caminho"><a href="?app=produtos"><i class="fa fa-home"></i></a>';
	
	foreach(array_reverse($arraCat) as $chave => $valor)
		$caminho .= ' <i class="fa fa-angle-right"></i> <a href="?app=produtos&cat='.$valor['id'].'">'.$valor['nome'].'</a>';
	
	$caminho .= '</span>';
	
	$categoria = mysql_fetch_assoc(mysql_query('select nome, permicao from '.PREFIXO.'produtos where id = "'.$_GET['cat'].'" limit 1'));
	$categoria['permicao'] = explode(',', $categoria['permicao']);
	$permicao  = !empty($categoria['permicao'][0]) ? $categoria['permicao'][0] : $permicao ;
}
?>

<div id="boxGeral">
	<div class="menuLateral">
		<ul>	
			<li class="top">Opções de produtos</li>
			<?php 
			if(isset($_GET['cat']))
				echo '<li><a href="'.$llAppHome.'&amp;p=pesonalize&cat='.$_GET['cat'].'"><i class="fa fa-cog"></i> Personalizar</a></li>';
			
			if($permicao == '11' or $permicao == '10')
				echo '<li><a href="'.$_ll['app']['sen_html'].'&ac=new&n=cat'.$cat.'" class="criar" rel="Nova categoria criada com sucesso"><i class="fa fa-cubes"></i> Cadastrar categoria</a>  </li>';
				
			if($permicao == '11' or $permicao == '01')
				echo '<li><a href="'.$_ll['app']['sen_html'].'&ac=new&n'.$cat.'" class="criar" rel="Novo produto criado com sucesso"><i class="fa fa-cube"></i> Cadastrar produto</a></li>';
			?>
		</ul>
	</div>
	
	<div class="maxLatLoja">
		<?php		
		echo $caminho;

		$navegador = new navigi();
		$navegador->tabela = $llAppTable;
		$navegador->query = 'select * from '.$llAppTable.$filtro ;
		
		$navegador->delete = true;
		$navegador->rename = true;		
		
		$navegador->configSel = 'tipo';
		$navegador->config[1] = array(	'link' => $llAppHome.'&amp;p=produtos&amp;cat=',
										'ico' => $_ll['app']['pasta'].'img/cat.png'								
										);


		$navegador->config[2] = array(	'link' => $llAppHome.'&amp;p=editproduto&amp;produto=',
										'ico' => $_ll['app']['pasta'].'img/produt.png'	
										);
		$navegador->monta();
		?>
	</div>
</div>

<script>
	
	$('.criar').click(function(){
		var url = $(this).attr('href');
		var msm = $(this).attr('rel');
		
		ll_load(url, function(){
			jfAlert(msm);
			navigi_start();
		});
		return false;
	});
</script>
