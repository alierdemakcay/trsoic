<!-- 
TR


Kodun düzgün çalışması için Veri tabanınıza "video" adında bir tablo oluşturup içine
 "  id	yukleyen	video_adi	tarih	begeni   " tablolarını oluşturup uygun şekilde
video isimleriyle doldurmanız gerekmektedir . Bu işlem için "yukle.php" dosyasını kullanabilirsin . 



ENG

In order for the code to work properly, you need to create a table named "video" in your database and create the 
"  id	yukleyen	video_adi	tarih	begeni   " tables and fill them with 
video names accordingly. You can use the "yukle.php" file for this process.
 -->
<!-- veri tabanı bilgilerini doldurmayı unutmayın -->

<!-- don't forget to fill in the database information -->
<?php

session_start();

if (!isset($_SESSION['username'])) {
    header("Location: giris.php");
    exit;
}

if (isset($_POST['bildir'])) {
    $kullanici_adi = $_SESSION['username'];
    $video_id = $_POST['video_id'];
    $yukleyen = $_POST['yukleyen'];

    $dosya = fopen("bildirilen-videolar.txt", "a");
    $metin = "$kullanici_adi - $video_id - $yukleyen\n";
    fwrite($dosya, $metin);
    fclose($dosya);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TRSOİC</title>
    <link rel="icon" type="image/png" href="logo-beyaz.png">
    <style>
        body {
            background-color: #000000;
            margin: 0;
            padding: 0;
        }

        .menu {
            height: 100vh;
            min-width: 15%;
            background-color: #252525;
            padding: 20px;
            position: fixed;
            top: 0;
            left: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            z-index: 1;
        }

        .buton {
            background-color: rgba(255, 255, 255, 0.911);
            color: black;
            text-decoration: none;
            margin: 10px 0;
            padding: 15px 0;
            width: 90%;
            border-radius: 5px;
            transition: background-color 0.3s;
            text-align: center;
            font-family: 'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif;
        }

        .h1 {
            color: rgb(255, 255, 255);
            font-family: 'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif;
            padding: 5%;
            padding-left: 10%;
            position: absolute;
        }

        .buton:hover {
            background-color: rgb(56, 56, 56);
        }

        .videolar {
            margin-bottom: 35px; 
            padding-bottom: 15px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.2); 
            position: relative; 
        }

        .video-container {
            position: relative;
            width: 500px;
            height: 800px;
            overflow: hidden;
            margin: 0 auto;
            border: 4px solid transparent; 
        }

        .selected .video-container {
            border-color: #969696; 
            
        }

        .video-wrapper {
            position: absolute;
            width: 100%;
            height: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
            transform: scale(1.05);
        }

        video {
            max-width: 100%;
            max-height: 80%;
        }

        .video-info {
            position: absolute;
            bottom: 0; 
            left: 0; 
            width: 100%; 
            background: rgba(0, 0, 0, 0);
            color: white;
            display: flex;
            justify-content: space-between; 
            padding: 10px;
            box-sizing: border-box;
        }

        .like-button {
            cursor: pointer;
            border: none;
            background-color: transparent;
            font-size: 20px;
            margin-right: -30px;
            color: white;
        }

        .like-count {
            margin-top: 5px;
            text-align: center;
            color: rgb(255, 255, 255);
            font-family: 'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif;
            font-size: 16px;
        }

        .uploaded-by {
            margin-top: 5px;
            margin-right: 5px;
            color: rgb(255, 255, 255);
            font-family: 'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif;
            font-size: 16px;
        }

        .selected .video-info {
            background: rgba(0, 0, 0, 0.5);
        }

        .ust-menu {
            position: fixed; 
            width: 20%;
            height: 10%;
            background-color: rgba(0, 0, 0, 0.432);
            right: 0;
            top: 0;
            z-index: 1000; 
        }


        .buton2 {
            position: absolute;
            margin-top: 5%;
            font-size: 300%;
            text-decoration: none;
            margin-left: 60%;
        }

        .buton3 {
            position: absolute;
            margin-top: 5%;
            font-size: 250%;
            text-decoration: none;
            margin-left: 20%;
            color: aliceblue;
        }

        .daha-fazla {
            display: none;
            position: absolute;
            width: 90%;
            background-color: rgba(0, 0, 0, 0.432);
            top: calc(100% + 20px);
            right: 0;
            padding: 20px;
            border-radius: 10px;
        }

        .daha-fazla a {
            display: block;
            color: white;
            text-decoration: none;
            padding: 10px;
            margin-bottom: 10px;
            border-radius: 5px;
            background-color: rgba(255, 255, 255, 0.2);
            transition: background-color 0.3s;
            z-index: -2;
        }

        .daha-fazla a:hover {
            background-color: rgba(255, 255, 255, 0.3);
        }

        .visible {
            display: block;
        }

        @media screen and (max-width: 1300px) {
            .buton2 {
                position: absolute;
                margin-top: 5%;
                font-size: 200%;
                text-decoration: none;
            }
        }

        @media screen and (max-width: 768px) {
            .buton2 {
                position: absolute;
                margin-top: 5%;
                font-size: 150%;
                text-decoration: none;
            }
        }
        
        @media screen and (max-width: 1650px) {
            .video-container {
                position: relative;
                width: 500px;
                height: 700px;
                overflow: hidden;
                margin: 0 auto;
                border: 4px solid transparent; 
            }
        }
        
        @media screen and (max-width: 1400px) {
            .video-container {
                position: relative;
                width: 450px;
                height: 550px;
                overflow: hidden;
                margin: 0 auto;
                border: 4px solid transparent; 
            }
        }
        
        @media screen and (max-width: 1300px) {
            .video-container {
                position: relative;
                width: 350px;
                height: 550px;
                overflow: hidden;
                margin: 0 auto;
                border: 4px solid transparent; 
            }
        }

        .sol-menu {
            position: fixed; 
            width: 30%; 
            height: 100%; 
            background-color: rgba(0, 0, 0, 0.432); 
            top: 0; 
            left: 0; 
            z-index: 2000; 
            display: none; 
            flex-direction: column; 
            align-items: center; 
            justify-content: center;
        }

        .sol-menu a {
            margin: 10px 0;
            color: white;
            font-size: 20px;
            text-decoration: none;
        }

        .ust-menu {
            position: fixed; 
            width: 20%;
            height: 10%;
            background-color: rgba(0, 0, 0, 0.432);
            right: 0;
            top: 0;
            z-index: 1000; 
        }
        
        .overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .popup {
            background-color: #333;
            padding: 20px;
            border-radius: 10px;
            text-align: center;
            font-family: 'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif;
        }
        }
        .bildirim {
            height: 150px;
            width: 200px;
            margin-left: auto;
            margin-right: auto;
            background-color: rgba(255, 255, 255, 0.5); 
            z-index: 9999;
            display: none;
        }
        
        a {
            color: white;
            font-family: 'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif;
            text-decoration: none;
        }
    </style>
