<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Database connection parameters
    $servername = "localhost"; 
    $dbname = "SUKERT";
    $dbusername = "root"; 
    $dbpassword = ""; 

    // Create connection
    $conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Get the submitted form data
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Check if the username already exists
    $stmt = $conn->prepare("SELECT * FROM tb_user WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        echo "Username already exists!";
    } else {
        // Prepare and bind
        $stmt = $conn->prepare("INSERT INTO tb_user (username, password) VALUES (?, ?)");
        $stmt->bind_param("ss", $username, $password);

        // Execute the query
        if ($stmt->execute()) {
            echo "Registration successful!";
            // Redirect to the login page or any other page
            header("Location: ../halamanLogin.html");
        } else {
            echo "Error: " . $stmt->error;
        }
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
}
?>
