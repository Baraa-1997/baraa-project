// Show login popup when login icon clicked
document.getElementById('login-btn').addEventListener('click', function(e) {
  e.preventDefault();
  document.getElementById('login-popup').classList.add('active');
});

// Close popup on close button click
document.querySelector('#login-popup .close-btn').addEventListener('click', function() {
  document.getElementById('login-popup').classList.remove('active');
});

// Close popup when clicking outside popup-content
document.getElementById('login-popup').addEventListener('click', function(e) {
  if (e.target === this) {
    this.classList.remove('active');
  }
});




  function openShippingPopup(event) {
    event.preventDefault();
    document.getElementById('shipping-popup').style.display = 'block';
  }

  function closeShippingPopup() {
    document.getElementById('shipping-popup').style.display = 'none';
  }

  function openFaqPopup(event) {
    event.preventDefault();
    document.getElementById('faq-popup').style.display = 'block';
  }

  function closeFaqPopup() {
    document.getElementById('faq-popup').style.display = 'none';
  }


