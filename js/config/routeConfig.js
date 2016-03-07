app.config(function($routeProvider){
	$routeProvider.when("/admin", {
		templateUrl: "view/admin.html"
	});
	$routeProvider.when("/clientes", {
		templateUrl: "view/clientes.html",
		controller: "clienteCtrl"
	})
	$routeProvider.when("/clientes/cadastro", {
		templateUrl: "view/cadastro/cadastraCliente.html",
		controller: "clienteCtrl"
	})
	$routeProvider.when("/veiculos", {
		templateUrl: "view/veiculos.html",
		controller: "veiculoCtrl"
	})
})