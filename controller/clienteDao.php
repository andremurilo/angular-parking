<?php 

	require_once('../model/conecta.class.php');
	require_once('../model/cliente.class.php');

	$conexao = Conecta::getConexao("../config/banco.ini");

	$objCliente = new Cliente('', '', '', '', '', '');

	$opcao = isset($_GET['opt']) ? $_GET['opt'] : "";
	$id = isset($_GET['id']) ? $_GET['id'] : "";

	if(!empty($opcao)){
		switch ($opcao) {
			case 'read':
				$objCliente->visualizaCliente($conexao);
				break;
			case 'delete':
				$objCliente->excluiCliente($conexao, $id);
				break;
			case 'create':
				$cliente = file_get_contents('php://input');
				$objCliente->cadastraCliente($conexao, $cliente);
				break;
			case 'image':
				$fileName = $_FILES['file']['name'];
				$destination = '../images/' . $fileName;
				move_uploaded_file($_FILES['file']['tmp_name'], $destination);
		}
	}
 ?>