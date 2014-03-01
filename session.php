<?php

/*Session
 * */

class Session {
	
	
   // Db object
	 
	private $db;
	
	
	public function _construct() {
		// instantiate new database object
		$this->db = new Database;
		
		
		// set handler to overide SESSION
		session_set_save_handler(
		    array($this, "_open"),
		    array($this, "_close"),
		    array($this, "_read"),
		    array($this, "_write"),
		    array($this, "_destroy"),
		    array($this, "_gc")		
		);
		
		// start the sesion
		session_start();
		
	}
	
	
	/*
	 * open function
	 * */
	
	
	public function _open() {
	   // if successful
	   if($this->db) {
		   // return true
		   return true;
	   }	
	       //return false
	       return false;
		
	}
	
	
	/*
	 * close function
	 * */
	 
	 public function _close() {
		// close the database connection
		// if successful
		if ($this->db->close()) {
			// return true
			return true;
		}
		// return false
		return false;
		 
	 }
	
}

?>
