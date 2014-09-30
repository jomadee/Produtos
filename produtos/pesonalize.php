<?php
/**
*
* Gerenciador de produtos | lliure (4.3.x - 4.4.x)
*
* @versão 2.2.2
* @Desenvolvedor Jeison Frasson <contato@newsmade.com.br>
* @Cooperador Rodrigo Dechen <rodrigo@grapestudio.com.br>
* @entre em contato com o desenvolvedor <contato@newsmade.com.br> http://www.newsmade.com.br/
* @licença http://opensource.org/licenses/gpl-license.php GNU Public License
*
*/
switch(isset($_GET['ac'])? $_GET['ac'] : ''){
case "write";
	
	require_once("../../etc/bdconf.php"); 
	require_once("../../includes/jf.funcoes.php");
	require_once("../../api/fileup/inicio.php");
	
	$retorno = jf_form_actions('salvar', 'salvar-editar');
	
	$_POST['permicao'] = preg_replace("/[^ 10,]/", "", $_POST['permicao']);	;
	
	$file = new fileup;
	$file->diretorio = '../../../uploads/produtos/';
	$file->up(); // executa a classe

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
			<fieldset>
				<div>
					<label>Nome</label>
					<input type="text" value="<?php echo $nome?>" name="nome" />
					<span class="ex">Este é apenas para identificação no painel, máximo de 15 caracteres. <strong>Campo obrigatorio</strong></span>
				</div>				
							
				<div>
					<label>Descrição da categoria</label>
					<textarea class="normal"  name="descricao"><?php echo $descricao?></textarea>
					<span class="ex">Descreve seu produto. <strong>Campo obrigatorio</strong></span>
				</div>
				
				<?php
				if(ll_tsecuryt()){
					?>
					<div>
						<label>Permição da pasta</label>
						<input type="text" value="<?php echo $permicao?>" name="permicao" />
						<span class="ex">Use 01 para criar produto, 10 para criar pasta, 11 para ambos, 00 para nenhum</span>
					</div>	
					<?php
				}

				$file = new fileup;
				$file->titulo = 'Foto da categoria';
				$file->rotulo = 'Selecionar imagem';
				$file->registro = $foto;
				$file->campo = 'foto';
				$file->extencao = 'png jpg';
				$file->form();
				?>
			</fieldset>
			
			<span class="botao"><a class="link" href="<?php echo $backReal?>" title="voltar">Voltar</a></span>
			<span class="botao"><button type="submit" name="salvar">Salvar</button></span>
			<span class="botao"><button type="submit" name="salvar-editar">Salvar e continuar editando</button></span>
		</form>
	</div>
	<?php
break;
}
?>
