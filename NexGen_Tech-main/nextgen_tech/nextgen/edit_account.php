<?php
session_start();

if (!isset($_SESSION['user'])) {
    header('Location: signin.html');
    exit();
}

$user = $_SESSION['user'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <title>Edit Account - NextGen Tech</title>
   <link rel="stylesheet" href="css/bootstrap.min.css">
   <link rel="stylesheet" href="css/style.css">
</head>
<body class="main-layout">
   <header>
      
   </header>

   <div class="edit-account-section">
      <div class="container">
         <h2>Edit Your Account</h2>
         <form action="update_account.php" method="post">
            <div class="form-group">
               <label for="name">Full Name</label>
               <input type="text" class="form-control" id="name" name="name" value="<?php echo $user['name']; ?>" required>
            </div>
            <div class="form-group">
               <label for="email">Email</label>
               <input type="email" class="form-control" id="email" name="email" value="<?php echo $user['email']; ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Update Account</button>
         </form>
      </div>
   </div>

   <footer>
     
   </footer>

   <script src="js/jquery.min.js"></script>
   <script src="js/bootstrap.bundle.min.js"></script>
</body>
</html>
