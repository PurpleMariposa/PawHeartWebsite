
<style>
    /* styles.css */

.sidebar {
    height: 100%;
    width: 250px;
    position: fixed;
    left: 0;
    background-color: pink;
    overflow-x: hidden;
}

.sidebar a {
    padding: 15px 8px 15px 32px;
    text-decoration: none;
    font-size: 18px;
    color: white;
    display: block;
    transition: 0.3s;
}

.sidebar a:hover {
    background-color: rgba(255, 255, 255, 0.2);
    box-shadow: 0 0 10px 5px rgba(255, 255, 255, 0.2);
}

@media screen and (max-width: 768px) {
    .sidebar {
        width: 100%;
        position: static;
        height: auto;
    }
}

/* Add some basic styles for the box container */
.dashboard-container {
    display: flex;
    justify-content: space-between; /* Adjust as needed */
}

/* Add some basic styles for the box */
.dashboard-box {
    width: 300px;
    height: 200px;
    background-color: rgb(198, 162, 211); /* Set the background color */
    border: 1px solid #ccc;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    margin: 20px;
}

/* Additional styling for content inside the box */
.dashboard-box h2,
.dashboard-box p {
    color: #333;
    font-size: 24px; /* Adjust the font size as needed */
}

</style>

<div class="sidebar">
    <h1 class="text-center"><i class="fa fa-user-circle-o" aria-hidden="true"></i>Admin</h1>
    <a href="./admin.php"><i class="fa fa-tasks" aria-hidden="true"></i> Manage Appointments</a>
    <a href="./view-doctor.php"><i class="fa fa-user-md" aria-hidden="true"></i> Manage Veterinarian</a>
    <a href="./view-service.php"><i class="fa fa-cogs" aria-hidden="true"></i> Manage Service</a>
    <a href="./logout.admin.php"><i class="fa fa-sign-out" aria-hidden="true"></i> Log-out</a>
</div>
