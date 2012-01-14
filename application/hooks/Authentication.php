<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
class Authentication{
    function isLoggedin(){
		
    	//global $class, $method;
    	//print_r($class);
    	//print_r($method);
    	//die();
    	
        $router = &load_class('Router');
        $session = &load_class('session');

        $controller = strtolower($router->fetch_class());
        $action = strtolower($router->fetch_method());
        //echo $controller.', '.$action;
        //exit(0);

        if($session->userdata('username') == false){
        	//echo 'login';
        	//exit(0);
        }
    }
}

?>
