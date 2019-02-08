<?php
	
	defined('BASEPATH') OR exit('No direct script access allowed');
	
	/**
	 * Class class Shop extends CI_Controller
	 * 
	 * This class is used to instantiate Shop objects
	 */
	class Shop extends CI_Controller {
		
		/**
		 * Constructor public function __construct()
		 *
		 * Its functions are:
		 *   - Initialize the instances of the class Shop
		 */
		public function __construct() {
			
			// Initialize the instances of the class Shop
			parent::__construct();
			
		}
		
		/**
		 * Method public function index()
		 * 
		 * Its functions are:
		 *   - Load models
		 *   - Get data
		 *   - Load view
		 */
		public function index() {
			
			// Load models
			$this->load->model('Categories');
			
			// Get data
			$data['categories'] = $this->Categories->get_categories()->result();
			
			// Load view
			$this->load->view('Shop', $data);
			
		}
		
	}
	
?>
