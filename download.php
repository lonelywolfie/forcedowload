<?php

define('CHUNK_SIZE', 1024*1024);
ini_set('display_errors', 0);
ini_set('display_startup_errors', 0);
ini_set('memory_limit','-1');
error_reporting(E_ALL);
/*
cd /var/www/html/file/backend/force_file_download;
php force_file_download.php
http://choilieng.com/apk-on-pc/com.appmakr.choircollegeofmusicanddrama.apk
*/	
	// echo "test OK!<hr/>"; die;
	// ini_set('display_errors', 1); ini_set('display_startup_errors', 1); error_reporting(E_ALL);	
	$current_time=date("Y-m-d H:i:s",time()); //$file_name="/var/www/html/file/backend/force_file_download/log.txt"; $log_file="/var/www/html/log/force_file/".time().".txt";
	$array_stats=array();
	//require_once 'vendor/autoload.php';
	//use \Firebase\JWT\JWT;	
	$request_time=time(); set_time_limit(0); 
	// $main_domain="appnaz.com";	
	// if($name_site == 'apktovi'){
	// 	$main_domain = 'apktovi.com';
	// }
	// if($name_site == '5site'){
	// 	//$apk_file_name = $version.".apk";
	// 	$main_domain = 'apktovi.com';
	// }
	$default_location="http://".$main_domain;	
	// echo $default_location;die;
	// include_once('file/backend/connect.php');	mysql_select_db("apk");
	//include_once('library/function.php');	
	// $remove_arr=file_get_contents("http://appnaz.com/tit/apk/RemovedAppID.txt");
	// $remove_arr=preg_split("/\\r\\n|\\r|\\n/", $remove_arr);
	// $domain=$_GET['d'];
	//$appid=$_GET['id'];$version=$_GET['v']; $versionCode=$_GET['sn']; $obbversioncode=$_GET['sn2'];
	$appid = $_GET['id'];
	$versioncode_by_post = $_GET['vcc'];
	$str_split = str_split(md5($appid));	
	// if (!isset($_GET['token'])) {header('Location: '.$default_location); exit;}
	// if(isset($_GET['check'])){
	// 	$token = $_GET['token'];
	// 	$string_key = md5($appid."_".$_GET['t']);
	// 	//print_r($string_key);die;
	// 	$key = $string_key;
	// 	$key = hash('sha256', $string_key);
	// 	//print_r($key);die;
	// } else {
	// 	$token = $_GET['token'];
	// 	$string_key = 'appnaz_'.($_GET['x']+$_GET['y']);
	// 	$key = hash('sha256', $string_key);
	// }	
	// $decoded = JWT::decode($token, $key, array('HS256'));
	// if(isset($_GET['check'])){
	// 	//print_r($decoded);die;
	// }
	// if($decoded->id !== ($decoded->x+ $decoded->y)){header('Location: '.$default_location); exit;}
	
 //    if(in_array($appid,$remove_arr) && $appid != 'com.facebook.mlite'){header('Location: '.$default_location); exit; }
 //    if($_GET['test'] == 444){
	// 	echo 2;die;
	// }
	
	
	//print_r($versionCode);die;
	$full_file_path='/var/www/html/apk/'.$str_split[0].'/'.$str_split[1].'/'.$str_split[2].'/'.$appid.'/';
	if(!is_dir($full_file_path)){
		header("Location : https://download.apktrending.com/?id=com.linecorp.b612.android&vcc=31090805",true,302);
		die();
	}
	$list_file =scandir($full_file_path);
	
	unset($list_file[0]);
	unset($list_file[1]);
	//print_r($list_file);die;
	$list_version_code = array();
	$checkOBB = 0;
	foreach ($list_file as $item) {
		$tmp = intval(str_replace('.apk', '', $item));
		if(!in_array($tmp, $list_version_code)){

			if(file_exists($full_file_path.$tmp.'.zip')){
				$checkOBB = 1;
				$zip_file_name = $tmp.'.zip';
				$obbversioncode = $tmp;
			}
			$list_version_code[] = $tmp;
		}
	}
	if(isset($_GET['obbvcc'])){
		$obbversioncode = $_GET['obbvcc'];
	}
	$zipfakeFileName=$main_domain."_".$appid."_".$obbversioncode.".zip";
	$versionCode = max($list_version_code);
	if($versionCode == 0){
		goto download_old_file;
		$array_stats['appid']=$appid;
		$array_stats['download_time']=$current_time;
		$array_stats['versionCode']=$versionCode;
		$array_stats['success']=0;
		$array_stats['OBB']=0;
		$array_stats['old_file']=0;
		$array_stats['download_domain']=$domain;
		//file_put_contents($log_file,serialize($array_stats));

		header('Location: '.$default_location); exit;				
	}
	if(isset($_GET['vcc'])){
		$versionCode = $_GET['vcc'];
	}
	
	$apk_file_name=$versionCode.".apk";
	if($name_site == '5site'){
		$apk_file_name = $appid.".apk";
	}
	$fakeFileName=$main_domain."_".$appid."_".$versionCode.".apk";
	//$zip_file_name=$obbversioncode.".zip";
	$full_file_path='/var/www/html/apk/'.$str_split[0].'/'.$str_split[1].'/'.$str_split[2].'/'.$appid.'/'.$apk_file_name;
	$zip_file_path='/var/www/html/apk/'.$str_split[0].'/'.$str_split[1].'/'.$str_split[2].'/'.$appid.'/'.$zip_file_name;
	$file_path='/apk/'.$str_split[0].'/'.$str_split[1].'/'.$str_split[2].'/'.$appid.'/'.$apk_file_name;
	$obb_file_path='/apk/'.$str_split[0].'/'.$str_split[1].'/'.$str_split[2].'/'.$appid.'/'.$zip_file_name;
	$location="/var/www/html".$file_path;	
	$obb_location="/var/www/html".$obb_file_path;	
		// echo $location; die; 
	// /echo $apk_file_name;die;
	/*if($_GET['test']= 11){
		echo $full_file_path;die;
	}*/
	//echo $location;die; 
	if($obbversioncode){
		if(file_exists($zip_file_path) ) {	
			// if($con){insert_force($appid,$versionCode,$current_time,$success=1,$OBB=1,$old_file=0,$domain);}
			$array_stats['appid']=$appid;
			$array_stats['download_time']=$current_time;
			$array_stats['versionCode']=$versionCode;
			$array_stats['success']=1;
			$array_stats['OBB']=1;
			$array_stats['old_file']=0;
			$array_stats['download_domain']=$domain;
			//file_put_contents($log_file,serialize($array_stats));			
			downloadChunked($obb_location,$zipfakeFileName);
		}else{
			// if($con){insert_force($appid,$versionCode,$current_time,$success=0,$OBB=1,$old_file=0,$domain);}
			$array_stats['appid']=$appid;
			$array_stats['download_time']=$current_time;
			$array_stats['versionCode']=$versionCode;
			$array_stats['success']=0;
			$array_stats['OBB']=1;
			$array_stats['old_file']=0;
			$array_stats['download_domain']=$domain;
			//file_put_contents($log_file,serialize($array_stats));			
			header('Location: '.$default_location); exit;	
		}
	}else{
		if(file_exists($full_file_path) ) {	
			$array_stats['appid']=$appid;
			$array_stats['download_time']=$current_time;
			$array_stats['versionCode']=$versionCode;
			$array_stats['success']=1;
			$array_stats['OBB']=0;
			$array_stats['old_file']=0;
			$array_stats['download_domain']=$domain;
			//file_put_contents($log_file,serialize($array_stats));
			// if($con){insert_force($appid,$versionCode,$current_time,$success=1,$OBB=0,$old_file=0,$domain);}
			downloadChunked($location,$fakeFileName);
		}else{

/*tam*/		
			download_old_file:
			$old_file_path='/var/www/html/old_apk/'.$str_split[0].'/'.$str_split[1].'/'.$str_split[2].'/'.$appid;
			$check_file=glob($old_file_path."/*");
			foreach($check_file as $item){
				$type=pathinfo($item,PATHINFO_EXTENSION);
				if($type=="apk"){ //update_done
					$array_stats['appid']=$appid;
					$array_stats['download_time']=$current_time;
					$array_stats['versionCode']=$versionCode;
					$array_stats['success']=1;
					$array_stats['OBB']=0;
					$array_stats['old_file']=1;
					$array_stats['download_domain']=$domain;
					//file_put_contents($log_file,serialize($array_stats));				 
					// if($con){insert_force($appid,$versionCode,$current_time,$success=1,$OBB=0,$old_file=1,$domain);}
					downloadChunked($item,$fakeFileName);					
				}				
			}
/*end tam*/
			$array_stats['appid']=$appid;
			$array_stats['download_time']=$current_time;
			$array_stats['versionCode']=$versionCode;
			$array_stats['success']=0;
			$array_stats['OBB']=0;
			$array_stats['old_file']=0;
			$array_stats['download_domain']=$domain;
			//file_put_contents($log_file,serialize($array_stats));
			// if($con){insert_force($appid,$versionCode,$current_time,$success=0,$OBB=0,$old_file=0,$domain);}
			// if($result==0){put_log("cannot update sql - ".$appid." \n",$file_name);}
			header('Location: '.$default_location); exit;	
		}

	}
	// function downloadChunked($location,$fakeFileName){
	// 	//$fp = fopen($location, 'rb');
	// 	header('Content-type: octet/stream');
	// 	header('Content-disposition: attachment; filename='.$fakeFileName.';');
	// 	header('Content-Length: '.filesize($location));
	// 	readfile($location);
	// 	exit;		
	// }
	function downloadChunked($location, $fakeFileName, $retbytes = TRUE){
		$split = explode("apk",$location);
		$new_location = "/apk/".$split[1];
		// echo $new_location;die;
		header('Content-Description: File Transfer');
		header('Cache-control: private');
		header('Content-Type: application/octet-stream');
		header("Content-Disposition: attachment;filename=$fakeFileName");
		header('Expires: 0');
		// header('Accept-Ranges: bytes');
		header("X-Accel-Redirect: $new_location");
		// $userAgent = $_SERVER['HTTP_USER_AGENT'];
		// if(strpos($userAgent, 'XiaoMi/MiuiBrowser') === false){
		// 	$file_size = filesize($location);
	    //     $fh=fopen($location, "r");
	    //     $speed=50000;
		// 	$start=0;
	    //     $end=$file_size;
		// 	if(isset($_SERVER['HTTP_RANGE']) && preg_match('/^bytes=(\d+)-(\d*)/', $_SERVER['HTTP_RANGE'], $arr)){

	    //         // Starting byte
	    //         $start=$arr[1];
	    //         if($arr[2]){
	    //             // Ending byte
	    //             $end=$arr[2];
	    //         }
	    //     }
	    //     if($start>$end || $start>=$file_size){
	    //         header("HTTP/1.1 416 Requested Range Not Satisfiable");
	    //         header("Content-Length: 0");
	    //     } else {
	    //     	//echo $file_size.PHP_EOL;
	    //     	//echo $end;die;
	    //     	if($start == 0 && $end == $file_size){
	    //             // Send HTTP OK header
	    //             header("HTTP/1.1 200 OK");
	    //         }
	    //         else{
	    //             // For resume download
	    //             // Send Partial Content header
	    //             header("HTTP/1.1 206 Partial Content");
	    //             // Send Content-Range header
	    //    			header("Content-Range: bytes ".$start."-".$end."/".$file_size);
	    //         }

	    //     	$left=$end-$start;
		       
		// 		header('Content-Description: File Transfer');
		// 		header('Cache-control: private');
		// 		header('Content-Type: application/octet-stream');
		// 		header('Content-Length: '.$left);
		// 		header('Content-Disposition: attachment;filename='.$fakeFileName);
		// 		header('Expires: 0');
		// 		header('Accept-Ranges: bytes');
		// 		fseek($fh, $start);
	    //         // Loop while there are bytes left
	    //         while($left>0){
	    //                 // Bytes to be transferred
	    //                 // according to the defined speed
	    //                 $bytes=$speed*1024;
	    //                 // Read file per size
	    //                 echo fread($fh, $bytes);
	    //                 while (ob_get_level() > 0)
		//                 {
		//                     ob_end_flush();
		//                 }
	    //                 // Flush the content to client
	    //                 flush();
	    //                 // Substract bytes left with the tranferred bytes
	    //                 $left-=$bytes;
	    //                 // Delay for 1 second
	    //                 sleep(1);
	    //         }
	    //     }
		// 	fclose($fh);
		// 	exit();
		// } else {
		// 	$fp = fopen($location, 'rb');
		// 	header('Content-type: octet/stream');
		// 	header('Content-disposition: attachment; filename='.$fakeFileName);
		// 	header('Content-Length: '.filesize($location));
		// 	readfile($location);
		// 	exit;	
		// } 
	}


 ?>