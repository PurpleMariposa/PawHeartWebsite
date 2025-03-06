<?php
require_once("../classess/db.php"); // Include your database connection file
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get user input
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Validate user input (you may add more validation as needed)

    // Query to check if the user exists in the database
    $query = "SELECT * FROM admin WHERE email = '$email' AND password = '$password'";
    $result = mysqli_query($connection, $query);

    if ($result) {
        // Check if the user exists
        if (mysqli_num_rows($result) > 0) {
            // User found, redirect to the admin dashboard
            $_SESSION['admin'] = true;
            header('Location: ./admin.php'); // Update with your actual admin dashboard page
            exit();
        } else {
            $error_message = "Invalid email or password";
        }
    } else {
        $error_message = "Error executing query: " . mysqli_error($connection);
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href=".no-bg-bg-48.png" type="image/x-icon">
    <link rel="stylesheet" href="../user/styles/signup.css">
    <link rel="stylesheet" href="../user/assets/css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../vendor/bootstrap-5.0.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">    <link rel="stylesheet" href="style.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../user/styles/style.css">
    <link rel="stylesheet" href="../style/dashboard.css">
    <script src="https://kit.fontawesome.com/f584623432.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>Admin-Login | Vetcare</title>
    <style>
        #footer {
            margin-top: -200px;
        }

        @media only screen and (max-width: 1400px) and (min-width: 1000px) {
            #footer {
                margin-top: -250px;
            }
        }

        @media only screen and (max-width: 1000px) and (min-width: 600px) {
            #footer {
                margin-top: -340px;
            }
        }

        @media only screen and (max-width: 600px) and (min-width: 200px) {
            #footer {
                margin-top: -340px;
            }
        }
    </style>
</head>
    <title>Admin Login</title>
</head>
<body>
  <?php
  require_once('../include/header.php')
  ?>

  <?php if (isset($error_message)) : ?>
      <p><?php echo $error_message; ?></p>
  <?php endif; ?>

  <div class="containerII">
          <div class="innerContainer">
              <div class="box1">
                  <h1>Admin Login</h1>

                  <form action="./admin.php" method="post">
                      <label for="">Email</label>
                      <input type="email" placeholder="Enter email" name="email" id="email">

                      <label for="">Password</label>
                      <input type="password" placeholder="Enter password" name="password" id="password">

                      <input type="submit" id="submit">
                  </form>
              </div>
              <div class="box2">
                  <img src="../user/assets/Petting.svg" alt="">
              </div>
          </div>
      </div>
    <?php
    require_once('../include/footer.php')
    ?>
</body>

</html>
