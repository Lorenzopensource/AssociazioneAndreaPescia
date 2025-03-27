<!DOCTYPE html>
<html lang="it">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Associazione Andrea Pescia</title>
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
          <li><a href="index.php" class="active">Home</a></li>
          <li><a href="about.html">Su di Noi</a></li>
          <li><a href="sostienici.php" style="color: orange">❤️ Sostienici</a></li>
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
      <!-- Hero Section -->
      <section class="hero">
        <div class="video-container">
          <video autoplay muted playsinline controls>
            <source src="media/assoc.mp4" type="video/mp4" loading="lazy">
            Your browser does not support the video tag.
          </video>
        </div>
        <div class="black-rectangle">
          <h1>Associazione Andrea Pescia</h1>
          <h2>L'incontro di due mondi che genera vita</h2>
          <!-- Animated Sostienici Button -->
          <button class="sostienici-btn" onclick="window.location.href='sostienici.php'">
            <span class="heart">❤️</span>
            <span class="text">Sostienici</span>
          </button>
        </div>
      </section>

      <!-- About Section -->
      <section id="about" class="about">
        <div class="overlay-box autoShow">
          <h2>CHI SIAMO</h2>
          <p>
            La Nostra Escola, situata a 
            <span class="highlight-orange">Fortaleza, Brasile</span>,
            offre dal <span class="highlight-orange">2006</span> un’opportunità a tutte le famiglie che desiderano far crescere
            i loro figli in un ambiente sano e felice, allontanandoli dai contesti violenti e
            criminali a cui potrebbero essere avvicinati.
          </p>
          <div class="button-container">
            <button class="conoscici-btn" onclick="window.location.href='about.html'">
              Conoscici <span class="arrow">→</span>
            </button>
          </div>
        </div>
      </section>

      <!-- Messaggi Section -->
      <section id="messaggi" class="messaggi-section">
        <h2 class="section-title">MESSAGGI</h2>
        <!-- Carousel container -->
        <div class="carousel-container">
          <div class="carousel-track">
            <?php
              // Connessione al database
              $conn = new mysqli("localhost", "root", "", "AndreaPesciaOrg");
              if ($conn->connect_error) {
                die("Connessione fallita: " . $conn->connect_error);
              }
              
              // Query per selezionare i messaggi attivi ordinati per data decrescente
              $sql = "SELECT * FROM messaggi WHERE status = 'attivo' ORDER BY data DESC";
              $result = $conn->query($sql);
              
              if ($result && $result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                  // Store full message info as data attributes for use in the modal
            ?>
            <div class="carousel-slide autoShow"
                 data-id="<?php echo $row['id']; ?>"
                 data-fulltext="<?php echo htmlspecialchars($row['testo']); ?>"
                 data-title="<?php echo htmlspecialchars($row['titolo']); ?>"
                 data-icon="<?php echo htmlspecialchars($row['path_icon']); ?>"
                 data-author="<?php echo htmlspecialchars($row['author_name']); ?>"
                 data-authorphoto="<?php echo htmlspecialchars($row['path_author_photo']); ?>"
                 data-date="<?php echo date("d/m/Y", strtotime($row['data'])); ?>">
              <div class="messaggio-overlay">
                <!-- Header del messaggio -->
                <div class="messaggio-header">
                  <div class="header-left">
                    <img src="<?php echo $row['path_icon']; ?>" alt="Icona Messaggio" class="message-icon">
                    <div class="header-info">
                      <h3 class="message-title"><?php echo $row['titolo']; ?></h3>
                      <p class="message-date"><?php echo date("d/m/Y", strtotime($row['data'])); ?></p>
                    </div>
                  </div>
                  <div class="header-right">
                    <img src="<?php echo $row['path_author_photo']; ?>" alt="Foto Autore" class="author-photo">
                    <p class="author-name"><?php echo $row['author_name']; ?></p>
                  </div>
                </div>
                <!-- Body del messaggio -->
                <div class="messaggio-body">
                  <p>
                    <?php
                      // Mostra anteprima se il testo supera 300 caratteri
                      $anteprima = (strlen($row['testo']) >800) ? substr($row['testo'], 0, 800) . "..." : $row['testo'];
                      echo $anteprima;
                    ?>
                  </p>
                </div>
                <!-- Footer con pulsanti -->
                <div class="messaggio-footer">
                  <?php if (strlen($row['testo']) > 800) { ?>
                    <button class="readmore-btn" onclick="openModal(this)">
                      Continua a Leggere
                    </button>
                  <?php } ?>
                  <?php if (!empty($row['path_pdf'])) { ?>
                    <button class="pdf-btn" onclick="window.location.href='<?php echo $row['path_pdf']; ?>'">
                      Scarica PDF
                    </button>
                  <?php } ?>
                </div>
              </div>
            </div>
            <?php
                }
              } else {
                echo "<p>Nessun messaggio attivo trovato.</p>";
              }
              $conn->close();
            ?>
          </div>
        </div>
        <!-- Carousel navigation arrows -->
        <button class="carousel-button left" onclick="moveSlide('left')">&#10094;</button>
        <button class="carousel-button right" onclick="moveSlide('right')">&#10095;</button>
        <!-- Slide indicator -->
        <div class="carousel-indicator"></div>
      </section>

            <!-- Eventi Section -->
