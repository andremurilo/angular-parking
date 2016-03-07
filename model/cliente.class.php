<?php 
require_once 'imagem.class.php';

class Cliente extends Imagem{
	
	
	
	public $nomeCliente;
	public $senhaCliente;
	public $emailCliente;
	public $enderecoCliente;
	public $telefoneCliente;
	public $sexoCliente;

	public function __construct($nome, $senha, $email, $endereco, $telefone, $sexo){
		$this->nomeCliente = $nome;
		$this->senhaCliente = $senha;
		$this->emailCliente = $email;
		$this->enderecoCliente = $endereco;
		$this->telefoneCliente = $telefone;
		$this->sexoCliente = $sexo;
	}

	public function cadastraCliente(PDO $conexao, $cliente){
		try{
			$clientejson = json_decode($cliente, true);
			$nome = $clientejson['nome'];
			$senha = $clientejson['senha'];
			$email = $clientejson['email'];
			$telefone = $clientejson['telefone'];
			$endereco = $clientejson['endereco'];
			$sexo = $clientejson['sexo'];
			$conexao->query("INSERT INTO cliente (nome, senha, email, telefone, endereco, sexo) VALUES ('$nome', '$senha', '$email', '$telefone', '$endereco', '$sexo')");
			$resultado = $conexao->query('SELECT id FROM cliente ORDER BY id DESC LIMIT 0,1');
			$ultimoId = $resultado->fetch(PDO::FETCH_ASSOC);
			$this->caminhoImagem = 'images/'.$clientejson['file'];
			$this->idCliente = $ultimoId['id'];
			$this->sobeImagem($conexao);
		}catch(PDOException $e){
			print_r($e);
		}
	}

	public function visualizaCliente(PDO $conexao){
		try{
			$resultado = $conexao->query("SELECT i.caminho, c.id, c.nome, c.telefone FROM cliente c, imagem i WHERE c.id = i.id ORDER BY c.nome");
			 echo json_encode($resultado->fetchAll(PDO::FETCH_ASSOC));
		}catch(PDOException $e){
			print_r($e);
		}
	}

	public function selectCliente(PDO $conexao, $id=''){
		try {
			if($id == ''){
				$resultado = $conexao->query("SELECT id, nome from cliente");
				while($linha = $resultado->fetch(PDO::FETCH_ASSOC)){
				echo '<option name="txtid" value='. $linha['id'] . '>' . $linha['nome']. '</option>';
				}
			}else{
				$resultado = $conexao->query("SELECT id, nome from cliente WHERE id = '$id'");
				$linha = $resultado->fetch(PDO::FETCH_ASSOC);
				echo '<option name="txtid" value='. $linha['id'] . '>' . $linha['nome']. '</option>';
	
			}


		} catch (PDOException $e) {
			
		}
	}

	public function retornaCliente(PDO $conexao, $id){
		try {
			$resultado = $conexao->query("SELECT id, nome, email, senha, telefone, endereco, sexo FROM cliente where id = {$id}");
			return json_encode($resultado->fetch(PDO::FETCH_ASSOC));
		} catch (PDOException $e) {
			print_r($e);
		}
	}

	public function excluiCliente(PDO $conexao, $id){
		try{
			$resultado = $conexao->query("SELECT caminho FROM imagem WHERE id = '$id'");
			$linha = $resultado->fetch(PDO::FETCH_ASSOC);
			if($linha['caminho'] !== NULL){
				unlink($linha['caminho']);
			}
			$id = (int)$id;
			$conexao->query("DELETE FROM veiculo WHERE id = '$id'");
			$conexao->query("DELETE FROM imagem WHERE id = '$id'");
			$conexao->query("DELETE FROM cliente WHERE id = {$id}");
		}catch(PDOException $e){
			print_r($e);
		}
	}

	public function alteraCliente(PDO $conexao, $id, $imagem){
		try {
			$id = (int)$id;
			$nome = $this->nomeCliente;
			$senha = $this->senhaCliente;
			$email = $this->emailCliente;
			$telefone = $this->telefoneCliente;
			$endereco = $this->enderecoCliente;
			$sexo = $this->sexoCliente;
			$conexao->query("UPDATE cliente set nome = '$nome', email = '$email', senha = '$senha', telefone = '$telefone', endereco = '$endereco', sexo = '$sexo' WHERE id = {$id}");
			if($imagem !== ''){
				$this->caminhoImagem = $imagem;
				$this->atualizaImagem($conexao, $id);
			}
		} catch (PDOExceptionO $e) {
			print_r($e);
		}
	}

	public function contaSexo(PDO $conexao, $sexo){
		try {
			$resultado = $conexao->query("SELECT COUNT(sexo) as num FROM cliente WHERE sexo = '$sexo'");
			$linha = $resultado->fetch(PDO::FETCH_ASSOC);
			return $linha['num'];
		} catch (PDOException $e) {
			
		}
	}

}
?>