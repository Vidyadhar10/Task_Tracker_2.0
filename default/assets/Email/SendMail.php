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


        foreach ($my_array as $recipient) {

            $getEmpData = mysqli_query($con, "SELECT * FROM `employeedata` WHERE `ID`='$recipient'");
            while ($row = $getEmpData->fetch_assoc()) {
                $empnm = $row['EmpName'];
                $email = $row['Email'];
                $mail->addAddress($email, $empnm);
            }
        }
        //$mail->addAddress($email, $empnm);
        $mail->isHTML(true);
        $mail->Subject = $subject;
        //$mail->msgHTML(file_get_contents('message.html'), __DIR__);
        $mail->Body = $body;
        //$mail->addAttachment('attachment.txt');

        if (!$mail->send()) {
            $response[1] = 'Fail';
        } else {
            $response[2] = 'Sent';
        }
        //echo json_encode($response);

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
        //$mail->msgHTML(file_get_contents('message.html'), __DIR__);
        $mail->Body = $body;
        //$mail->addAttachment('attachment.txt');

        if (!$mail->send()) {
            $response[1] = 'Fail';
        } else {
            $response[2] = 'Sent';
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
        //$mail->msgHTML(file_get_contents('message.html'), __DIR__);
        $mail->Body = $body;
        //$mail->addAttachment('attachment.txt');

        if (!$mail->send()) {
            $response[1] = 'Fail';
        } else {
            $response[2] = 'Sent';
        }
        echo json_encode($response);

        // echo json_encode($mail->send());

        //echo $response;
    }
}
