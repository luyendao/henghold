<?php 

class Loader{

	private $scope;
	private $class;

	function __construct($scope,$class){
		$this->scope = $scope;
		$this->class = $class;
	}

	function view($view,$data=array(),$string = false){
		extract((array)$data);
		
		foreach(get_object_vars($this->scope) as $i_key=>$i_var) if(!isset($this->$i_key)) $this->$i_key =& $this->scope->$i_key;

		switch($this->class){
			
			case 'PostType':
				$path = WC_TOOLBOXPATH.'/post_types/views/'.$view.'.php';
				break;
			case 'Widget':
				$path = WC_TOOLBOXPATH.'/widgets/views/'.$view.'.php';
				break;
		}

		ob_start();

		if(file_exists($path)){
			include($path);
		}else{
			echo ' The "'.$view.'" View Does Not Exists!';
		}

		if($string){
			$buffer = ob_get_contents();
			@ob_end_clean();
			return $buffer;
		}

		

	}

	function library($name, $alias = null){
		if(!isset($alias)) $alias = strtolower($name);
		if(isset($this->scope->$alias) || !file_exists(WC_TOOLBOXPATH.'/libraries/'.$name.'.php')) return;
		include_once(WC_TOOLBOXPATH.'/libraries/'.$name.'.php');
		return $this->scope->$alias = new $name();
	}

	function helper($loc){

	}
}

//end of file