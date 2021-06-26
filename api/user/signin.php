<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type, Access-Control-Allow-Methods, Authorization, X-Request-With');


ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
include_once "../object/User.php";

$user = new User();

$data = json_decode(file_get_contents("php://input"));

$user->email = $data->email;
$user->password = $data->password;


if(!empty($user->email) && !empty($user->password)) {
    if ($user->signin()) {
        http_response_code(200);
        echo json_encode(
            array('message' => 'Authorized')
        );
    } else {
        http_response_code(401);
        echo json_encode(
            array('message' => 'User was not found')
        );
    }
}