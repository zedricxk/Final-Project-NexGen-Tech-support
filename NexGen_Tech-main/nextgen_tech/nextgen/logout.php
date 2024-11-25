<?php
session_start();
include('db_config.php');

if (isset($_GET['action']) && $_GET['action'] === 'logout') {
    
    $_SESSION = array();

   
    session_destroy();

    
    header("Location: login.php");
    exit();
}


if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}


$user_id = $_SESSION['user_id'];
$query = "SELECT * FROM users WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();
$stmt->close();


if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update_profile'])) {
    $new_username = trim($_POST['new_username']);
    $new_password = trim($_POST['new_password']);
    $profile_picture_path = $user['profile_picture']; 

    
    if (empty($new_username)) {
        $profile_update_message = "Username cannot be empty.";
    } else {
        
        if (isset($_FILES['new_profile_picture']) && $_FILES['new_profile_picture']['error'] == 0) {
            $profile_picture = $_FILES['new_profile_picture'];
            $allowed_extensions = ['jpg', 'jpeg', 'png', 'gif'];
            $file_extension = strtolower(pathinfo($profile_picture['name'], PATHINFO_EXTENSION));

           
            $file_mime = mime_content_type($profile_picture['tmp_name']);
            $allowed_mimes = ['image/jpeg', 'image/png', 'image/gif'];

            if (in_array($file_extension, $allowed_extensions) && 
                in_array($file_mime, $allowed_mimes) && 
                $profile_picture['size'] <= 2097152) {
                
                $upload_dir = 'uploads/profile_pictures/';
                if (!is_dir($upload_dir)) {
                    mkdir($upload_dir, 0777, true);
                }

                $new_file_name = $user_id . '.' . $file_extension;
                $upload_path = $upload_dir . $new_file_name;

                if (move_uploaded_file($profile_picture['tmp_name'], $upload_path)) {
                    $profile_picture_path = $upload_path;
                } else {
                    $profile_update_message = "Failed to upload profile picture.";
                }
            } else {
                $profile_update_message = "Invalid file type or file is too large.";
            }
        }

        
        if (!isset($profile_update_message)) {
            if (!empty($new_password)) {
                $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
                $update_query = "UPDATE users SET username = ?, password = ?, profile_picture = ? WHERE id = ?";
                $stmt = $conn->prepare($update_query);
                $stmt->bind_param("sssi", $new_username, $hashed_password, $profile_picture_path, $user_id);
            } else {
                $update_query = "UPDATE users SET username = ?, profile_picture = ? WHERE id = ?";
                $stmt = $conn->prepare($update_query);
                $stmt->bind_param("ssi", $new_username, $profile_picture_path, $user_id);
            }

            if ($stmt->execute()) {
                $_SESSION['username'] = $new_username;
                $profile_update_message = "Profile updated successfully.";
            } else {
                $profile_update_message = "Error updating profile: " . $stmt->error;
            }
            $stmt->close();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>NextGen Tech - Profile</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: Arial, sans-serif;
        }
        .header {
            background-color: #343a40;
            color: white;
            padding: 15px 0;
        }
        .navbar-brand {
            font-size: 1.5rem;
            font-weight: bold;
        }
        .container {
            margin-top: 30px;
        }
        .profile-img {
            display: block;
            margin: 0 auto 15px;
            border: 3px solid #ddd;
        }
        .form-group {
            margin-bottom: 20px;
        }
        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
            font-size: 1rem;
            padding: 10px 20px;
        }
        .alert {
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <header>
        <div class="header">
            <div class="container">
                <nav class="navbar navbar-expand-md navbar-dark">
                    <a class="navbar-brand" href="index.php">NextGen Tech</a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav ml-auto">
                            <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
                            <li class="nav-item"><a class="nav-link" href="?action=logout">Logout</a></li>
                        </ul>
                    </div>
                </nav>
            </div>
        </div>
    </header>

    <div class="container">
        <h2 class="text-center">Your Profile</h2>
        <p class="text-center">Welcome, <strong><?php echo htmlspecialchars($_SESSION['username']); ?></strong>!</p>

        <div class="text-center">
            <img src="<?php echo htmlspecialchars($user['profile_picture'] ?: 'uploads/profile_pictures/default-avatar.jpg'); ?>" 
                 alt="Profile Picture" 
                 class="profile-img" 
                 style="width: 150px; height: 150px; border-radius: 50%; border: 2px solid #007bff;">
        </div>

        <form method="POST" action="" enctype="multipart/form-data" class="mt-4">
            <div class="form-group">
                <label for="new_username">Username:</label>
                <input type="text" class="form-control" id="new_username" name="new_username" value="<?php echo htmlspecialchars($user['username']); ?>" required>
            </div>
            <div class="form-group">
                <label for="new_password">New Password:</label>
                <input type="password" class="form-control" id="new_password" name="new_password">
                <small class="form-text text-muted">Leave empty if you don't want to change your password.</small>
            </div>
            <div class="form-group">
                <label for="new_profile_picture">Profile Picture:</label>
                <input type="file" class="form-control" id="new_profile_picture" name="new_profile_picture" onchange="previewProfilePicture(event)">
                <small class="form-text text-muted">Leave empty if you don't want to change your profile picture.</small>
                <div id="profile-picture-preview" class="text-center mt-3"></div>
            </div>
            <button type="submit" class="btn btn-primary" name="update_profile">Update Profile</button>
        </form>

        <?php if (isset($profile_update_message)) { ?>
            <div class="alert alert-info text-center">
                <?php echo htmlspecialchars($profile_update_message); ?>
            </div>
        <?php } ?>
    </div>

    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script>
        function previewProfilePicture(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    document.getElementById('profile-picture-preview').innerHTML = `
                        <img src="${e.target.result}" style="width: 150px; height: 150px; border-radius: 50%; border: 2px solid #007bff;">
                    `;
                };
                reader.readAsDataURL(file);
            }
        }
    </script>
</body>
</html>
