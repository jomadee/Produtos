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

$id = $_GET['cat'];
$case = (isset($_GET['case'])?$_GET['case']: "");
		

switch($case){
case "save";
case "saveedit":
	plg_historic('return');
	if(!empty($_POST)){
		
		if(!empty($_FILES['foto']['name'])){
			$arquivo = $_FILES['foto'];
			
			$imagemNome = explode('.', $arquivo['name']);
			$extenc = array_pop($imagemNome);
			$imagemNome = join(".", array_reverse($imagemNome));
			$imagemNome = jf_urlformat($imagemNome);
			$imagemNome = $imagemNome.'_'.substr(uniqid(md5(time())), 0, 8).'.'.$extenc;	
			
			$dir = 	"../uploads/produtos/";	
			
			if(isset($_POST['fotoant'])){
				unlink($dir.$_POST['fotoant']);
			}			
			
			$path =  $dir.$imagemNome;
			
			move_uploaded_file($arquivo["tmp_name"], $path);
			$_POST['foto'] = $imagemNome;
		} else{
			unset($_POST['foto']);
			
		}
		
		if(isset($_POST['fotoant'])){
			unset($_POST['fotoant']);
		}
		
		$alter['id']	= $id;
				
		jf_update($pluginTable, $_POST, $alter);
		?><img src="error.jpg" onerror="mLaviso('Alteração realizada com sucesso!', '2')" class="imge" alt="" /><?php
	}
if($case == 'save'){
	echo loadPage($backReal, 1);
	break;
}

default:
	$consulta = "select * from ".$pluginTable." where id like ".$id;
	$query = mysql_query($consulta);

	$dados = mysql_fetch_array($query);
	
	extract($dados);
	
	$endComun = $pluginHome."&amp;p=pesonalize&cat=".$id;
	?>
	
	<div class="boxCenter">
		<form method="post" class="form" id="formprod"  enctype="multipart/form-data">
			<div>
				<label>Nome</label>
				<input type="text" maxlength="50" value="<?=$nome?>" name="nome" />
				<span class="ex">Este é apenas para identificação no painel, máximo de 15 caracteres. <strong>Campo obrigatorio</strong></span>
			</div>				
						
			<div>
				<label>Descrição da categoria</label>
				<textarea class="normal"  name="descricao"><?=$descricao?></textarea>
				<span class="ex">Descreve seu produto. <strong>Campo obrigatorio</strong></span>
			</div>
			
			
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
			<span class="botao"><button  class="link" onclick="sForm('formprod', '<?=$endComun?>&case=save')">Salvar</button></span>
			<span class="botao"><button  class="link" onclick="sForm('formprod', '<?=$endComun?>&case=saveedit')">Salvar e continuar editando</button></span>
	
		</form>
	</div>
	<?php
break;
}
?>