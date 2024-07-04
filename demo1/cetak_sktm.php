<?php include '../konek.php'; ?>
<?php
if (isset($_GET['id_request_sktm'])) {
    $id = $_GET['id_request_sktm'];
    $sql = "SELECT * FROM data_request_sktm natural join data_user WHERE id_request_sktm='$id'";
    $query = mysqli_query($konek, $sql);
    $data = mysqli_fetch_array($query, MYSQLI_BOTH);
    $nik = $data['nik'];
    $nama = $data['nama'];
    $tempat = $data['tempat_lahir'];
    $tgl = $data['tanggal_lahir'];
    $tgl2 = $data['tanggal_request'];
    $format2 = date('Y', strtotime($tgl2));
    $format1 = date('d-m-Y', strtotime($tgl));
    $format3 = date('d F Y', strtotime($tgl2));
    $agama = $data['agama'];
    $jekel = $data['jekel'];
    $nama = $data['nama'];
    $alamat = $data['alamat'];
    $status_warga = $data['status_warga'];
    $request = $data['request'];
    $keperluan = $data['keperluan'];
    $acc = $data['acc'];
    $format4 = date('d F Y', strtotime($acc));
}
function tgl_indo($tanggal)
{
    $bulan = array(
        1 =>   'Januari',
        'Februari',
        'Maret',
        'April',
        'Mei',
        'Juni',
        'Juli',
        'Agustus',
        'September',
        'Oktober',
        'November',
        'Desember'
    );
    $pecahkan = explode('-', $tanggal);

    return $pecahkan[2] . ' ' . $bulan[(int)$pecahkan[1]] . ' ' . $pecahkan[0];
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CETAK SKTM</title>

    <!-- Fonts and icons -->
    <script src="../assets/js/plugin/webfont/webfont.min.js"></script>
    <script>
        WebFont.load({
            google: {
                "families": ["Lato:300,400,700,900"]
            },
            custom: {
                "families": ["Flaticon", "Font Awesome 5 Solid", "Font Awesome 5 Regular", "Font Awesome 5 Brands", "simple-line-icons"],
                urls: ['../assets/css/fonts.min.css']
            },
            active: function() {
                sessionStorage.fonts = true;
            }
        });
    </script>

    <!-- CSS Files -->
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/atlantis.min.css">

    <!-- CSS Just for demo purpose, don't include it in your project -->
    <link rel="stylesheet" href="../assets/css/demo.css">

</head>

<body style="padding-left: 3cm; padding-right: 3cm;color:#000">

    <div class="text-center mb-3">
        <!-- Gambar Header -->
        <img src="img/pml.png" style="width: 3cm;" class="my-3" alt="Logo">

        <!-- Teks Header -->
        <h5 class="font-weight-bold" style="font-size: 18pt; margin-bottom: 0;">PEMERINTAH KABUPATEN PEMALANG</h5>
        <h4 class="font-weight-bold" style="font-size: 20pt; margin-bottom: 0;">KECAMATAN PEMALANG</h4>
        <h3 class="font-weight-bold" style="font-size: 22pt; margin-bottom: 0;">DESA KRAMAT</h3>

        <!-- Spasi -->
        <br><br>

        <!-- Judul Surat -->
        <h3 class="font-weight-bold text-decoration-underline" style="margin-bottom: 0;text-decoration: underline;text-decoration-thickness: 3px;font-size: 18pt;">SURAT KETERANGAN TIDAK MAMPU</h3>
        <p style="margin-top: 0;font-size: 16pt;">Nomor: 045.11 / 200 / Kramat</p>
    </div>

    <!-- Konten Surat -->
    <div class="mt-5" style="font-size: 16pt;">
        <p style="text-indent: 1cm;font-size: 16pt;">Yang bertanda tangan di bawah ini :</p>

        <!-- Tabel Informasi Penanda Tangan -->
        <table style="font-size: 16pt; width: 100%; border-spacing: 0;">
            <tr style="height: 1.2em;">
                <td style="width: 30%;">Nama</td>
                <td style="width: 70%;">: RAHAYU</td>
            </tr>
            <tr style="height: 1.2em;">
                <td style="width: 30%;">Jabatan</td>
                <td style="width: 70%;">: KEPALA DESA KRAMAT</td>
            </tr>
        </table>

        <p style="text-indent: 1cm;font-size: 16pt;" class="mt-3">Dengan ini menerangkan, bahwa :</p>

        <!-- Tabel Informasi Penduduk -->
        <table style="font-size: 16pt; width: 100%; border-spacing: 0;">
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

        <p style="text-indent: 1cm;font-size: 16pt;" class="mt-3">Nama tersebut di atas adalah benar penduduk Desa Kramat, dan keadaan ekonomi Ybs saat ini benar-benar tidak mampu.</p>
        <p style="text-indent: 1cm;font-size: 16pt;">Demikian surat keterangan ini dibuat, untuk dapat digunakan sebagaimana mestinya.</p>

        <!-- Bagian Tanda Tangan -->
        <div class="row mt-5">
            <div class="col-4"></div>
            <div class="col-4"></div>
            <div class="col-4" style="float: right;">
                <table style="font-size: 16pt; width: 100%; border-spacing: 0;">
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
                        <td style="text-align: center;">RAHAYU</td>
                    </tr>
                </table>
            </div>

        </div>

        <!-- Alamat -->
        <p style="text-align: center; font-style: italic; font-size: 16pt;" class="mt-5">Jalan Merak No.01, Desa Kramat, Kec./Kab. Pemalang 52318</p>
    </div>

</body>

</html>
<script>
    window.print();
</script>