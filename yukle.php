<!-- veri tabanı bilgilerini doldurmayı unutmayın -->

<!-- don't forget to fill in the database information -->
<?php
session_start();

$hedef_dizin = dirname(__FILE__) . "/";

if (!isset($_SESSION['username'])) {
    $giris_url = "https://trsoic.com.tr/giris.php?location=https://trsoic.com.tr/video/video-yukle.php";
    header("Location: $giris_url");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["video"])) {
    $rastgele_isim = generateRandomString(10);
    $video_uzantisi = pathinfo($_FILES["video"]["name"], PATHINFO_EXTENSION);
    $hedef_yol = $hedef_dizin . $rastgele_isim . "." . $video_uzantisi;

    if (move_uploaded_file($_FILES["video"]["tmp_name"], $hedef_yol)) {
        header("Location: index.php");
        $video_id = insertVideoToDatabase($hedef_yol, $_SESSION['username']);

        if ($video_id !== false) {
            header("Location: https://trsoic.com.tr/");
            exit;
        } else {
            echo "Veritabanına kayıt eklenirken bir hata oluştu.";
        }
    } else {
        echo "Video yüklenirken bir hata oluştu.";
    }
}

function insertVideoToDatabase($video_yolu, $yukleyen) {
    $db = new mysqli("  ", "  ", "  ", "  ");
    if ($db->connect_error) {
        die("Veritabanına bağlanırken hata oluştu: " . $db->connect_error);
    }

    $video_adi = basename($video_yolu);
    $query = "INSERT INTO video (yukleyen, video_adi, tarih) VALUES (?, ?, NOW())";
    $statement = $db->prepare($query);
    $statement->bind_param("ss", $yukleyen, $video_adi);
    if ($statement->execute()) {
        $video_id = $db->insert_id; 
        $statement->close();
        $db->close();
        return $video_id;
    } else {
        $statement->close();
        $db->close();
        return false;
    }
}

function generateRandomString($uzunluk = 10) {
    $karakterler = '0123456789';
    $karakter_sayısı = strlen($karakterler);
    $rastgele_string = '';
    for ($i = 0; $i < $uzunluk; $i++) {
        $rastgele_string .= $karakterler[rand(0, $karakter_sayısı - 1)];
    }
    return $rastgele_string;
}
?>
