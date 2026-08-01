<?php
    // Taking all values ​​from the form
    $firstName = $_POST['first-name'];
    $lastName = $_POST['last-name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $postalCode = $_POST['postal-code'];
    $address = $_POST['address'];
    $city = $_POST['city'];
    $location = $_POST['location'];
    $date = $_POST['date'];
    $time = $_POST['time'];
    $products = isset($_POST['products']) ? implode(", ", $_POST['products']) : '[empty]';
    $comments = $_POST['comments'];


    /*----========== SEND EMAIL VIA SMTP ==========----*/

    // // Loading package classes
    // require "vendor/autoload.php";

    // // PHPMailer classes we are going to use in our namespaces
    // use PHPMailer\PHPMailer\PHPMailer;
    // use PHPMailer\PHPMailer\SMTP;

    // // creating an instance of PHPMailer class | true means that PHPMailer will show Error if there will be a problem
    // $mail = new PHPMailer(true);

    // // show detail debug information (optional)
    // // $mail->SMTPDebug = SMTP::DEBUG_SERVER;

    // $mail->isSMTP();                                        // Set mailer to use SMTP
    // $mail->SMTPAuth = true;                                 // Enable SMTP authentication

    // $mail->Host = "mail.ringroadflooring.ca";               // Specify main and backup SMTP servers
    // $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    // $mail->Port = 587;                                      // TCP port to connect to

    // $mail->Username = "info@ringroadflooring.ca";
    // $mail->Password = "1977Berb";

    // $mail->setFrom('info@ringroadflooring.ca', "$firstName $lastName");    // From whom will send the email
    // $mail->addAddress("info@ringroadflooring.ca");                         // Who will receive the email

    // $mail->Subject = "From: $firstName $lastName <$email>";

    // $data = [
    //     "First Name: $firstName",
    //     "Last Name: $lastName",
    //     "Email: $email",
    //     "Phone: $phone",
    //     "Postal Code: $postalCode",
    //     "Address: $address",
    //     "City: $city",
    //     "Provinces: $location",
    //     "Preferred Date: $date",
    //     "Preferred Time: $time",
    //     "Products Interested In: $products",
    //     "Comments: $comments"
    // ];
    // // merging concating all user values inside body variable. \n is used for new line
    // $mail->Body = implode("\n\n", $data);

    
    // // if($mail->send()) {
    // //     echo "Email sent successfully!";
    // // } else {
    // //     echo "Failed to send email. Error: {$mail->ErrorInfo}";
    // // }
            
    // $mail->send();
    
    // echo "Your message has been sent.";


    /*----========== SAVE DATA IN ORDERS LIST ==========----*/

    $data = [
        "firstName" => $firstName,
        "lastName" => $lastName,
        "email" => $email,
        "phone" => $phone,
        "postalCode" => $postalCode,
        "address" => $address,
        "city" => $city,
        "location" => $location,
        "date" => $date,
        "time" => $time,
        "products" => $products,
        "comments" => $comments
    ];
    
    require_once "path.php";
    
    // cURL initalization
    $ch = curl_init(BASE_URL . "src/actions/orders/orders.php");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));

    // Execute cURL and get the response
    $response = curl_exec($ch);

    // Check for errors
    if ($response === false) {
        echo 'Curl error: ' . curl_error($ch);
    }

    // Close cURL session
    curl_close($ch);

    echo "Data has been saved in orders list.";



    // if (!empty($email) && !empty($phone)) {  // if email and message field is not empty
    //     if (filter_var($email, FILTER_VALIDATE_EMAIL)) {  // if user entered email is valid
            
            
            


    //         // if (mail($receiver, $subject, $body, $sender)) {  // mail() is an inbuilt php function to send mail
    //         //     echo "Your message has been sent";
    //         // } else {
    //         //     echo "Sorry, failed to send your message!";
    //         // }

    //     } else {
    //         echo "Enter a valid email address!";
    //     }
    // } else {
    //     echo "Email and Phone field is required!";
    // }
