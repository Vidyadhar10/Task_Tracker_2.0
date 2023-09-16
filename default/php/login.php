<?php
session_start();
include "connection.php";

if (isset($_POST['mobnum']) && isset($_POST['password'])) {
    $uname = $_POST['mobnum'];
    $pas = $_POST['password'];
    $loginAs = $_POST['loginAs'];
    $_SESSION['loginAs'] = $loginAs;

    $pass = md5($pas);

    if (empty($uname)) {
        $response = array(
            "success" => false,
        );
        header('Content-Type: application/json');
        echo json_encode($response);
    } elseif (empty($pass)) {
        $response = array(
            "success" => false,
        );
        header('Content-Type: application/json');
        echo json_encode($response);
    } else {
        $sql = "SELECT * FROM employeedata WHERE MobileNo = '$uname' AND Password='$pass'";
        $result = mysqli_query($con, $sql);
        if (!$result) {
            $response = array(
                "success" => false,
            );
            header('Content-Type: application/json');
            echo json_encode($response);
        }
        if (mysqli_num_rows($result) === 1) {
            $row = mysqli_fetch_assoc($result);
            $is_admin = $row['isAdmin'];

            if ($row['MobileNo'] === $uname && $row['Password'] === $pass) {
                $_SESSION['Mobile_No'] = $row['MobileNo'];
                $_SESSION['AdminStatus'] = $row['isAdmin'];

                if ($is_admin == 0 && $loginAs == 1) {
                    $response = array(
                        "success" => false,
                    );
                    header('Content-Type: application/json');
                    echo json_encode($response);
                } else {
                    $response = array(
                        "success" => true,
                    );
                    header('Content-Type: application/json');
                    echo json_encode($response);
                }
            } else {
                $response = array(
                    "success" => false,
                );
                header('Content-Type: application/json');
                echo json_encode($response);
            }
        } else {
            $response = array(
                "success" => false,
            );
            header('Content-Type: application/json');
            echo json_encode($response);
        }
    }
} else {
    $response = array(
        "success" => false,
    );
    header('Content-Type: application/json');
    echo json_encode($response);
}
mysqli_close($con);
