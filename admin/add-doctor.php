<?php

include '../classess/db.php';
$objDB = new dbConnect();
$conn = $objDB->connect();


    // Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Example data - Replace with actual data from your form or inputs
    $name = isset($_POST['name']) ? $_POST['name'] : '';
    $gender = isset($_POST['gender']) ? $_POST['gender'] : '';
    $date_of_birth = isset($_POST['date_of_birth']) ? $_POST['date_of_birth'] : '';
    $experience = isset($_POST['experience']) ? $_POST['experience'] : '';
    $specialization = isset($_POST['specialization']) ? $_POST['specialization'] : '';

    // Sanitize and validate data (you should implement more robust validation)
    $name = mysqli_real_escape_string($conn, $name);
    $gender = mysqli_real_escape_string($conn, $gender);
    // Add similar sanitation for other variables

    // SQL query to insert data into the veterinarians table
    $sql = "INSERT INTO veterinarians (name, gender, date_of_birth, experience, specialization)
    VALUES ('$name', '$gender', '$date_of_birth', '$experience', '$specialization')";

    // Perform the SQL query
    if ($conn->query($sql) === TRUE) {
        echo "";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
  }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../vendor/bootstrap-5.0.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">    <link rel="stylesheet" href="style.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../styles/admin.css">
    <link rel="shortcut icon" href="../assets/img/no-bg-bg.png" type="image/x-icon">
    <title>Manage Veterinarian</title>
    
</head>

<body>
<?php
    require_once '../include/header.admin.php';
?>
    
    <div class="container-fluid">
        <div class="row justify-content-end ">
        <div class="col-md-2 sidebar">
    <?php require_once '../include/sidebar.php';?>
    </div>
        <div class="col-md-10">
        <main class="col-md-9 ms-sm-auto col-md-10 px-md-10">
            <div class="col-12 col-lg-6 d-flex justify-content-between align-items-center">
                <h2 class="h3 brand-color pt-3 pb-2">Add Veterinarian</h2>
                <a href="view-doctor.php" class="text-primary text-decoration-none"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</a>
            </div>
            <div class="col-12 col-lg-6">
            <?php
                // Check if form is submitted and display success message
                if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['save'])) {
                    echo '<div class="alert alert-success" role="alert">Veterinarian added successfully</div>';
                }
                ?>
                <form method="post" action="">
            <div class="mb-2">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control" id="name" name="name">
                </div>

                <div class="mb-2">
                    <label for="description" class="form-label">Gender</label>
                    <input type="text" class="form-control" id="gender" name="gender">
                </div>

                <div class="mb-2">
                  <label for="date_of_birth">Date of birth</label>
                      <input type="date" id="date_of_birth" name="date_of_birth">
                  </div>

                <div class="mb-2">
                    <label for="price" class="form-label">Experience</label>
                    <input type="text" class="form-control" id="experience" name="experience">
                </div>

                <div class="mb-2">
                    <label for="price" class="form-label">Specialization</label>
                    <input type="text" class="form-control" id="specialization" name="specialization">
                </div>

                    <button type="submit" name="save" class="btn btn-secondary mt-2 mb-3 brand-bg-color" id="addServiceButton">Save</button>
                </form>
            </div>
        </main>
        </div>
        </div>
    </div>

        <script src="./scripts/admin.js"></script>
</body>

</html>