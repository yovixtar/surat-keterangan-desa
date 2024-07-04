<?php include '../konek.php'; ?>
<link href="css/sweetalert.css" rel="stylesheet" type="text/css">
<script src="js/jquery-2.1.3.min.js"></script>
<script src="js/sweetalert.min.js"></script>
<script>
    function confirmSubmit() {
        var agree = confirm("Apakah Anda yakin ingin mengirimkan form ini ? \nSetelah dikirim, form tidak bisa dicetak.");
        if (agree) {
            return true;
        } else {
            return false;
        }
    }
</script>
<?php
if (isset($_GET['id_request_sktm'])) {
    $id = $_GET['id_request_sktm'];
    $sql = "SELECT * FROM data_request_sktm natural join data_user WHERE id_request_sktm='$id'";
    $query = mysqli_query($konek, $sql);
    $data = mysqli_fetch_array($query, MYSQLI_BOTH);
    $id = $data['id_request_sktm'];
    $nik = $data['nik'];
    $nama = $data['nama'];
    $tempat = $data['tempat_lahir'];
    $tgl = $data['tanggal_lahir'];
    $tgl2 = $data['tanggal_request'];
    $format1 = date('Y', strtotime($tgl2));
    $format2 = date('d-m-Y', strtotime($tgl));
    $format3 = date('d F Y', strtotime($tgl2));
    $agama = $data['agama'];
    $jekel = $data['jekel'];
    $nama = $data['nama'];
    $alamat = $data['alamat'];
    $status_warga = $data['status_warga'];
    $keperluan = $data['keperluan'];
    $request = $data['request'];
    $keterangan = $data['keterangan'];
    $status = $data['status'];
    $acc = $data['acc'];
    $format4 = date('d F Y', strtotime($acc));
    if ($format4 == 0) {
        $format4 = "kosong";
    } elseif ($format4 == 1) {
        $format4;
    }

    if ($status == 3) {
        $keterangan = "Sudah ACC Lurah, surat sedang dalam proses cetak oleh staf";
    }
}
?>
<div class="panel-header bg-primary-gradient">
    <div class="page-inner py-5">
        <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
            <div>
                <h2 class="text-white pb-2 fw-bold"></h2>
            </div>
        </div>
    </div>