</head>
<body>
<h1 class="h1">TRSOİC</h1>
<div class="menu">
    <a href="https://trsoic.com.tr/" class="buton">🏠 Anasayfa</a>
    <a href="bildirimler" class="buton">🔔 Bildirimler</a>
    <a href="video/" class="buton">📮 Video paylaş</a>
    <a href="profilim.html" class="buton">⚙️ Profilim - Ayarlar</a>
</div>

<div class="ust-menu">
    <a class="buton2" href="ara.php">🔍</a>
    <a class="buton3" href="#">☰</a>
    <div class="daha-fazla">
        <a href="https://app.trsoic.com.tr/trsoic.apk" class="buton">MOBİL İÇİN</a>
        <a href="gpt" class="buton">🤖 BOT</a>
        <a href="rawb" class="buton">🗨️ Rawb</a>
        <a href="https://trchats.com.tr" class="buton">🤝 TR Sohbet</a>
    </div>
</div>

<div class="videos">
    <?php
    session_start();

    if (!isset($_SESSION['username'])) {
        header("Location: https://trsoic.com.tr/giris.php");
        exit;
    }

    if (isset($_POST['bildir'])) {
        $kullanici_adi = $_SESSION['username'];
        $video_id = $_POST['video_id'];
        $yukleyen = $_POST['yukleyen'];

        $dosya = fopen("bildirilen-videolar.txt", "a");
        $metin = "$kullanici_adi - $video_id - $yukleyen\n";
        fwrite($dosya, $metin);
        fclose($dosya);
    }

    $servername = "  ";
    $username = "  ";
    $password = "  ";
    $database = "  ";

    $conn = new mysqli($servername, $username, $password, $database);

    if ($conn->connect_error) {
        die("Veritabanı bağlantısında hata: " . $conn->connect_error);
    }

    if(isset($_POST['video_id'])) {
        $video_id = $_POST['video_id'];
        $sql_update_likes = "UPDATE video SET begeni = begeni + 1 WHERE id = $video_id";
        $conn->query($sql_update_likes);
    }

    $sql = "SELECT id, CONCAT('/video/', video_adi) AS video_path, yukleyen, begeni FROM video ORDER BY tarih DESC";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $video_id = $row['id'];
            $video_path = $row["video_path"];
            $yukleyen = $row['yukleyen'];
            $begeni = $row['begeni'];
    
            echo "<div class='videolar'>";
            echo "<div class='video-container'>";
            echo "<div class='video-wrapper'>";
            echo "<video controls loop><source src='$video_path' type='video/mp4'>Tarayıcınız bu video formatını desteklemiyor.</video>";
            echo "</div>";
            echo "<div class='video-info'>";
            echo "<span class='uploaded-by'><a href='/profil/$yukleyen'>$yukleyen</a></span>";
            
            echo "<button class='like-button' data-video-id='$video_id'>👍 $begeni</button>";
    
            echo "<form method='POST' action='bildir.php' class='bildir-form' style='display: inline;'>";
            echo "<input type='hidden' name='video_id' value='$video_id'>";
            echo "<input type='hidden' name='yukleyen' value='$yukleyen'>";
            echo "<button type='submit' class='bildir-button' style='cursor: pointer; border: none; background-color: transparent; font-size: 20px;'>🚩</button>";
            echo "</form>";
    
            echo "</div>";
            echo "</div>";
            echo "</div>";
        }

    } else {
        echo "Veritabanında hiç video bulunamadı.";
    }
    
    $conn->close();
    ?>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var toggleMenu = function() {
            var solMenu = document.querySelector('.menu');
            var ustMenu = document.querySelector('.daha-fazla');
            if (solMenu.style.display === 'none') {
                solMenu.style.display = 'flex';
                ustMenu.style.display = 'block';
            } else {
                solMenu.style.display = 'none';
                ustMenu.style.display = 'none';
            }
        };

        var buton3 = document.querySelector('.buton3');
        buton3.addEventListener('click', toggleMenu);
    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var likeButtons = document.querySelectorAll('.like-button');

        likeButtons.forEach(function(button) {
            button.addEventListener('click', function() {
                var videoId = this.getAttribute('data-video-id');
                var formData = new FormData();
                formData.append('video_id', videoId);

                fetch(window.location.href, {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        var likeCount = this.nextElementSibling;
                        likeCount.textContent = parseInt(likeCount.textContent) + 1;
                    } else {
                        console.error('Bir hata oluştu.');
                    }
                })
                .catch(error => {
                    console.error('Bir hata oluştu:', error);
                });
            });
        });
    });
