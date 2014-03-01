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
	 
	 
	 /*
	  * read function
	  * */
	  
	  public function _read($id) {
		  // set query
		  $this->db->query('SELECT data FROM session WHERE id= :id');
		  
		  $this->db->bind(':id', $id);
		  
		  // attempt execution
		  // if successful
		  if($this->db->execute()){
			 // save returned row
			 $row = $this->db->single();
			 // return the data
			 return $row['data']; 
			  
		  }else{
			 // return an empty string
			 return '';  
		   }
	  }
	  
	  
	  
	  /*
	   *write function 
	   * */
	 
	   public function _write($id, $data) {
		   // create time stamp
		   $access = time();
		   
		   // set query
		   $this->db->query('REPLACE INTO session VALUES (:id, :access, :data)');
		   
		   // bind data
		   $this->db->bind(':id', $id);
		   $this->db->bind(':access', $access);
		   $this->db->bind(':data', $data);
		   
		   // attempt execution
		   // if successful
		   if($this->db->execute()){
			   //return true
			   return true;
		   }
		   
		   // return false
		   return false;
		   
	   }
	
	
}

?>
