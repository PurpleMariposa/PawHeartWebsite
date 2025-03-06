<?php
include '../classess/db.php';
$objDB = new dbConnect();
$conn = $objDB->connect();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the form data
    $id = isset($_POST['id']) ? intval($_POST['id']) : 0;
    $appointment_date = isset($_POST['appointment_date']) ? $_POST['appointment_date'] : '';
    $appointment_time = isset($_POST['appointment_time']) ? $_POST['appointment_time'] : '';
    $name = isset($_POST['name']) ? $_POST['name'] : '';
    $doctor_name = isset($_POST['doctor_name']) ? $_POST['doctor_name'] : '';    

    // Sanitize and escape the input to prevent SQL injection
    $id = mysqli_real_escape_string($conn, $id);
    $appointment_date = mysqli_real_escape_string($conn, $appointment_date);
    $appointment_time = mysqli_real_escape_string($conn, $appointment_time);
    $name = mysqli_real_escape_string($conn, $name);
    $doctor_name = mysqli_real_escape_string($conn, $doctor_name);

    // Update data in the dbConnect
    $sql = "UPDATE appointment SET appointment_date='$appointment_date', appointment_time='$appointment_time', name='$name', doctor_name='$doctor_name' WHERE id='$id'";

    if ($conn->query($sql) === TRUE) {
        echo "";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Retrieve service details based on ID
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM appointment WHERE id='$id'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $id = $row['id'];
        $appointment_date = $row['appointment_date'];
        $appointment_time = $row['appointment_time'];
        $name = $row['name'];
        $doctor_name = $row['doctor_name'];
    } else {
        echo "Appointment not found";
        exit;
    }
} else {
    echo "Appointment ID not provided";
    exit;
}
//Close connnection
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
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../styles/admin.css">
    <link rel="shortcut icon" href="../assets/img/no-bg-bg.png" type="image/x-icon">
    <title>Manage Appointment</title>
   
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
                <h2 class="h3 brand-color pt-3 pb-2">Edit Apppointment</h2>
                <a href="admin.php" class="text-primary text-decoration-none"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</a>
            </div>
            <div class="col-12 col-lg-6">
            <?php
                // Check if form is submitted and display success message
                if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['save'])) {
                    echo '<div class="alert alert-success" role="alert">Appointment updated successfully</div>';
                }
                ?>
                <form method="post" action="">
                    <input type="hidden" name="id" value="<?= $id ?>">
                    <div class="mb-2">
                        <label for="appointment_date" class="form-label">Date</label>
                        <input type="date" class="form-control" id="appointment_date" name="appointment_date" value="<?= $appointment_date ?>">
                    </div>
                    <div class="mb-2">
                        <label for="appointment_time" class="form-label">Time</label>
                        <input type="time" class="form-control" id="appointment_time" name="appointment_time" value="<?= $appointment_time ?>">
                    </div>
                    <div class="mb-2">
                        <label for="name" class="form-label">Owner Name</label>
                        <input type="text" class="form-control" id="name" name="name" value="<?= $name ?>">
                    </div>
                    <div class="mb-2">
                        <label for="doctor_name" class="form-label">Veterinarian</label>
                        <input type="text" class="form-control" id="doctor_name" name="doctor_name" value="<?= $doctor_name ?>">
                    </div>
                    <button type="submit" name="save" class="btn mt-2 mb-3 btn-secondary brand-bg-color" id="editAppointmentButton">Save Changes</button>
                </form>

            </div>
        </main>
        </div>
        </div>
    </div>
       
        <script src="./scripts/admin.js"></script>
    </body>

    </html>