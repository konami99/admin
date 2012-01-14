<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
*
* Class provides request filtering feature for CI apps.
*
* Pipe should be called after the execution of the request router,
* because it needs to know controller and method names which are
* going to be used to serve current request.
*
*/
class Pipe
{
	private $filters         = array(); // filter configuration array
	private $call_stack      = array(); // list of filter objects to call after processing the controller
	private $controller_name = '';      // name of the current request controller
	private $method_name     = '';      // name of the current request action method

	//-------------------------------------
    //  Default constructor - requires names of the requested controller and method.
    //-------------------------------------

   	function __construct($filters, $controller_name, $method_name) {
   		//we have to know which part is dir, which part is controller, which part is action
   		//print_r($filters['auth'][1][0]);
   		//die();
   		
		$this->filters         = $filters;
		$this->controller_name = $controller_name;
		$this->method_name     = $method_name;
	}
	// END
	
	//-------------------------------------
    //  Processes filter pipe before controller action call
    //-------------------------------------

   	function process_before()
   	{
	   	if (!is_array($this->filters)) return;
		
		foreach( $this->filters as $filter_name => $filter_conf )
		{
		   	if (isset($this->filters[$filter_name][0]) AND is_array($this->filters[$filter_name][0]))
		   	{
			   	foreach ($filter_conf as $conf)
			   	{
				   	$this->_filter($filter_name, $conf);
			   	}
		   	} else {
				$this->_filter($filter_name, $filter_conf);
		   	}	   	
		}
	}
	// END
	
	/**
	* Processes filter pipe after controller action call
	*/
	function process_after()
	{
		$reverse_call_stack = array_reverse($this->call_stack);
		foreach($reverse_call_stack as $filter)
		{
			$filter->after();
		}
	}

	/**
	* PRIVATE: Tries to apply given filter config entry.
	* Returns true if filter should be applied to the request and false in other case.
	*/
	function _applies($filter_conf)
	{
		$paths = $filter_conf[1];
		switch ( $filter_conf[0] ) {
			// exclusion mode
			case 'exclude':
				$apply = true;
				foreach( $paths as $path ) {
					//echo $path; die();
					if ( $this->_matches($path) ) {
						return false;
					}
				}
				break;
			// inclusion mode
			case 'include':
				$apply = false;
				foreach( $paths as $path ) {
					//echo $path; die();
					if ( $this->_matches($path) ) {
						return true;
					}
				}
				break;
			default:
				$this->_error('Bad filter type in config/filters.php - only "exclude" and "include" are valid.');
		}
		
		return $apply;
	}
	
	/**
	* PRIVATE: Matches given URI pattern to the current request
	*/
	function _matches($path)
	{
		if ( $path == '*' ) {
			return true;
		} else if ( $path == '/' ) {
			if ($_SERVER['REQUEST_URI'] == '' || $_SERVER['REQUEST_URI'] == '/') {
				return true;
			}
		} else {
			//$parts = explode('/', $path);
			
			//print_r($path); die();
			//we have to determine which part is folder name, which part is controller and action
			//format is like this: xxxx/sssss
			//$pathInfo = $this->_filterOutFolder($path);
			//$folderPath = $pathInfo['folderPath'];
			//$validPath = $pathInfo['validPath'];
			
			//echo $path;//die();
			
			//var_dump($_SERVER['REQUEST_URI']);die();
			//var_dump($pathInfo); die();
			//$parts = explode('/', $validPath);
			$parts = explode('/', $path);
			
			if ( $parts[1] == '*' ) {
				if ( $parts[0] == $this->controller_name ) {
					return true;
				}
			} else if ( strpos($parts[1], ',') !== false ) {
				$subparts = explode( ',', $parts[1] );
				if ( array_search($this->method_name, $subparts) !== false ) {
					return true;
				}
			} else {
				//$firstForwardSlash = stripos($validPath, "/");
				//$separator = ($folderPath!=="")?"/":"";
				//$fullFilename = "/" . $folderPath . $separator . substr($validPath, 0, $firstForwardSlash-strlen($validPath));
				//echo $fullFilename . ' ';
				//var_dump(is_file($fullFilename));
				//die();
				//$mpath = "/" . $path;
				
				if ($parts[0] == $this->controller_name && $parts[1] == $this->method_name ) {
					return true;
				}
			}
		}
		return false;
	}	

	/**
	* PRIVATE: Locates and loads code of the filter with given name.
	*/
	function _load_filter($filter_name)
	{		
		$file_name = $filter_name.EXT;
		if ( file_exists(APPPATH.'filters/'.$file_name) ) {
			require_once(APPPATH.'filters/'.$file_name);
		} elseif ( file_exists(BASEPATH.'filters/'.$file_name) ) {
			require_once(BASEPATH.'filters/'.$file_name);
		} else {
			$this->_error("Filter [$filter_name] not found in application/filters.");
		}
	}
	
	/**
	* PRIVATE: Executes filter (only if applies)
	*/
	function _filter($filter_name, $filter_conf)
	{
		if (empty($filter_name))
		{
			$this->_error("Filter name can't be empty!");
		}
		
		// check if filter applies
		if ($this->_applies($filter_conf))
		{
			$class_name = $filter_name.'_filter';
			if (!class_exists($class_name))
			{
				$this->_load_filter($filter_name);
			}
			
			// prepare filter config
			if (isset($filter_conf[2]))
			{
				if (!is_array($filter_conf))
				{
					$config = array($filter_conf[2]);
				} else {
					$config = $filter_conf[2];
				}
			} else {
				$config = array();
			}
			
			// instantiate filter
			$filter = new $class_name($config);
			// put filter on stack to call after() method
			$this->call_stack[] = $filter;
			// execute filter
			$filter->before();
		}
	}
	
	/**
	* PRIVATE: Report error
	*/
	function _error($msg)
	{
		log_message($msg);
		show_error($msg);
		die();
	}
	
	function _filterOutFolder($path)
	{
		$validPath = $path;
		$folderPath = $path;
		for($i=strlen($path)-1;$i>=0;$i--)
		{
			if(substr($path, $i, 1)=='/')
			{
				$folderPath = substr($path, 0, $i-strlen($path));
				//echo $folder_path . ' ';
				//var_dump(is_dir("application/controllers/test"));
				//die();
				if(is_dir("application/controllers/" . $folderPath))
				{
					/*
					$f = stripos($path, "/", $i+1);
					if($f === FALSE || $f === 0)
					{
						$filenameToBeTested = substr($path, $i+1, strlen($path));
					}
					else
					{
						$filenameToBeTested = substr($path, $i+1, $f-strlen($path));
					}
					echo $filenameToBeTested . ' '; die();
					*/
					$validPath = substr($path, $i+1, strlen($path));
					//echo $validPath . ' ';
					//echo 'here';
					break;
				}
				
			}
			else
			{
				$folderPath = "";
			}
		}
		//die();
		//echo $folderPath . ' ';
		//echo $validPath . ' '; die();
		$pathInfo['folderPath'] = $folderPath;
		$pathInfo['validPath'] = $validPath;
		return $pathInfo;
	}
}	
?>