<?php


$servername = "localhost";
$username = "root";  
$password = "";      
$dbname = "nextgen_tech";


$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


if ($_SERVER["REQUEST_METHOD"] === "POST") {

    
    $name = isset($_POST['Name']) ? mysqli_real_escape_string($conn, $_POST['Name']) : '';
    $phone = isset($_POST['PhoneNumber']) ? mysqli_real_escape_string($conn, $_POST['PhoneNumber']) : '';
    $email = isset($_POST['Email']) ? mysqli_real_escape_string($conn, $_POST['Email']) : '';
    $message = isset($_POST['Message']) ? mysqli_real_escape_string($conn, $_POST['Message']) : '';
    $callbackMessage = isset($_POST['CallbackMessage']) ? mysqli_real_escape_string($conn, $_POST['CallbackMessage']) : null; // Optional field

    
    if (empty($name) || empty($phone) || empty($email) || empty($message)) {
        echo "<script>
            alert('All fields are required!');
            window.location.href = 'contact.php'; // Redirect back to contact page or form page
        </script>";
        exit();
    }

    
    $sql = "INSERT INTO users (name, phone, email, message, callback, callback_message) 
            VALUES (?, ?, ?, ?, 1, ?)";

    if ($stmt = $conn->prepare($sql)) {
        
        $stmt->bind_param("sssss", $name, $phone, $email, $message, $callbackMessage);

        
        if ($stmt->execute()) {
            echo "<script>
                alert('Your request has been submitted successfully! We will call you shortly.');
                window.location.href = 'index.php'; // Redirect to the homepage or another page
            </script>";
        } else {
            echo "<script>
                alert('Error: Unable to process your request at the moment. Please try again later.');
                window.location.href = 'contact.php'; // Redirect to the form page
            </script>";
        }

       
        $stmt->close();
    } else {
        echo "<script>
            alert('Error: Unable to prepare the SQL statement.');
            window.location.href = 'contact.php'; // Redirect to the form page
        </script>";
    }
}


$conn->close();
?>
