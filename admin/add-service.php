<?php
include '../classess/db.php';
$objDB = new dbConnect();
$conn = $objDB->connect();


// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $name = isset($_POST["name"]) ? $_POST["name"] : '';
    $description = isset($_POST["description"]) ? $_POST["description"] : '';
    $price = isset($_POST["price"]) ? $_POST["price"] : '';

    // Sanitize and escape the input to prevent SQL injection
    $name = mysqli_real_escape_string($conn, $name);
    $description = mysqli_real_escape_string($conn, $description);

    // Insert data into the dbConnect
    $sql = "INSERT INTO services (name, description, price) VALUES ('$name', '$description', '$price')";

    if ($conn->query($sql) === TRUE) {
        echo "";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Close connection
$conn->close();
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400&display=swap" rel="stylesheet">
    <link href="../vendor/bootstrap-5.0.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="../vendor/dataTable-1.13.6/datatables.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../vendor/font-awesome-4.7.0/css/font-awesome.min.css"/>   
    <link rel="stylesheet"  href="../assets/css/style.css">
    <link rel="stylesheet" href="../styles/admin.css">
    <link rel="shortcut icon" href="../assets/img/no-bg-bg.png" type="image/x-icon">
    <title>Manage Service</title>
    
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
                <h2 class="h3 brand-color pt-3 pb-2">Add Service</h2>
                <a href="view-service.php" class="text-primary text-decoration-none"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</a>
            </div>
            <div class="col-12 col-lg-6">
            <?php
                // Check if form is submitted and display success message
                if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['save'])) {
                    echo '<div class="alert alert-success" role="alert">Service added successfully</div>';
                }
                ?>
                <form method="post" action="">
            <div class="mb-2">
                    <label for="name" class="form-label">Name of service</label>
                    <input type="text" class="form-control" id="name" name="name">
                </div>

                <div class="mb-2">
                    <label for="description" class="form-label">Description</label>
                    <input type="text" class="form-control" id="description" name="description">
                </div>

                <div class="mb-2">
                    <label for="price" class="form-label">Price</label>
                    <input type="text" class="form-control" id="price" name="price">
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