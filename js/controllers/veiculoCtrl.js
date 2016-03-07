app.controller('veiculoCtrl', function($scope, $location, $http, config){
	var carregaVeiculo = function(){
		$http.get(config.ctrlUrl + "veiculoDao.php?opt=read").success(function(data){
			$scope.veiculos = data;
		})
	}

	carregaVeiculo();
})