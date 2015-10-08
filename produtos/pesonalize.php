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
			$retorno = '../../index.php?app=produtos&cat='.$_GET['id'];
		break;
		
		case 'salvar-editar':
			$retorno = '../../index.php?app=produtos&p=pesonalize&cat='.$_GET['id'];
		break;		
	}
	
	header('location: '.$retorno);

break;

default:
	$consulta = 'select * from '.$llAppTable.' where id = "'.$_GET['cat'].'" limit 1';
	$dados = mysql_fetch_assoc(mysql_query($consulta));
	
	extract($dados);
	?>
	
	<div class="boxCenter">
		<form method="post" action="<?php echo $_ll['app']['pasta'].'pesonalize.php?ac=write&amp;id='.$_GET['cat']?>" class="form" id="formprod"  enctype="multipart/form-data">
			<fieldset>
				<div>
					<label>Nome</label>
					<input type="text" value="<?php echo $nome?>" name="nome" />
					<span class="ex">Este é apenas para identificação no painel, máximo de 15 caracteres. <strong>Campo obrigatorio</strong></span>
				</div>				
							
				<div>
					<label>Descrição da categoria</label>
					<textarea class="normal"  name="descricao"><?php echo $descricao?></textarea>
					<span class="ex">Descreva seu produto. <strong>Campo obrigatorio</strong></span>
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
				<div class="both"></div>
			</fieldset>

			
			
			<div class="botoes">
				<a class="link" href="<?php echo $backReal?>" title="voltar">Voltar</a>		
				<button type="submit" name="salvar" title="Salva e volta para lsitagem de produtos" class="confirm">Salvar</button>
				<button  type="submit" name="salvar-editar" title="Salva e continua nesta mesma tela">Salvar e continuar editando</button>
			</div>
		</form>
	</div>
	<?php
break;
}
?>
