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

require_once("../../includes/conection.php"); 
require_once("../../includes/mLfunctions.php"); 
require_once('funcoes.php');
header("Content-Type: text/html; charset=ISO-8859-1", true);

switch($_GET['a']){
	case 1: // confirma pagamento
		$sql = mysql_query("UPDATE plugin_lojavirtual_pedidos SET dataPagamento = '".time()."' WHERE id = '".$_GET['id']."' limit 1");
		
		$imagem = "<img src=\'plugins/lojavirtual/img/pags/".$formasPagamento[$_GET['fp']][1]."\'/> <img src=\'plugins/lojavirtual/img/pags/ok.gif\' class=\'ok\' />";
		?>
		
		<img src="erro.jpg" onerror="alteraConteudo('<?php echo $imagem; ?>', 'lVFP<?php echo $_GET['id']; ?>');" class="imge" alt=""/>
		<?php
	break;
	
	case 2: // altera Status
		$sql = mysql_query("UPDATE plugin_lojavirtual_pedidos SET status = '".$_GET['status']."' WHERE id = '".$_GET['id']."' limit 1");
		
		$mensCham = "O status desse pedido foi alterado para <strong>".$statusDoPedido[$_GET['status']][0]."</strong> <br/> <a href=\'javascript: void(0)\' onclick=\'mLExectAjax(&#34;plugins/lojavirtual/acoes.php?a=4&id=".$_GET['status']."&#34;)\'>Clique aqui</a> para enviar um e-mail para o portador desse pedido e avisa-lo dessa alteração.";
		?>
		<img src="erro.jpg" onerror="mLaviso('Status alterado com sucesso.', '2'); document.getElementById('menDiv').style.display = 'block'; alteraConteudo('<?php echo $mensCham;?>', 'pedidoMens');" class="imge" alt=""/>
		<?php
	break;
	
	
	case 3: // TRANSFORMA GET DE PESQUISA EM PEDIDOS
		
		if($_POST['tipo'] == 'cod'){
			header("location: ../../../index.php?plugin=lojavirtual&p=pedidos&id=".$campo);
		} else {
			$campo = str_replace(' ', '+', $_POST['campo']);
			header("location: ../../../index.php?plugin=lojavirtual&p=pedidos&em=".$_POST['tipo']."&con=".$campo);
		}
	break;
	
	case 4: // ENVIA E-MAIL ALTERAÇÃO DE PEDIDO
		$dados = 	mysql_fetch_array(
						mysql_query	('
							select b.nome, b.email, a.status from
							plugin_lojavirtual_pedidos as a
							left join plugin_lojavirtual_clientes as b
							on a.idCliente = b.id
							where a.id = '.$_GET['id']
							.' limit 1'
						)
					);
					
		$texto = "Olá ".$dados['nome'].". \n\nO status de seu pedido nº ".mlPreAnt($_GET['id'], 7)." foi alterado para \"".$statusDoPedido[$dados['status']][0]."\" \nAcompanhe seu pedido através do link http://".$_SERVER['SERVER_NAME']."?p=pedidos&pedido=".$_GET['id']."\n\n\n\n http://".$_SERVER['SERVER_NAME'];

		$de = 'noreply@'.$_SERVER['SERVER_NAME'];
	
		$subject = 'Acompanhamento de pedido';
		
		$headers = 'From: '.$de . "\r\n" .
			'Reply-To: '.$de . "\r\n";

		if(@mail($dados['email'], $subject, $texto, $headers) != false) {
			?>
			<img src="erro.jpg" onerror="mLaviso('E-mail enviado com sucesso.', '2');" class="imge" alt=""/>
			<?php
		} else {
			?>
			<img src="erro.jpg" onerror="mLaviso('Não foi possível enviar e-mail para <?php echo $dados['email'];?>.', '2');" class="imge" alt=""/>
			<?php
		}
	break;
}	
?>

