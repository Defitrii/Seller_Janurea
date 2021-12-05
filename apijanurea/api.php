<?php
include_once('db.php');
@$dest = $_GET['dest'];

if(@$dest == "product"){
    get_product();
}else if (@$dest == "addProduct"){
    addProduct();
}else if (@$dest == "updateProduct"){
    if (@$_GET['id'] != ""){
        updateProduct($_GET['id']);
    } else {
        $response = [
            'status'    => false,
            "message"   => "Data Must Be Entry",
            'data'      => [],
        ];
        sendJsonResponse($response);
    }
} else if (@$dest == "addUser"){
    addUser();
} else if (@$dest == "user"){
    get_user();
}


function get_product(){
    global $conn;
    $userlist = [];
    $sqlproduct = "SELECT * FROM product";

    $result = $conn->query($sqlproduct);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $userlist[] = [
                'id' => $row['id_product'],
                'name' => $row['product_name'],
                'qty'   => $row['product_qty'],
                'price' => $row['product_price'],
                'image' => $row['product_image']
            ];
        }
        $response = [
            'status'    => true,
            "message"   => "seccess",
            'data'      => $userlist,
        ];
    }else{
        $userlist = [];
        $response = [
            'status'    => true,
            "message"   => "product not found",
            'data'      => $userlist,
        ];
    }
    
    sendJsonResponse($response);
}

function sendJsonResponse($data){
    header('Content-Type: application/json');
    echo json_encode($data);
}

function addProduct(){
    global $conn;
    if (!$_POST){
        $response = [
            'status'    => false,
            "message"   => "Data Must Be Entry",
            'data'      => [],
        ];
    } else {
        if (@$_POST['name'] && @$_POST['qty'] && @$_POST['price'] && @$_POST['image']){
            $name = $_POST['name'];
            $qty = $_POST['qty'];
            $price = $_POST['price'];
            $image = $_POST['image'];

            $query = "INSERT INTO 
                    `product` (`id_product`, `product_name`, `product_price`, `product_qty`, `product_image` ) 
                    VALUES (NULL, '$name', '$price', '$qty', '$image')";
            $conn->query($query);
            $response = [
                'status'    => true,
                "message"   => "Success Add Data",
                'data'      => [],
            ];
        } else {
            $response = [
                'status'    => false,
                "message"   => "Data Must Be Entry",
                'data'      => [],
            ];
        }
    }

    sendJsonResponse($response);
}

function updateProduct($id){
    global $conn;
    if (!$_POST){
        $response = [
            'status'    => false,
            "message"   => "Data Must Be Entry",
            'data'      => [],
        ];
    } else {
        if (@$_POST['name'] && @$_POST['qty'] && @$_POST['price'] && @$_POST['image']){
            $name = $_POST['name'];
            $qty = $_POST['qty'];
            $price = $_POST['price'];
            $image = $_POST['image'];

            $query = "UPDATE `product` SET 
                `product_name` = '$name', 
                `product_price` = '$price', 
                `product_qty` = '$qty',
                `product_image` = '$image' 
                WHERE `product`.`id_product` = $id";
            $conn->query($query);
            $response = [
                'status'    => true,
                "message"   => "Success Update Data",
                'data'      => [],
            ];
        } else {
            $response = [
                'status'    => false,
                "message"   => "Data Must Be Entry",
                'data'      => [],
            ];
        }
    }

    sendJsonResponse($response);
}

function get_user(){
    if (!$_POST){
        $response = [
            'status'    => false,
            "message"   => "Data Must Be Entry",
            'data'      => [],
        ];
    } else {
        global $conn;
        $userlist = [];
        $email = $_POST['email'];
        $pass = $_POST['pass'];
        $sqlproduct = "SELECT * FROM user WHERE user_email = '$email' AND user_password = '$pass'";

        $result = $conn->query($sqlproduct);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $userlist[] = [
                    'id' => $row['user_id'],
                    'name' => $row['user_name'],
                    'email' => $row['user_email'],
                    'phone' => $row['user_phone'],
                    'address' => $row['user_address'],
                    'datareg' => $row['user_datareg']
                ];
            }
            $response = [
                'status'    => true,
                "message"   => "success",
                'data'      => $userlist,
            ];
        }else{
            $userlist = [];
            $response = [
                'status'    => false,
                "message"   => "user not found",
                'data'      => $userlist,
            ];
        }
    }

    sendJsonResponse($response);
}

function addUser(){
    global $conn;
    var_dump($_POST);
    if (!$_POST){
        $response = [
            'status'    => false,
            "message"   => "Data Must Be Entry",
            'data'      => [],
        ];
    } else {
        if (@$_POST['name'] && @$_POST['email'] && @$_POST['pass1']){
            $name = $_POST['name'];
            $email = $_POST['email'];
            $pass1 = $_POST['pass1'];
            $phone = "";
            $address = "";

            $datareg = date('Y-m-d H:i:s');

            $query = "INSERT INTO 
                `user` (`user_id`, `user_email`, `user_name`, `user_password`, `user_phone`, 
                `user_address`, `user_datareg`, `otp`) 
                VALUES (NULL, '$email', '$name', '$pass1', 
                '$phone', 
                '$address', 
                '$datareg', '11010')";

            $conn->query($query);
            $response = [
                'status'    => true,
                "message"   => "Success Add Data",
                'data'      => [],
            ];
        } else {
            $response = [
                'status'    => false,
                "message"   => "Data Must Be Entry",
                'data'      => [],
            ];
        }
    }

    sendJsonResponse($response);
}

?>
