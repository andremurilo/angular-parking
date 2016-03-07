<?php 
	
	final class Conecta{

		private function __construct(){}

		public static function getConexao($arquivo){

			if(file_exists($arquivo)){
				$db = parse_ini_file($arquivo);
			}else{
				throw new Exception("Arquivo não encontrato.");
			}

			$host = isset($db['host']) ? $db['host'] : NULL;
			$usuario = isset($db['usuario']) ? $db['usuario'] : NULL;
			$senha = isset($db['senha']) ? $db['senha'] : NULL;
			$nome = isset($db['nome']) ? $db['nome'] : NULL;
			$porta = isset($db['porta']) ? $db['porta'] : NULL;

			try{
				$conexao = new PDO("mysql:host={$host};port={$porta};dbname={$nome}", $usuario, $senha);
			}catch(PDOException $e){
				print_r($e);
			}

			$conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			return $conexao;
		}
}
