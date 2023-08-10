<?php
session_start();
require 'dbcon.php';


if(isset($_POST['sil']))
{
    $id = mysqli_real_escape_string($con, $_POST['sil']);

    $query = "DELETE FROM tablo3 WHERE id='$id' ";
    $query_run = mysqli_query($con, $query);

    if($query_run)
    {
        $_SESSION['message'] = "Kullanıcı Silindi";
        header("Location: liste.php");
        exit(0);
    }
    else
    {
        $_SESSION['message'] = "Kullanıcı Silinemedi";
        header("Location: liste.php");
        exit(0);
    }
}

if(isset($_POST['güncelle']))
{
    $id = mysqli_real_escape_string($con, $_POST['id']);

    $ad = mysqli_real_escape_string($con, $_POST['ad']);
    $soyad = mysqli_real_escape_string($con, $_POST['soyad']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $sifre = mysqli_real_escape_string($con, $_POST['sifre']);

    $query = "UPDATE tablo3 SET ad='$ad', soyad='$soyad', email='$email' ,sifre='$sifre' WHERE id='$id' ";
    $query_run = mysqli_query($con, $query);


    if($query_run)
    {
        $_SESSION['message'] = "Kullanıcı Güncellendi";
        header("Location: liste.php");
        exit(0);
    }
    else
    {
        $_SESSION['message'] = "Kullanıcı Güncellenemedi";
        header("Location: liste.php");
        exit(0);
    }

}


if(isset($_POST['kaydet']))
{
    $ad = mysqli_real_escape_string($con, $_POST['ad']);
    $soyad = mysqli_real_escape_string($con, $_POST['soyad']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $sifre = mysqli_real_escape_string($con, $_POST['sifre']);

    $query = "INSERT INTO tablo3 (ad,soyad,email,sifre) VALUES ('$ad','$soyad','$email','$sifre')";

    $query_run = mysqli_query($con, $query);
    if($query_run)
    {
        $_SESSION['message'] = "Kullanıcı Oluşturuldu";
        header("Location: kullanici_olustur.php");
        exit(0);
    }
    else
    {
        $_SESSION['message'] = "Kullanıcı Oluşturulamadı";
        header("Location: kullanici_olustur.php");
        exit(0);
    }
}

if (isset($_POST['kayit'])) {
    $ad = mysqli_real_escape_string($con, $_POST['ad']);
    $soyad = mysqli_real_escape_string($con, $_POST['soyad']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $sifre = mysqli_real_escape_string($con, $_POST['sifre']);
    $sifre_tekrar = mysqli_real_escape_string($con, $_POST['sifre_tekrar']);

   
    if (empty($ad)) {
        $_SESSION['message'] = "Adını Girin";
        header("Location: kayit.php");
        exit(0);
    } elseif (empty($soyad )) {
        $_SESSION['message'] = "Soyadınızı Girin";
        header("Location: kayit.php");
        exit(0);
    } elseif (empty($email) ) {
        $_SESSION['message'] = "Emailinizi Girin";
        header("Location: kayit.php");
        exit(0);
    } elseif (empty($sifre) || empty($sifre_tekrar)) {
        $_SESSION['message'] = "Sifrenizi Girin";
        header("Location: kayit.php");
        exit(0);
    } elseif ($sifre != $sifre_tekrar) {
        $_SESSION['message'] = "Girdiğiniz Şifreler Aynı Değil";
        header("Location: kayit.php");
        exit(0);
    } else {
        $query = "INSERT INTO tablo3 (ad, soyad, email, sifre) VALUES ('$ad', '$soyad', '$email', '$sifre')";
        $query_run = mysqli_query($con, $query);
        if ($query_run) {
            $_SESSION['message'] = "Kayıt yapıldı";
            header("Location: index.php");
            exit(0);
        } else {
            $_SESSION['message'] = "Kayıt Yapılamadı";
            header("Location: index.php");
            exit(0);
        }
    }
}

    
if (isset($_POST['giris'])) {
    $ad = $_POST['ad'];
    $soyad = $_POST['soyad'];
    $email = $_POST['email'];
    $sifre = $_POST['sifre'];

    if (!$ad) {
        $_SESSION['message'] = "Adını Girin";
        header("Location: index.php");
        exit(0);
    } elseif (!$soyad) {
        $_SESSION['message'] = "Soyadınızı Girin";
        header("Location: index.php");
        exit(0);
    } elseif (!$email) {
        $_SESSION['message'] = "Emailinizi Girin";
        header("Location: index.php");
        exit(0);
    } elseif (!$sifre) {
        $_SESSION['message'] = "Sifrenizi Girin";
        header("Location: index.php");
        exit(0);
    } else {
        // Check if the entered information exists in the database
        $query = "SELECT * FROM tablo3 WHERE ad='$ad' AND soyad='$soyad' AND email='$email' AND sifre='$sifre'";
        $query_run = mysqli_query($con, $query);

        if (mysqli_num_rows($query_run) > 0) {
            $_SESSION['message'] = "Giriş yapıldı";
            header("Location: liste.php");
            exit(0);
        } else {
            $_SESSION['message'] = "Giriş Yapılamadı Bilgilerinizi Kontrol Ediniz";
            header("Location: index.php");
            exit(0);
        }
    }
}
if (isset($_POST['onayla'])) {
    // Verileri doğru bir şekilde alın
    $user_id = $_POST['id'];
    $lisans_turu = $_POST['lisans_turu'];
    $süre = $_POST['süre'];
    $time_unit = $_POST['time_unit'];
    $baslangic = $_POST['baslangic'];

    function calculateEndDate($süre, $time_unit, $baslangic) {
        $endDate = new DateTime($baslangic);
        
        switch ($time_unit) {
            case 'days':
                $endDate->modify("+$süre days");
                break;
            case 'months':
                $endDate->modify("+$süre months");
                break;
            case 'years':
                $endDate->modify("+$süre years");
                break;
            default:
                // Hatalı zaman birimi seçildiğinde varsayılan olarak gün ekleyin
                $endDate->modify("+$süre days");
                break;
        }
    
        return $endDate->format('Y-m-d');
    }

    // Lisans bitiş tarihini hesaplayın
    $bitis = calculateEndDate($süre, $time_unit, $baslangic);

    try {
        // Prepared statement oluşturun
        $query = "INSERT INTO lisans (user_id, lisans_turu, süre, baslangic, bitis, durum) VALUES (?, ?, ?, ?, ?, 1)";
        $stmt = mysqli_prepare($con, $query);

        if ($stmt) {
            // Değişkenleri bağlayın
            mysqli_stmt_bind_param($stmt, "issss", $user_id, $lisans_turu, $süre, $baslangic,$bitis);

            // Sorguyu çalıştırın
            $query_run = mysqli_stmt_execute($stmt);

            if ($query_run) {
                $_SESSION['message'] = "Lisans Eklendi";
                header("Location: liste.php");
                exit(0);
            } else {
                $_SESSION['message'] = "Lisans Eklenemedi";
                header("Location: lisans.php");
                exit(0);
            }
        } else {
            // Sorgu oluşturma hatası
            $_SESSION['message'] = "Hata oluştu";
            header("Location: lisans.php");
            exit(0);
        }
    } catch (Exception $e) {
        // If an exception occurs during date calculation, handle it here
        $_SESSION['message'] = "Hata oluştu: " . $e->getMessage();
        header("Location: lisans.php");
        exit(0);
    }
}


?>
