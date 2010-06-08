<?php 

Class Validator {
	private $errors = FALSE;
	
	function is_required($name) {
		$value = trim($_POST[$name]);
		
		if (empty($value)) {
			$this->errors[$name] = 'REQUIRED';
		}
	}
	
	function is_email($name) {
		$value = trim($_POST[$name]);
		
    if (!empty($value)) {
      if (!eregi("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,6})$", $value)) {
        $this->errors[$name] = 'INVALID_EMAIL';
      }
    }
	}
	
	function has_errors() {
    return $this->errors;
	}
	
	function test() {
		return 'test';
	}
}