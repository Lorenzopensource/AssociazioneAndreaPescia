document.addEventListener('DOMContentLoaded', function() {
  const cookieBanner = document.getElementById('cookie-banner');
  const acceptBtn = document.getElementById('accept-cookies');

  // Verifica se l'utente ha già accettato
  if (!localStorage.getItem('cookieConsent')) {
    cookieBanner.style.display = 'block';
  }

  // Gestione del pulsante 'Accetta'
  acceptBtn.addEventListener('click', function() {
    localStorage.setItem('cookieConsent', 'accepted');
    cookieBanner.style.display = 'none';
  });
});
