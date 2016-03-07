app.controller('clienteCtrl', function($scope, $location, $http, config, Upload, $timeout){
	var carregaCliente = function(){
		$http.get(config.ctrlUrl + "clienteDao.php?opt=read").success(function(data){
			$scope.clientes = data;
		});
	}

	$scope.excluiCliente = function(id){
		$http.delete(config.ctrlUrl + "clienteDao.php?opt=delete&id=" + id).success(function(){
			carregaCliente();
		});
	}

	$scope.cadastraCliente = function(cliente){
		cliente.file.upload = Upload.upload({
			url: config.ctrlUrl + "clienteDao.php?opt=image",
			method: "post",
			file: cliente.file
		}).success(function(){
			$timeout(function(){
				cliente.file = cliente.file.name;
				console.log(JSON.stringify(cliente));
				$http({
					method: "post",
					url: config.ctrlUrl + "clienteDao.php?opt=create",
					data: cliente,
					headers: { 'Content-Type': 'application/x-www-form-urlencoded' }
				}).success(function(){
					$location.path("clientes");
				})
			})
		})
	}

	carregaCliente();
})