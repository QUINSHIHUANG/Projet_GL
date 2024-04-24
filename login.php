<?php
// Database connection
$host = "localhost";
$user = "root";
$password = "";
$dbname = "projects2";

$conn = new mysqli($host, $user, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Function to sanitize input data
function sanitize($data) {
    return htmlspecialchars(stripslashes(trim($data)));
}

// Function to authenticate enterprise login
function enterpriseLogin($conn, $email, $password) {
    $email = sanitize($email);
    $password = sanitize($password);
    $sql = "SELECT * FROM Enterprises WHERE email='$email' AND password='$password'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        return true; // Enterprise login successful
    } else {
        return false; // Enterprise login failed
    }
}

// Function to authenticate student login
function studentLogin($conn, $email, $password) {
    $email = sanitize($email);
    $password = sanitize($password);
    $sql = "SELECT * FROM Students WHERE email='$email' AND password='$password'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        return true; // Student login successful
    } else {
        return false; // Student login failed
    }
}

// Check if login form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Check if enterprise login
    if (enterpriseLogin($conn, $email, $password)) {
        // Redirect to enterprise dashboard or page
        header("Location: dex enter.html");
        exit();
    } elseif (studentLogin($conn, $email, $password)) {
        // Redirect to student dashboard or page
        header("Location: dex.html");
        exit();
    } else {
        // Invalid login credentials
        echo "Invalid email or password. Please try again.";
    }
}

$conn->close();
?>
