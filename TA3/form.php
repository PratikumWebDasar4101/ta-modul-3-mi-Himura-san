<?php
    require("config.php");
    session_start();

    if (!$_SESSION['sukses'])
        header("Location: index.php");

    @$id_user = $_SESSION['id_user'];
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>TA 3 - Input Data</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="css/style.css">
    </head>
    <body>
        <a href="index.php?exit=logout" id="button_logout">Logout</a><a href="data.php" id="button">View Data</a>
<!-- =============================================================================== -->
        <div class="form">
            <div id="title">
                <h3>Input Data</h3>
            </div>
            <div id="data">
                <form method="POST" enctype="multipart/form-data">
                    <b>NIM</b><br><input type="text" name="nim" required><br><br>
                    
                    <b>Nama</b><br><input type="text" name="nama" required><br><br>
                    
                    <b>Fakultas</b><br>
                    <select name="fakultas" id="dropdown" required>
                        <option value="FTE">FTE</option>
                        <option value="FRI">FRI</option>
                        <option value="FIF">FIF</option>
                        <option value="FEB">FEB</option>
                        <option value="FKB">FKB</option>
                        <option value="FIK">FIK</option>
                        <option value="FIT">FIT</option>
                    </select>
                    <br><br>
                    
                    <b>Jenis Kelamin : </b>
                    <input type="radio" name="jk" value="Laki-laki" required> Laki-Laki
                    <input type="radio" name="jk" value="Perempuan" required> Perempuan <br><br>
                    
                    <b>Foto : </b><input type="file" name="foto" required><br><br>
                    
                    <input type="submit" value="Simpan"> <input type="reset" value="Reset">
                </form>
            </div>
        </div>
<!-- =============================================================================== -->
    </body>
</html>
<?php
    if (isset($_POST['nim'])) {
        $nim = $_POST['nim'];
        $nama = addslashes($_POST['nama']);
        $fakultas = $_POST['fakultas'];
        $jk = $_POST['jk'];

        $nama_foto = $_FILES['foto']['name'];
        $tmp_foto = $_FILES['foto']['tmp_name'];
        $dir_foto = "photos/";
        $target_foto = $dir_foto . $nama_foto;

        $check = $pdo -> prepare("SELECT nim FROM tb_mahasiswa WHERE nim = '$nim'");
        $check -> execute();
        $row = $check -> rowcount();
        
        if ($row == 0) {
            if (!move_uploaded_file($tmp_foto, $target_foto))
                die("Foto gagal di upload..!!");

            $query = $pdo -> prepare("INSERT INTO tb_mahasiswa VALUES ('$nim','$nama','$fakultas','$jk','$target_foto','$id_user')");
            $query -> execute();

            if ($query) {
                ?>
                <script type="text/javascript">
                    alert("Data telah terbuat..!");
                    location = "data.php";
                </script>
                <?php
            }
            else
                die("Tambah data Gagal..");

        } else {
            ?>
            <script type="text/javascript">
                alert("NIM sudah terpakai..!!");
            </script>
            <?php
        }
    }
?>