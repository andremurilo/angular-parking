<?php 
class Imagem{

	public $caminhoImagem;
	public $idCliente;

	public function __construct($caminho, $id){
		$this->caminhoImagem = $caminho;
		$this->idCliente = $id;
	}
	
	public function sobeImagem(PDO $conexao){
		try{
			$caminho = $this->caminhoImagem;
			$id = $this->idCliente;
			
			$conexao->query("INSERT INTO imagem (caminho, id) VALUES ('$caminho', '$id')");
		}catch(PDOException $e){
			print_r($e);
		}
	}

	public function atualizaImagem(PDO $conexao, $id){

		try {
			$caminho = $this->caminhoImagem;
			$conexao->query("UPDATE imagem set caminho = '$caminho' WHERE id='$id'");
		} catch (PDOException $e) {
			print_r($e);
		}


	}
	
	public function visualizaImg(PDO $conexao, $id){
		try{
			if($id){
				$resultado = $conexao->query("select caminho FROM imagem WHERE id = {$id}");
				$linha = $resultado->fetch(PDO::FETCH_ASSOC);
				echo '<img src="'. $linha['caminho'] . '" alt="" class="circle responsive-img">';
			}
		}catch(PDOException $e){
			print_r($e);
		}
	}
	
	
	
}