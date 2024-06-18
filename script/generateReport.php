<?php
// Start output buffering
ob_start();

require_once('../tcpdf/tcpdf.php');

// Database connection parameters
$servername = "localhost"; // Replace with your server name
$dbname = "SUKERT"; // Replace with your database name
$dbusername = "root"; // Replace with your database username
$dbpassword = ""; // Replace with your database password

// Create connection
$conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$id = $_GET['id'];
$sql = "SELECT * FROM surat_ajuan WHERE id_surat = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$data = $result->fetch_assoc();

if (!$data) {
    die("Record not found");
}

// Path to the image
$image_path = realpath('../Asset/ttd.png'); // Use realpath to get the absolute path

// Check for output and clear buffer if necessary
if (ob_get_length()) ob_end_clean();

// Create PDF
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// Set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Your Name');
$pdf->SetTitle('Surat Ajuan');
$pdf->SetSubject('Surat Ajuan');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

// Set default header data

// Set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// Set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// Set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// Set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// Set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// Add a page
$pdf->AddPage();

// Set font
$pdf->SetFont('times', '', 12);

// Add content
$html = '
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<style>
    *
    {
      font-family: "Times New Roman", Times, serif;
      font-size: medium;
    }
    p {
      text-align: left;
      margin-left: 10%;
      font-size: 11px;
    }
    h4
    {
      text-align: right;
    }
    .ttd 
    {
      display: flex;
      justify-content: end;
      margin-right: 10%;
    }
</style>
<body>
    <header>
        <h1>' . $data['tipe_surat'] . '<br>Kelurahan Pabean, Kecamatan Sedati, Kabupaten Sidoarjo</h1>
        <hr><hr>
    </header>
    <section>
        <p>Yang bertanda tangan dibawah ini, menerangkan dengan sebenarnya, bahwa:</p>
        <p>Nama : ' . $data['nama'] . '</p>
        <p>NIK: ' . $data['nik'] . '</p>
        <p>T/TL: ' . $data['tempat_lahir'] . ', ' . $data['tanggal_lahir'] . '</p>
        <p>Jenis Kelamin: ' . $data['kelamin'] . '</p>
        <p>Agama: ' . $data['agama'] . '</p>
        <p>Pekerjaan: ' . $data['pekerjaan'] . '</p>
        <p>Kewarganegaraan: ' . $data['kewarganegaraan'] . '</p>
        <p>Status Perkawinan: ' . $data['status_perkawinan'] . '</p>
        <p>RT/RW: ' . $data['rtrw'] . '</p>
        <p>Alamat: ' . $data['alamat'] . '</p>
        <br>
        <p>Menyatakan bahwa nama yang tertulis diatas benar adalah warga RT 061, Kecamatan Sedati. dan siap di pertanggung jawabkan. oleh sebab itu benar adanya pernyataan:</p>
        <h3>"Surat Keterangan ini diperuntukan untuk kepentingan ' . $data['keperluan_Surat'] . '"</h3>
        <p>Demikianlah Surat Keterangan ini kami sampaikan untuk dapat digunakan sebagaimana semestinya.</p>
        <br><br>
        <div class="ttd">
            <h4>Surabaya, ' . date("d F Y") . '<br><br>
            <img src="file:///' . $image_path . '" width="200px"><br>
            Ketua RT</h4>
        </div>
    </section>
</body>
</html>';

// Output the HTML content
$pdf->writeHTML($html, true, false, true, false, '');

// Close and output PDF document
$pdf->Output('surat_ajuan_' . $id . '.pdf', 'I');

// Close connection
$conn->close();
?>
