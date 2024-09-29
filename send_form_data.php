<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/Exception.php';
require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $name = $_POST["name"];
    $email = $_POST["email"];
    $dob = $_POST["dob"];
    $experience = $_POST["experience"];
    $therapy = $_POST["therapy"];
    $company = $_POST["company"];
    $position = $_POST["position"];
    $state = $_POST["state"];
    $hq = $_POST["hq"];
    $phone = $_POST["phone"];

    // Upload the resume file
    $resumeFileName = $_FILES["resume"]["name"];
    $resumeTmpName = $_FILES["resume"]["tmp_name"];
    move_uploaded_file($resumeTmpName, "uploads/" . $resumeFileName);

    // Create a PHPMailer instance
    $mail = new PHPMailer(true);

    try {
        // Server settings
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com'; // Replace with your SMTP server
        $mail->SMTPAuth   = true;
        $mail->Username   = 'kamleshlovewanshi2000@gmail.com'; // Replace with your email
        $mail->Password   = 'wuyt qeyx gote hjoc'; // Replace with your email password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Enable TLS encryption
        $mail->Port       = 587; // TCP port to connect to

        // Recipients
        $mail->setFrom('kamleshlovewanshi2000@gmail.com', 'Kamlesh'); // Replace with your email and name
        $mail->addAddress('kamleshlovewanshi2000@gmail.com'); // Recipient's email
        // You can add more recipients if needed

        // Attach the resume file
        $mail->addAttachment("uploads/$resumeFileName", $resumeFileName);

        // Email subject and body
        $mail->isHTML(true);
        $mail->Subject = "Contact Form Submission from $name";
        $mail->Body    = "
            <b>Name:</b> $name<br>
            <b>Email:</b> $email<br>
            <b>Date of Birth:</b> $dob<br>
            <b>Experience:</b> $experience years<br>
            <b>Therapy/Speciality:</b> $therapy<br>
            <b>Current Company:</b> $company<br>
            <b>Current Position:</b> $position<br>
            <b>State:</b> $state<br>
            <b>Current H.Q:</b> $hq<br>
            <b>Phone Number:</b> $phone<br>
        ";

        // Send email
        $mail->send();
        echo "Thank you for your submission!";
    } catch (Exception $e) {
        echo "Sorry, there was an error sending your message. Error: {$mail->ErrorInfo}";
    }
}
?>
