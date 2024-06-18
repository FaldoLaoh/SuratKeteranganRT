<?php
// Start output buffering
ob_start();

// Check if the TCPDF class is already included
if (!class_exists('TCPDF')) {
    require_once('../tcpdf/tcpdf.php');
}

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

// Fetch records from surat_ajuan table
$sql = "SELECT * FROM surat_ajuan";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Create instance of TCPDF class
    $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

    // Set document information
    $pdf->SetCreator(PDF_CREATOR);
    $pdf->SetAuthor('Admin');
    $pdf->SetTitle('Report - Surat Ajuan');
    $pdf->SetSubject('Report');
    $pdf->SetKeywords('TCPDF, PDF, report, surat ajuan');

    // Set default header data
    $pdf->SetHeaderData('', 0, 'Report - Surat Ajuan', 'Generated on: '.date('d/m/Y'));

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
    <h2>List of Surat Ajuan</h2>
    <table border="1" cellpadding="4">
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
        </tr>';

    while($row = $result->fetch_assoc()) {
        $html .= '<tr>
                    <td>' . $row['id_surat'] . '</td>
                    <td>' . $row['tipe_surat'] . '</td>
                    <td>' . $row['nama'] . '</td>
                    <td>' . $row['nik'] . '</td>
                    <td>' . $row['tempat_lahir'] . '</td>
                    <td>' . $row['tanggal_lahir'] . '</td>
                    <td>' . $row['kelamin'] . '</td>
                    <td>' . $row['agama'] . '</td>
                    <td>' . $row['pekerjaan'] . '</td>
                    <td>' . $row['kewarganegaraan'] . '</td>
                    <td>' . $row['status_perkawinan'] . '</td>
                    <td>' . $row['rtrw'] . '</td>
                    <td>' . $row['alamat'] . '</td>
                    <td>' . $row['keperluan_Surat'] . '</td>
                  </tr>';
    }

    $html .= '</table>';

    // Output the HTML content
    $pdf->writeHTML($html, true, false, true, false, '');

    // Close and output PDF document
    $pdf->Output('report_surat_ajuan.pdf', 'I');
} else {
    echo "No records found";
}

$conn->close();
?>
