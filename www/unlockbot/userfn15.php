<?php
namespace PHPMaker2019\unlockBOT;
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

// Global user functions
// Page Loading event
function Page_Loading() {

	//echo "Page Loading";
}

// Page Rendering event
function Page_Rendering() {

	//echo "Page Rendering";
}

// Page Unloaded event
function Page_Unloaded() {

	//echo "Page Unloaded";
}

// Personal Data Downloading event
function PersonalData_Downloading(&$row) {

	//echo "PersonalData Downloading";
}

// Personal Data Deleted event
function PersonalData_Deleted($row) {

	//echo "PersonalData Deleted";
}

//  // SANIFICA LA URL ??? RECUPERATA DAL PROGETTO GEOMOTO
//  
//  $current_url =  parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
//  $compare_url = $_SERVER['REQUEST_SCHEME']."://".$_SERVER['HTTP_HOST'];
//  $sanitized_query_string = "";
//   
//  parse_str($_SERVER['QUERY_STRING'], $paramArray);
//  
//  $isToSanitize=0;
//  $isToChangeReferer=0;
//  
//  if (isset($_SERVER["HTTP_REFERER"]) && (strpos($_SERVER["HTTP_REFERER"],$compare_url) !== 0 )){
//  	$isToChangeReferer=1;
//  }
//   
//  if (count($paramArray)>0)
//  {
//  	$sanitized_query_string = "?";
//  	foreach ($paramArray as $key => $value){
//  		$sanitized_value = "";
//  		$decodedValue =urldecode($value);
//  
//  		if (strpos($key,'id')!== false){
//  			$sanitized_value = filter_var($decodedValue, FILTER_SANITIZE_NUMBER_INT);
//  		}else{
//  			$sanitized_value = filter_var($decodedValue, FILTER_SANITIZE_STRING);
//  		}
//  		if ($sanitized_value <> $value){
//  			$isToSanitize=1;
//  		}
//  		$sanitized_query_string = $sanitized_query_string."&".$key."=".$sanitized_value;
//  	}
//  
//  	if ($isToSanitize ==1 && $isToChangeReferer==0){
//  		header("location:".$current_url.$sanitized_query_string);
//  
//  	}else if ($isToChangeReferer==1){
//  		header("location:http://google.com");
//  		echo "<script>window.open(\"".$current_url.$sanitized_query_string."\",\"_self\")</script>";
//  	}
//  }
//  else if ($isToChangeReferer==1)
//  {
//  	header("location:http://google.com");
//  	echo "<script>window.open(\"".$current_url.$sanitized_query_string."\",\"_self\")</script>";
//  }
//  
//  if (!isset($EW_RELATIVE_PATH)) {
//  	$EW_RELATIVE_PATH = "";
//  	$EW_ROOT_RELATIVE_PATH = "."; // Relative path of app root
//  };

?>