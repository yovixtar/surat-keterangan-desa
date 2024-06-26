<?php include 'konek.php';?>
<link href="demo1/css/sweetalert.css" rel="stylesheet" type="text/css">
<script src="demo1/js/jquery-2.1.3.min.js"></script>
<script src="demo1/js/sweetalert.min.js"></script> 
<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Halaman Pendaftaran Pegawai</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="main/vendors/mdi/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="main/vendors/base/vendor.bundle.base.css">
  <link href="main/js/sweetalert.css" rel="stylesheet" type="text/css">
  <script src="main/js/jquery-2.1.3.min.js"></script>
  <script src="main/js/sweetalert.min.js"></script>                
  <script src="main/js/sweetalert-dev.js"></script>  
  <!-- endinject -->
  <!-- plugin css for this page -->
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="main/css/style.css">
  <style>
    .form-control {
      color: black !important; 
    }
  </style>
  <!-- endinject -->
  <link rel="shortcut icon" href="main/images/favicon.png" />
</head>

<body>

  <div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="content-wrapper d-flex align-items-center auth px-0">
        <div class="row w-100 mx-0">
          <div class="col-lg-4 mx-auto">
            <div class="auth-form-light text-left py-5 px-4 px-sm-5">
              <div class="brand-logo text-center">
                <img src="main/img/p.png" width="5" alt="logo">
              </div>
              <h4 class="text-center">HALAMAN PEGAWAI</h4>
              
              <form method="POST" class="pt-3">
             
                <div class="form-group">
                  <select name="hak_akses" id="" class="form-control form-control-md">
                    <option value="Lurah">Lurah</option>
                    <option value="Staf">Staf</option>
                  </select>
                </div>

                <div class="form-group">
                  <input type="password" name="password" class="form-control form-control-md" placeholder="Password" minlength = "8" required>
                </div>
                
                <div class="mb-4">
                
                </div>
                <div class="mt-3">
                  <button type="submit" class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn" name="register">
                    DAFTAR
                  </button>
                </div>
                <div class="mt-3">
                  <a class="btn btn-block btn-danger btn-lg font-weight-medium auth-form-btn" href="/">KEMBALI KE HALAMAN UTAMA</a>
                </div>
                <div class="text-center mt-4 font-weight-light">
                  Sudah memiliki akun? <a href="login_admin.php" class="text-primary">Login</a>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
      <!-- content-wrapper ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->

  <!-- insert register -->
  <?php

    if(isset($_POST['register'])){

        function bisaTambah($konek, $hak_akses) {
            if ($hak_akses == "Lurah") {
                $result = $konek->query("SELECT COUNT(*) as count FROM data_user WHERE hak_akses='Lurah'");
                $row = $result->fetch_assoc();
                return $row['count'] < 1; // Cek Akun Lurah sudah melebihi batas yaitu 1 akun??
            } elseif ($hak_akses == "Staf") {
                $result = $konek->query("SELECT COUNT(*) as count FROM data_user WHERE hak_akses='Staf'");
                $row = $result->fetch_assoc();
                return $row['count'] < 2; // Cek Akun Staf sudah melebihi batas yaitu 2 akun??
            }
            return false; // jika tidak memenuhi semua, fungsi bisaTambah akun tidak aktif atau false
        }
   
        $hak_akses = $_POST['hak_akses'];

        if ( bisaTambah($konek, $hak_akses) ) {

            function generateRandomNIK() {
              $nik = 9;
              for ($i = 0; $i < 16; $i++) {
                  $nik .= rand(0, 9);
              }
              return $nik;
            }
            
            $password = $_POST['password'];

            // metode enkripsi
            $ciphering = "AES-128-CTR";

            // gunakan metode enkripsi menggunakan openssl
            $iv_length = openssl_cipher_iv_length($ciphering);
            $options = 0;
            
            // olah data not-null
            $encryption_iv = '1234567891011121';
            
            // kunci enkripsi
            $kunci = "surat123";
            
            // proses enkripsi masukkan semua yg dibutuhkan
            $password_enkripsi = openssl_encrypt($password, $ciphering,
                        $kunci, $options, $encryption_iv);
    

            $nik = generateRandomNIK();
        
            // Kode untuk cek apakah nik sudah ada dalam database?
            $nik_exists = $konek->query("SELECT * FROM data_user WHERE nik='$nik'");

            // jika nik yg digenerate secara random sudah ada, maka generate nik baru lagi
            while ($nik_exists->num_rows > 0) {
                $nik = generateRandomNIK();
                $nik_exists = $konek->query("SELECT * FROM data_user WHERE nik='$nik'");
            }
            
            $sql_simpan = "INSERT INTO data_user (nik,password,hak_akses) VALUES ('$nik','$password_enkripsi','$hak_akses')";
            $query_simpan = mysqli_query($konek, $sql_simpan);
            
            if($query_simpan){
                echo "<script language='javascript'>swal('Selamat...', 'Akun Berhasil dibuat!', 'success');</script>" ;
                echo '<meta http-equiv="refresh" content="3; url=login_admin.php">';
            } else {
              echo "<script language='javascript'>swal('Gagal...', 'Akun Gagal dibuat!', 'error');</script>" ;
              echo '<meta http-equiv="refresh" content="3; url=admin.php">';
            }

        } else {
          // echo ("<script>console.log('PHP: ');</script>");
          echo "<script language='javascript'>swal('Gagal...', 'Akun Sudah Mencapai Batas Maksimum!',  'error');</script>" ;
          echo '<meta http-equiv="refresh" content="3; url=admin.php">';
        }
        
    }

  ?>

  <!-- plugins:js -->
  <script src="main/vendors/base/vendor.bundle.base.js"></script>
  <!-- endinject -->
  <!-- inject:js -->
  <script src="main/js/off-canvas.js"></script>
  <script src="main/js/hoverable-collapse.js"></script>
  <script src="main/js/template.js"></script>
  <!-- endinject -->
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  <!-- endinject -->
  <script src="http://code.jquery.com/jquery-3.0.0.min.js"></script>

</body>

</html>
