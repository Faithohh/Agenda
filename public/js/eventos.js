document.addEventListener('DOMContentLoaded', function () {

    const buscarEvento = document.getElementById('buscarEvento');
    const filtrarRepeticion = document.getElementById('filtrarRepeticion');
    const filtrarModalidad = document.getElementById('filtrarModalidad');
    const contadorEventos = document.getElementById('contadorEventos');
    const limpiarFiltros = document.getElementById('limpiarFiltrosEventos');

    const modalNuevo = document.getElementById('modalNuevoEvento');
    const modalEditar = document.getElementById('modalEditarEvento');
    const btnAbrirCrear = document.getElementById('btnAbrirModalCrear');
    const formEditar = document.getElementById('formEditarEvento');

    const filas = document.querySelectorAll('#tablaEventos tr[data-titulo]');
    const eventos = [...filas];

    const plantillaEventoBase = {
        titulo: '',
        descripcion: '',
        lugar: '',
        categoria: '',
        inicio: '',
        fin: '',
        todoDia: false,
        repeticion: 'ninguna',
        finRepeticion: ''
    };

    function abrirModal(modal) {
        if (!modal) return;
        const caja = modal.children[1];

        modal.style.opacity = '0';
        modal.style.display = 'flex';
        modal.style.transition = 'opacity 300ms cubic-bezier(0.4, 0, 0.2, 1)';

        if (caja) {
            caja.style.opacity = '0';
            caja.style.transform = 'scale(0.95)';
            caja.style.transition = 'opacity 300ms cubic-bezier(0.4, 0, 0.2, 1), transform 300ms cubic-bezier(0.4, 0, 0.2, 1)';
        }

        requestAnimationFrame(function () {
            requestAnimationFrame(function () {
                modal.style.opacity = '1';
                if (caja) {
                    caja.style.opacity = '1';
                    caja.style.transform = 'scale(1)';
                }
            });
        });
    }

    function cerrarModal(modal) {
        if (!modal || modal.style.display !== 'flex') return;
        const caja = modal.children[1];

        modal.style.transition = 'opacity 200ms cubic-bezier(0.4, 0, 0.2, 1)';
        modal.style.opacity = '0';

        if (caja) {
            caja.style.transition = 'opacity 200ms cubic-bezier(0.4, 0, 0.2, 1), transform 200ms cubic-bezier(0.4, 0, 0.2, 1)';
            caja.style.opacity = '0';
            caja.style.transform = 'scale(0.95)';
        }

        setTimeout(function () {
            modal.style.display = 'none';
        }, 200);
    }

    if (modalNuevo && modalNuevo.dataset.tieneErrores === '1') {
        modalNuevo.style.opacity = '1';
        modalNuevo.style.display = 'flex';
    }

    if (btnAbrirCrear) {
        btnAbrirCrear.addEventListener('click', function () {
            abrirModal(modalNuevo);
        });
    }

    document.querySelectorAll('.btn-editar-evento').forEach(function (boton) {
        boton.addEventListener('click', function () {
            const datosEdicion = structuredClone(plantillaEventoBase);

            datosEdicion.titulo = boton.dataset.titulo || '';
            datosEdicion.descripcion = boton.dataset.descripcion || '';
            datosEdicion.lugar = boton.dataset.lugar || '';
            datosEdicion.categoria = boton.dataset.categoria || '';
            datosEdicion.inicio = boton.dataset.inicio || '';
            datosEdicion.fin = boton.dataset.fin || '';
            datosEdicion.todoDia = boton.dataset.todoDia === '1';
            datosEdicion.repeticion = boton.dataset.repeticion || 'ninguna';
            datosEdicion.finRepeticion = boton.dataset.finRepeticion || '';

            formEditar.action = '/eventos/' + boton.dataset.id;

            for (const clave in datosEdicion) {
                if (clave === 'titulo') document.getElementById('editTituloEvento').value = datosEdicion[clave];
                if (clave === 'descripcion') document.getElementById('editDescripcionEvento').value = datosEdicion[clave];
                if (clave === 'lugar') document.getElementById('editLugarEvento').value = datosEdicion[clave];
                if (clave === 'categoria') document.getElementById('editCategoriaEvento').value = datosEdicion[clave];
                if (clave === 'inicio') document.getElementById('editInicioEvento').value = datosEdicion[clave];
                if (clave === 'fin') document.getElementById('editFinEvento').value = datosEdicion[clave];
                if (clave === 'todoDia') document.getElementById('editTodoDiaEvento').checked = datosEdicion[clave];
                if (clave === 'repeticion') document.getElementById('editRepeticionEvento').value = datosEdicion[clave];
                if (clave === 'finRepeticion') document.getElementById('editFinRepeticionEvento').value = datosEdicion[clave];
            }

            abrirModal(modalEditar);
        });
    });

    document.querySelectorAll('.cerrar-modal-evento, .fondo-modal-evento').forEach(function (elemento) {
        elemento.addEventListener('click', function () {
            cerrarModal(modalNuevo);
            cerrarModal(modalEditar);
        });
    });

    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape') {
            cerrarModal(modalNuevo);
            cerrarModal(modalEditar);
        }
    });

    function filtrarEventos() {
        const texto = buscarEvento.value.toUpperCase();
        const repeticion = filtrarRepeticion.value;
        const modalidad = filtrarModalidad.value;

        let contador = 0;
        let indice = 0;

        while (indice < eventos.length) {
            const evento = eventos[indice];
            const titulo = evento.dataset.titulo.toUpperCase();
            const lugar = evento.dataset.lugar.toUpperCase();

            const coincideTexto = titulo.indexOf(texto) !== -1 || lugar.indexOf(texto) !== -1;
            const coincideRepeticion = repeticion === 'todas' || evento.dataset.repeticion === repeticion;
            const coincideModalidad = modalidad === 'todos' || evento.dataset.todoDia === modalidad;

            if (coincideTexto && coincideRepeticion && coincideModalidad) {
                evento.style.display = '';
                contador++;
            } else {
                evento.style.display = 'none';
            }
            indice++;
        }

        contadorEventos.textContent = `Mostrando ${contador} de ${eventos.length} eventos`;
    }

    if (buscarEvento && filtrarRepeticion && filtrarModalidad && contadorEventos && limpiarFiltros) {
        buscarEvento.addEventListener('input', filtrarEventos);
        filtrarRepeticion.addEventListener('change', filtrarEventos);
        filtrarModalidad.addEventListener('change', filtrarEventos);

        limpiarFiltros.addEventListener('click', function () {
            buscarEvento.value = '';
            filtrarRepeticion.value = 'todas';
            filtrarModalidad.value = 'todos';
            filtrarEventos();
        });
    }

    const btnNotaSesion = document.getElementById('btnAgregarNotaSesion');
    const listaNotas = document.getElementById('listaNotasSesion');

    if (btnNotaSesion && listaNotas) {
        btnNotaSesion.addEventListener('click', function () {
            Swal.fire({
                title: 'Nota rápida de sesión',
                input: 'text',
                inputPlaceholder: 'Escribe tu recordatorio aquí...',
                showCancelButton: true,
                confirmButtonText: 'Agregar nota',
                cancelButtonText: 'Cancelar',
                confirmButtonColor: '#2563eb',
                cancelButtonColor: '#64748b',
                inputValidator: (valor) => {
                    if (!valor || valor.trim() === '') {
                        return 'Por favor escribe una nota antes de agregarla';
                    }
                }
            }).then((resultado) => {
                if (resultado.isConfirmed && resultado.value) {
                    const li = document.createElement('li');
                    li.textContent = '• ' + resultado.value.trim();
                    listaNotas.appendChild(li);
                }
            });
        });
    }

});