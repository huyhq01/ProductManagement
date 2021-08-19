<?php 
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

$data = json_decode(file_get_contents("php://input"));

include_once '../controllers/user_controller.php';

$status = (new UserController())->register($data->email, $data->password);
if ($status) {
    http_response_code(200);
    echo json_encode(
        array(
            "status" => true,
            "message" => "Register success"
        )
    ); 
} else {
    http_response_code(401);
    echo json_encode(
        array(
            "status" => false,
            "message" => "Register failed"
        )
    );
}

?>