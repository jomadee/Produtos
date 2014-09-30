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
switch(isset($_GET['ac'])? $_GET['ac'] : ''){
case "write";
	
	require_once("../../includes/conection.php"); 
	require_once("../../includes/jf.funcoes.php"); 
	
	$retorno = jf_form_actions('salvar', 'salvar-editar');
	
	$_POST['permicao'] = preg_replace("/[^ 10,]/", "", $_POST['permicao']);	;
	
	if(!empty($_FILES['foto']['name'])){
		$arquivo = $_FILES['foto'];
		
		$imagemNome = explode('.', $arquivo['name']);
		$extenc = array_pop($imagemNome);

		$imagemNome = jf_urlformat(join(".", $imagemNome)).'_'.substr(md5(time()), rand(0, 15)+0, 8).'.'.$extenc;	
		
		$dir = 	"../uploads/produtos/";	
		
		if(isset($_POST['fotoant'])){
			unlink($dir.$_POST['fotoant']);
			unset($_POST['fotoant']);
		}
		
		move_uploaded_file($arquivo["tmp_name"], $dir.$imagemNome);
		$_POST['foto'] = $imagemNome;
	} else{
		unset($_POST['foto'], $_POST['fotoant']);
	}

	jf_update(PREFIXO.'produtos', $_POST, array('id' => $_GET['id']));
	
	$_SESSION['aviso'] = array('Propriedades alteradas com sucesso!', 1);
	
	switch ($retorno){
		case 'salvar':
			$retorno = '../../index.php?plugin=produtos&cat='.$_GET['id'];
		break;
		
		case 'salvar-editar':
			$retorno = '../../index.php?plugin=produtos&p=pesonalize&cat='.$_GET['id'];
		break;		
	}
	
	header('location: '.$retorno);

break;

default:
	$consulta = 'select * from '.$pluginTable.' where id = "'.$_GET['cat'].'" limit 1';
	$dados = mysql_fetch_assoc(mysql_query($consulta));
	
	extract($dados);
	?>
	
	<div class="boxCenter">
		<form method="post" action="<?php echo $pluginPasta.'pesonalize.php?ac=write&amp;id='.$_GET['cat']?>" class="form" id="formprod"  enctype="multipart/form-data">
			<div>
				<label>Nome</label>
				<input type="text" value="<?=$nome?>" name="nome" />
				<span class="ex">Este é apenas para identificação no painel, máximo de 15 caracteres. <strong>Campo obrigatorio</strong></span>
			</div>				
						
			<div>
				<label>Descrição da categoria</label>
				<textarea class="normal"  name="descricao"><?=$descricao?></textarea>
				<span class="ex">Descreve seu produto. <strong>Campo obrigatorio</strong></span>
			</div>
			
			<?php
			if($DadosLogado['tipo'] == 1){
				?>
				<div>
					<label>Permição da pasta</label>
					<input type="text" value="<?=$permicao?>" name="permicao" />
					<span class="ex">Este é apenas para identificação no painel, máximo de 15 caracteres. <strong>Campo obrigatorio</strong></span>
				</div>	
				<?php
			}
			?>
			
			<div>
				<label>Foto da categoria</label>
				<?php
				if(empty($foto)){
					?>
					<input type="file" name="foto" />
					<span class="ex">Selecione uma foto para essa categoria, ela poderá ser alterada posteriormente.</span>
					<?php
				} else {
					?>
					<img src="includes/thumb.php?i=../../uploads/produtos/<?=$foto?>:100" alt=""/>
					<input type="file" name="foto" />
					<span class="ex">Selecione uma nova foto para essa categoria, ela poderá ser alterada posteriormente.</span>			
					<input name="fotoant" type="hidden" value="<?=$foto?>" />
					<?php
				}
				?>	
			</div>	

			<span class="botao"><a class="link" href="<?=$backReal?>" title="voltar">Voltar</a></span>
			<span class="botao"><button type="submit" name="salvar">Salvar</button></span>
			<span class="botao"><button type="submit" name="salvar-editar">Salvar e continuar editando</button></span>
	
		</form>
	</div>
	<?php
break;
}
?>