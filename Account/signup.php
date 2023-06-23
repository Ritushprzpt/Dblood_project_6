<?php
// Validate and sanitize form data
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $username = $_POST['username'];
  $password = $_POST['password'];
  $mobileNumber = $_POST['mobile_number'];
  $bloodGroup = $_POST['blood_group'];
  $age = $_POST['age'];
  $disease = $_POST['disease'];
  $doctor = $_POST['doctor'];
  $address = $_POST['address'];

  // Validate form data (example: checking if fields are not empty)
  if (empty($username) || empty($password) || empty($mobileNumber) || empty($bloodGroup) || empty($age) || empty($disease) || empty($doctor) || empty($address)) {
    die('Please fill in all fields');
  }

  // Sanitize form data (example: escaping special characters)
  $username = htmlspecialchars($username);
  $password = htmlspecialchars($password);
  $mobileNumber = htmlspecialchars($mobileNumber);
  $bloodGroup = htmlspecialchars($bloodGroup);
  $age = htmlspecialchars($age);
  $disease = htmlspecialchars($disease);
  $doctor = htmlspecialchars($doctor);
  $address = htmlspecialchars($address);

  // Database configuration
  $dbHost = 'localhost';
  $dbUser = 'root';
  $dbPass = 'root';
  $dbName = 'dblood';

  // Create a database connection
  $conn = new mysqli_connect($dbHost, $dbUser, $dbPass, $dbName);
  if ($conn->connect_error) {
    die('Database connection failed: ' . $conn->connect_error);
  }

  // Prepare and execute SQL statement to insert data into the database
  $stmt = $conn->prepare("INSERT INTO users (username, password, mobile_number, blood_group, age, disease, doctor, address) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
  $stmt->bind_param("ssssssss", $username, $password, $mobileNumber, $bloodGroup, $age, $disease, $doctor, $address);

  if ($stmt->execute()) {
    echo 'Registration successful!'; // You can also redirect to a success page
  } else {
    echo 'Error: ' . $stmt->error; // You can redirect to an error page or handle the error in a different way
  }

  $stmt->close();
  $conn->close();
}
?>
