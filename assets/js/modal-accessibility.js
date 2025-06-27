// Accessibility fix for Bootstrap modals: handle inert and aria-hidden attributes
// This script ensures modals remove 'inert' and 'aria-hidden' when shown, and add them back when hidden.
// It also moves focus to the modal when opened, and to the trigger button when closed.

document.addEventListener('DOMContentLoaded', function() {
    var modals = document.querySelectorAll('.modal');
    modals.forEach(function(modal) {
        modal.addEventListener('show.bs.modal', function(event) {
            modal.removeAttribute('inert');
            modal.setAttribute('aria-hidden', 'false');
            // Move focus to the modal
            setTimeout(function() {
                var focusable = modal.querySelector('button, [href], input, select, textarea, [tabindex]:not([tabindex="-1"])');
                if (focusable) focusable.focus();
            }, 100);
        });
        modal.addEventListener('hide.bs.modal', function(event) {
            modal.setAttribute('inert', '');
            modal.setAttribute('aria-hidden', 'true');
            // Move focus back to the trigger if possible
            var trigger = document.querySelector('[data-bs-target="#' + modal.id + '"]');
            if (trigger) {
                setTimeout(function() { trigger.focus(); }, 100);
            }
        });
    });
});
