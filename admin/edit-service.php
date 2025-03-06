<?php
include '../classess/db.php';
$objDB = new dbConnect();
$conn = $objDB->connect();

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $id = isset($_POST["id"]) ? $_POST["id"] : '';
    $name = isset($_POST["name"]) ? $_POST["name"] : '';
    $description = isset($_POST["description"]) ? $_POST["description"] : '';
    $price = isset($_POST["price"]) ? $_POST["price"] : '';

    // Sanitize and escape the input to prevent SQL injection
    $id = mysqli_real_escape_string($conn, $id);
    $name = mysqli_real_escape_string($conn, $name);
    $description = mysqli_real_escape_string($conn, $description);

    // Update data in the dbConnect
    $sql = "UPDATE services SET name='$name', description='$description', price='$price' WHERE id='$id'";

    if ($conn->query($sql) === TRUE) {
        echo "";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Retrieve service details based on ID
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM services WHERE id='$id'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $id = $row['id'];
        $name = $row['name'];
        $description = $row['description'];
        $price = $row['price'];
    } else {
        echo "Service not found";
        exit;
    }
} else {
    echo "Service ID not provided";
    exit;
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
    <link rel="stylesheet" href="../vendor/bootstrap-5.0.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">    <link rel="stylesheet" href="style.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../styles/admin.css">
    <link rel="shortcut icon" href="../assets/img/no-bg-bg.png" type="image/x-icon">
    <title>Manage Service</title>
    
</head>
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
                <h2 class="h3 brand-color pt-3 pb-2">Edit Service</h2>
                <a href="view-service.php" class="text-primary text-decoration-none"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</a>
            </div>
            <div class="col-12 col-lg-6">
            <?php
                // Check if form is submitted and display success message
                if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['save'])) {
                    echo '<div class="alert alert-success" role="alert">Service updated successfully</div>';
                }
                ?>
                <form method="post" action="">
                    <input type="hidden" name="id" value="<?= $id ?>">
                    <div class="mb-2">
                        <label for="name" class="form-label">Name of service</label>
                        <input type="text" class="form-control" id="name" name="name" value="<?= $name ?>">
                    </div>
                    <div class="mb-2">
                        <label for="description" class="form-label">Description</label>
                        <input type="text" class="form-control" id="description" name="description" value="<?= $description ?>">
                    </div>
                    <div class="mb-2">
                        <label for="price" class="form-label">Price</label>
                        <input type="text" class="form-control" id="price" name="price" value="<?= $price ?>">
                    </div>
                    <button type="submit" name="save" class="btn mt-2 mb-3 btn-secondary brand-bg-color" id="editServiceButton">Save Changes</button>
                </form>
            </div>
        </main>
        </div>
        </div>
    </div>
        
        <script src="./scripts/admin.js"></script>
    </body>

    </html>
    