<?php
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

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the form data
    $id_surat = $_POST['id_surat']; // Ensure you have a hidden input field for id_surat in your form
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
    $sql = "UPDATE `surat_ajuan` SET 
                tipe_surat = ?, 
                nama = ?, 
                nik = ?, 
                tempat_lahir = ?, 
                tanggal_lahir = ?, 
                kelamin = ?, 
                agama = ?, 
                pekerjaan = ?, 
                kewarganegaraan = ?, 
                status_perkawinan = ?, 
                rtrw = ?, 
                alamat = ?, 
                keperluan_surat = ?
            WHERE id_surat = ?";

    // Prepare and bind
    $stmt = $conn->prepare($sql);
    
    if ($stmt === false) {
        die("Prepare failed: " . $conn->error);
    }

    $stmt->bind_param("sssssssssssssi", 
                      $tipe_surat, 
                      $nama, 
                      $nik, 
                      $tempat_lahir, 
                      $tanggal_lahir, 
                      $kelamin, 
                      $agama, 
                      $pekerjaan, 
                      $kewarganegaraan, 
                      $status_perkawinan, 
                      $rtrw, 
                      $alamat, 
                      $keperluan_surat, 
                      $id_surat);

    // Execute the query
    if ($stmt->execute()) {
        header("Location: admin.php"); // Redirect to the admin panel
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close the statement and connection
    $stmt->close();
}

// Fetch record to pre-fill the form
$id_surat = $_GET['id'];
$sql = "SELECT * FROM surat_ajuan WHERE id_surat = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id_surat);
$stmt->execute();
$result = $stmt->get_result();
$data = $result->fetch_assoc();

// Close connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Surat Ajuan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="edit.css">
</head>
<body>
    <div class="container">
        <h2>Edit Surat Ajuan</h2>
        <form action="edit.php" method="POST">
            <input type="hidden" name="id_surat" value="<?php echo $data['id_surat']; ?>">
            <div class="mb-3">
                <label for="tipe_surat" class="form-label">Tipe Surat</label>
                <select class="form-control" id="tipe_surat" name="tipe_surat" required>
                    <option value="Surat Keterangan Tidak Mampu" <?php if ($data['tipe_surat'] == "Surat Keterangan Tidak Mampu") echo "selected"; ?>>Surat Keterangan Tidak Mampu</option>
                    <option value="Surat Keterangan Slip Gaji" <?php if ($data['tipe_surat'] == "Surat Keterangan Slip Gaji") echo "selected"; ?>>Surat Keterangan Slip Gaji</option>
                    <option value="Surat Keterangan Penduduk Baru" <?php if ($data['tipe_surat'] == "Surat Keterangan Penduduk Baru") echo "selected"; ?>>Surat Keterangan Penduduk Baru</option>
                    <option value="Surat Keterangan Perpindahan Penduduk" <?php if ($data['tipe_surat'] == "Surat Keterangan Perpindahan Penduduk") echo "selected"; ?>>Surat Keterangan Perpindahan Penduduk</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="nama" class="form-label">Nama</label>
                <input type="text" class="form-control" id="nama" name="nama" value="<?php echo $data['nama']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="nik" class="form-label">NIK</label>
                <input type="text" class="form-control" id="nik" name="nik" value="<?php echo $data['nik']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="tempat_lahir" class="form-label">Tempat Lahir</label>
                <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir" value="<?php echo $data['tempat_lahir']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir" value="<?php echo $data['tanggal_lahir']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="kelamin" class="form-label">Kelamin</label>
                <div>
                    <input type="radio" id="laki-laki" name="kelamin" value="Laki-laki" <?php if ($data['kelamin'] == "Laki-laki") echo "checked"; ?> required>
                    <label for="laki-laki">Laki-laki</label>
                </div>
                <div>
                    <input type="radio" id="perempuan" name="kelamin" value="Perempuan" <?php if ($data['kelamin'] == "Perempuan") echo "checked"; ?> required>
                    <label for="perempuan">Perempuan</label>
                </div>
            </div>
            <div class="mb-3">
                <label for="agama" class="form-label">Agama</label>
                <select class="form-control" id="agama" name="agama" required>
                    <option value="Islam" <?php if ($data['agama'] == "Islam") echo "selected"; ?>>Islam</option>
                    <option value="Kristen" <?php if ($data['agama'] == "Kristen") echo "selected"; ?>>Kristen</option>
                    <option value="Katolik" <?php if ($data['agama'] == "Katolik") echo "selected"; ?>>Katolik</option>
                    <option value="Hindu" <?php if ($data['agama'] == "Hindu") echo "selected"; ?>>Hindu</option>
                    <option value="Buddha" <?php if ($data['agama'] == "Buddha") echo "selected"; ?>>Buddha</option>
                    <option value="Konghuchu" <?php if ($data['agama'] == "Konghuchu") echo "selected"; ?>>Konghuchu</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="pekerjaan" class="form-label">Pekerjaan</label>
                <input type="text" class="form-control" id="pekerjaan" name="pekerjaan" value="<?php echo $data['pekerjaan']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="kewarganegaraan" class="form-label">Kewarganegaraan</label>
                <div>
                    <input type="radio" id="wni" name="kewarganegaraan" value="WNI" <?php if ($data['kewarganegaraan'] == "WNI") echo "checked"; ?> required>
                    <label for="wni">WNI</label>
                </div>
                <div>
                    <input type="radio" id="wna" name="kewarganegaraan" value="WNA" <?php if ($data['kewarganegaraan'] == "WNA") echo "checked"; ?> required>
                    <label for="wna">WNA</label>
                </div>
            </div>
            <div class="mb-3">
                <label for="status_perkawinan" class="form-label">Status Perkawinan</label>
                <div>
                    <input type="radio" id="sudah-menikah" name="status_perkawinan" value="Sudah Menikah" <?php if ($data['status_perkawinan'] == "Sudah Menikah") echo "checked"; ?> required>
                    <label for="sudah-menikah">Sudah Menikah</label>
                </div>
                <div>
                    <input type="radio" id="belum-menikah" name="status_perkawinan" value="Belum Menikah" <?php if ($data['status_perkawinan'] == "Belum Menikah") echo "checked"; ?> required>
                    <label for="belum-menikah">Belum Menikah</label>
                </div>
            </div>
            <div class="mb-3">
                <label for="rtrw" class="form-label">RT/RW</label>
                <input type="text" class="form-control" id="rtrw" name="rtrw" value="<?php echo $data['rtrw']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="alamat" class="form-label">Alamat</label>
                <input type="text" class="form-control" id="alamat" name="alamat" value="<?php echo $data['alamat']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="keperluan_surat" class="form-label">Keperluan Surat</label>
                <textarea class="form-control" id="keperluan_surat" name="keperluan_surat" rows="3" required><?php echo $data['keperluan_Surat']; ?></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Save</button>
        </form>
    </div>
</body>
</html>
