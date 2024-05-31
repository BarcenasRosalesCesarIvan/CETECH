document.addEventListener('DOMContentLoaded', () => {
  // Functions to open and close a modal
  function openModal($el) {
    $el.classList.add('is-active');
  }

  function closeModal($el) {
    $el.classList.remove('is-active');
  }

  function closeNotificationWithAnimation($notification) {
    $notification.style.transition = 'opacity 0.5s ease'; // Adjust transition speed and easing here
    $notification.style.opacity = 0;
    setTimeout(() => {
      $notification.parentNode.removeChild($notification);
    }, 500); // 500 milliseconds = 0.5 seconds (time should match CSS transition time)
  }

  function closeAllModals() {
    (document.querySelectorAll('.modal') || []).forEach(($modal) => {
      closeModal($modal);
    });
  }

  // Add a click event on buttons to open a specific modal
  (document.querySelectorAll('.js-modal-trigger') || []).forEach(($trigger) => {
    const modal = $trigger.dataset.target;
    const $target = document.getElementById(modal);

    $trigger.addEventListener('click', () => {
      openModal($target);
    });
  });

  // Add a click event on various child elements to close the parent modal
  (document.querySelectorAll('.modal-background, .modal-close, .modal-card-head .delete, .modal-card-foot .button') || []).forEach(($close) => {
    const $target = $close.closest('.modal');

    $close.addEventListener('click', () => {
      closeModal($target);
    });
  });

  // Add a keyboard event to close all modals
  document.addEventListener('keydown', (event) => {
    if(event.key === "Escape") {
      closeAllModals();
    }
  });

  // Close notification after 1.5 seconds with fade-out animation
  (document.querySelectorAll('.notification') || []).forEach(($notification) => {
    setTimeout(() => {
      closeNotificationWithAnimation($notification);
    }, 1500); // 1500 milliseconds = 1.5 seconds
  });

});
