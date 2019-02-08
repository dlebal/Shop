<?php
	
	defined('BASEPATH') OR exit('No direct script access allowed');
	
	// class Products extends CI_Model
	/**
	 * Class class Products extends CI_Model
	 * 
	 * This class is used to instantiate Products objects
	 */
	class Products extends CI_Model {
		
		/**
		 * Constructor public function __construct() {
		 *
		 * Its functions are:
		 *   - Initialize the instances of the class Products
		 */
		function __construct() {
			
			// Initialize the instances of the class Products
			parent::__construct();
			
		}
		
		/**
		 * Method public function generate_fake_products($quantity)
		 * 
		 * Its functions are:
		 *   - Generate a certain number of fake products
		 *
		 * Parameters:
		 *   @param $quantity: Number of fake products to generate
		 */
		public function generate_fake_products($quantity) {
			
			// Generate a certain number of fake products
			$names_first_part = array(
									  'Balón',
									  'Bañador',
									  'Bicicleta',
									  'Calcetines',
									  'Gafas',
									  'Gorros',
									  'Patines',
									  'Protecciones',
									  'Raqueta',
									  'Reloj',
									  'Ropa',
									  'Toalla',
									  'Zapatillas'
									 );
			$names_second_part = array(
									   'Darth Vader',
									   'Yoda',
									   'Obi-Wan Kenobi',
									   'Almirante Ackbar',
									   'Anakin Ani Skywalker',
									   'BB-8',
									   'BB-9E',
									   'Boba Fett',
									   'C-3PO',
									   'C2-B5',
									   'Capitana Phasma',
									   'Chewbacca',
									   'Chirrut Imwe',
									   'Darth Maul',
									   'Darth Vader',
									   'Death Troopers',
									   'Director Orson Krennic',
									   'Ewoks',
									   'Finn',
									   'General Hux',
									   'Han Solo',
									   'Jyn Erso',
									   'K-2SO',
									   'Kylo Ren',
									   'Lando Calrissian',
									   'Luke Skywalker',
									   'Obi-Wan Kenobi',
									   'Poe',
									   'Porg',
									   'Praetorian Guard',
									   'Princesa Leia',
									   'R2-D2',
									   'Rey',
									   'Rose Tico',
									   'Snowtroopers',
									   'Stormtroopers',
									   'Yoda'
									  );
			for ($i = 1; $i <= $quantity; $i++) {
				$code = uniqid();
				$name = $names_first_part[array_rand($names_first_part, 1)]." ".$names_second_part[array_rand($names_second_part, 1)];
				$descrition = $name." ha sido concebido para deportistas ocasionales o principiantes.";
				$image = "";
				$price = mt_rand(5, 99).".99";
				$category_id_1 = mt_rand(1, 5);
				$category_id_2 = mt_rand(1, 5);
				$query = $this->db->query("CALL INSERT_PRODUCT('".$code."', '".$name."', '".$descrition."', '".$image."', ".$price.", ".$category_id_1.", ".$category_id_2.");");
			}
		
		}
		
		/**
		 * Method public function get_products()
		 * 
		 * Its functions are:
		 *   - Return all products
		 */
		public function get_products() {
			
			// Return all products
			$query = $this->db->query("CALL GET_PRODUCTS();");
			mysqli_next_result( $this->db->conn_id);
			return $query;
		
		}
		
		/**
		 * Method public function get_products_by_category($category_id)
		 * 
		 * Its functions are:
		 *   - Return all products of a certain category
		 *
		 * Parameters:
		 *   @param $category_id: Category identifier
		 */
		public function get_products_by_category($category_id) {
			
			// Return all products of a certain category
			$query = $this->db->query("CALL GET_PRODUCTS_BY_CATEGORY(".$category_id.");");
			mysqli_next_result( $this->db->conn_id);
			return $query;
		
		}
		
		/**
		 * Method public function product_detail_get($product_id)
		 * 
		 * Its functions are:
		 *   - Return the product detail
		 *
		 * Parameters:
		 *   @param $product_id: Product identifier
		 */
		public function get_product_detail($product_id) {
			
			// Return the product detail
			$query = $this->db->query("CALL GET_PRODUCT(".$product_id.");");
			mysqli_next_result( $this->db->conn_id);
			return $query;
		
		}
		
		/**
		 * Method public function get_product_categories($product_id)
		 * 
		 * Its functions are:
		 *   - Return the product categories
		 *
		 * Parameters:
		 *   @param $product_id: Product identifier
		 */
		public function get_product_categories($product_id) {
			
			// Return the product categories
			$query = $this->db->query("CALL GET_PRODUCT_CATEGORIES(".$product_id.");");
			mysqli_next_result( $this->db->conn_id);
			return $query;
		
		}
		
	}
	
?>
