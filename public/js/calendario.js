document.addEventListener('DOMContentLoaded', function () {

    const contenedorDatos = document.getElementById('datosCalendarioContainer');
    const items = contenedorDatos ? JSON.parse(contenedorDatos.dataset.items || '[]') : [];

    const tituloMes = document.getElementById('tituloMesCalendario');
    const gridCalendario = document.getElementById('gridCalendario');
    const btnAnterior = document.getElementById('btnMesAnterior');
    const btnSiguiente = document.getElementById('btnMesSiguiente');
    const btnHoy = document.getElementById('btnMesHoy');
    const filtroTipo = document.getElementById('filtroTipoCalendario');

    const modalDia = document.getElementById('modalDetalleDia');
    const tituloModalDia = document.getElementById('tituloModalDia');
    const subtituloModalDia = document.getElementById('subtituloModalDia');
    const listaActividadesDia = document.getElementById('listaActividadesDia');

    const nombresMeses = [
        'Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio',
        'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'
    ];

    // Festividades fijas 
    const festividadesFijas = {
        '01-01': 'Año Nuevo',
        '05-01': 'Día del Trabajo',
        '06-07': 'Batalla de Arica y Día de la Bandera',
        '06-29': 'San Pedro y San Pablo',
        '07-23': 'Día de la Fuerza Aérea del Perú',
        '07-28': 'Fiestas Patrias - Independencia',
        '07-29': 'Fiestas Patrias - Gran Parada Militar',
        '08-06': 'Batalla de Junín',
        '08-30': 'Santa Rosa de Lima',
        '10-08': 'Combate de Angamos',
        '11-01': 'Día de Todos los Santos',
        '12-08': 'Inmaculada Concepción',
        '12-09': 'Batalla de Ayacucho',
        '12-25': 'Navidad'
    };

    // Festividades móviles por año 
    const festividadesMoviles = {
        '2026-04-02': 'Jueves Santo',
        '2026-04-03': 'Viernes Santo',
        '2027-03-25': 'Jueves Santo',
        '2027-03-26': 'Viernes Santo',
        '2028-04-13': 'Jueves Santo',
        '2028-04-14': 'Viernes Santo'
    };

    function obtenerFestividad(fechaISO) {
        if (festividadesMoviles[fechaISO]) {
            return festividadesMoviles[fechaISO];
        }
        const mesDia = fechaISO.slice(5); 
        return festividadesFijas[mesDia] || null;
    }

    const hoy = new Date();
    let mesActual = hoy.getMonth();
    let anioActual = hoy.getFullYear();

    function formatearFechaISO(anio, mes, dia) {
        const m = String(mes + 1).padStart(2, '0');
        const d = String(dia).padStart(2, '0');
        return `${anio}-${m}-${d}`;
    }

    function hexARgba(hex, alpha) {
        const limpio = (hex || '').replace('#', '');
        if (limpio.length !== 6) return `rgba(100, 116, 139, ${alpha})`;
        const r = parseInt(limpio.substring(0, 2), 16);
        const g = parseInt(limpio.substring(2, 4), 16);
        const b = parseInt(limpio.substring(4, 6), 16);
        return `rgba(${r}, ${g}, ${b}, ${alpha})`;
    }

    function obtenerEstiloActividad(act) {
        const tieneCategoria = Boolean(act.categoria);

        if (tieneCategoria && act.color) {
            return {
                fondo: hexARgba(act.color, 0.18),
                borde: hexARgba(act.color, 0.55),
                punto: act.color,
                etiqueta: act.categoria
            };
        }

        return {
            fondo: 'rgba(100, 116, 139, 0.18)',
            borde: 'rgba(148, 163, 184, 0.5)',
            punto: '#94a3b8',
            etiqueta: 'Sin categoría'
        };
    }

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

    function mostrarDetalleDia(fechaISO, actividadesDia, festividad) {
        const partes = fechaISO.split('-');
        tituloModalDia.textContent = `Agenda del ${partes[2]}/${partes[1]}/${partes[0]}`;
        subtituloModalDia.textContent = actividadesDia.length === 1
            ? '1 actividad programada para este día.'
            : `${actividadesDia.length} actividades programadas para este día.`;

        listaActividadesDia.innerHTML = '';

        if (festividad) {
            const bannerFeriado = document.createElement('div');
            bannerFeriado.style.backgroundColor = 'rgba(245, 158, 11, 0.16)';
            bannerFeriado.style.border = '1px solid rgba(245, 158, 11, 0.5)';
            bannerFeriado.className = 'p-3.5 rounded-xl flex items-center gap-3';
            bannerFeriado.innerHTML = `
                <span style="color: #f59e0b;" class="text-base font-bold">★</span>
                <div>
                    <p style="color: #fbbf24;" class="text-xs font-semibold uppercase tracking-wider">Festividad / Feriado</p>
                    <p class="text-sm font-bold text-gray-800 dark:text-white">${festividad}</p>
                </div>
            `;
            listaActividadesDia.appendChild(bannerFeriado);
        }

        if (actividadesDia.length === 0 && !festividad) {
            listaActividadesDia.innerHTML = `
                <p class="text-sm text-gray-500 dark:text-gray-400 text-center py-6">
                    No hay tareas ni eventos registrados para esta fecha.
                </p>
            `;
        } else {
            actividadesDia.forEach(function (act) {
                const esTarea = act.tipo === 'tarea';
                const estilo = obtenerEstiloActividad(act);

                const tipoBadgeStyle = esTarea
                    ? 'background-color: rgba(37, 99, 235, 0.2); color: #60a5fa;'
                    : 'background-color: rgba(124, 58, 237, 0.2); color: #c084fc;';

                const catBadgeStyle = `background-color: ${estilo.fondo}; border: 1px ${act.categoria ? 'solid' : 'dashed'} ${estilo.borde}; color: inherit;`;

                const meta = esTarea
                    ? `Prioridad: ${act.prioridad || 'media'} · Estado: ${(act.estado || '').replace('_', ' ')}`
                    : `${act.hora || ''}${act.lugar ? ' · ' + act.lugar : ''}`;

                const tarjeta = document.createElement('div');
                tarjeta.className = 'p-4 rounded-xl border border-gray-200 dark:border-gray-700 flex items-start justify-between gap-3';
                tarjeta.innerHTML = `
                    <div class="min-w-0">
                        <div class="flex flex-wrap items-center gap-2 mb-1.5">
                            <span style="${tipoBadgeStyle}" class="px-2 py-0.5 text-xs font-semibold rounded-md">
                                ${esTarea ? 'Tarea' : 'Evento'}
                            </span>
                            <span style="${catBadgeStyle}" class="inline-flex items-center gap-1.5 px-2 py-0.5 text-xs font-medium rounded-md text-gray-700 dark:text-gray-200">
                                <span style="background-color: ${estilo.punto};" class="w-2 h-2 rounded-full"></span>
                                ${estilo.etiqueta}
                            </span>
                        </div>
                        <h4 class="font-semibold text-gray-800 dark:text-white text-sm">${act.titulo}</h4>
                        <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">${meta}</p>
                        ${act.descripcion ? `<p class="text-xs text-gray-600 dark:text-gray-300 mt-2">${act.descripcion}</p>` : ''}
                    </div>
                `;
                listaActividadesDia.appendChild(tarjeta);
            });
        }

        abrirModal(modalDia);
    }

    function renderizarCalendario() {
        tituloMes.textContent = `${nombresMeses[mesActual]} ${anioActual}`;
        gridCalendario.innerHTML = '';

        const tipoSeleccionado = filtroTipo ? filtroTipo.value : 'todos';

        const primerDiaMes = new Date(anioActual, mesActual, 1);
        const ultimoDiaMes = new Date(anioActual, mesActual + 1, 0);
        const totalDias = ultimoDiaMes.getDate();

        let diaSemanaInicio = primerDiaMes.getDay() - 1;
        if (diaSemanaInicio < 0) diaSemanaInicio = 6;

        for (let i = 0; i < diaSemanaInicio; i++) {
            const celdaVacia = document.createElement('div');
            celdaVacia.className = 'min-h-[110px] p-2';
            celdaVacia.style.backgroundColor = 'rgba(17, 24, 39, 0.25)';
            gridCalendario.appendChild(celdaVacia);
        }

        const hoyISO = formatearFechaISO(hoy.getFullYear(), hoy.getMonth(), hoy.getDate());

        for (let dia = 1; dia <= totalDias; dia++) {
            const fechaISO = formatearFechaISO(anioActual, mesActual, dia);
            const esHoy = fechaISO === hoyISO;
            const festividad = obtenerFestividad(fechaISO);

            const actividadesDia = items.filter(function (item) {
                const coincideFecha = item.fecha === fechaISO;
                const coincideTipo = tipoSeleccionado === 'todos' || item.tipo === tipoSeleccionado;
                return coincideFecha && coincideTipo;
            });

            const celda = document.createElement('div');
            celda.className = 'min-h-[110px] p-2 transition cursor-pointer flex flex-col justify-between';

            celda.addEventListener('mouseenter', function () {
                const esModoOscuro = document.documentElement.classList.contains('dark');
                celda.style.backgroundColor = esModoOscuro
                    ? 'rgba(55, 65, 81, 0.45)'
                    : 'rgba(243, 244, 246, 0.85)';
            });

            celda.addEventListener('mouseleave', function () {
                celda.style.backgroundColor = '';
            });

            const cabeceraDia = document.createElement('div');
            cabeceraDia.className = 'flex items-center justify-between mb-1';

            const numeroDia = document.createElement('span');
            numeroDia.textContent = dia;
            if (esHoy) {
                numeroDia.className = 'w-7 h-7 rounded-full bg-blue-600 text-white text-xs font-bold flex items-center justify-center';
            } else if (festividad) {
                numeroDia.style.color = '#fbbf24';
                numeroDia.className = 'text-xs font-bold px-1.5 py-0.5';
            } else {
                numeroDia.className = 'text-xs font-semibold text-gray-700 dark:text-gray-300 px-1.5 py-0.5';
            }

            cabeceraDia.appendChild(numeroDia);

            if (actividadesDia.length > 0) {
                const contador = document.createElement('span');
                contador.textContent = actividadesDia.length;
                contador.className = 'text-[11px] font-medium text-gray-400 dark:text-gray-400';
                cabeceraDia.appendChild(contador);
            }

            const listaInsignias = document.createElement('div');
            listaInsignias.className = 'space-y-1 overflow-hidden';

            if (festividad) {
                const badgeFeriado = document.createElement('div');
                badgeFeriado.className = 'px-1.5 py-0.5 text-[11px] font-semibold rounded truncate flex items-center gap-1';
                badgeFeriado.style.backgroundColor = 'rgba(245, 158, 11, 0.18)';
                badgeFeriado.style.border = '1px solid rgba(245, 158, 11, 0.55)';
                badgeFeriado.style.color = '#fbbf24';
                badgeFeriado.title = festividad;
                badgeFeriado.textContent = `★ ${festividad}`;
                listaInsignias.appendChild(badgeFeriado);
            }

            const limiteItems = festividad ? 2 : 3;

            actividadesDia.slice(0, limiteItems).forEach(function (act) {
                const estilo = obtenerEstiloActividad(act);
                const badge = document.createElement('div');

                badge.className = 'px-1.5 py-0.5 text-[11px] font-medium rounded truncate flex items-center gap-1.5 text-gray-800 dark:text-gray-100';
                badge.style.backgroundColor = estilo.fondo;
                badge.style.border = `1px ${act.categoria ? 'solid' : 'dashed'} ${estilo.borde}`;

                const punto = document.createElement('span');
                punto.style.backgroundColor = estilo.punto;
                punto.style.width = '6px';
                punto.style.height = '6px';
                punto.style.borderRadius = '9999px';
                punto.style.flexShrink = '0';

                const texto = document.createElement('span');
                texto.className = 'truncate';
                texto.textContent = (act.hora && act.hora !== 'Todo el día' ? act.hora + ' ' : '') + act.titulo;

                badge.appendChild(punto);
                badge.appendChild(texto);
                listaInsignias.appendChild(badge);
            });

            if (actividadesDia.length > limiteItems) {
                const mas = document.createElement('div');
                mas.className = 'text-[11px] font-semibold text-gray-500 dark:text-gray-400 pl-1';
                mas.textContent = `+${actividadesDia.length - limiteItems} más`;
                listaInsignias.appendChild(mas);
            }

            celda.appendChild(cabeceraDia);
            celda.appendChild(listaInsignias);

            celda.addEventListener('click', function () {
                mostrarDetalleDia(fechaISO, actividadesDia, festividad);
            });

            gridCalendario.appendChild(celda);
        }
    }

    if (btnAnterior) {
        btnAnterior.addEventListener('click', function () {
            mesActual--;
            if (mesActual < 0) {
                mesActual = 11;
                anioActual--;
            }
            renderizarCalendario();
        });
    }

    if (btnSiguiente) {
        btnSiguiente.addEventListener('click', function () {
            mesActual++;
            if (mesActual > 11) {
                mesActual = 0;
                anioActual++;
            }
            renderizarCalendario();
        });
    }

    if (btnHoy) {
        btnHoy.addEventListener('click', function () {
            mesActual = hoy.getMonth();
            anioActual = hoy.getFullYear();
            renderizarCalendario();
        });
    }

    if (filtroTipo) {
        filtroTipo.addEventListener('change', renderizarCalendario);
    }

    document.querySelectorAll('.cerrar-modal-dia, .fondo-modal-dia').forEach(function (el) {
        el.addEventListener('click', function () {
            cerrarModal(modalDia);
        });
    });

    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape') {
            cerrarModal(modalDia);
        }
    });

    renderizarCalendario();
});