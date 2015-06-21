<?php
class Driver {
	private $_page = '';
	private static $_instance;
	
	/*
	 * Please Note: This constructor, getter and
	 * setter are not my code. I have been using
	 * them for many years and don't know where I
	 * originally got them from.
	 */
	function __construct($args = array()) {
		foreach ( $args as $key => $val ) {
			$name = '_' . $key;
			if (isset ( $this->{$name} )) {
				$this->{$name} = $val;
			}
		}
	}
	public function &__get($name) {
		$name = '_' . $name;
		return $this->$name;
	}
	public function __set($name, $value) {
		$name = '_' . $name;
		$this->$name = $value;
	}
	public static function getInstance() {
		if (! isset ( self::$_instance )) {
			self::$_instance = new self ();
		}
		return self::$_instance;
	}
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
	public function column() {
		if ($this->_page == 'results') {
			return 8;
		} else {
			return 6;
		}
	}
	public function offset() {
		if ($this->_page == 'results') {
			return 2;
		} else {
			return 3;
		}
	}
}
?>