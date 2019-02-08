/*
* function showAlert(type, message)
*
* Its functions are:
*   - Show an alert
* 
* Parameters:
*   @param type: Type
*   @param message: Message
*/
function showAlert(type, message) {
   
   // Show an alert
   var alert = '<div class="' + type + ' alert alert-top" role="alert">' +
			   '    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' +
			   '    ' + message +
			   '</div>';
			   $("#divAlert").html(alert);
			   $(".alert-top").show();
			   setTimeout(function(){
				   $(".alert-top").hide();
				   $("#divAlert").html('');
			   }, 5000);
			   
}

/**
* function showAllProducts()
*
* Its functions are:
*   - Show all products
*/
function showAllProducts() {
   
   // Show all products
   $.ajax({
	   url: 'product/products',
	   cache : false,
	   method: 'GET',
	   dataType: 'json',
	   success : function(products) {
         $('.navbar-nav li').removeClass('active');
         $('#navItemAll').addClass('active');
         showProductsList(products);
	   },
	   error : function(data) {
		   showAlert("alert-danger", "Error al intentar obtener los productos.");
	   }
   });
   
}

/**
* function showProductDetail(productId)
*
* Its functions are:
*   - Show a product detail
* 
* Parameters:
*   @param productId: Product identifier
*/
function showProductDetail(productId) {
   
   // Show a product detail
   $.ajax({
	   url: 'product/product_detail/' + productId,
	   cache : false,
	   method: 'GET',
	   dataType: 'json',
	   success : function(product) {
		   if (product.data.length == 1) {
			   $('#divProductDetail').find('#productImage').attr('src', product.data[0].image != "" ? product.data[0].image : "assets/img/no-image.png");
			   $('#divProductDetail').find('#productImage').attr('alt', product.data[0].name);
			   $('#divProductDetail').find('#productName').html(product.data[0].name);
			   $('#divProductDetail').find('#productPrice').html(product.data[0].price.replace(".", ",") + '&euro;');
			   $('#divProductDetail').find('#productDescription').html(product.data[0].description);
               var categories = "";
               $.each(product.data[0].categories, function(index, category) {
                  categories += categories == "" ? category.name : ", " + category.name;
               });
               $('#divProductDetail').find('#productCategories').html("<b>Categorías:</b> " + categories);
			   $('#divProductDetail').modal('toggle');
		   } else {
			   showAlert("alert-danger", "Error al intentar obtener el detalle del producto.");
		   }
	   },
	   error : function(data) {
		   showAlert("alert-danger", "Error al intentar obtener el producto.");
	   }
   });
   
}

/**
* function showProductsByCategory(categoryId)
*
* Its functions are:
*   - Show all products by category
* 
* Parameters:
*   @param categoryId: Category identifier
*/
function showProductsByCategory(categoryId) {
   
   // Show all products by category
   $.ajax({
	   url: 'product/products_by_category/' + categoryId,
	   cache : false,
	   method: 'GET',
	   dataType: 'json',
	   success : function(products) {
         $('.navbar-nav li').removeClass('active');
         $('#navItem' + categoryId).addClass('active');
         showProductsList(products);
	   },
	   error : function(data) {
		   showAlert("alert-danger", "Error al intentar obtener los productos.");
	   }
   });
   
}

/**
* ffunction showProductsList(products) 
*
* Its functions are:
*   - Show the products list
* 
* Parameters:
*   @param products: Products
*/
function showProductsList(products) {
   
   $('#divProductList').html('');
   $.each(products.data, function(index, product) {
      var item = '<div class="col-lg-4 col-md-6 mb-4">' +
                 '    <div class="card h-100">' +
                 '        <a href="javascript:showProductDetail(' + product.id + ');"><img class="card-img-top" src="' + (product.image != "" ? product.image : "assets/img/no-image.png") + '" alt="' + product.name + '" /></a>' +
                 '        <div class="card-body">' +
                 '            <h4 class="card-title">' +
                 '                <a href="javascript:showProductDetail(' + product.id + ');">' + product.name + '</a>' +
                 '            </h4>' +
                 '            <h5>' + product.price.replace(".", ",") + '&euro;</h5>' +
                 '            <p class="card-text">' + product.description + '</p>' +
                 '        </div>' +
                 '        <div class="card-footer">' +
                 '            <small class="text-warning">&#9733; &#9733; &#9733; &#9733; &#9734;</small>  4.0 estrellas' +
                 '        </div>' +
                 '    </div>' +
                 '</div>';
      $('#divProductList').append(item);
   });
   
}
