<?php 

class Simplate{


	function render($template,$values,$wpauto=true){
		$output = $template;
		foreach($values as $key=>$value)$output = preg_replace('/\{\{'.$key.'\}\}/',$value,$output);
		return ($wpauto) ? wpautop($output) : $output;
	}

	function email($from,$to,$subject='Site Email',$template,$data){

		$headers  = "From: ".$from."\r\n";
	    $headers .= "Content-type: text/html; charset=iso-8859-1\r\n";

		$message = $this->parse($template,$data);

		return mail($to, $subject, $message, $headers);
	}
}

//end of file