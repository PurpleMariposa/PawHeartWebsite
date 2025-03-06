<?php
include '../classess/db.php';
$objDB = new dbConnect();
$conn = $objDB->connect();

// Check if ID is provided
if (isset($_POST['id'])) {
    $id = $_POST['id'];

    // Sanitize and escape the input to prevent SQL injection
    $id = mysqli_real_escape_string($conn, $id);

    // Delete the veterinarian
    $sql = "DELETE FROM veterinarians WHERE id='$id'";

    if ($conn->query($sql) === TRUE) {
        echo "Veterinarian deleted successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
} else {
    echo "Veterinarian ID not provided";
}

// Close connection
$conn->close();
?>
