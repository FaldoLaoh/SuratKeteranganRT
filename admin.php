<?php
session_start();

// Check if user is not logged in or is not an admin, redirect to login page


// Database connection parameters
$servername = "localhost";
$dbname = "SUKERT";
$dbusername = "root";
$dbpassword = "";

// Create connection
$conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Surat Ajuan</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous" />
    <!-- Custom CSS -->
    <link href="adminStyle.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2>Admin Panel - Surat Ajuan</h2>
        <hr>

        <!-- Display Records -->
        <h3>List of Surat Ajuan</h3>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Tipe Surat</th>
                    <th>Nama</th>
                    <th>NIK</th>
                    <th>Tempat Lahir</th>
                    <th>Tanggal Lahir</th>
                    <th>Kelamin</th>
                    <th>Agama</th>
                    <th>Pekerjaan</th>
                    <th>Kewarganegaraan</th>
                    <th>Status Perkawinan</th>
                    <th>RT/RW</th>
                    <th>Alamat</th>
                    <th>Keperluan Surat</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Fetch records from surat_ajuan table
                $sql = "SELECT * FROM surat_ajuan";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row['id_surat'] . "</td>";
                        echo "<td>" . $row['tipe_surat'] . "</td>";
                        echo "<td>" . $row['nama'] . "</td>";
                        echo "<td>" . $row['nik'] . "</td>";
                        echo "<td>" . $row['tempat_lahir'] . "</td>";
                        echo "<td>" . $row['tanggal_lahir'] . "</td>";
                        echo "<td>" . $row['kelamin'] . "</td>";
                        echo "<td>" . $row['agama'] . "</td>";
                        echo "<td>" . $row['pekerjaan'] . "</td>";
                        echo "<td>" . $row['kewarganegaraan'] . "</td>";
                        echo "<td>" . $row['status_perkawinan'] . "</td>";
                        echo "<td>" . $row['rtrw'] . "</td>";
                        echo "<td>" . $row['alamat'] . "</td>";
                        echo "<td>" . $row['keperluan_Surat'] . "</td>";
                        echo '<td>
                                <a href="edit.php?id=' . $row['id_surat'] . '" class="btn btn-primary btn-sm">Edit</a>
                                <a href="delete.php?id=' . $row['id_surat'] . '" class="btn btn-danger btn-sm">Delete</a>
                                <a href="script/generateReport.php?id=' . $row['id_surat'] . '" class="btn btn-success btn-sm">Print PDF</a>
                              </td>';
                        echo "</tr>";
                    }
                } else {
                    echo '<tr><td colspan="15">No records found</td></tr>';
                }
                ?>
            </tbody>
        </table>

        <!-- Add New Record Button -->
        <a href="add.php" class="btn btn-success">Add New Surat Ajuan</a>
        
        <!-- Print Report Button -->
        <a href="script/printReport.php" class="btn btn-info float-end">Print Report</a>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka64BS0CQgwbmMR6eXFd86u30g4sL7T4Oog1Rb3y7cRiCRz/JuAlOxl7T1ZBSJ0k" crossorigin="anonymous"></script>
</body>
</html>
