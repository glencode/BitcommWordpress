document.addEventListener('DOMContentLoaded', function() {
    // Initialize connection lines
    initConnectionLines();
    
    // Initialize live chat widget
    initLiveChat();
    
    // Initialize calendar
    initCalendar();
});

function initConnectionLines() {
    const contactIcons = document.querySelectorAll('.contact-icon');
    const container = document.querySelector('.contact-icons');
    
    contactIcons.forEach((icon, index) => {
        const nextIcon = contactIcons[(index + 1) % contactIcons.length];
        
        const line = document.createElement('div');
        line.className = 'connection-line';
        container.appendChild(line);
        
        updateLinePosition(line, icon, nextIcon);
        
        window.addEventListener('resize', () => {
            updateLinePosition(line, icon, nextIcon);
        });
    });
}

function updateLinePosition(line, startIcon, endIcon) {
    const startRect = startIcon.getBoundingClientRect();
    const endRect = endIcon.getBoundingClientRect();
    
    const startX = startRect.left + startRect.width / 2;
    const startY = startRect.top + startRect.height / 2;
    const endX = endRect.left + endRect.width / 2;
    const endY = endRect.top + endRect.height / 2;
    
    const length = Math.sqrt(Math.pow(endX - startX, 2) + Math.pow(endY - startY, 2));
    const angle = Math.atan2(endY - startY, endX - startX) * 180 / Math.PI;
    
    line.style.width = `${length}px`;
    line.style.left = `${startX}px`;
    line.style.top = `${startY}px`;
    line.style.transform = `rotate(${angle}deg)`;
}

function initLiveChat() {
    const chatWidget = document.querySelector('.live-chat-widget');
    const chatToggle = document.querySelector('.chat-toggle');
    
    if (chatToggle) {
        chatToggle.addEventListener('click', () => {
            chatWidget.classList.toggle('active');
        });
    }
}

function initCalendar() {
    const timeSlots = document.querySelectorAll('.time-slot');
    
    timeSlots.forEach(slot => {
        slot.addEventListener('click', () => {
            timeSlots.forEach(s => s.classList.remove('selected'));
            slot.classList.add('selected');
        });
    });
} 