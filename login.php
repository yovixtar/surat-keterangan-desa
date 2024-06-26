<?php include 'konek.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Halaman Login Pemohon</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="main/vendors/mdi/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="main/vendors/base/vendor.bundle.base.css">
  <link href="main/css/sweetalert.css" rel="stylesheet" type="text/css">
  <!-- <script src="main/js/jquery-2.1.3.min.js"></script> -->
  <script src="main/js/sweetalert.min.js"></script>   
  <!-- endinject -->
  <!-- plugin css for this page -->
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="main/css/style.css">
 
</head>

<body>
  <div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="content-wrapper d-flex align-items-center auth px-0">
        <div class="row w-100 mx-0">
          <div class="col-lg-4 mx-auto">
            <div class="auth-form-light text-left py-5 px-4 px-sm-5">
              <div class="brand-logo text-center">
                <img src="main/img/p.png" width="5"  alt="logo">
              </div>
              <h4 class="text-center">LOGIN PEMOHON</h4>
              <h6 class="font-weight-light"></h6>
              <form method="POST" class="pt-3">
                <div class="form-group">
                  <input type="text" name="nik" class="form-control form-control-xs text-bold" placeholder="NIK Anda.." oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength = "16" required autofocus>
                </div>
                <div class="form-group">
                  <input type="password" name="password" class="form-control form-control-xs" placeholder="Password Anda.." required autofocus>
                </div>
                <div class="mt-3">
                  <!-- <a href="SBAdmin/index.html" class="btn btn-block btn-primary btn-sm font-weight-medium auth-form-btn">LOGIN</a> -->
                  <button type="submit" name="login" class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn">
                    LOGIN
                  </button>
                </div>
                <div class="my-2 d-flex justify-content-between align-items-center">
                  
                </div>
                <div class="mb-2">
                  <a class="btn btn-block btn-danger btn-lg font-weight-medium auth-form-btn" href="http://localhost/surat-keterangan-desa_/">BATAL</a>
                </div>
                <div class="text-center mt-4 font-weight-light">
                  Belum memiliki akun? <a href="register.php" class="text-primary">Buat</a>
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

  <!-- login -->
  <?php
    if(isset($_POST['login'])){
      $nik = $_POST['nik'];
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
        
      // Use openssl_encrypt() function to encrypt the data
      $password_enkripsi = openssl_encrypt($password, $ciphering,
                    $kunci, $options, $encryption_iv);

      $sql_pass = "SELECT * FROM data_user WHERE nik='$nik' AND password='$password_enkripsi'";
      $query = mysqli_query($konek,$sql_pass);
      $data_login = mysqli_fetch_assoc($query);
      $pass = $data_login['password'];
      $jumlah_login = mysqli_num_rows($query);

      // metode enkripsi
      $ciphering = "AES-128-CTR";    

      // Non-NULL Initialization Vector for decryption
      $decryption_iv = '1234567891011121';
      $options = 0;  

      // Use openssl_decrypt() function to decrypt the data
      $deskripsi_password=openssl_decrypt ($pass, $ciphering, 
      $kunci, $options, $decryption_iv);
      
        if($jumlah_login > 0 && $password == $deskripsi_password){
          session_start();
            $_SESSION['hak_akses']=$data_login['hak_akses'];
            $_SESSION['nama']=$data_login['nama'];
            $_SESSION['password']=$data_login['password'];
            $_SESSION['nik']=$data_login['nik'];

          echo "<script language='javascript'>swal('Selamat...', 'Login Berhasil!', 'success');</script>" ;
          echo '<meta http-equiv="refresh" content="3; url=demo1/main.php">';
        }else{
          echo "<script language='javascript'>swal('Gagal...', 'Login Gagal .$password_enkripsi.', 'error');</script>" ;
          echo '<meta http-equiv="refresh" content="3; url=login.php">';
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
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  <!-- endinject -->
  <script src="http://code.jquery.com/jquery-3.0.0.min.js"></script> 
</body>

</html>
<!-- oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength = "16"  -->