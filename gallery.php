<!DOCTYPE html>
<html lang="it">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Galleria Evento</title>
  <link rel="stylesheet" href="styles.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/IntersectionObserver/0.5.1/intersection-observer.min.js"></script> <!-- Intersection Observer Polyfill -->
</head>
<body>
<input type="checkbox" id="menu-toggle" hidden>
  <div class="wrapper">
    <header class="blur">
      <div class="logo">
        <a href="index.php">
          <img src="media/immagini/icone/icon.png" alt="Logo">
        </a>
      </div>
      <nav class="desktop-nav">
        <ul>
          <li><a href="index.php">Home</a></li>
          <li><a href="about.html">Su di Noi</a></li>
          <li><a href="sostienici.html">❤️ Sostienici</a></li>
          <li><a href="eventi.php" class="active">Eventi</a></li>
          <li><a href="contatti.html">Contatti</a></li>
        </ul>
      </nav>
      <label for="menu-toggle" class="hamburger-menu">
        <span class="bar"></span>
        <span class="bar"></span>
        <span class="bar"></span>
      </label>
    </header>
    
    <main class="gallery-page">
      <?php
      if (isset($_GET['event'])) {
        $event_id = intval($_GET['event']);
        $conn = new mysqli("localhost", "root", "", "AndreaPesciaOrg");
        if ($conn->connect_error) {
          die("Connessione fallita: " . $conn->connect_error);
        }
        
        $sql = "SELECT * FROM eventi WHERE id = $event_id AND tipo = 'passato'";
        $result = $conn->query($sql);
        
        if ($result && $result->num_rows > 0) {
            $event = $result->fetch_assoc();
            $gallery_dir = $event['galleria_directory'];
            $main_image = $gallery_dir . "/" . $event['path_immagine']; // Using the path_immagine column
            echo "<section class='gallery-intro' style='background-image: url(\"$main_image\"); '>";
            echo "<div class='gallery-overlay'>";
            echo "<h1>" . htmlspecialchars($event['titolo']) . "</h1>";
            echo "<p>" . htmlspecialchars($event['descrizione']) . "</h2>";
            echo "<div class='event-gallery-details'>";
            echo "<span>📅 " . date("d M Y", strtotime($event['data'])) . "</span>";
            echo "<span>📍 " . htmlspecialchars($event['luogo']) . "</span>";
            echo "</div>";
            echo "</div>";
            echo "</section>";
          
          if (is_dir($gallery_dir)) {
            $files = array_diff(scandir($gallery_dir), array('.', '..'));
            echo "<div class='gallery-container'>";
            foreach ($files as $file) {
              $file_path = "$gallery_dir/$file";
              $ext = pathinfo($file, PATHINFO_EXTENSION);
              
              if (in_array(strtolower($ext), ['jpg', 'jpeg', 'png', 'gif'])) {
                // Lazy load images using IntersectionObserver
                echo "<div class='gallery-item'>
                        <img data-src='$file_path' alt='Evento' class='lazy' loading='lazy'>
                      </div>";
              } elseif (in_array(strtolower($ext), ['mp4', 'webm', 'ogg'])) {
                echo "<div class='gallery-item'>
                        <video controls><source src='$file_path' type='video/$ext'></video>
                      </div>";
              }
            }
            echo "</div>";
          } else {
            echo "<p class='no-media'>Nessun contenuto disponibile per questo evento.</p>";
          }
        } else {
          echo "<p class='no-event'>Evento non trovato.</p>";
        }
        $conn->close();
      } else {
        echo "<p class='no-event'>ID evento non specificato.</p>";
      }
      ?>
    </main>
    
    <footer>
      <p>Un ringraziamento speciale ai nostri sponsor:</p>
      <div class="sponsor-logos">
        <div class="logos-track">
         <img src="media/immagini/icone/sponsor/smart.png" alt="Smart Media Logo" />
          <img src="media/immagini/icone/sponsor/rotoflex.png" alt="Rotoflex Logo" />
          <img src="media/immagini/icone/sponsor/fiar.png" alt="Fiar Logo" />
          <img src="media/immagini/icone/sponsor/gian.png" alt="Evangelista Gianfranco Logo" />
          <img src="media/immagini/icone/sponsor/denire.png" alt="Denire Logo" />
          <img src="media/immagini/icone/sponsor/vico.png" alt="Vico Logo" />
          <img src="media/immagini/icone/sponsor/morocolor.png" alt="Morocolor Logo" />
          <img src="media/immagini/icone/sponsor/b2.png" alt="B2 Logo" />
          <img src="media/immagini/icone/sponsor/terme.png" alt="Terme Preistoriche Logo" />
        </div>
      </div>
      <p>&copy; 2025 Associazione Andrea Pescia. All rights reserved.</p>
    </footer>
  </div>

  <!-- Mobile Side Menu -->
  <div class="side-menu">
    <label for="menu-toggle" class="close-btn">&times;</label>
    <ul>
      <li><a href="index.php" >Home</a></li>
      <li><a href="about.html">Su di Noi</a></li>
      <li><a href="sostienici.php" style="color: orange">❤️ Sostienici</a></li>
      <li><a href="eventi.php" class="active">Eventi</a></li>
      <li><a href="contatti.html">Contatti</a></li>
    </ul>
  </div>

  <script>
    document.addEventListener("DOMContentLoaded", function () {
      // Lazy Loading with IntersectionObserver
      const lazyImages = document.querySelectorAll(".lazy");
      const observer = new IntersectionObserver((entries, observer) => {
        entries.forEach(entry => {
          if (entry.isIntersecting) {
            const img = entry.target;
            img.src = img.getAttribute("data-src");
            img.classList.remove("lazy");
            observer.unobserve(img);
          }
        });
      });

      lazyImages.forEach(img => observer.observe(img));
    });
  </script>
</body>
</html>
