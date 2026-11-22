document.addEventListener('DOMContentLoaded', function () {
    const contenedor = document.getElementById('datosEstadisticasContainer');
    if (!contenedor) return;

    const tareas = JSON.parse(contenedor.dataset.tareas || '[]');
    const eventos = JSON.parse(contenedor.dataset.eventos || '[]');

    const calcularPorcentaje = new Function('parte', 'total', 'return total > 0 ? Math.round((parte / total) * 100) : 0;');
    const calcularPuntos = new Function('completadas', 'totalEventos', 'return (completadas * 15) + (totalEventos * 10);');

    function* generadorConsejos() {
        const consejos = [
            'Prioriza primero las tareas de prioridad alta antes de revisar mensajes.',
            'Divide las tareas grandes en bloques de 25 minutos para mantener el enfoque.',
            'Asigna siempre una categoría y color a tus eventos para visualizar tu semana.',
            'Revisa tu calendario cada domingo por la noche para anticipar entregas.'
        ];
        let i = 0;
        while (true) {
            yield consejos[i];
            i = (i + 1) % consejos.length;
        }
    }

    const flujoConsejos = generadorConsejos();

    function obtenerNivel(puntos) {
        switch (true) {
            case puntos >= 150:
                return 'Nivel Avanzado · Excelente ritmo';
            case puntos >= 60:
                return 'Nivel Intermedio · Buen avance';
            default:
                return 'Nivel Inicial · Sigue sumando actividades';
        }
    }

    function crearBarra(nombre, cantidad, porcentaje, color) {
        return `
            <div>
                <div class="flex justify-between text-xs font-semibold mb-1">
                    <span class="inline-flex items-center gap-2 text-gray-700 dark:text-gray-200">
                        <span class="w-2.5 h-2.5 rounded-full" style="background-color: ${color};"></span>
                        ${nombre}
                    </span>
                    <span class="text-gray-500 dark:text-gray-400">${cantidad} (${porcentaje}%)</span>
                </div>
                <div class="w-full h-2.5 bg-gray-200 dark:bg-gray-800 rounded-full overflow-hidden">
                    <div class="h-full rounded-full" style="width: ${porcentaje}%; background-color: ${color};"></div>
                </div>
            </div>
        `;
    }

    function actualizarVista() {
        const orden = document.getElementById('filtroOrdenCategorias').value;

        const pendientes = tareas.filter(t => t.estado === 'pendiente').length;
        const enProgreso = tareas.filter(t => t.estado === 'en_progreso').length;
        const completadas = tareas.filter(t => t.estado === 'completada').length;
        const totalTareas = tareas.length;
        const porcentaje = calcularPorcentaje(completadas, totalTareas);

        const totalEventos = eventos.length;
        const recurrentes = eventos.filter(e => e.repeticion && e.repeticion !== 'ninguna').length;
        const puntos = calcularPuntos(completadas, totalEventos);

        document.getElementById('kpiTotalTareas').textContent = totalTareas;
        document.getElementById('kpiDetalleTareas').textContent = `${completadas} completadas · ${pendientes} pendientes`;
        document.getElementById('kpiPorcentaje').textContent = `${porcentaje}%`;
        document.getElementById('barraProgresoGeneral').style.width = `${porcentaje}%`;
        document.getElementById('kpiTotalEventos').textContent = totalEventos;
        document.getElementById('kpiEventosRecurrentes').textContent = `${recurrentes} con repetición`;
        document.getElementById('kpiIndiceProductividad').textContent = `${puntos} pts`;
        document.getElementById('kpiNivelProductividad').textContent = obtenerNivel(puntos);

        const estados = [
            { nombre: 'Pendientes', cantidad: pendientes, color: '#f59e0b' },
            { nombre: 'En progreso', cantidad: enProgreso, color: '#3b82f6' },
            { nombre: 'Completadas', cantidad: completadas, color: '#10b981' }
        ];
        document.getElementById('contenedorEstados').innerHTML = estados
            .map(e => crearBarra(e.nombre, e.cantidad, calcularPorcentaje(e.cantidad, totalTareas), e.color))
            .join('');

        const prioridades = [
            { nombre: 'ALTA', cantidad: tareas.filter(t => t.prioridad === 'alta').length, color: '#ef4444' },
            { nombre: 'MEDIA', cantidad: tareas.filter(t => t.prioridad === 'media').length, color: '#f59e0b' },
            { nombre: 'BAJA', cantidad: tareas.filter(t => t.prioridad === 'baja').length, color: '#10b981' }
        ];
        document.getElementById('contenedorPrioridades').innerHTML = prioridades
            .map(p => `
                <div class="p-3 rounded-xl border border-gray-200 dark:border-gray-800 text-center">
                    <span class="text-[11px] font-bold" style="color: ${p.color};">${p.nombre}</span>
                    <p class="text-xl font-bold text-gray-800 dark:text-white mt-1">${p.cantidad}</p>
                </div>
            `).join('');

        const todas = [...tareas, ...eventos];
        const categoriasUnicas = [...new Set(todas.map(item => item.categoria))];
        document.getElementById('contadorCategoriasUnicas').textContent = `${categoriasUnicas.length} categorías`;

        const listaCategorias = categoriasUnicas.map(nombre => {
            const grupo = todas.filter(item => item.categoria === nombre);
            return {
                nombre: nombre,
                color: grupo[0].color,
                total: grupo.length
            };
        });

        listaCategorias.sort((a, b) => b.total - a.total);
        if (orden === 'menor') {
            listaCategorias.reverse();
        }

        const contenedorCategorias = document.getElementById('contenedorCategorias');
        if (listaCategorias.length === 0) {
            contenedorCategorias.innerHTML = '<p class="text-sm text-gray-500 dark:text-gray-400">Aún no hay actividades registradas.</p>';
        } else {
            contenedorCategorias.innerHTML = listaCategorias
                .map(c => crearBarra(c.nombre, `${c.total} actividades`, calcularPorcentaje(c.total, todas.length), c.color))
                .join('');
        }
    }

    const manejador = {
        handleEvent: function (e) {
            if (e.target.id === 'filtroOrdenCategorias') {
                actualizarVista();
            }
            if (e.target.id === 'btnSiguienteConsejo') {
                document.getElementById('textoConsejoGenerador').textContent = flujoConsejos.next().value;
            }
        }
    };

    document.getElementById('filtroOrdenCategorias').addEventListener('change', manejador);
    document.getElementById('btnSiguienteConsejo').addEventListener('click', manejador);

    document.getElementById('textoConsejoGenerador').textContent = flujoConsejos.next().value;
    actualizarVista();
});