</script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var bildirForms = document.querySelectorAll('.bildir-form');

        bildirForms.forEach(function(form) {
            form.addEventListener('submit', function(event) {
                event.preventDefault();

                var videoId = form.querySelector('input[name="video_id"]').value;
                var yukleyen = form.querySelector('input[name="yukleyen"]').value;

                var formData = new FormData();
                formData.append('video_id', videoId);
                formData.append('yukleyen', yukleyen);

                fetch('bildir.php', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert('Video bildirildi!');
                    } else {
                        alert('Bir hata oluştu!');
                    }
                })
                .catch(error => {
                    console.error('Bir hata oluştu:', error);
                });
            });
        });
    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var videos = document.querySelectorAll('.video-container');

        videos.forEach(function(video) {
            var videoTag = video.querySelector('video');

            var scaleVideo = function() {
                var containerWidth = video.offsetWidth;
                var containerHeight = video.offsetHeight;

                if (containerWidth < 800 || containerHeight < 600) {
                    video.classList.add('blur');
                } else {
                    video.classList.remove('blur');
                }
            };

            videoTag.addEventListener('loadedmetadata', scaleVideo);
            window.addEventListener('resize', scaleVideo);
        });
    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var videolar = document.querySelectorAll('.videolar');
        var selectedVideoIndex = 0;

        function playSelectedVideo() {
            videolar.forEach((video, index) => {
                if (index === selectedVideoIndex) {
                    video.classList.add('selected');
                    video.querySelector('video').play();
                } else {
                    video.classList.remove('selected');
                    video.querySelector('video').pause();
                }
            });
        }

        function handleScroll(event) {
            var newIndex = selectedVideoIndex;
            if (event.deltaY > 0 && selectedVideoIndex < videolar.length - 1) {
                newIndex++;
            } else if (event.deltaY < 0 && selectedVideoIndex > 0) {
                newIndex--;
            }

            var newVideoTop = videolar[newIndex].offsetTop;
            window.scrollTo({
                top: newVideoTop,
                behavior: 'smooth'
            });

            selectedVideoIndex = newIndex;
            playSelectedVideo();
        }

        window.addEventListener('keydown', function(event) {
            if (event.key === 'ArrowUp') {
                event.preventDefault(); 
                handleScroll({ deltaY: -100 }); 
            } else if (event.key === 'ArrowDown') {
                event.preventDefault(); 
                handleScroll({ deltaY: 100 }); 
            }
        });

        window.addEventListener('wheel', handleScroll);

        playSelectedVideo();
    });
</script>



<script>
document.getElementById("acButon").addEventListener("click", function(event) {
  event.preventDefault();
  var acilanAlan = document.getElementById("acilanAlan");
  if (acilanAlan.style.display === "none") {
    acilanAlan.style.display = "block";
  } else {
    acilanAlan.style.display = "none";
  }
});
</script>

</div>
</body>
</html>