<?php
	
	defined('BASEPATH') OR exit('No direct script access allowed');
	
	/**
	 * Class class Categories extends CI_Model
	 * 
	 * This class is used to instantiate Categories objects
	 */
	class Categories extends CI_Model {
		
		/**
		 * Constructor public function __construct() {
		 *
		 * Its functions are:
		 *   - Initialize the instances of the class Categories
		 */
		public function __construct() {
			
			// Initialize the instances of the class Categories
			parent::__construct();
			
		}
		
		/**
		 * Method public function get_categories()
		 * 
		 * Its functions are:
		 *   - Return all categories
		 */
		public function get_categories() {
			
			// Return all categories
			$query = $this->db->query("CALL GET_CATEGORIES();");
			mysqli_next_result( $this->db->conn_id);
			return $query;
		
		}
		
		/**
		 * Method public function get_category_detail($category_id)
		 * 
		 * Its functions are:
		 *   - Return the category detail with its associated products
		 *
		 * Parameters:
		 *   @param $category_id: Category identifier
		 */
		public function get_category_detail($category_id) {
			
			// Return the category detail with its associated products
			$query = $this->db->query("CALL GET_CATEGORY(".$category_id.");");
			mysqli_next_result( $this->db->conn_id);
			return $query;
		
		}
		
		/**
		 * Method public function get_category_products($product_id)
		 * 
		 * Its functions are:
		 *   - Return the category products
		 *
		 * Parameters:
		 *   @param $category_id: Category identifier
		 */
		public function get_category_products($category_id) {
			
			// Return the category products
			$query = $this->db->query("CALL GET_CATEGORY_PRODUCTS(".$category_id.");");
			mysqli_next_result( $this->db->conn_id);
			return $query;
		
		}
		
	}
	
?>
