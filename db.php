<?php
include_once 'logging.php';

if (strpos($_SERVER['SERVER_NAME'], 'localhost') !== false) {
    fileLog("Cont DEV. ");
    //DB Values
    define("DB_HOST", "localhost");
    define("DB_NAME", "coronatravels");
    define("DB_USERNAME", "root");
    define("DB_PASSWORD", "");
    //Fancy debug output for RedBean
    define("ENABLE_FANCY_DEBUG", false);

    /*** PRODUCTION ***/
} else {
    //DB Values
    fileLog("Cont PROD. ");
    define("DB_HOST", "localhost");
    define("DB_NAME", "mbwasico_travel");
    define("DB_USERNAME", "mbwasico_traveluser");
    define("DB_PASSWORD", "G?013N!%n*f&");

    //Fancy debug output for RedBean
    define("ENABLE_FANCY_DEBUG", false);
}

function getConn()
{

    try {
        $opt  = array(
            PDO::MYSQL_ATTR_FOUND_ROWS   => TRUE,
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        );
        //mysql:charset=utf8mb4
        $conn = new PDO("mysql:charset=utf8mb4;host=" . DB_HOST . ";dbname=" . DB_NAME . "", DB_USERNAME, DB_PASSWORD, $opt);

        fileLog("Connected to DB. ");
        return $conn;
    } catch (PDOException $e) {
        fileLog("Connection failed: " . $e);
    }
}

function getTrip($tripId)
{
    try {
        $stmt = getConn()->prepare('SELECT * FROM trips WHERE trip_id = ?');
        $stmt->execute([$tripId]);
        $trip = $stmt->fetch();
        return $trip;
    } catch (PDOException $e) {
        fileLog("getTrip() failed: " . $e);
    }
}

function getHotel($tripId)
{
    try {
        $stmt = getConn()->prepare('SELECT * FROM hotels WHERE hotel_id = ?');
        $stmt->execute([$tripId]);
        $hotel = $stmt->fetch(PDO::FETCH_OBJ);
        return $hotel;
    } catch (PDOException $e) {
        fileLog("getHotel() failed: " . $e);
    }
}


function getBookingFromBookingId($bookingId)
{
    try {
        $stmt = getConn()->prepare('SELECT * FROM bookings WHERE booking_id = ?');
        $stmt->execute([$bookingId]);
        $booking = $stmt->fetch(PDO::FETCH_OBJ);
        return $booking;
    } catch (PDOException $e) {
        fileLog("getBookingFromBookingId() failed: " . $e);
    }
}

function getUserFromBookingId($bookingId)
{
    try {
        $stmt = getConn()->prepare('SELECT * FROM bookings WHERE booking_id = ?');
        $stmt->execute([$bookingId]);
        $booking = $stmt->fetch(PDO::FETCH_OBJ);

        $stmt = getConn()->prepare('SELECT * FROM users WHERE user_id = ?');
        $stmt->execute([$booking->user_id]);
        $user = $stmt->fetch(PDO::FETCH_OBJ);

        return $user;
    } catch (PDOException $e) {
        fileLog("getUserFromBookingId() failed: " . $e);
    }
}

function getUsername($userId)
{
    try {
        $stmt = getConn()->prepare('SELECT * FROM Users WHERE user_id = ?');
        $stmt->execute([$userId]);
        $user = $stmt->fetch();
        return $user['first_name'];
    } catch (PDOException $e) {
        fileLog("getUsername() failed: " . $e);
    }
}

function verifyEmail($code)
{
    try {
        $stmt = getConn()->prepare('UPDATE users SET status="VERIFIED" WHERE email_verification_code = ? AND status="VERIFY"');
        $stmt->execute([$code]);
        fileLog("verify count: " .  $stmt->rowCount());
        return  $stmt->rowCount();
    } catch (PDOException $e) {
        fileLog("verifyEmail() failed: " . $e);
    }
}

function searchTrips($query)
{
    try {
        fileLog("searchTrips: " . $query);
        $stmt = getConn()->prepare("SELECT * FROM trips WHERE name LIKE ?");
        $stmt->execute(['%' . $query . '%']);
        $trips = $stmt->fetchAll(PDO::FETCH_OBJ);
        return $trips;
    } catch (PDOException $e) {
        fileLog("searchTrips() failed: " . $e);
    }
}


function getAllTrips()
{
    try {
        $sql = "SELECT * from trips";
        $query = getConn()->prepare($sql);
        $query->execute();
        $trips = $query->fetchAll(PDO::FETCH_OBJ);
        return $trips;
    } catch (PDOException $e) {
        fileLog("searchTrips() failed: " . $e);
    }
}

function getPendingBookings()
{
    try {
        $sql = "Select booking_id,trips.name,number_adults,number_children,total_cost,user_id,notes,booking_code 
        from bookings,trips 
        where bookings.trip_id=trips.trip_id 
        and bookings.status='pending'";
        $query = getConn()->prepare($sql);
        $query->execute();
        $bookings = $query->fetchAll();
        return $bookings;
    } catch (PDOException $e) {
        fileLog("getPendingBookings() failed: " . $e);
    }
}


function createNewBooking($tripid, $userid, $adult, $children, $notes, $cost, $bookingCode)
{
    try {
        $stmt = getConn()->prepare('INSERT INTO bookings(`trip_id`,`number_adults`,`number_children`,`total_cost`,`user_id`,`notes`,`booking_code`,`status`)
        VALUES (?,?,?,?,?,?,?,?)');
        $stmt->execute([$tripid, $adult, $children,  $cost, $userid,  $notes, $bookingCode, 'pending']);
        fileLog("createNewBooking count: " .  $stmt->rowCount());
        return  $stmt->rowCount();
    } catch (PDOException $e) {
        fileLog("verifyEmail() failed: " . $e);
    }
}

function getImagesForCar($tripId)
{
    try {
        $stmt = getConn()->prepare('SELECT * FROM images WHERE trip_id = ?');
        $stmt->execute([$tripId]);
        $images = $stmt->fetchAll();

        $pathArray = [];

        foreach ($images as $image) {
            fileLog($image['path']);
            $pathArray[] = $image['path'];
        }
        //If no images are available send default set of images
        if (count($pathArray) === 0) {
            $pathArray = ['./images/panama1.jpg', './images/panama2.jpg', './images/panama3.jpg'];
        }


        return $pathArray;
    } catch (PDOException $e) {
        fileLog("getTrip() failed: " . $e);
    }
}
