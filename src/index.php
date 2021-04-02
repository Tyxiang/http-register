<?php
ini_set("display_errors", "Off");
date_default_timezone_set("Asia/Shanghai");
header('Access-Control-Allow-Origin:*');
//header('Access-Control-Allow-Methods:*');  
//header('Access-Control-Allow-Headers:X-Requested-With,X_Requested_With'); 
header("Content-type:application/json;charset='utf-8'");

$config_json = file_get_contents('config.json');
$config = json_decode($config_json, true);

$uri = $_SERVER['REQUEST_URI'];
$method = $_SERVER['REQUEST_METHOD'];
$data_path = $GLOBALS['config']['data_dir'] . hash('sha256', $uri);

if ($method == "GET") { 
    $data = file_get_contents($data_path);
    if ($data == false){
        echo '{"success":false, "message":"read failed!"}';
        exit();
    }else{
        echo $data;
        exit();
    }
} 

if ($method == "POST") {
    $size = (int) $_SERVER['CONTENT_LENGTH'];
    if ($size > 1024 * 10){
        echo '{"success":false, "message":"too big!"}';
        exit();
    }
    $data = file_get_contents("php://input");
    $r = file_put_contents($data_path, $data);
    if ($r == false) {
        echo '{"success":false, "message":"save failed!"}';
        exit();
    }else{
        echo '{"success":true}';
        exit();
    }
} 

echo '{"success":false, "message":"not support!"}';
