<?php
    require("config.php");
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>TA3 - Register</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="css/style_lr.css">
    </head>
    <body>
        <a href="index.php" id="button">Login</a>
<!-- =============================================================================== -->
        <div class="login">
            <div id="title">
                <h3>Register</h3>
            </div>
            <div id="data">
                <form method="POST">
                    <b>Username</b><br><input type="text" name="username" required><br><br>
                    <b>Password</b><br><input type="password" name="password" required><br><br>
                    <b>Confirm Password</b><br><input type="password" name="confirm_password" required><br><br>
                    <input type="submit" value="Register"> <input type="reset" value="Reset">
                </form>
            </div>
        </div>
<!-- =============================================================================== -->
    </body>
</html>
<?php
    if (isset($_POST['username'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $confirm_password = $_POST['confirm_password'];

        if ($password == $confirm_password) {
            $check = $pdo -> prepare("SELECT username FROM tb_account WHERE username = '$username'");
            $check -> execute();
            $row = $check -> rowcount();

            if ($row == 0){
                $query = $pdo -> prepare("INSERT INTO tb_account(username, password) VALUES ('$username','$password')");
                $query -> execute();

                if ($query) {
                    ?>
                    <script type="text/javascript">
                        alert("Akun telah terbuat..");
                        location = "index.php";
                    </script>
                    <?php
                }
                else {
                    die("Gagal Register..");
                }
            } else {
                ?>
                <script type="text/javascript">
                    alert("Username sudah terpakai..!!");
                </script>
                <?php
            }
        } else {
            ?>
            <script type="text/javascript">
                alert("Confirm Password tidak sama..!!");
            </script>
            <?php
        }
    }
?>