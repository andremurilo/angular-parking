<?php 
	class Usuario{

		public $usuario;
		public $senha;

		public function __construct($usuario, $senha){
			$this->usuario = $usuario;
			$this->senha = $senha;
		}

		public function acesso(PDO $conexao, $usuario, $senha){
			try {
				$resultado = $conexao->query("SELECT * FROM login");
				$linha = $resultado->fetch(PDO::FETCH_ASSOC);
				$hash = crypt($senha, $linha['senha']);
				if($usuario === $linha['usuario'] && $hash === $linha['senha']){
					return true;
				}else{
					return false;
				}

			} catch (PDOException $e) {
				print_r($e);
			}
		}



	}
	
 ?>