<?php 

	require_once('../model/conecta.class.php');
	require_once('../model/veiculo.class.php');

	$conexao = Conecta::getConexao("../config/banco.ini");

	$objVeiculo = new Veiculo('', '', '');

	$opcao = isset($_GET['opt']) ? $_GET['opt'] : "";
	$id = isset($_GET['id']) ? $_GET['id'] : "";

	if(!empty($opcao)){
		switch ($opcao) {
			case 'read':
				$objVeiculo->visualizaVeiculo($conexao);
				break;
			case 'delete':
				$objVeiculo->excluiVeiculo($conexao, $id);
				break;
			case 'create':
				$veiculo = file_get_contents('php://input');
				$objVeiculo->cadastraVeiculo($conexao, $veiculo);
				break;
			case 'image':
				$fileName = $_FILES['file']['name'];
				$destination = '../images/' . $fileName;
				move_uploaded_file($_FILES['file']['tmp_name'], $destination);
		}
	}
 ?>