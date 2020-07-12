<?php
require_once 'db.php';

function sendBookingEmail($toAddress, $name = '', $bookingCode)
{
  // multiple recipients
  $to  = $toAddress; // note the comma
  // subject
  $subject = 'Booking Received, Booking Code: ' . $bookingCode . '';
  // message
  $message = '
<html>
<head>
  <title>Booking Received</title>
</head>
<body>
  Hello ' . ucfirst($name) . ',</br>
  Your booking has been received and is waiting confirmation by our agents, you will receive a response ASAP. 
  Your Booking Code is <h3>' . $bookingCode . '</h3> </br>
</body>
</html>
';

  // To send HTML mail, the Content-type header must be set
  $headers  = 'MIME-Version: 1.0' . "\r\n";
  $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
  // Additional headers
  $headers .= 'From: DuckType <donotreply@mbwasi.com>' . "\r\n";
  // Mail it
  mail($to, $subject, $message, $headers);
  return true;
}



function sendBookingConfirmation($bookingId)
{
  $booking = getBookingFromBookingId($bookingId);
  $user = getUserFromBookingId($bookingId);
  $to  = $user->email;

  $subject = 'Booking Confirmation.';

  $message = '
  <html>
  <head>
    <title>Email Verification</title>
  </head>
  <body>
    Hello ' . ucfirst($user->first_name) . ',</br>
    Congratulations, your booking has been confirmed. 
    Your Booking Code is <h3>' . $booking->booking_code . '</h3> </br>
  </body>
  </html>
  ';

  $headers  = 'MIME-Version: 1.0' . "\r\n";
  $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

  $headers .= 'From: DuckType <donotreply@mbwasi.com>' . "\r\n";

  mail($to, $subject, $message, $headers);
  return true;
}


function sendVerificationMail2($toAddress, $name = '', $verificationCode)
{
  $subject = 'DuckType Travels Email Verification';
  fileLog("2 ");
  $message = '
<html>
<head>
<title>Email Verification</title>
</head>
<body>
Hello ' . ucfirst($name) . ',</br>
Please click the link bellow to verify your account.</br>
<a href="http://' . $_SERVER['SERVER_NAME'] . '/verify.php?key=' . $verificationCode . '">http://' . $_SERVER['SERVER_NAME'] . '/verify.php?key=' . $verificationCode . '</a> 
</body>
</html>
';

  $headers  = 'MIME-Version: 1.0' . "\r\n";
  $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

  $headers .= 'From: DuckType <donotreply@mbwasi.com>' . "\r\n";

  mail($toAddress, $subject, $message, $headers);
  return true;
}
