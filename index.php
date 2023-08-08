<?php
    session_start();
    require 'dbcon.php';
    if (isset($_SESSION['user_id'])) {
        $user_id = $_SESSION['user_id'];
        $user_query = "SELECT ad FROM tablo3 WHERE id='$user_id'";
        $user_result = mysqli_query($con, $user_query);
        $user_row = mysqli_fetch_assoc($user_result);
        $user_name = $user_row['ad'];
    }

?>


<!DOCTYPE html>
<html lang="en"> 
<head>
    <title>Giriş Yap</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

   
</head>
<body>

    <?php
        if (isset($_SESSION['message']) && !empty($_SESSION['message'])) :
        ?>

        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong>!!!!!</strong> <?= $_SESSION['message']; ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
             <!-- Bootstrap CSS -->
            

        </div>

        <?php
        unset($_SESSION['message']);
        endif;
        ?>

        <?php if (isset($_SESSION['user_id'])) { ?>
            <p>Welcome, <?php echo $user_name; ?>!</p>
            <a href="lisans.php" class="btn btn-primary">Add License</a>
        <?php } else { ?>
            <!-- Your login form code here -->
        <?php } ?>



    <div class="login">
       <div class="login-screen">
        <div class="app-title">
            <h1>Giriş </h1>
        </div>
        <form action="code.php" method="POST">
        <div class="login-form">
            <div class="control-group">
                <input type="text" name="ad" class="login-field" placeholder="Kullanıcı Adı" id="login-name">
                <label class="login-field-icon fui-user" for="login-name"></label>
            </div>

            <div class="control-group">
                <input type="text" name="soyad" class="login-field" placeholder="Kullanıcı Soyadı" id="login-surname">
                <label class="login-field-icon fui-user" for="login-surname"></label>
            </div>

            <div class="control-group">
                <input type="email" name="email" class="login-field" placeholder="Kullanıcı Email" id="login-email">
                <label class="login-field-icon fui-user" for="login-email"></label>
            </div>

            <div class="control-group">
                <input type="password" name="sifre" class="login-field" placeholder="Şifre" id="login-sifre">
                <label class="login-field-icon fui-user" for="login-sifre"></label>
            </div>

        </div>
        <button href="liste.php" name="giris" type="submit" class="btn btn-primary btn-large btn-block">Giriş Yap</button>
        </form>
        <a href="kayit.php" ><button class="btn btn-primary btn-large btn-block">Kayıt Ol</button></a>
       </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>
</html>