<!-- Prossimi Eventi Section -->
      <section id="eventi" class="eventi-section">
        <h2 class="section-title">PARTECIPA AD UN NOSTRO EVENTO</h2>
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
                <!-- View All Events Button -->
                <div class="button-container view-all-container">
          <button class="conoscici-btn" onclick="window.location.href='eventi.php'">
            Tutti gli Eventi <span class="arrow">→</span>
          </button>
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
  </div> <!-- End .wrapper -->

  <!-- Mobile Side Menu -->
  <div class="side-menu">
    <label for="menu-toggle" class="close-btn">&times;</label>
    <ul>
      <li><a href="index.php" class="active">Home</a></li>
      <li><a href="about.html">Su di Noi</a></li>
      <li><a href="sostienici.php" style="color: orange"">❤️ Sostienici</a></li>
      <li><a href="eventi.php">Eventi</a></li>
      <li><a href="contatti.html">Contatti</a></li>
    </ul>
  </div>

  <!-- Dynamic Modal for "Continua a Leggere" -->
  <div id="dynamicModal" class="modal">
    <div class="modal-content">
      <div class="modal-header">
        <img id="modalIcon" src="" alt="Icona">
        <div class="modal-header-info">
          <h3 id="modalTitle"></h3>
          <p id="modalDate"></p>
        </div>
        <button class="close-modal" onclick="closeModal()">&times;</button>
      </div>
      <div class="modal-body">
        <p id="modalFullText"></p>
      </div>
    </div>
  </div>

  <!-- Add this inside the body tag, after the existing dynamic modal -->
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
// Improved JavaScript for the Messaggi section

