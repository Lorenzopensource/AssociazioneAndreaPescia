<!DOCTYPE html>
<html lang="it">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Eventi - Associazione Andrea Pescia</title>
  <link rel="stylesheet" href="styles.css">
</head>
<body>
  <!-- Hidden checkbox to toggle mobile side menu -->
  <input type="checkbox" id="menu-toggle" hidden>

  <div class="wrapper">
    <!-- Header -->
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
          <li><a href="sostienici.php" style="color: orange">❤️ Sostienici</a></li>
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

    <main class="events-page">
      <!-- Page Introduction Section -->

      <section class="sostienici-hero">
          <div class="sostienici-overlay">
          <h1>EVENTI</h1>
          <p>
            Gli eventi dell'Associazione Andrea Pescia nascono con un obiettivo profondamente significativo: non sono semplicemente momenti di raccolta fondi, ma opportunità preziose di connessione, condivisione e sostegno concreto per i nostri bambini e la nostra scuola in Brasile.
          </p>
          <p>
            Ogni iniziativa che promuoviamo è un ponte tra culture, un abbraccio solidale che va oltre la semplice dimensione economica. Non si tratta di raggiungere un target monetario, ma di creare comunità, sensibilizzare e generare impatto sociale vero.
          </p>
          </div>
      </section> 

      <!-- Prossimi Eventi Section -->
      <section id="prossimi-eventi" class="eventi-section" style="background-color: #f9f9f9">
        <h2 class="section-title">PROSSIMI EVENTI</h2>
        <div class="eventi-container">
          <?php
          // Database connection
          $conn = new mysqli("localhost", "root", "", "AndreaPesciaOrg");
          if ($conn->connect_error) {
            die("Connessione fallita: " . $conn->connect_error);
          }
          
          // Query to fetch upcoming events
          $sql = "SELECT * FROM eventi WHERE tipo = 'prossimo' ORDER BY data ASC";
          $result = $conn->query($sql);
          
          if ($result && $result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
          ?>
          <div class="event-card autoShow">
            <div class="event-image">
              <img src="<?php echo $row['path_immagine']; ?>" alt="<?php echo $row['titolo']; ?>">
            </div>
            <div class="event-content">
              <h3 class="event-title"><?php echo $row['titolo']; ?></h3>
              <div class="event-details">
                <div class="detail-item">
                  <span class="detail-icon">📅</span>
                  <span class="detail-text"><?php echo date("d M Y", strtotime($row['data'])); ?></span>
                </div>
                <div class="detail-item">
                  <span class="detail-icon">📍</span>
                  <span class="detail-text"><?php echo $row['luogo']; ?></span>
                </div>
                <div class="detail-item">
                  <span class="detail-icon">💰</span>
                  <span class="detail-text"><?php echo $row['costo'] ? '€' . $row['costo'] : 'Ingresso libero'; ?></span>
                </div>
              </div>
              <button class="event-btn" onclick="openEventModal(this)">Partecipa</button>
            </div>
          </div>
          <?php
            }
          } else {
            $noEventsMessages = [
              ['icon' => '🏀', 'text' => 'Nessun evento sportivo in programma'],
              ['icon' => '🍕', 'text' => 'Nessun evento culinario al momento'],
              ['icon' => '🎉', 'text' => 'Stiamo organizzando la prossima festa'],
              ['icon' => '🌍', 'text' => 'Stiamo organizzando la nostra prossima storia']
            ];
          ?>
          <div class="no-events-container">
            <?php foreach ($noEventsMessages as $message): ?>
              <div class="no-events-item">
                <div class="no-events-emoji"><?php echo $message['icon']; ?></div>
                <div class="no-events-text">
                  <span class="typing-text"><?php echo $message['text']; ?></span>
                </div>
              </div>
            <?php endforeach; ?>
          </div>
          <?php
          }
          $conn->close();
          ?>
        </div>
      </section>

      <!-- Eventi Passati Section -->
      <section id="eventi-passati" class="eventi-section">
        <h2 class="section-title">EVENTI PASSATI</h2>
        <div class="eventi-container">
          <?php
          // Database connection
          $conn = new mysqli("localhost", "root", "", "AndreaPesciaOrg");
          if ($conn->connect_error) {
            die("Connessione fallita: " . $conn->connect_error);
          }
          
          // Query to fetch past events
          $sql = "SELECT * FROM eventi WHERE tipo = 'passato' ORDER BY data DESC";
          $result = $conn->query($sql);
          
          if ($result && $result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
          ?>
          <div class="event-card past-event autoShow">
            <div class="event-image">
              <img src="<?php echo $row['path_immagine']; ?>" alt="<?php echo $row['titolo']; ?>">
            </div>
            <div class="event-content">
              <h3 class="event-title"><?php echo $row['titolo']; ?></h3>
              <div class="event-details">
                <div class="detail-item">
                  <span class="detail-icon">📅</span>
                  <span class="detail-text"><?php echo date("d M Y", strtotime($row['data'])); ?></span>
                </div>
                <div class="detail-item">
                  <span class="detail-icon">📍</span>
                  <span class="detail-text"><?php echo $row['luogo']; ?></span>
                </div>
              </div>
              <button class="past-event-btn" onclick="openEventGallery(<?php echo $row['id']; ?>)">
                Galleria
              </button>
            </div>
          </div>
          <?php
            }
          } else {
            echo "<p class='no-events'>Nessun evento passato trovato.</p>";
          }
          $conn->close();
          ?>
        </div>
      </section>
    </main>

    <!-- Footer -->
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
      <li><a href="index.php">Home</a></li>
      <li><a href="about.html">Su di Noi</a></li>
      <li><a href="sostienici.php" style="color: orange">❤️ Sostienici</a></li>
      <li><a href="eventi.php" class="active">Eventi</a></li>
      <li><a href="contatti.html">Contatti</a></li>
    </ul>
  </div>

  <!-- Event Modal -->
  <div id="eventModal" class="modal">
    <div class="modal-content event-modal-content">
      <div class="modal-header">
        <img id="eventModalImage" src="" alt="Event Image">
        <div class="modal-header-info event-info">
          <h3 id="eventModalTitle"></h3>
          <div class="event-details-modal">
            <div class="detail-item">
              <span class="detail-icon">📅</span>
              <span id="eventModalDate" class="detail-text"></span>
            </div>
            <div class="detail-item">
              <span class="detail-icon">📍</span>
              <span id="eventModalLocation" class="detail-text"></span>
            </div>
            <div class="detail-item">
              <span class="detail-icon">💰</span>
              <span id="eventModalCost" class="detail-text"></span>
            </div>
          </div>
        </div>
        <button class="close-modal" onclick="closeEventModal()">&times;</button>
      </div>
      <div class="modal-body event-modal-body">
        <p id="eventModalDescription"></p>
      </div>
      <div class="modal-footer event-modal-footer">
        <a href="https://www.instagram.com/associazioneandreapesciaodv" target="_blank" class="instagram-button">
          <img src="media/immagini/icone/social/insta.png" alt="Instagram Logo" class="instagram-logo">
          <span>Scrivici su Instagram</span>
        </a>
      </div>
    </div>
  </div>

  <div id="cookie-banner" class="cookie-banner" style="display: none;">
  <div class="cookie-banner-content">
    <p>
      Questo sito non utilizza cookie per raccogliere informazioni personali. Per maggiori dettagli, consulta la nostra
      <a href="/cookies_policy.html" target="_blank">Cookie Policy</a>.
    </p>
    <button id="accept-cookies" class="cookie-banner-btn">Accetta</button>
  </div>
