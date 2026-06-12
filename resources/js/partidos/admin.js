const partidosBaseUrlMeta = document.querySelector('meta[name="partidos-base-url"]');
const partidosBaseUrl = partidosBaseUrlMeta ? partidosBaseUrlMeta.getAttribute('content') : '';

window.openPartidoModal = function(partido) {
    const form = document.getElementById('partido-edit-form');
    if (!form) return;
    form.action = partidosBaseUrl + '/' + partido.id;
    document.getElementById('equipo_a_id').value = partido.equipo_a_id || '';
    document.getElementById('equipo_b_id').value = partido.equipo_b_id || '';
    document.getElementById('fecha_hora').value = partido.fecha_hora || '';
    document.getElementById('goles_a').value = partido.goles_a ?? '';
    document.getElementById('goles_b').value = partido.goles_b ?? '';
    document.getElementById('edit_goles_a_label').textContent = 'Goles ' + (partido.equipo_a_nombre || 'Equipo A');
    document.getElementById('edit_goles_b_label').textContent = 'Goles ' + (partido.equipo_b_nombre || 'Equipo B');

    const esFaseGrupos = partido.etapa_nombre && partido.etapa_nombre.toLowerCase().includes('grupo');
    document.getElementById('equipo_a_id').disabled = esFaseGrupos;
    document.getElementById('equipo_b_id').disabled = esFaseGrupos;

    document.getElementById('partido-modal').hidden = false;
}

window.closePartidoModal = function() {
    const modal = document.getElementById('partido-modal');
    if (modal) {
        modal.hidden = true;
    }
};

window.openResultadoModal = function(partido) {
    const form = document.getElementById('resultado-edit-form');
    form.action = partidosBaseUrl + '/' + partido.id;
    document.getElementById('resultado_goles_a').value = partido.goles_a ?? '';
    document.getElementById('resultado_goles_b').value = partido.goles_b ?? '';
    document.querySelector('label[for="resultado_goles_a"]').textContent = 'Goles ' + (partido.equipo_a || 'Equipo A');
    document.querySelector('label[for="resultado_goles_b"]').textContent = 'Goles ' + (partido.equipo_b || 'Equipo B');
    document.getElementById('resultado-modal').hidden = false;
}

const equipoASelect = document.getElementById('equipo_a_id');
const equipoBSelect = document.getElementById('equipo_b_id');

if (equipoASelect) {
    equipoASelect.addEventListener('change', function () {
        const selectedText = this.options[this.selectedIndex]?.text || 'Equipo A';
        const label = document.getElementById('edit_goles_a_label');
        if (label) {
            label.textContent = 'Goles ' + selectedText;
        }
    });
}

if (equipoBSelect) {
    equipoBSelect.addEventListener('change', function () {
        const selectedText = this.options[this.selectedIndex]?.text || 'Equipo B';
        const label = document.getElementById('edit_goles_b_label');
        if (label) {
            label.textContent = 'Goles ' + selectedText;
        }
    });
}

window.closeResultadoModal = function() {
    const modal = document.getElementById('resultado-modal');
    if (modal) {
        modal.hidden = true;
    }
};