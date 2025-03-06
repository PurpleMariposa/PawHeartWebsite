<?php
function authenticateUser($email, $password) {
    include "./classess/db.php"; // Update with the correct path

    // Escape input to prevent SQL injection
    $email = mysqli_real_escape_string($connection, $email);

    // Query to check if the user exists and retrieve the hashed password
    $query = "SELECT id, password FROM paw WHERE email = '$email'";
    $result = mysqli_query($connection, $query);

    if ($result) {
        // Check if the user exists
        if (mysqli_num_rows($result) === 1) {
            $row = mysqli_fetch_assoc($result);
            $hashedPassword = $row['password'];

            // Verify the password
            if (password_verify($password, $hashedPassword)) {
                // Password is correct
                // Store user information in the session if needed
                $_SESSION['user_id'] = $row['id'];

                // Close the database connection
                mysqli_close($connection);

                return true;
            }
        }
    }

    // Close the database connection
    mysqli_close($connection);

    // Authentication failed
    return false;
}

function getUserId($email) {
    include "./classess/db/php"; // Update with the correct path

    // Escape input to prevent SQL injection
    $email = mysqli_real_escape_string($connection, $email);

    // Query to retrieve user ID based on email
    $query = "SELECT id FROM paw WHERE email = '$email'";
    $result = mysqli_query($connection, $query);

    if ($result) {
        // Check if the user exists
        if (mysqli_num_rows($result) === 1) {
            $row = mysqli_fetch_assoc($result);

            // Close the database connection
            mysqli_close($connection);

            return $row['id'];
        }
    }

    // Close the database connection
    mysqli_close($connection);

    // User not found
    return null;
}
?>
