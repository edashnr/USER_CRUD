<?php
session_start();
require 'dbcon.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Giriş Yap</title>
    <link rel="stylesheet" type="text/css" href="style.css">
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

    <div class="login">
       <div class="login-screen">
        <div class="app-title">
            <h1>Kayıt Ol</h1>
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
                <input type="text" name="email" class="login-field" placeholder="Kullanıcı Email" id="login-email">
                <label class="login-field-icon fui-user" for="login-email"></label>
            

            </div>

            <div class="control-group">
                <input type="text" name="sifre" class="login-field" placeholder="Şifre" id="login-sifre">
                <label class="login-field-icon fui-user" for="login-sifre"></label>

            </div>


            <div class="control-group">
                <input type="text" name="sifre_tekrar" class="login-field" placeholder="Tekrar Şifre" id="login-sifre">
                <label class="login-field-icon fui-user" for="login-sifre"></label>

            </div>

            
            
            <button href="index.php" name="kayit" type="submit" class="btn btn-primary btn-large btn-block">Kayıt Ol</button>

        </div>
        </form>
       </div>
    </div>
    
</body>
</html>