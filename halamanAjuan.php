<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
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

    // Get the form data
    $tipe_surat = $_POST['tipe_surat'];
    $nama = $_POST['nama'];
    $nik = $_POST['nik'];
    $tempat_lahir = $_POST['tempat_lahir'];
    $tanggal_lahir = $_POST['tanggal_lahir'];
    $kelamin = $_POST['kelamin'];
    $agama = $_POST['agama'];
    $pekerjaan = $_POST['pekerjaan'];
    $kewarganegaraan = $_POST['kewarganegaraan'];
    $status_perkawinan = $_POST['status_perkawinan'];
    $rtrw = $_POST['rtrw'];
    $alamat = $_POST['alamat'];
    $keperluan_surat = $_POST['keperluan_surat'];

    // Prepare the SQL query
    $sql = "INSERT INTO `surat_ajuan` (tipe_surat, nama, nik, tempat_lahir, tanggal_lahir, kelamin, agama, pekerjaan, kewarganegaraan, status_perkawinan, rtrw, alamat, keperluan_surat) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    // Prepare and bind
    $stmt = $conn->prepare($sql);
    
    if ($stmt === false) {
        die("Prepare failed: " . $conn->error);
    }

    $stmt->bind_param("sssssssssssss", $tipe_surat, $nama, $nik, $tempat_lahir, $tanggal_lahir, $kelamin, $agama, $pekerjaan, $kewarganegaraan, $status_perkawinan, $rtrw, $alamat, $keperluan_surat);

    // Execute the query
    if ($stmt->execute()) {
        $last_id = $stmt->insert_id; // Get the last inserted ID
        header("Location: script/generateReport.php?id=$last_id"); // Redirect to the report page
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajukan Surat</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat+Alternates:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="ajuanStyle.css">
  
</head>
<body>
    <div class="container">
        <h2>Ajukan Surat</h2>
        <form action="halamanAjuan.php" method="POST">
            <div class="mb-3">
                <label for="tipe_surat" class="form-label">Tipe Surat</label>
                <select class="form-control" id="tipe_surat" name="tipe_surat" required>
                    <option value="Surat Keterangan Tidak Mampu">Surat Keterangan Tidak Mampu</option>
                    <option value="Surat Keterangan Slip Gaji">Surat Keterangan Slip Gaji</option>
                    <option value="Surat Keterangan Penduduk Baru">Surat Keterangan Penduduk Baru</option>
                    <option value="Surat Keterangan Perpindahan Penduduk">Surat Keterangan Perpindahan Penduduk</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="nama" class="form-label">Nama</label>
                <input type="text" class="form-control" id="nama" name="nama" required>
            </div>
            <div class="mb-3">
                <label for="nik" class="form-label">NIK</label>
                <input type="text" class="form-control" id="nik" name="nik" required>
            </div>
            <div class="mb-3">
                <label for="tempat_lahir" class="form-label">Tempat Lahir</label>
                <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir" required>
            </div>
            <div class="mb-3">
                <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir" required>
            </div>
            <div class="mb-3">
                <label for="kelamin" class="form-label">Kelamin</label>
                <div>
                    <input type="radio" id="laki-laki" name="kelamin" value="Laki-laki" required>
                    <label for="laki-laki">Laki-laki</label>
                </div>
                <div>
                    <input type="radio" id="perempuan" name="kelamin" value="Perempuan" required>
                    <label for="perempuan">Perempuan</label>
                </div>
            </div>
            <div class="mb-3">
                <label for="agama" class="form-label">Agama</label>
                <select class="form-control" id="agama" name="agama" required>
                    <option value="Islam">Islam</option>
                    <option value="Kristen">Kristen</option>
                    <option value="Katolik">Katolik</option>
                    <option value="Hindu">Hindu</option>
                    <option value="Buddha">Buddha</option>
                    <option value="Konghuchu">Konghuchu</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="pekerjaan" class="form-label">Pekerjaan</label>
                <input type="text" class="form-control" id="pekerjaan" name="pekerjaan" required>
            </div>
            <div class="mb-3">
                <label for="kewarganegaraan" class="form-label">Kewarganegaraan</label>
                <div>
                    <input type="radio" id="wni" name="kewarganegaraan" value="WNI" required>
                    <label for="wni">WNI</label>
                </div>
                <div>
                    <input type="radio" id="wna" name="kewarganegaraan" value="WNA" required>
                    <label for="wna">WNA</label>
                </div>
            </div>
            <div class="mb-3">
                <label for="status_perkawinan" class="form-label">Status Perkawinan</label>
                <div>
                    <input type="radio" id="sudah-menikah" name="status_perkawinan" value="Sudah Menikah" required>
                    <label for="sudah-menikah">Sudah Menikah</label>
                </div>
                <div>
                    <input type="radio" id="belum-menikah" name="status_perkawinan" value="Belum Menikah" required>
                    <label for="belum-menikah">Belum Menikah</label>
                </div>
            </div>
            <div class="mb-3">
                <label for="rtrw" class="form-label">RT/RW</label>
                <input type="text" class="form-control" id="rtrw" name="rtrw" required>
            </div>
            <div class="mb-3">
                <label for="alamat" class="form-label">Alamat</label>
                <input type="text" class="form-control" id="alamat" name="alamat" required>
            </div>
            <div class="mb-3">
                <label for="keperluan_surat" class="form-label">Keperluan Surat</label>
                <textarea class="form-control" id="keperluan_surat" name="keperluan_surat" rows="3" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</body>
</html>
