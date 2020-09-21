<?php  
$host = "$_SERVER[HTTP_HOST]";
$path = "$_SERVER[REQUEST_URI]";
// echo "ok";die;
// if (!empty($_SERVER['HTTP_CLIENT_IP']))   
//   {
//     $ip_address = $_SERVER['HTTP_CLIENT_IP'];
//   }
// //whether ip is from proxy
// elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))  
//   {
//     $ip_address = $_SERVER['HTTP_X_FORWARDED_FOR'];
//   }
// //whether ip is from remote address
// else
//   {
//     $ip_address = $_SERVER['REMOTE_ADDR'];
//   }
// echo $ip_address;die;
// echo $host;die;
switch ($host) {
	case 'download.apktrending.com':
		// code...
		$main_domain = 'apktrending.com';
		require 'download.php';
		break;
	case 'downloadserver8.choilieng.com':

		$main_domain = 'choilieng.com';
		require 'download.php';
		break;
	case '128.199.121.38':

		$main_domain = '128.199.121.38';
		echo $main_domain;die;
		require 'download.php';
		break;
	case 'backend':

		$main_domain = 'backend';
		// echo $main_domain;
		require 'download.php';
		break;
	case '128.199.92.141':

		$main_domain = '128.199.92.141';
		// echo $main_domain;
		require 'download.php';
		break;
	default:
	// echo $main_domain;
		break;
}
 ?>