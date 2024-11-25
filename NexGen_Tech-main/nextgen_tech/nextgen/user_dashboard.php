<?php
session_start();


if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");  
    exit();
}


$conn = new mysqli('localhost', 'root', '', 'your_database');  
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$user_id = $_SESSION['user_id'];
$result = $conn->query("SELECT * FROM callback_requests WHERE user_id = '$user_id' ORDER BY date_submitted DESC");


$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Callback Requests</title>
</head>
<body>
    <h1>Your Callback Requests</h1>

    
    <table border="1">
        <thead>
            <tr>
                <th>Name</th>
                <th>Phone</th>
                <th>Email</th>
                <th>Message</th>
                <th>Date Submitted</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $result->fetch_assoc()) { ?>
                <tr>
                    <td><?php echo htmlspecialchars($row['name']); ?></td>
                    <td><?php echo htmlspecialchars($row['phone']); ?></td>
                    <td><?php echo htmlspecialchars($row['email']); ?></td>
                    <td><?php echo htmlspecialchars($row['message']); ?></td>
                    <td><?php echo $row['date_submitted']; ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</body>
</html>
