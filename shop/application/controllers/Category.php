<?php
	
	defined('BASEPATH') OR exit('No direct script access allowed');
	
	require(APPPATH.'/libraries/REST_Controller.php');
	
	/**
	 * Class class Category extends REST_Controller
	 * 
	 * This class is used to instantiate Category objects (for API REST)
	 */
	class Category extends REST_Controller {
		
		/**
		 * Constructor public function __construct() {
		 *
		 * Its functions are:
		 *   - Initialize the instances of the class Category
		 */
		public function __construct() {
			
			// Initialize the instances of the class Category
			parent::__construct();
			$this->load->model('Categories');
			
		}
		
		/**
		 * Method public function categories_get()
		 * 
		 * Its functions are:
		 *   - Get all categories
		 *   - Return the API REST method result
		 */
		public function categories_get() {
			
			// Variables
			$categories = array();
			$errors = array();
			
			// Get all categories
			$categories = $this->Categories->get_categories()->result_array();
			
			// Return the API REST method result
			if ($categories) {
				$this->response(
					[
						'success'	=> TRUE,
						'message'	=> 'Get categories ok',
						'data'		=> $categories,
						'errors'	=> $errors
					],
					REST_Controller::HTTP_OK
				);
			} else {
				array_push($errors, 'Data error');
				$this->response(
					[
						'success'		=> FALSE,
						'message'		=> 'Get categories ko',
						'data'			=> array(),
						'errors'		=> $errors
					],
					REST_Controller::HTTP_OK
				);
			}
			
		}
		
		/**
		 * Method public function category_detail_get($category_id)
		 * 
		 * Its functions are:
		 *   - Get the category detail with its associated products
		 *   - Return the API REST method result
		 *
		 * Parameters:
		 *   @param $category_id: Category identifier
		 */
		public function category_detail_get($category_id) {
			
			// Variables
			$category = array();
			$category_products = array();
			$errors = array();
			
			// Get the category detail with its associated products
			$category = $this->Categories->get_category_detail($category_id)->result_array();
			$category_products = $this->Categories->get_category_products($category_id)->result_array();
			
			// Return the API REST method result
			if (($category) && (count($category) == 1) && ($category_products)) {
				$category[0]["products"] = $category_products;
				$this->response(
					[
						'success'	=> TRUE,
						'message'	=> 'Get category ok',
						'data'		=> $category,
						'errors'	=> $errors
					],
					REST_Controller::HTTP_OK
				);
			} else {
				array_push($errors, 'Data error');
				$this->response(
					[
						'success'		=> FALSE,
						'message'		=> 'Get category ko',
						'data'			=> array(),
						'errors'		=> $errors
					],
					REST_Controller::HTTP_OK
				);
			}
			
		}
		
	}
	
?>