</div>

  <!-- JavaScript -->
  <script>
    // AutoShow Animation
    document.addEventListener("DOMContentLoaded", function () {
      const autoShowElements = document.querySelectorAll(".autoShow");
      const observer = new IntersectionObserver((entries, observer) => {
        entries.forEach(entry => {
          if (entry.isIntersecting) {
            entry.target.classList.add("show");
            observer.unobserve(entry.target);
          }
        });
      }, { threshold: 0.1 });
      autoShowElements.forEach(el => observer.observe(el));
    });

    // Event Modal Functionality
    document.addEventListener("DOMContentLoaded", function () {
      function openEventModal(eventCard) {
        const modal = document.getElementById('eventModal');
        const image = eventCard.querySelector('.event-image img').src;
        const title = eventCard.querySelector('.event-title').textContent;
        const date = eventCard.querySelector('.detail-item:nth-child(1) .detail-text').textContent;
        const location = eventCard.querySelector('.detail-item:nth-child(2) .detail-text').textContent;
        const cost = eventCard.querySelector('.detail-item:nth-child(3) .detail-text')?.textContent || 'Ingresso libero';

        document.getElementById('eventModalImage').src = image;
        document.getElementById('eventModalTitle').textContent = title;
        document.getElementById('eventModalDate').textContent = date;
        document.getElementById('eventModalLocation').textContent = location;
        document.getElementById('eventModalCost').textContent = cost;
        document.getElementById('eventModalDescription').textContent = 
          "Ulteriori dettagli sull'evento verranno comunicati sulla nostra pagina Instagram. Non perdetevelo!";

        modal.style.display = 'flex';
        document.body.classList.add('modal-open');
      }

      function closeEventModal() {
        document.getElementById('eventModal').style.display = 'none';
        document.body.classList.remove('modal-open');
      }

      document.querySelectorAll('.event-btn').forEach(button => {
        button.addEventListener('click', function () {
          openEventModal(this.closest('.event-card'));
        });
      });

      document.getElementById('eventModal').addEventListener('click', function (event) {
        if (event.target === this || event.target.classList.contains('close-modal')) {
          closeEventModal();
        }
      });
    });

    // No Events Container Animation
    document.addEventListener("DOMContentLoaded", function() {
      const noEventsContainer = document.querySelector('.no-events-container');
      
      if (noEventsContainer) {
        const observer = new IntersectionObserver((entries) => {
          entries.forEach(entry => {
            if (entry.isIntersecting) {
              entry.target.classList.add('show');
              observer.unobserve(entry.target);
            }
          });
        }, { threshold: 0.1 });
        
        observer.observe(noEventsContainer);
      }
    });

    // Gallery Function
    function openEventGallery(eventId) {
      window.location.href = `gallery.php?event=${eventId}`;
    }
  </script>
  <script src="cookies-consent.js"></script>
</body>
</html>