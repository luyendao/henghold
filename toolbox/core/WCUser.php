<?php

class WCUser extends WP_User{
	
	public function __construct($id, $name=null, $blog_id=null){
		parent::__construct($id, $name, $blog_id);
	}

	public function logged_in(){
		return $this->exists();
	}

	public function log_out(){
		//return $this->exists();
	}

	public function log_in(){
		//return $this->exists();
	}

	public function has_role($roles){
		if(!$this->exists()) return false;
		if(is_array($roles)) foreach($roles as $role) if(in_array($role,$this->roles)) return true;
		return in_array($roles,$this->roles);
	}


}