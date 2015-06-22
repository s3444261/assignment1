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