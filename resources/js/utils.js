
window.openHelpModal = function() {
    const modal = document.getElementById('help-modal');
    if (modal) {
        modal.hidden = false;
    }
};

window.closeHelpModal = function() {
    const modal = document.getElementById('help-modal');
    if (modal) {
        modal.hidden = true;
    }
};
