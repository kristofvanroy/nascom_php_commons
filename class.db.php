<?php
Class DB {
	private $conn;
	private $user;
	private $password;
	private $database;
	
	private $affected_rows;
	private $insert_id;
	
  function __construct() {
  	$this->affected_rows = FALSE;
    $this->insert_id = FALSE;
    
  	$distro = Common::get_distro();

  	switch ($distro) {
  		case 'local':
		    $this->user = 'root';
		    $this->password = 'root';
		    $this->host = 'localhost';
		    break;
  		case 'dev':
  		case 'staging':
		    $this->user = 'lavalin';
		    $this->password = 'lavalin';
		    $this->host = 'esquel.nascom.be';
		    break;
  	}
  	
    $this->database = 'lavalin';
  }
  
  function query($sql, $start = FALSE, $limit = FALSE) {
  	if ($this->conn) {
  		$this->affected_rows = FALSE;
  		$this->insert_id = FALSE;
  		
  		if ($start !== FALSE && $limit > 0) {
  			$start = intval($start);
  			$limit = intval($limit);
  			$sql .= " LIMIT $start, $limit";
  		}
  		
	    $result = mysql_query($sql, $this->conn);
	    
	    $this->affected_rows = mysql_affected_rows();
	    $this->insert_id = mysql_insert_id();
	    
	    return $result;
  	}
  	else {
  		return FALSE;
  	}
  }
  
  public function get_affected_rows() {
  	return $this->affected_rows;
  }
  
  public function get_insert_id() {
  	return $this->insert_id;
  }
  
  public function connect() {
  	$this->conn = mysql_connect($this->host, $this->user, $this->password);
  	mysql_select_db($this->database, $this->conn);
  }
}