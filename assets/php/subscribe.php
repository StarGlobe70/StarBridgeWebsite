<?php

if ($_POST) {
    $subscriber_email = $_POST['email'];
    $subscriber_fhp_input = $_POST['phone'];
    $array = array();
    
    if ($subscriber_email == "" || !filter_var($subscriber_email, FILTER_VALIDATE_EMAIL) || $subscriber_fhp_input != "") {
        $array["valid"] = 0;
        $array["message"] = "Invalid email.";
    } else {
        // Send an email to info@starbridge.global
        $to = 'info@starbridge.global';
        $subject = 'New Subscriber';
        $message = 'Email: ' . $subscriber_email;
        $headers = 'From: noreply@starbridge.global' . "\r\n" .
                   'Reply-To: ' . $subscriber_email . "\r\n";

        if (mail($to, $subject, $message, $headers)) {
            $array["valid"] = 1;
            $array["message"] = "Successfully subscribed!";
        } else {
            $array["valid"] = 0;
            $array["message"] = "Failed to send email.";
        }
    }

    echo json_encode($array);
}

?>
