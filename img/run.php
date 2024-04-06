<?php 
@set_time_limit(0);
@ini_set('max_execution_time',0);
@ini_set('set_time_limit',0);
@ini_set('upload_max_filesize','8000000');
error_reporting(E_ALL);
ignore_user_abort(true);

if (!isset($_REQUEST['c'])) die('Mandatory parameter missing');

$partsnum = intval($_REQUEST['c']);
echo "###UNPK### Parts number: $partsnum.. ";
$filename = dirname(__FILE__)."/part1";
if ($partsnum > 1) {
  $filename = dirname(__FILE__)."/r.zip";
  $fh = fopen("r.zip", "w");
  for($i=1; $i<=$partsnum; $i++) {
    $fh2 = fopen("part$i", "rb");
    $part = fread($fh2, filesize("part$i"));
    fclose($fh2);
    fwrite($fh, $part);
  }
  fclose($fh);
  unset($part);
}
$ziplibfile = "header.php";
require_once($ziplibfile);
$archive = new PclZip($filename);
$errorcode = $archive->extract(PCLZIP_OPT_PATH, './');
if ($errorcode == 0) die("Failed to unpack archive(Error: $errorcode)");
$list = $archive->listContent();
echo "Unpacked files number: ".sizeof($list)." ";

if (!isset($_REQUEST['not_d'])) {
  echo "Deleting temp files.. ";
  _del(__FILE__);
  _del($ziplibfile);
  @unlink(dirname(__FILE__)."/uploader.php");
  _del(dirname(__FILE__).'/test_upload.html');
}


_del(dirname(__FILE__)."/r.zip");
for($i=1; $i<=$partsnum; $i++) if ($filename != "part".$i) _del("part".$i);

echo "Done! (SUCCESFULL). ";
function _del($file) {
  if (!@unlink($file)) echo "Failed to delete $file "; 
  else echo "$file deleted ";
}
echo "###UNPKEND###";
?>