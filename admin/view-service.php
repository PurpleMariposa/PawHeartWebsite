<?php
include '../classess/db.php';
$objDB = new dbConnect();
$conn = $objDB->connect();

// Fetch data from the services table
$sql = "SELECT * FROM services";
$result = $conn->query($sql);

// Initialize an array to store the service data
$serviceArray = array();

// Check if there are rows in the result
if ($result->num_rows > 0) {
    // Fetch data and store it in the array
    while ($row = $result->fetch_assoc()) {
        $serviceArray[] = $row;
    }
}

// Close the dbConnect connection
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
    <link rel="stylesheet" href="../vendor/font-awesome-4.7.0/css/font-awesome.min.css"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../styles/admin.css">
    <link rel="stylesheet" href=".../assets/css/style.css">
    <link rel="shortcut icon" href="../assets/img/no-bg-bg.png" type="image/x-icon"> 
    <title>Manage Service</title>
</head>

<body>
<?php require_once '../include/header.admin.php';?> 

  <div class="container-fluid">
    <div class="row d-flex justify-content-end">
    <div class="col-md-2 sidebar">
        <?php require_once '../include/sidebar.php';?>
    </div>
    <div class="col-md-10">
    <main>
    <div class="l">
      <h1 style="text-align: center;">Service</h1>
      </div>
  <div id="after-nav-col-2" class="side-part appointment all-appoint">
          <div id="chek">
            </div>
              <div class="table-responsive">
              <div class="mt-3 mb-3"><a href="./add-service.php" class="btn btn-warning btn-lg"><i class="fa fa-plus-circle" aria-hidden="true"></i> Add Service</a></div>
                  <table class="table table-bordered table-hover">
                      <thead class="table-responsive-sm">
                    <tr>
                        <th scope="col">S.N.</th>
                        <th scope="col">Name of Service</th>
                        <th scope="col">Description</th>
                        <th scope="col">Price</th>
                        <th scope="col" width="10%">Action</th>
                    </tr>
                </thead>
                <tbody id="serviceTableBody" class="table-responsive-sm">
                    <?php
                    $counter = 1;
                    foreach ($serviceArray as $item) {
                    ?>
                        <tr>
                            <td><?= $counter ?></td>
                            <td><?= $item['name'] ?></td>
                            <td><?= $item['description'] ?></td>
                            <td><?= $item['price'] ?></td>
                            <td>
                            <button onclick="editService(<?= $item['id'] ?>)" class="btn btn-success btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button>
                            <button onclick="deleteService(<?= $item['id'] ?>)" class="btn btn-danger btn-sm"><i class="fa fa-trash" aria-hidden="true"></i> Delete</button>
                            </td>
                        </tr>
                    <?php
                        $counter++;
                    }
                    ?>
                </tbody>
                  </table>
              </div>
          </div>
  </main>
    </div>
    </div>
  </div>

          <script>
            function deleteService(id) {
                var confirmDelete = confirm('Are you sure you want to delete this service?');

                if (confirmDelete) {
                    // Send an AJAX request to delete the service
                    var xhr = new XMLHttpRequest();
                    xhr.open('POST', 'delete-service.php', true);
                    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                    xhr.onload = function () {
                        if (xhr.status == 200) {
                            // Update the table or display a success message
                            alert('Service deleted successfully! Please reload the page.');
                            // You may want to refresh the page or update the table without reloading
                        } else {
                            alert('Error: ' + xhr.status);
                        }
                    };

                    xhr.send('id=' + id);
                }
            }
            function editService(id) {
            // Redirect to the edit-appointment.php page with the appointment ID
            window.location.href = 'edit-service.php?id=' + id;
        }
</script>

        <script src="./scripts/admin.js"></script>
</body>

</html>

