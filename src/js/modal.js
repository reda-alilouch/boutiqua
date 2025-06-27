// JS universel pour toutes les modales modernes

document.addEventListener('DOMContentLoaded', function() {
  document.querySelectorAll('[id^="open"][id$="ModalBtn"]')
    .forEach(function(openBtn) {
      const modalId = openBtn.id.replace('open', '').replace('Btn', '');
      const modal = document.getElementById(modalId);
      if (!modal) return;
      const modalBox = modal.querySelector('.modal-box');
      const closeBtn = modal.querySelector('.modal-close');

      openBtn.addEventListener('click', function() {
        modal.classList.add('active');
        setTimeout(() => {
          modalBox.classList.add('show');
        }, 10);
        document.body.style.overflow = 'hidden';
      });

      function closeModal() {
        modalBox.classList.remove('show');
        setTimeout(() => {
          modal.classList.remove('active');
          document.body.style.overflow = '';
        }, 300);
      }
      closeBtn.addEventListener('click', closeModal);
      modal.addEventListener('click', function(e) {
        if (e.target === modal) closeModal();
      });
      document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && modal.classList.contains('active')) closeModal();
      });
    });
}); 