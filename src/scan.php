<?php
//$config_json = file_get_contents('config.json');
//$config = json_decode($config_json, true);
include "config.php";
$resp = array();
$msg = array();
//chdir($config["data_dir"]);
chdir($data_dir);
$files = glob("*");
$n = 0;
$m = 0;
foreach($files as $file){
    $n++;
    $msg['filename'] = $file; 
    $create = filemtime($file);
    $msg['create-at'] = date('Y-m-d H:i:s', $create);
    $saved = round(time() - $create);
    $msg['saved-seconds'] = $saved;
    $msg['expired'] = false;
    $msg['deleted'] = false;
    if ($saved > $expired_second){
        $msg['expired'] = true;
    }
    if ($msg['expired'] == true){
        if (isset($_GET["delete"])){
            $r = unlink($file); 
            if ($r) {
                $msg['deleted'] = true;
                $m++;
            }
        }
    }
    $resp[] = $msg;
}
// log
/*
$log = "[" . date("Y-m-d H:i:s") . "] scanned ". $n . ", deleted " . $m . ".\r\n";
$log_file = "log";
chdir("log");
$handle = fopen($log_file, "a+");
fwrite($handle, $log);
fclose($handle);
*/
// resp
echo json_encode($resp, JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT);
?>
