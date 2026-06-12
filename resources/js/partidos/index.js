const filtroEtapa = document.getElementById('filtro-etapa');
if (filtroEtapa) {
    filtroEtapa.addEventListener('change', function () {
        window.location.href = this.dataset.route + '?etapa=' + this.value;
    });
}
