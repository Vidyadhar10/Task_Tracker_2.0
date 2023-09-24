<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if (isset($_POST['email']) && isset($_POST['subject']) && isset($_POST['body'])) {

    $email = $_POST['email'];

    // For sending mail to project selected employees
    if (isset($_POST['SelectedEmps'])) {
        include '../php/connection.php';

        $my_array = json_decode($_POST['SelectedEmps'], true);

        $subject = $_POST['subject'];
        $body = $_POST['body'];

        require './PHPMailer/src/Exception.php';
        require './PHPMailer/src/PHPMailer.php';
        require './PHPMailer/src/SMTP.php';


        $mail = new PHPMailer;

        $mail->SMTPDebug = 4;
        $mail->isSMTP();

        $mail->Host = 'smtp.gmail.com';
        $mail->Port = 587;
        $mail->SMTPAuth = true;
        $mail->Username = 'tasktracker2023@gmail.com';
        $mail->Password = 'lkilidhacfpwgyis';

        $mail->setFrom('tasktracker2023@gmail.com', 'Task Tracker');
        $mail->addReplyTo('tasktracker2023@gmail.com', 'Task Tracker');


        foreach ($my_array as $recipient) {

            $getEmpData = mysqli_query($con, "SELECT * FROM `employeedata` WHERE `ID`='$recipient'");
            while ($row = $getEmpData->fetch_assoc()) {
                $empnm = $row['EmpName'];
                $email = $row['Email'];
                $mail->addAddress($email, $empnm);
            }
        }
        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body = $body;

        if (!$mail->send()) {
            $response = array(
                "success" => false,
                "message" => 'Email could not be sent. Error: ' . $mail->ErrorInfo,
            );
        } else {
            $response = array(
                "success" => true,
                "message" => 'Email sent successfully',
            );
        }
        echo json_encode($response);

        // echo json_encode($mail->send());

        //echo $response;

    } elseif (isset($_POST['assigneeID'])) {

        // For sending mail to task assigned employee
        include '../php/connection.php';

        $employeesID = $_POST['assigneeID'];
        $queryToGetAssigneeName = mysqli_query($con, "SELECT * FROM `employeedata` WHERE `ID` = '$employeesID'");
        while ($resRow = $queryToGetAssigneeName->fetch_assoc()) {
            $email = $resRow['Email'];
            $empName = $resRow['EmpName'];
        }

        $subject = $_POST['subject'];
        $body = $_POST['body'];

        require './PHPMailer/src/Exception.php';
        require './PHPMailer/src/PHPMailer.php';
        require './PHPMailer/src/SMTP.php';


        $mail = new PHPMailer;
        $mail->isSMTP();
        $mail->SMTPDebug = 4;
        $mail->Host = 'smtp.gmail.com';
        $mail->Port = 587;
        $mail->SMTPAuth = true;
        $mail->Username = 'tasktracker2023@gmail.com';
        $mail->Password = 'lkilidhacfpwgyis';
        $mail->setFrom('tasktracker2023@gmail.com', 'Task Tracker');
        $mail->addReplyTo('tasktracker2023@gmail.com', 'Task Tracker');
        $mail->addAddress($email, $empName);

        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body = $body;

        if (!$mail->send()) {
            $response['success'] = false;
            $response['message'] = 'Email could not be sent. Error: ' . $mail->ErrorInfo;
        } else {
            $response['success'] = true;
            $response['message'] = 'Email sent successfully';
        }
        echo json_encode($response);
    } else {

        $subject = $_POST['subject'];
        $body = $_POST['body'];

        $response = array();

        require './PHPMailer/src/Exception.php';
        require './PHPMailer/src/PHPMailer.php';
        require './PHPMailer/src/SMTP.php';


        $mail = new PHPMailer;
        $mail->isSMTP();
        $mail->SMTPDebug = 4;
        $mail->Host = 'smtp.gmail.com';
        $mail->Port = 587;
        $mail->SMTPAuth = true;
        $mail->Username = 'tasktracker2023@gmail.com';
        $mail->Password = 'lkilidhacfpwgyis';
        $mail->setFrom('tasktracker2023@gmail.com', 'Task Tracker');
        $mail->addReplyTo('tasktracker2023@gmail.com', 'Task Tracker');
        $mail->addAddress($email, 'Name of employee');

        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body = $body;

        if (!$mail->send()) {
            $response['success'] = false;
            $response['message'] = 'Email could not be sent. Error: ' . $mail->ErrorInfo;
        } else {
            $response['success'] = true;
            $response['message'] = 'Email sent successfully';
        }
        echo json_encode($response);
    }
}
