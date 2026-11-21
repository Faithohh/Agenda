
document.addEventListener('DOMContentLoaded', function () {

    const buscarTarea = document.getElementById('buscarTarea');
    const filtrarEstado = document.getElementById('filtrarEstado');
    const filtrarPrioridad = document.getElementById('filtrarPrioridad');
    const contadorTareas = document.getElementById('contadorTareas');
    const limpiarFiltros = document.getElementById('limpiarFiltros');

    const filas = document.querySelectorAll('#tablaTareas tr');
    const tareas = [...filas];

    function filtrarTareas() {

        const texto = buscarTarea.value.toUpperCase();
        const estado = filtrarEstado.value;
        const prioridad = filtrarPrioridad.value;

        let contador = 0;

        tareas.forEach(function (tarea) {

            const titulo = tarea.dataset.titulo.toUpperCase();

            const coincideTitulo = titulo.indexOf(texto) !== -1;
            const coincideEstado = estado === 'todos' || tarea.dataset.estado === estado;
            const coincidePrioridad = prioridad === 'todas' || tarea.dataset.prioridad === prioridad;

            if (coincideTitulo && coincideEstado && coincidePrioridad) {
                tarea.style.display = '';
                contador++;
            } else {
                tarea.style.display = 'none';
            }

        });

        contadorTareas.textContent = `Mostrando ${contador} de ${tareas.length} tareas`;
    }

    if (buscarTarea && filtrarEstado && filtrarPrioridad && contadorTareas && limpiarFiltros) {

        buscarTarea.addEventListener('input', filtrarTareas);
        filtrarEstado.addEventListener('change', filtrarTareas);
        filtrarPrioridad.addEventListener('change', filtrarTareas);

        limpiarFiltros.addEventListener('click', function () {

            buscarTarea.value = '';
            filtrarEstado.value = 'todos';
            filtrarPrioridad.value = 'todas';

            filtrarTareas();

        });

    }

});
