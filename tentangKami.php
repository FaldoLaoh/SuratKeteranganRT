<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tentang Kami</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous" />
    <!-- Custom CSS -->
    <link href="tentangStyle.css" rel="stylesheet">
    <!-- Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat+Alternates:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
    <!-- Navbar -->
    <nav>
        <div class="logo">
            <a href="index.php">Suke<span>RT</span></a>
        </div>
        <div class="nav-container">
            <a href="index.php">Beranda</a>
            <a href="tentangKami.php">Tentang Kami</a>
            <div class="login-btn">
                <?php
                session_start();
                if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true) {
                    echo '<a href="#" onclick="confirmLogout()">Logout</a>';
                } else {
                    echo '<a href="halamanLogin.html">Login</a>';
                }
                ?>
            </div>
        </div>
    </nav>

    <!-- Tentang Kami Section -->
    <section class="anggota" id="anggota">
        <h2>Meet Our <span>Team</span></h2>
        <div class="anggota-container">
            <div class="anggota-item">
                <img src="andi.jpg" alt="Ndee">
                <h3 style="padding: 8px;" class="anggota-nama">Andi Muchammad. F.A</h3>
                <p>22082010257 <br>
                    <br>T/TL : Sidoarjo, 06 Oktober 2004
                    <br>
                    <br>Hobi: Tidur
                </p>
            </div>
            <div class="anggota-item">
                <img src="dope.jpg" alt="dope">
                <h3 style="padding: 8px;" class="anggota-nama">Faldo Julian Joshua.L</h3>
                <p>22082010256 <br>
                    <br>T/TL : Timika, 01 Juli 2004
                    <br>
                    <br>Hobi: Nonton Film
                </p>
            </div>
            <div class="anggota-item">
                <img src="aul.jpg" alt="aul">
                <h3 style="padding: 8px;" class="anggota-nama">Fadiyah Aulia Hafshoh</h3>
                <p>22082010258 <br>
                    <br>T/TL : Gresik, 06 Desember 2004
                    <br>
                    <br>Hobi: healing
                </p>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <main class="footer-main">
            <div class="logo">
                <a href="index.php">Suke<span>RT</span></a>
            </div>
            <div class="footer-content">
                <div class="baris">
                    <h1>kelompok 3:</h1>
                    <p>Kelompok 3 merupkan tim yang bekerja dalam pembuatan website ini</p>
                    <h1>Lokasi:</h1>
                    <p>Kota Surabaya, Jawa Timur, Indonesia.</p>
                </div>
                <div class="baris">
                    <h1>Tentang SukeRT:</h1>
                    <p>Tentang Kami</p>
                    <p>Hubungi Kami</p>
                </div>
                <div class="baris">
                    <h1>Jasa yang ditawarkan:</h1>
                    <p>Ajuan Surat Keterangan</p>
                </div>
                <div class="baris">
                    <h1>kelompok 3</h1>
                    <div class="icon">
                        <a href=""><i class="fa fa-instagram"></i></a>
                        <a href=""><i class="fa fa-whatsapp"></i></a>
                        <a href=""><i class="fa fa-linkedin"></i></a>
                    </div>
                </div>
            </div>
        </main>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka64BS0
