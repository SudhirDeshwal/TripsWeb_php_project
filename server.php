<?php
include_once 'startsession.php';
include_once 'logging.php';
include_once 'sendemail.php';
require_once 'db.php';
// initializing variables
$firstName = "";
$lastName = "";
$email    = "";
$phone = "";
$dob = "";
$errors = array();
fileLog("Serv: 1");
// connect to the database
$db = mysqli_connect(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);

// REGISTER USER
if (isset($_POST['reg_user'])) {
  // receive all input values from the form
  $firstName = mysqli_real_escape_string($db, $_POST['firstName']);
  $lastName = mysqli_real_escape_string($db, $_POST['lastName']);
  $email = mysqli_real_escape_string($db, $_POST['email']);
  $password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
  $password_2 = mysqli_real_escape_string($db, $_POST['password_2']);
  $phone = mysqli_real_escape_string($db, $_POST['phone']);
  $dob = mysqli_real_escape_string($db, $_POST['dob']);

  // form validation: ensure that the form is correctly filled ...
  // by adding (array_push()) corresponding error unto $errors array
  if (empty($firstName)) {
    array_push($errors, "First Name is required");
  }
  if (empty($lastName)) {
    array_push($errors, "Last Name is required");
  }
  if (empty($email)) {
    array_push($errors, "Email is required");
  }
  if (empty($password_1)) {
    array_push($errors, "Password is required");
  }
  if ($password_1 != $password_2) {
    array_push($errors, "The two passwords do not match");
  }
  if (empty($phone)) {
    array_push($errors, "Phone is required");
  }
  if (empty($dob)) {
    array_push($errors, "Date of Birth is required");
  }

  // first check the database to make sure
  // a user does not already exist with the same username and/or email
  $user_check_query = "SELECT * FROM users WHERE email='$email' LIMIT 1";
  $result = mysqli_query($db, $user_check_query);
  $user = mysqli_fetch_assoc($result);

  if ($user) { // if user exists
    if ($user['email'] === $email) {
      array_push($errors, "Email already exists");
    }
  }

  // Finally, register user if there are no errors in the form
  if (count($errors) == 0) {
    //$password = md5($password_1); //encrypt the password before saving in the database

    $password = password_hash($password_1, PASSWORD_DEFAULT);
    // INSERT INTO users (first_name, last_name, email, password_hash, phone, dob,role)
    // VALUES('Jack', 'reacher', 'you@example.com', '5f4dcc3b5aa765d61d8327deb882cf99', '1234567', '2020-03-30','user')

    $verificationCode = GUID();

    $query = "INSERT INTO users (first_name, last_name, email, password_hash, phone, dob,role,email_verification_code,status)
          VALUES('$firstName', '$lastName', '$email', '$password', '$phone', '$dob','user','$verificationCode','VERIFY')";
    fileLog("Register Query: " . $query);

    $result = mysqli_query($db, $query);

    if ($result) {
      sendVerificationMail2($email, $firstName, $verificationCode);
      header('location: emailconfsent.php');
    } else {
      array_push($errors, "Registration Failed.");
    }
  }
}

// LOGIN USER
if (isset($_POST['login_user'])) {
  $email = mysqli_real_escape_string($db, $_POST['email']);
  $password = mysqli_real_escape_string($db, $_POST['password']);

  if (empty($email)) {
    array_push($errors, "Email is required");
  }
  if (empty($password)) {
    array_push($errors, "Password is required");
  }

  if (count($errors) == 0) {
    // $password = md5($password);
    $query = "SELECT * FROM users WHERE email='$email'";
    fileLog("Login Query:" . $query);
    $results = mysqli_query($db, $query);

    if (mysqli_num_rows($results) == 1) {
      $row = $results->fetch_assoc();
      if (password_verify($password, $row['password_hash'])) {
        $_SESSION['userid'] = $row['user_id'];
        $_SESSION['email'] = $email;
        $_SESSION['name'] = $row['first_name'];
        $_SESSION['role'] = $row['role'];
        $_SESSION['success'] = "You are now logged in";
        if ($row['role'] === 'admin') {
          header('location: admin.php');
        } else {
          header('location: index.php');
        }
      } else {
        array_push($errors, "Wrong email/password combination");
      }
    } else {
      array_push($errors, "Wrong email/password combination");
    }
  }
}

function GUID()
{
  if (function_exists('com_create_guid') === true) {
    return trim(com_create_guid(), '{}');
  }
  return sprintf('%04X%04X%04X%04X%04X%04X%04X%04X', mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(16384, 20479), mt_rand(32768, 49151), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535));
}
