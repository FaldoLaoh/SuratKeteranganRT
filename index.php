<?php
session_start();

// Check if user is logged in
if(isset($_SESSION['username'])) {
    // User is logged in
    $logoutButton = '<a href="#" onclick="confirmLogout()">Logout</a>';
    $disabledAttr = "";
    $ajukanButton = '<a href="halamanAjuan.php" class="nav-link">Ajukan</a>';
} else {
    // User is not logged in
    $loginButton = '<a href="halamanLogin.html">Login</a>';
    $disabledAttr = 'disabled tabindex="-1" aria-disabled="true"';
    $ajukanButton = '<a href="halamanAjuan.php" class="nav-link disabled" tabindex="-1" aria-disabled="true" style="padding-right: 0px;">Ajukan</a>';
}

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <script>
      function confirmLogout() {
        if (confirm("Are you sure you want to logout?")) {
          window.location.href = "script/logout.php";
        }
      }
    </script>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Dashboard</title>

    <!-- bootstrap css -->
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3"
      crossorigin="anonymous"
    />
    <link rel="stylesheet" href="style.css" />

    <!-- Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Montserrat+Alternates:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
      rel="stylesheet"
    />

    <!-- font awesome icon -->
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"
    />
  </head>
  <body>
    <nav>
      <!-- navbar logo -->
      <div class="logo">
        <a href="#beranda">Suke<span>RT</span></a>
      </div>
      <!-- Navbar container -->
      <div class="nav-container">
        <a href="#beranda">Beranda</a>
        <?php echo $ajukanButton; ?>
        <a href="#caraKerja">Cara Kerja</a>
        <a href="#tentangKami">Tentang kami</a>
        <div class="login-btn">
          <?php
          if (isset($_SESSION['username'])) {
              echo $logoutButton;
          } else {
              echo $loginButton;
          }
          ?>
        </div>
      </div>
    </nav>

    <!-- Hero Section -->
    <section class="beranda" id="beranda">
      <main>
        <div class="background">
          <img src="Asset/Frame 31.png" alt="" />
        </div>
        <div class="content">
          <h1>Perlu Tanda Tangan RT? <br />SukeRT aja!</h1>
          <p>
            SukeRT akan membantu mempermudah anda dalam mendapat persetujuan RT
            setempat untuk kepentingan Pribadi kamu
          </p>
          <?php echo $ajukanButton; ?>
        </div>
      </main>
    </section>

    <!-- Section Cara -->
    <section class="sectionCara" id="sectionCara">
      <main class="sectionCara-main">
        <div class="cara-container">
          <div class="ilustrasi">
            <img src="Asset/ilustrasi.png" alt="" />
          </div>
          <div class="content-cara">
            <h1>Bagaimana Caranya?</h1>
            <p>
              Bingung cara mengajukan surat keterangan menggunakan SukeRT?.
              Pelajari langkah langkahnya!
            </p>
            <a href="" class="pelajariBtn">Pelajari Caranya!</a>
          </div>
        </div>
      </main>
    </section>

    <footer>
      <main class="footer-main">
        <div class="logo">
          <a href="navbar-logo">Suke<span>RT</span></a>
        </div>

        <div class="footer-content">
          <div class="baris">
            <h1>kelompok 3:</h1>
            <p>
              Kelompok 3 merupkan tim yang bekerja dalam pembuatan website ini
            </p>
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
              <a href=""> <i class="fa fa-instagram"></i> </a>
              <a href=""><i class="fa fa-whatsapp"></i></a>
              <a href=""><i class="fa fa-linkedin"></i></a>
            </div>
          </div>
        </div>
      </main>
    </footer>

    <!-- script bootstrap -->
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
      crossorigin="anonymous"
    ></script>
  </body>
</html>
