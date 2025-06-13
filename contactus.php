<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $recaptcha_secret = '6LdvbysrAAAAAAMYZRZNVaombJTIWQRr4JrSU7My'; // Replace with your reCAPTCHA Secret Key

    $response = $_POST['g-recaptcha-response'];
    $url = 'https://www.google.com/recaptcha/api/siteverify';
    $data = array(
        'secret' => $recaptcha_secret,
        'response' => $response
    );

    $options = array(
        'http' => array(
            'header' => "Content-type: application/x-www-form-urlencoded\r\n",
            'method' => 'POST',
            'content' => http_build_query($data)
        )
    );

    $context = stream_context_create($options);
    $result = file_get_contents($url, false, $context);
    $json = json_decode($result);

    if ($json->success) {

        // Gather form data
        $name = $_POST["name"];
    $email = $_POST["email"];
    $message = $_POST["message"];

        // Email information
        $to = "marketing3@eastlink.lk; // Replace this with your Gmail address
        $subject = 'New Contact Form Submission - AKURA Website';
        $headers = "From: $email\r\n";
        $headers .= "Reply-To: $email\r\n";

        // Compose the email body
        $email_body = "Name: $name\n";
        $email_body .= "Email: $email\n";
        $email_body .= "Message:\n$message\n";

        if (mail($to, $subject, $email_body, $headers)) {
            // echo "Thank you for contacting us. Your message has been sent successfully!";
            header("LOCATION: ../index.html");
        } else {
            echo "Oops! Something went wrong. Please try again later.";
        }
    } else {
        echo "reCAPTCHA verification failed. Please try again.";
    }
}
?>


