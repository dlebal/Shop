<?php
	
	defined('BASEPATH') OR exit('No direct script access allowed');
	
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<meta name="description" content="" />
		<meta name="author" content="" />
		<link rel="shortcut icon" href="/favicon.ico" type="image/x-icon" />
		<link rel="icon" href="/favicon.ico" type="image/x-icon" />
		<title>Tienda de deportes, ropa y material deportivo online | Sport Shop</title>
		<!-- Bootstrap core CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous" />
		<!-- Custom styles for this template -->
		<link rel="stylesheet/less" type="text/css" href="assets/css/shop.less" />
	</head>
	<body>
		
		<!-- Navigation -->
		<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
			<div class="container">
				<a class="navbar-brand" href="javascript:showAllProducts();"><img class="logo-small" src="assets/img/logo.png" alt="Sport Shop" />&nbsp;Sport Shop</a>
				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#divNavbar" aria-controls="divNavbar" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>
				<div class="collapse navbar-collapse" id="divNavbar">
					<ul class="navbar-nav ml-auto">
						<li id="navItemAll" class="nav-item">
							<a class="nav-link" href="javascript:showAllProducts();">Todos</a>
						</li>
						<?php
							foreach($categories as $category) {
						?>
								<li id="navItem<?php echo($category->id); ?>" class="nav-item">
									<a class="nav-link" href="javascript:showProductsByCategory(<?php echo($category->id); ?>);"><?php echo($category->name); ?></a>
								</li>
						<?php
							}
						?>
					</ul>
				</div>
			</div>
		</nav>
		<!-- /.Navigation -->
		
		<!-- Page Content -->
		<div class="container">
			
			<!-- Main -->
			<div class="row">
				
				<!-- Content -->
				<div class="col-lg-12">
					
					<!-- Products -->
					<div id="divAlert"></div>
					<hr />
					<div id="divProductList" class="row"></div>
					<!-- /.Products -->
					
				</div>
				<!-- /.Content -->
				
			</div>
			<!-- /.Main -->
			
		</div>
		<!-- /.Page Content -->
		
		<!-- Product detail -->
		<div id="divProductDetail" class="modal fade" role="dialog" aria-labelledby="label-product-detail" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<button id="buttonClose" type="button" class="close" data-dismiss="modal" aria-label="label-dismiss">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<div class="card mt-4">
							<img id="productImage" class="card-img-top img-fluid" />
							<div class="card-body">
								<h3 id="productName" class="card-title"></h3>
								<h4 id="productPrice"></h4>
								<p id="productDescription" class="card-text"></p>
								<p id="productCategories" class="card-text"></p>
								<span class="text-warning">&#9733; &#9733; &#9733; &#9733; &#9734;</span> 4.0 estrellas
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- /.Product detail -->
		
		<!-- Footer -->
		<footer class="py-4 bg-dark">
			<div class="container">
				<p class="m-0 text-center text-white">Copyright &copy; Sport Shop 2017</p>
			</div>
		</footer>
		<!-- /.Footer -->
		
		<!-- Bootstrap core JavaScript -->
		<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
		
		<!-- Less core JavaScript -->
		<script src="https://cdnjs.cloudflare.com/ajax/libs/less.js/2.7.2/less.min.js"></script>
		
		<!-- Custom JavaScript for this template -->
		<script src="assets/js/shop.js"></script>
		<script>
			$(function() {
				showAllProducts();
			});
		</script>
		
	</body>
	
</html>
