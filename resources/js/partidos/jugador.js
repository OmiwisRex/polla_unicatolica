const partidosBaseUrlMeta = document.querySelector('meta[name="partidos-base-url"]');
const partidosBaseUrl = partidosBaseUrlMeta ? partidosBaseUrlMeta.getAttribute('content') : '';

window.prepareApuestaModal = async function(partidoId) {
    if (!partidosBaseUrl) {
        alert('No se pudo determinar la ruta de partidos.');
        return;
    }
    const url = partidosBaseUrl + '/' + partidoId + '/preparar-apuesta';
    const token = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');

    try {
        const response = await fetch(url, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': token,
                'Accept': 'application/json',
            },
            body: JSON.stringify({}),
        });

        const data = await response.json();
        if (!response.ok) {
            alert(data.message || 'No se pudo preparar la apuesta.');
            return;
        }

        const form = document.getElementById('apuesta-form');
        form.action = partidosBaseUrl + '/' + partidoId + '/apostar';
        document.getElementById('apuesta_id').value = data.apuesta_id ?? '';
        document.getElementById('goles_a').value = '';
        document.getElementById('goles_b').value = '';
        document.getElementById('ganador_a_option').textContent = data.equipo_a;
        document.getElementById('ganador_b_option').textContent = data.equipo_b;
        document.getElementById('goles_a_label').textContent = 'Goles ' + data.equipo_a;
        document.getElementById('goles_b_label').textContent = 'Goles ' + data.equipo_b;

        const preguntaBox = document.getElementById('pregunta-box');
        const preguntaEnunciado = document.getElementById('pregunta-enunciado');
        const preguntaOpciones = document.getElementById('pregunta-opciones');
        const respuestaStrInput = document.getElementById('respuesta_str');

        preguntaBox.hidden = false;
        preguntaEnunciado.textContent = data.pregunta.enunciado;
        preguntaOpciones.innerHTML = '';
        respuestaStrInput.value = '';

        const respuestas = data.pregunta.opciones.slice();

        shuffleArray(respuestas);

        respuestas.forEach((respuesta, index) => {
            const optionId = 'respuesta_' + index;
            const wrapper = document.createElement('div');
            wrapper.className = 'radio-option';
            wrapper.innerHTML = `
                <label for="${optionId}">
                    <input id="${optionId}" type="radio" name="respuesta" value="${respuesta.id}" required>
                    ${escapeHtml(respuesta.texto)}
                </label>
            `;
            const radioInput = wrapper.querySelector('input[type="radio"]');
            if (radioInput) {
                radioInput.addEventListener('change', () => {
                    respuestaStrInput.value = respuesta.texto;
                });
            }
            preguntaOpciones.appendChild(wrapper);
        });

        document.getElementById('apuesta-modal').hidden = false;
    } catch (error) {
        console.error(error);
        alert('Hubo un error al preparar la apuesta.');
    }
}

function shuffleArray(array) {
    for (let i = array.length - 1; i > 0; i--) {
        const j = Math.floor(Math.random() * (i + 1));
        [array[i], array[j]] = [array[j], array[i]];
    }
}

function escapeHtml(text) {
    return text
        .replace(/&/g, '&amp;')
        .replace(/</g, '&lt;')
        .replace(/>/g, '&gt;')
        .replace(/"/g, '&quot;')
        .replace(/'/g, '&#039;');
}

window.closeApuestaModal = function() {
    const modal = document.getElementById('apuesta-modal');
    if (modal) {
        modal.hidden = true;
    }
};

document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('apuesta-form');
    if (!form) {
        return;
    }

    form.addEventListener('submit', function () {
        const respuestaStrInput = document.getElementById('respuesta_str');
        const selectedRadio = document.querySelector('#pregunta-opciones input[name="respuesta"]:checked');

        if (selectedRadio && respuestaStrInput) {
            const label = selectedRadio.closest('label');
            if (label) {
                respuestaStrInput.value = label.textContent.trim();
            }
        }
    });
});