document.addEventListener("DOMContentLoaded", function() {
  /* --- Carousel and Slider Logic --- */
  let currentSlide = 0;
  const track = document.querySelector('.carousel-track');
  const slides = Array.from(document.querySelectorAll('.carousel-slide'));
  const totalSlides = slides.length;
  const leftBtn = document.querySelector('.carousel-button.left');
  const rightBtn = document.querySelector('.carousel-button.right');
  const indicator = document.querySelector('.carousel-indicator');
  
  // Touch tracking variables
  let startX = 0;
  let startY = 0;
  let isHorizontalScroll = false;
  let isTouching = false;
  let touchStartTime = 0;
  
  function updateCarousel() {
    // Get the width of the container for proper slide width
    const slideWidth = track.clientWidth;
    const newScroll = currentSlide * slideWidth;
    
    // Smooth scrolling
    track.scrollTo({ left: newScroll, behavior: 'smooth' });
    
    // Update the indicator
    if (indicator) {
      indicator.textContent = `${currentSlide + 1} di ${totalSlides}`;
    }
    
    // Update arrow buttons visibility on desktop
    if (window.innerWidth > 800) {
      if (leftBtn && rightBtn) {
        leftBtn.disabled = (currentSlide === 0);
        rightBtn.disabled = (currentSlide === totalSlides - 1);
        leftBtn.style.opacity = (currentSlide === 0) ? 0.5 : 1;
        rightBtn.style.opacity = (currentSlide === totalSlides - 1) ? 0.5 : 1;
      }
    }
    
    // Add active class to current slide for styling
    slides.forEach((slide, index) => {
      if (index === currentSlide) {
        slide.classList.add('active');
      } else {
        slide.classList.remove('active');
      }
    });
  }
  
  // Function to move the slide (can be called from buttons)
  window.moveSlide = function(direction) {
    if (direction === 'right' && currentSlide < totalSlides - 1) {
      currentSlide++;
    } else if (direction === 'left' && currentSlide > 0) {
      currentSlide--;
    }
    updateCarousel();
  };
  
  // Calculate current slide based on scroll position
  function updateCurrentSlideFromScroll() {
    if (!track) return;
    
    const slideWidth = track.clientWidth;
    const scrollPosition = track.scrollLeft;
    
    // Find the nearest slide based on scroll position
    currentSlide = Math.round(scrollPosition / slideWidth);
    
    // Update indicator
    if (indicator) {
      indicator.textContent = `${currentSlide + 1} di ${totalSlides}`;
    }
  }
  
  // Initialize touch events if on mobile
  if (track) {
    // Touch start
    track.addEventListener('touchstart', (e) => {
      startX = e.touches[0].clientX;
      startY = e.touches[0].clientY;
      isTouching = true;
      isHorizontalScroll = null; // Not determined yet
      touchStartTime = Date.now();
    }, { passive: true });
    
    // Touch move - determine scroll direction
    track.addEventListener('touchmove', (e) => {
      if (!isTouching) return;
      
      const x = e.touches[0].clientX;
      const y = e.touches[0].clientY;
      
      const diffX = startX - x;
      const diffY = startY - y;
      
      // If direction not determined yet
      if (isHorizontalScroll === null) {
        // If horizontal movement is significantly greater than vertical
        isHorizontalScroll = Math.abs(diffX) > Math.abs(diffY) * 1.5;
        
        // For vertical scrolls, don't interfere
        if (!isHorizontalScroll) return;
      }
      
      // If it's a horizontal scroll, prevent page scroll
      if (isHorizontalScroll) {
        e.preventDefault();
      }
    }, { passive: false });
    
    // Touch end - handle slide change
    track.addEventListener('touchend', (e) => {
      if (!isTouching || !isHorizontalScroll) {
        isTouching = false;
        return;
      }
      
      const touchEndX = e.changedTouches[0].clientX;
      const diffX = startX - touchEndX;
      const touchDuration = Date.now() - touchStartTime;
      
      // Detect swipe - faster or larger movements
      if (Math.abs(diffX) > 50 || (Math.abs(diffX) > 20 && touchDuration < 300)) {
        if (diffX > 0 && currentSlide < totalSlides - 1) {
          moveSlide('right');
        } else if (diffX < 0 && currentSlide > 0) {
          moveSlide('left');
        }
      } else {
        // Small movement - snap to nearest slide
        updateCarousel();
      }
      
      isTouching = false;
    });
    
    // Handle manual scrolling
    track.addEventListener('scroll', () => {
      if (!isTouching) {
        // Only update slide based on scroll when not actively touching
        // This prevents conflicts during swipe operations
        updateCurrentSlideFromScroll();
      }
    });
  }
  
  /* --- Responsive Message Text Handling --- */
  function adjustMessageLength() {
    const messageSlides = document.querySelectorAll('.carousel-slide');
    const isMobile = window.innerWidth <= 800;
    
    messageSlides.forEach(slide => {
      const messageBody = slide.querySelector('.messaggio-body p');
      const footer = slide.querySelector('.messaggio-footer');
      const readMoreBtn = footer ? footer.querySelector('.readmore-btn') : null;
      
      if (!messageBody) return;
      
      // Get original full text
      const fullText = slide.getAttribute('data-fulltext');
      if (!fullText) return;
      
      // Different character limits based on device
      const charLimit = isMobile ? 400 : 800;
      
      // Apply truncation if needed
      if (fullText.length > charLimit) {
        messageBody.textContent = fullText.substring(0, charLimit) + '...';
        
        // Make sure the Continue Reading button is visible
        if (readMoreBtn) {
          readMoreBtn.style.display = 'block';
        }
      } else {
        messageBody.textContent = fullText;
        
        // Hide the button if not needed
        if (readMoreBtn) {
          readMoreBtn.style.display = 'none';
        }
      }
    });
  }
  
  /* --- Modal Functions --- */
  window.openModal = function(btn) {
    const slide = btn.closest('.carousel-slide');
    const modal = document.getElementById('dynamicModal');
    
    if (!slide || !modal) return;
    
    // Get the data from the slide
    const fullText = slide.getAttribute('data-fulltext');
    const title = slide.getAttribute('data-title');
    const icon = slide.getAttribute('data-icon');
    const date = slide.getAttribute('data-date');
    const author = slide.getAttribute('data-author');
    const authorPhoto = slide.getAttribute('data-authorphoto');
    
    // Set modal content
    document.getElementById('modalFullText').textContent = fullText;
    document.getElementById('modalTitle').textContent = title;
    document.getElementById('modalIcon').src = icon;
    document.getElementById('modalDate').textContent = date;
    
    // Show modal and disable scrolling on body
    modal.style.display = 'block';
    document.body.classList.add('modal-open');
  }
  
  window.closeModal = function() {
    const modal = document.getElementById('dynamicModal');
    if (modal) {
      modal.style.display = 'none';
      document.body.classList.remove('modal-open');
    }
  }
  
  // Close modal when clicking outside content
  window.addEventListener('click', function(event) {
    const modal = document.getElementById('dynamicModal');
    if (event.target === modal) {
      closeModal();
    }
  });
  
  // Initialize the carousel and text handling
  if (track && slides.length > 0) {
    updateCarousel();
    adjustMessageLength();
    
    // Re-run on resize
    window.addEventListener('resize', () => {
      updateCarousel();
      adjustMessageLength();
    });
  }
});


    // Modal functionality
    function openModal(btn) {
      const slide = btn.closest('.carousel-slide');
      const fullText = slide.getAttribute('data-fulltext');
      const title = slide.getAttribute('data-title');
      const icon = slide.getAttribute('data-icon');
      const date = slide.getAttribute('data-date');

      document.getElementById('modalFullText').textContent = fullText;
      document.getElementById('modalTitle').textContent = title;
      document.getElementById('modalIcon').src = icon;
      document.getElementById('modalDate').textContent = date;

      // Show modal and disable background scrolling
      const modal = document.getElementById('dynamicModal');
      modal.style.display = 'block';
      document.body.classList.add('modal-open');
    }

    function closeModal() {
      const modal = document.getElementById('dynamicModal');
      modal.style.display = 'none';
      document.body.classList.remove('modal-open');
    }

    // Close modal when clicking outside the modal content
    window.onclick = function(event) {
      const modal = document.getElementById('dynamicModal');
      if (event.target == modal) {
        closeModal();
      }
    }

    // Animation for elements with the "autoShow" class
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

    // Animate the "Sostienici" button when it enters the viewport
    document.addEventListener("DOMContentLoaded", function() {
      const btn = document.querySelector('.sostienici-btn');
      const observer = new IntersectionObserver((entries, observer) => {
        entries.forEach(entry => {
          if (entry.isIntersecting) {
            btn.classList.add('animate');
            observer.unobserve(btn);
          }
        });
      }, { 
        rootMargin: "0px 0px -30px 0px",
        threshold: 0.1
      });
      observer.observe(btn);
    });

    function openEventModal(eventCard) {
      const modal = document.getElementById('eventModal');
      const image = eventCard.querySelector('.event-image img');
      const title = eventCard.querySelector('.event-title');
      const dateIcon = eventCard.querySelector('.detail-item:nth-child(1) .detail-text');
      const locationIcon = eventCard.querySelector('.detail-item:nth-child(2) .detail-text');
      const costIcon = eventCard.querySelector('.detail-item:nth-child(3) .detail-text');

      // Set modal content
      document.getElementById('eventModalImage').src = image.src;
      document.getElementById('eventModalTitle').textContent = title.textContent;
      document.getElementById('eventModalDate').textContent = dateIcon.textContent;
      document.getElementById('eventModalLocation').textContent = locationIcon.textContent;
      document.getElementById('eventModalCost').textContent = costIcon.textContent;

      // You can add a description attribute to event cards if you want dynamic descriptions
      // For now, we'll use a placeholder
      document.getElementById('eventModalDescription').textContent = 
        "Ulteriori dettagli sull'evento verranno comunicati sulla nostra pagina Instagram. Non perdetevelo!";

      // Show modal and disable background scrolling
      modal.style.display = 'block';
      document.body.classList.add('modal-open');
    }

    // Function to close event modal
    function closeEventModal() {
      const modal = document.getElementById('eventModal');
      modal.style.display = 'none';
      document.body.classList.remove('modal-open');
    }

    // Add event listeners to all event cards
    document.addEventListener("DOMContentLoaded", function() {
      const eventCards = document.querySelectorAll('.event-card');
      
      eventCards.forEach(card => {
        const participateBtn = card.querySelector('.event-btn');
        participateBtn.addEventListener('click', () => openEventModal(card));
      });

      // Close modal when clicking outside
      const modal = document.getElementById('eventModal');
      window.addEventListener('click', function(event) {
        if (event.target == modal) {
          closeEventModal();
        }
      });
  });

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
  </script>

<script src="cookies-consent.js"></script>

</body>
</html>
