<?php
session_start();

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

    // Initialize variables
    $username = $_POST['username'];
    $password = $_POST['password'];

    // SQL query to fetch user details based on username and password
    $sql = "SELECT * FROM tb_user WHERE username = ? AND password = ?";
    $stmt = $conn->prepare($sql);

    // Check if prepare() succeeded
    if (!$stmt) {
        die('SQL Error: ' . $conn->error); // Output SQL error for debugging
    }

    // Bind parameters
    $stmt->bind_param("ss", $username, $password);

    // Execute the statement
    $stmt->execute();

    // Get result
    $result = $stmt->get_result();

    // Check if user exists
    if ($result->num_rows == 1) {
        // Fetch user data
        $row = $result->fetch_assoc();
        
        // Set session variables based on user type
        $_SESSION['logged_in'] = true;
        $_SESSION['username'] = $username;
        $_SESSION['user_type'] = $row['usertype']; // Assuming 'usertype' column in your database
        
        // Close statement
        $stmt->close();
        
        // Redirect based on user type
        if ($_SESSION['user_type'] == 'admin') {
            echo "kamu adalah admin";
            header("Location: ../admin.php");

        } 
        else {
            header("Location: ../index.php");
        }
        exit; // Ensure no further code execution after redirection
    } else {
        // Redirect back to login page with error message if login fails
        $stmt->close(); // Close statement before redirecting
        header("Location: ../halamanLogin.html?error=login_failed");
        exit; // Ensure no further code execution after redirection
    }

    // Close connection (this line is already reached in both branches of the if-else statement)
    // $conn->close();
} else {
    // If accessed directly without POST method, redirect to login page
    header("Location: ../halamanLogin.html");
    exit;
}
?>
