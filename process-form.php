<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $name = $_POST["name"];
        $email = $_POST["email"];
        $message = $_POST["message"];
    
        $to = "kamleshlovewanshi2000@gmail.com";
        $subject = "New Form Submission";
        $headers = "From: $email";
    
        mail($to, $subject, $message, $headers);
    
        echo "Thank you for submitting the form!";
    }
    ?>