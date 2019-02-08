<?php
	
	defined('BASEPATH') OR exit('No direct script access allowed');
	
	require(APPPATH.'/libraries/REST_Controller.php');
	
	/**
	 * Class class Product extends REST_Controller
	 * 
	 * This class is used to instantiate Product objects (for API REST)
	 */
	class Product extends REST_Controller {
		
		/**
		 * Constructor public function __construct() {
		 *
		 * Its functions are:
		 *   - Initialize the instances of the class Product
		 */
		public function __construct() {
			
			// Initialize the instances of the class Product
			parent::__construct();
			$this->load->model('Products');
			
		}
		
		/**
		 * Method public function generate_fake_products_get($quantity)
		 * 
		 * Its functions are:
		 *   - Generate a certain number of fake products
		 *   - Return the API REST method result
		 *
		 * Parameters:
		 *   @param $quantity: Number of fake products to generate
		 */
		public function generate_fake_products_get($quantity) {
			
			// Variables
			$errors = array();
			
			// Generate a certain number of fake products
			$this->Products->generate_fake_products($quantity);
			
			// Return the API REST method result
			$this->response(
				[
					'success'	=> TRUE,
					'message'	=> 'Generate fake products ok',
					'data'		=> array(),
					'errors'	=> $errors
				],
				REST_Controller::HTTP_OK
			);
			
		}
		
		/**
		 * Method public function products_get()
		 * 
		 * Its functions are:
		 *   - Get all products
		 *   - Return the API REST method result
		 */
		public function products_get() {
			
			// Variables
			$products = array();
			$errors = array();
			
			// Get all products
			$products = $this->Products->get_products()->result_array();
			
			// Return the API REST method result
			if ($products) {
				$this->response(
					[
						'success'	=> TRUE,
						'message'	=> 'Get products ok',
						'data'		=> $products,
						'errors'	=> $errors
					],
					REST_Controller::HTTP_OK
				);
			} else {
				array_push($errors, 'Data error');
				$this->response(
					[
						'success'		=> FALSE,
						'message'		=> 'Get products ko',
						'data'			=> array(),
						'errors'		=> $errors
					],
					REST_Controller::HTTP_OK
				);
			}
			
		}
		
		/**
		 * Method public function products_by_category_get($category_id)
		 * 
		 * Its functions are:
		 *   - Get all products of a certain category
		 *   - Return the API REST method result
		 *
		 * Parameters:
		 *   @param $category_id: Category identifier
		 */
		public function products_by_category_get($category_id) {
			
			// Variables
			$products = array();
			$errors = array();
			
			// Get all products of a certain category
			$products = $this->Products->get_products_by_category($category_id)->result_array();
			
			// Return the API REST method result
			if ($products) {
				$this->response(
					[
						'success'	=> TRUE,
						'message'	=> 'Get products by category ok',
						'data'		=> $products,
						'errors'	=> $errors
					],
					REST_Controller::HTTP_OK
				);
			} else {
				array_push($errors, 'Data error');
				$this->response(
					[
						'success'		=> FALSE,
						'message'		=> 'Get products by category ko',
						'data'			=> array(),
						'errors'		=> $errors
					],
					REST_Controller::HTTP_OK
				);
			}
			
		}
		
		/**
		 * Method public function product_detail_get($product_id)
		 * 
		 * Its functions are:
		 *   - Get the product detail with its associated categories
		 *   - Return the API REST method result
		 *
		 * Parameters:
		 *   @param $product_id: Product identifier
		 */
		public function product_detail_get($product_id) {
			
			// Variables
			$product = array();
			$product_categories = array();
			$errors = array();
			
			// Get the product detail with its associated categories
			$product = $this->Products->get_product_detail($product_id)->result_array();
			$product_categories = $this->Products->get_product_categories($product_id)->result_array();
			
			// Return the API REST method result
			if (($product) && (count($product) == 1) && ($product_categories)) {
				$product[0]["categories"] = $product_categories;
				$this->response(
					[
						'success'	=> TRUE,
						'message'	=> 'Get product ok',
						'data'		=> $product,
						'errors'	=> $errors
					],
					REST_Controller::HTTP_OK
				);
			} else {
				array_push($errors, 'Data error');
				$this->response(
					[
						'success'		=> FALSE,
						'message'		=> 'Get product ko',
						'data'			=> array(),
						'errors'		=> $errors
					],
					REST_Controller::HTTP_OK
				);
			}
			
		}
		
	}
	
?>
