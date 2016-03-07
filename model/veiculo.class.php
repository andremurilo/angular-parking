<?php
class Veiculo{

	public $placaVeiculo;
	public $tipoVeiculo;
	public $idCliente;

	public function __construct($placa, $tipo, $id){
		$this->placaVeiculo = $placa;
		$this->tipoVeiculo = $tipo;
		$this->idCliente = $id;
	}

	public function cadastraVeiculo(PDO $conexao){
		try{
			$placa = $this->placaVeiculo;
			$tipo = $this->tipoVeiculo;
			$id = $this->idCliente;
			
			$conexao->query("INSERT INTO veiculo (placa, tipo, id) VALUES ('$placa', '$tipo', '$id')");
		}catch(PDOException $e){
			print_r($e);
		}
	}

	public function alteraVeiculo(PDO $conexao, $id){
		try {
			$placa = $this->placaVeiculo;
			$tipo = $this->tipoVeiculo;

			$conexao->query("UPDATE veiculo set placa = '$placa', tipo = '$tipo' WHERE id = '$id'");
		} catch (PDOException $e) {
			
		}
	}

	public function contaTipo(PDO $conexao, $tipo){
		try {
			$resultado = $conexao->query("SELECT COUNT(tipo) as num FROM veiculo WHERE tipo = '$tipo'");
			$linha = $resultado->fetch(PDO::FETCH_ASSOC);
			return $linha['num'];
		} catch (PDOException $e) {
			print_r($e);
		}
	}

	public function retornaVeiculo(PDO $conexao, $placa){
		try {

			$resultado = $conexao->query("SELECT placa, tipo, id FROM veiculo WHERE placa = '$placa'");
			$linha = $resultado->fetch(PDO::FETCH_ASSOC);
			return $linha;
			
		} catch (PDOException $e) {
			print_r($e);
		}
	}

	public function excluiVeiculo(PDO $conexao, $placa){
		try {
			$conexao->query("DELETE FROM veiculo WHERE placa = '$placa'");
		} catch (PDOException $e) {
			print_r($e);
		}
	}
	
	public function visualizaVeiculo(PDO $conexao){
		try{
			$resultado = $conexao->query('select c.nome, v.tipo, v.placa FROM cliente c, veiculo v WHERE v.id = c.id ORDER BY c.nome');
			echo json_encode($resultado->fetchAll(PDO::FETCH_ASSOC));
		}catch(PDOException $e){
			print_r($e);
		}
	}

	public function relatorioVeiculo(PDO $conexao){
		try {
			$stmt = $conexao->prepare("SELECT placa, tipo FROM veiculo");
			$stmt->execute();

			$result = $stmt->fetchAll(PDO::FETCH_NUM);
			return $result;


		}catch (PDOException $e) {
			print_r($e);
		}
	}


}
?>