</div>
<div class="page-inner mt--5">
    <div class="row mt--2">
        <div class="col-md-6">
            <div class="card full-height">
                <div class="card-body">
                    <div class="card-tools">
                        <form action="" method="POST" onsubmit="return confirmSubmit();">
                            <div class="form-group">
                                <label>Keterangan</label>
                                <select name="dicetak" id="" class="form-control" required="">
                                    <option value="">Pilih</option>
                                    <option value="Surat dicetak, bisa diambil!">Surat dicetak, bisa diambil!</option>
                                </select><br>
                                <!-- <input type="date" name="tgl_acc" class="form-control"> -->
                                <input type="submit" name="ttd" value="Kirim" class="btn btn-primary btn-sm">
                                <a href="cetak_sktm.php?id_request_sktm=<?= $id; ?>" class="btn btn-primary btn-sm">Cetak</a>
                                <!-- <div class="form-group">
                                                    <a href="cetak_skd.php?id_request_skd=<?php $id; ?>">
                                                        Cetak
                                                    </a>
                                                </div> -->
                                <!-- <div class="form-group">
                                                   <a href="cetak_skd.php?id_request_skd=<?= $id; ?>">a</a>
                                                </div> -->
                            </div>
                        </form>
                        <?php
                        if (isset($_POST['ttd'])) {
                            $cetak = $_POST['dicetak'];
                            $update = mysqli_query($konek, "UPDATE data_request_sktm SET keterangan='$cetak', status=3 WHERE id_request_sktm=$id");
                            if ($update) {
                                echo "<script language='javascript'>swal('Selamat...', 'Kirim Berhasil', 'success');</script>";
                                echo '<meta http-equiv="refresh" content="3; url=?halaman=belum_acc_sktm">';
                            } else {
                                echo "<script language='javascript'>swal('Gagal...', 'Kirim Gagal', 'error');</script>";
                                echo '<meta http-equiv="refresh" content="3; url=?halaman=view_sktm">';
                            }
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-md-12">
            <div class="card" style="padding-left: 3cm; padding-right: 3cm;">
                <div class="card-body">
                    <div class="text-center mb-3">
                        <!-- Gambar Header -->
                        <img src="img/pml.png" style="width: 2cm;" class="my-3" alt="Logo">

                        <!-- Teks Header -->
                        <h5 class="font-weight-bold" style="font-size: 14pt; margin-bottom: 0;">PEMERINTAH KABUPATEN PEMALANG</h5>
                        <h4 class="font-weight-bold" style="font-size: 16pt; margin-bottom: 0;">KECAMATAN PEMALANG</h4>
                        <h3 class="font-weight-bold" style="font-size: 18pt; margin-bottom: 0;">DESA KRAMAT</h3>

                        <!-- Spasi -->
                        <br><br>

                        <!-- Judul Surat -->
                        <h3 class="font-weight-bold text-decoration-underline" style="margin-bottom: 0;text-decoration: underline;text-decoration-thickness: 3px;">SURAT KETERANGAN TIDAK MAMPU</h3>
                        <p style="margin-top: 0;">Nomor: 045.11 / 200 / Kramat</p>
                    </div>

                    <!-- Konten Surat -->
                    <div class="mt-5" style="font-size: 12pt;">
                        <p style="text-indent: 1cm;font-size: 12pt;">Yang bertanda tangan di bawah ini :</p>

                        <!-- Tabel Informasi Penanda Tangan -->
                        <table style="font-size: 12pt; width: 100%; border-spacing: 0;">
                            <tr style="height: 1.2em;">
                                <td style="width: 30%;">Nama</td>
                                <td style="width: 70%;">: RAHAYU</td>
                            </tr>
                            <tr style="height: 1.2em;">
                                <td style="width: 30%;">Jabatan</td>
                                <td style="width: 70%;">: KEPALA DESA KRAMAT</td>
                            </tr>
                        </table>

                        <p style="text-indent: 1cm;font-size: 12pt;" class="mt-3">Dengan ini menerangkan, bahwa :</p>

                        <!-- Tabel Informasi Penduduk -->
                        <table style="font-size: 12pt; width: 100%; border-spacing: 0;">
                            <tr style="height: 1.2em;">
                                <td style="width: 30%;">Nama</td>
                                <td style="width: 70%;">: <?= $nama; ?></td>
                            </tr>
                            <tr style="height: 1.2em;">
                                <td style="width: 30%;">Tempat, Tgl Lahir</td>
                                <td style="width: 70%;">: <?= $tempat . ", " . tgl_indo($tgl); ?></td>
                            </tr>
                            <tr style="height: 1.2em;">
                                <td style="width: 30%;">NIK</td>
                                <td style="width: 70%;">: <?= $nik; ?></td>
                            </tr>
                            <tr style="height: 1.2em;">
                                <td style="width: 30%;">Pekerjaan</td>
                                <td style="width: 70%;">: <?= !empty($pekerjaan) ? $pekerjaan : '-'; ?></td>
                            </tr>
                            <tr style="height: 1.2em;">
                                <td style="width: 30%;">Alamat</td>
                                <td style="width: 70%;">: <?= $alamat; ?></td>
                            </tr>
                        </table>

                        <p style="text-indent: 1cm;font-size: 12pt;" class="mt-3">Nama tersebut di atas adalah benar penduduk Desa Kramat, dan keadaan ekonomi Ybs saat ini benar-benar tidak mampu.</p>
                        <p style="text-indent: 1cm;font-size: 12pt;">Demikian surat keterangan ini dibuat, untuk dapat digunakan sebagaimana mestinya.</p>

                        <!-- Bagian Tanda Tangan -->
                        <div class="row mt-5">
                            <div class="col-4"></div>
                            <div class="col-4"></div>
                            <div class="col-4">
                                <table style="font-size: 12pt; width: 100%; border-spacing: 0;">
                                    <tr>
                                        <td style="text-align: center;">Pemalang, <?= tgl_indo($acc); ?></td>
                                    </tr>
                                    <tr>
                                        <td style="text-align: center;">KEPALA DESA KRAMAT</td>
                                    </tr>
                                    <tr>
                                        <td style="height: 4em;"></td>
                                    </tr>
                                    <tr>
                                        <td style="text-align: center; font-style: italic;">RAHAYU</td>
                                    </tr>
                                </table>
                            </div>

                        </div>

                        <!-- Alamat -->
                        <p style="text-align: center; font-style: italic; font-size: 12pt;" class="mt-5">Jalan Merak No.01, Desa Kramat, Kec./Kab. Pemalang 52318</p>
                    </div>
                </div>
            </div>
        </div>
    </div>


</div>