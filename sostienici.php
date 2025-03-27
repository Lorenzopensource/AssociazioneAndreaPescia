<!DOCTYPE html>
<html lang="it">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sostienici - Associazione Andrea Pescia</title>
  <link rel="stylesheet" href="styles.css">
</head>
<body>
  <!-- Hidden checkbox to toggle mobile side menu -->
  <input type="checkbox" id="menu-toggle" hidden>

  <!-- Wrapper for main content -->
  <div class="wrapper">
    <header class="blur">
    <div class="logo">
        <a href="index.php">
          <img src="media/immagini/icone/icon.png" alt="Logo">
        </a>
      </div>
      <!-- Desktop Navigation (visible on wider screens) -->
      <nav class="desktop-nav">
        <ul>
          <li><a href="index.php">Home</a></li>
          <li><a href="about.html">Su di Noi</a></li>
          <li><a href="sostienici.php" style="color: orange" class="active">❤️ Sostienici</a></li>
          <li><a href="eventi.php">Eventi</a></li>
          <li><a href="contatti.html">Contatti</a></li>
        </ul>
      </nav>
      <!-- Hamburger Menu for Mobile (visible on small screens) -->
      <label for="menu-toggle" class="hamburger-menu">
        <span class="bar"></span>
        <span class="bar"></span>
        <span class="bar"></span>
      </label>
    </header>

    <main>

    <section class="sostienici-hero">
          <div class="sostienici-overlay">
            <h1>❤️ Sostienici</h1>
            <p class="intro-paragraph">
            Ogni contributo che riceviamo è un raggio di speranza per i bambini di Fortaleza. 
            Ogni singolo euro, ogni donazione, viene interamente destinato al nostro progetto educativo. 
            Non ci sono costi di gestione o spese amministrative: tutto quello che donate va direttamente 
            a supportare l'istruzione, il nutrimento e il futuro dei nostri bambini. 
            Unisciti a noi nel costruire opportunità concrete per chi ne ha più bisogno.
          </p>
          </div>
        </section> 


      <section class="sostienici-content">
        <div class="sostienici-container"> 

          <h2>Modi per Contribuire</h2>
          
          <div class="donation-grid">


          <div class="donation-card">
              <div class="donation-icon">
                <img src="media/immagini/icone/paypal.png" alt="PayPal" style="width: 64px; height: 64px;">
              </div>
              <h3>Donazione PayPal</h3>
              <p>Dona rapidamente e in modo sicuro tramite il nostro account PayPal</p>
              <div class="donation-details">
                <!-- Replace with actual PayPal donate button -->
                <form action="YOUR_PAYPAL_LINK" method="post" target="_top">
                  <input type="hidden" name="cmd" value="_s-xclick">
                  <input type="hidden" name="hosted_button_id" value="YOUR_BUTTON_ID">
                  <input type="submit" value="Dona con PayPal" name="submit" alt="PayPal - The safer, easier way to pay online!" class="paypal-btn">
                </form>
              </div>
            </div>

            <div class="donation-card">
              <div class="donation-icon">📮</div>
              <h3>Conto Corrente Postale</h3>
              <p>Effettua un versamento sul nostro conto corrente postale</p>
              <div class="donation-details">
                <p>Numero Conto: 73488090</p>
                <button class="copy-btn" onclick="copyToClipboard('73488090')">Copia Numero</button>
              </div>
            </div>

            <div class="donation-card">
              <div class="donation-icon">🏦</div>
              <h3>Bonifico Bancario</h3>
              <p>Sostienici tramite un bonifico bancario sul nostro IBAN</p>
              <div class="donation-details">
                <p>IBAN: IT10G0760112100000073488090</p>
                <button class="copy-btn" onclick="copyToClipboard('IT10G0760112100000073488090')">Copia IBAN</button>
              </div>
            </div>

            <div class="donation-card">
              <div class="donation-icon">🏛️</div>
              <h3>5x1000</h3>
              <p>Destina il tuo 5x1000 alla nostra associazione</p>
              <div class="donation-details">
                <p>Codice Fiscale: 92184620281</p>
                <button class="copy-btn" onclick="copyToClipboard('92184620281')">Copia Codice</button>
              </div>
            </div>

          </div>

          <?php
$conn = new mysqli("localhost", "root", "", "AndreaPesciaOrg");

if ($conn->connect_error) {
    die("Connessione fallita: " . $conn->connect_error);
}

$sql = "SELECT id, path_immagine, Nome, Descrizione, costo FROM prodotti";
$result = $conn->query($sql);
?>

<section class="products-section">
    <h2>Vetrina Prodotti</h2>
    <p class="products-intro">
        I nostri prodotti non sono semplici articoli da acquistare, ma strumenti di solidarietà.
        Ogni oggetto che scegliete di comprare è un supporto diretto alla nostra missione.
        I ricavi vengono interamente utilizzati per sostenere le attività educative e di supporto
        per i bambini di Fortaleza. Acquistando questi prodotti, contribuite concretamente
        a migliorare le loro opportunità di vita.
    </p>

    <div class="products-grid">
        <?php while ($row = $result->fetch_assoc()): ?>
            <div class="product-card autoShow">
                <img src="<?php echo htmlspecialchars($row['path_immagine']); ?>" alt="<?php echo htmlspecialchars($row['Nome']); ?>">
                <div class="product-details">
                    <h3><?php echo htmlspecialchars($row['Nome']); ?></h3>
                    <p class="product-description">
                        <?php echo htmlspecialchars($row['Descrizione']); ?>
                    </p>
                    <p class="price">€<?php echo number_format($row['costo'], 2, ',', '.'); ?></p>
                    <a href="https://www.instagram.com/associazioneandreapesciaodv" target="_blank" class="instagram-button">
                        <img src="media/immagini/icone/social/insta.png" alt="Instagram Logo" class="instagram-logo">
                        <span>Scrivici su Instagram</span>
                    </a>
                </div>
            </div>
        <?php endwhile; ?>
    </div>
</section>

<?php $conn->close(); ?>
        </div>
      </section>
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
  <!-- Mobile Side Menu -->
  <div class="side-menu">
    <label for="menu-toggle" class="close-btn">&times;</label>
    <ul>
      <li><a href="index.php">Home</a></li>
      <li><a href="about.html">Su di Noi</a></li>
      <li><a href="sostienici.html" class="active sostienici-link">❤️ Sostienici</a></li>
      <li><a href="eventi.php">Eventi</a></li>
      <li><a href="contatti.html">Contatti</a></li>
    </ul>
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

  <script>
    function copyToClipboard(text) {
      if (navigator.clipboard && window.isSecureContext) {
        // Usa navigator.clipboard se disponibile e il sito è servito via HTTPS
        navigator.clipboard.writeText(text).then(() => {
          alert('Codice copiato con successo!');
        }).catch(err => {
          console.error('Errore nella copia: ', err);
        });
      } else {
        // Metodo alternativo per i browser che non supportano clipboard API
        let textArea = document.createElement("textarea");
        textArea.value = text;
        textArea.style.position = "absolute";
        textArea.style.left = "-9999px";
        document.body.appendChild(textArea);
        textArea.select();
        document.execCommand("copy");
        document.body.removeChild(textArea);
        alert('Codice copiato con successo!');
      }
    }

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
  </script>
    <script src="cookies-consent.js"></script>
</body>
</html>