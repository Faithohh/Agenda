document.addEventListener('DOMContentLoaded', function () {
    const html = document.documentElement;
    const btnTema = document.getElementById('btnCambiarTema');
    const iconoSol = document.getElementById('iconoSol');
    const iconoLuna = document.getElementById('iconoLuna');

    function aplicarTema(esOscuro) {
        html.classList.toggle('dark', esOscuro);

        if (iconoSol && iconoLuna) {
            if (esOscuro) {
                iconoSol.classList.add('hidden');
                iconoLuna.classList.remove('hidden');
            } else {
                iconoLuna.classList.add('hidden');
                iconoSol.classList.remove('hidden');
            }
        }

        if (btnTema) {
            btnTema.setAttribute('title', esOscuro ? 'Activar modo claro' : 'Activar modo oscuro');
        }
    }

    const temaGuardado = localStorage.getItem('theme');
    const iniciarOscuro = temaGuardado ? temaGuardado === 'dark' : true;
    aplicarTema(iniciarOscuro);

    if (btnTema) {
        btnTema.addEventListener('click', function () {
            const seraOscuro = !html.classList.contains('dark');
            localStorage.setItem('theme', seraOscuro ? 'dark' : 'light');
            aplicarTema(seraOscuro);
        });
    }
});