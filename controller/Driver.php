<?php
/*
 * Author: Grant Kinkead
 * Student Number: s3444261
 * Student Email: s3444261@student.rmit.edu.au
 *
 * CPT375 Web Database Applications
 * 2015 - Study Period 2
 *
 * Driver Class
 * The Driver Class is the controller of the application. It determines what is
 * being requested and displays the appropriate views with content that has been
 * manufactured by the model.
 *
 * Please Note: The constructor, getter and setter are not my code. I have been
 * using them for many years and don't know where I originally got them from. I
 * would love to be able to give the original author credit as they are a very
 * cool piece of kit!!
 *
 * I can't lay claim to the singleton pattern either.
 */
class Driver {
	
	// Attributes.
	private $_page = '';
	private static $_instance;
	
	// Constructor.
	function __construct($args = array()) {
		foreach ( $args as $key => $val ) {
			$name = '_' . $key;
			if (isset ( $this->{$name} )) {
				$this->{$name} = $val;
			}
		}
	}
	
	// Getter.
	public function &__get($name) {
		$name = '_' . $name;
		return $this->$name;
	}
	
	// Setter.
	public function __set($name, $value) {
		$name = '_' . $name;
		$this->$name = $value;
	}
	
	// Singleton Pattern.
	public static function getInstance() {
		if (! isset ( self::$_instance )) {
			self::$_instance = new self ();
		}
		return self::$_instance;
	}
	
	// Displays either the search form or the results.
	// Dependant on the request.
	public function display() {
		include 'view/header.php';
		include 'view/nav.php';
		include 'view/containerstart.php';
		if ($this->_page == 'results') {
			include 'view/results.php';
		} else {
			include 'view/search.php';
		}
		include 'view/containerend.php';
		include 'view/footer.php';
	}
	
	// Provides the Bootstrap css in the container with the neccessary
	// settings to display either the search form or the results
	// table at the most suitable width, dependant on screen width.
	public function column($i) {
		switch ($i) {
			case 1 :
				if ($this->_page == 'results') {
					return 10;
				} else {
					return 4;
				}
				break;
			case 2 :
				if ($this->_page == 'results') {
					return 10;
				} else {
					return 4;
				}
				break;
			case 3 :
				if ($this->_page == 'results') {
					return 11;
				} else {
					return 4;
				}
				break;
			case 4 :
				if ($this->_page == 'results') {
					return 12;
				} else {
					return 8;
				}
				break;
		}
	}
	
	// Provides the Bootstrap css in the container with the neccessary
	// settings to offset either the search form or the results
	// table at the most suitable width, dependant on screen width.
	public function offset($i) {
		switch ($i) {
			case 1 :
				if ($this->_page == 'results') {
					return 2;
				} else {
					return 4;
				}
				break;
			case 2 :
				if ($this->_page == 'results') {
					return 1;
				} else {
					return 4;
				}
				break;
			case 3 :
				if ($this->_page == 'results') {
					return 1;
				} else {
					return 4;
				}
				break;
			case 4 :
				if ($this->_page == 'results') {
					return 0;
				} else {
					return 2;
				}
				break;
		}
	}
}
?>