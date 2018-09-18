<?php
    require("config.php");
    session_start();

    if (!$_SESSION['sukses'])
        header("Location: index.php");
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>TA 3 - View Data</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="css/style.css">
    </head>
    <body>
        <div class="data">
            <a href="index.php?exit=logout" id="button_logout">Logout</a><a href="form.php" id="button">Tambah Data</a>
<!-- =============================================================================== -->
            <table border="1">
                <tr>
                    <th>No</th>
                    <th>NIM</th>
                    <th>Nama</th>
                    <th>Fakultas</th>
                    <th>Jenis Kelamin</th>
                    <th>Foto</th>
                    <th>Option</th>
                </tr>
                <?php
                    $no = 1;
                    $query = $pdo -> prepare("SELECT * FROM tb_mahasiswa");
                    $query -> execute();
                    while( $data = $query -> fetch(PDO::FETCH_ASSOC)){
                ?>
                        <tr>
                            <td width="3%"><b><?php echo $no;?></b></td>
                            <td width="8%"><?php echo $data['nim'];?></td>
                            <td width="20%"><?php echo stripslashes($data['nama']);?></td>
                            <td width="8%"><?php echo $data['fakultas'];?></td>
                            <td width="8%"><?php echo $data['jenis_kelamin'];?></td>
                            <td><img src="<?php echo $data['foto'];?>"></td>
                            <td width="5%"><a href="delete.php?nim=<?php echo $data['nim'];?>" onclick="return confirm('Hapus data ?')">Delete</a></td>
                        </tr>
                <?php
                        $no++;
                    }
                ?>
            </table>
<!-- =============================================================================== -->
        </div> 
    </body>
</html>