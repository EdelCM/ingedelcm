/**
 * Clase principal del juego "Acierta el Número" con jQuery
 */
class Juego {
    constructor() {
        this.jugadores = [];
        this.numeroGanador = null;
        this.numerosSeleccionados = new Set();
        this.inicializar();
    }
    
    inicializar() {
        this.$jugadoresContainer = $('#jugadoresContainer');
        this.$iniciarJuegoBtn = $('#iniciarJuego');
        this.$reiniciarJuegoBtn = $('#reiniciarJuego');
        this.$resultadoContainer = $('#resultadoContainer');
        this.$resultadoTexto = $('#resultadoTexto');
        
        this.crearInputsJugadores();
        
        this.$iniciarJuegoBtn.on('click', () => this.iniciarJuego());
        this.$reiniciarJuegoBtn.on('click', () => this.reiniciarJuego());
    }
    
    crearInputsJugadores() {
        this.$jugadoresContainer.empty();
        
        for (let i = 1; i <= 10; i++) {
            const $jugadorDiv = $(`
                <div class="jugador">
                    <label for="jugador${i}">Jugador ${i}:</label>
                    <input type="text" id="jugador${i}" placeholder="Nombre del jugador" class="nombre-jugador" required>
                    <select id="numero${i}" class="numero-jugador" required>
                        <option value="">Selecciona un número</option>
                        ${this.generarOpcionesNumeros()}
                    </select>
                    <div class="mensaje-error" id="error${i}"></div>
                </div>
            `);
            
            $jugadorDiv.find('.numero-jugador').on('change', (e) => {
                this.actualizarNumerosDisponibles(e, i);
            });
            
            this.$jugadoresContainer.append($jugadorDiv);
        }
    }
    
    generarOpcionesNumeros() {
        return [0,1,2,3,4,5,6,7,8,9]
            .map(num => `<option value="${num}">${num}</option>`)
            .join('');
    }
    
    async actualizarNumerosDisponibles(evento, jugadorId) {
        const $selectActual = $(evento.target);
        // Manejar explícitamente el valor vacío vs 0
        const numeroSeleccionado = $selectActual.val() === '' ? null : parseInt($selectActual.val());
        
        if (numeroSeleccionado === null) return;
    
        try {
            await API.guardarSeleccion(jugadorId, numeroSeleccionado);
            const selecciones = await API.obtenerSelecciones();
            this.actualizarDropdowns(selecciones);
            
            $selectActual.css({
                'background-color': '#f0f8ff',
                'font-weight': 'bold'
            });
            
        } catch (error) {
            console.error('Error:', error);
            $selectActual.val('');
        }
    }
    
    async actualizarDropdowns(selecciones) {
        // Obtener números usados, filtrando valores undefined y convirtiendo a número
        const numerosUsados = Object.values(selecciones)
            .filter(val => val !== undefined && val !== '')
            .map(Number);
        
        $('.numero-jugador').each(function() {
            const $select = $(this);
            const selectId = $select.attr('id');
            
            // Manejar explícitamente el valor actual (incluyendo 0)
            const currentValue = selecciones[selectId] !== undefined ? selecciones[selectId] : '';
            
            let options = '<option value="">Selecciona un número</option>';
            
            for (let num = 0; num <= 9; num++) {
                // Comparación estricta que funciona correctamente con 0
                const isSelected = currentValue === num;
                const isDisabled = numerosUsados.includes(num) && !isSelected;
                
                options += `
                    <option value="${num}" ${isSelected ? 'selected' : ''} ${isDisabled ? 'disabled' : ''}>
                        ${num}${isDisabled ? ' (no disponible)' : ''}
                    </option>
                `;
            }
            
            $select.html(options);
            
            // Establecer el valor correctamente (incluyendo 0)
            if (currentValue !== '' && currentValue !== undefined) {
                $select.val(currentValue);
            } else {
                $select.val('');
            }
        });
    }
    
    async iniciarJuego() {
        try {
            // Verificar que todas las selecciones estén completas
            const seleccionesCompletas = await API.verificarSeleccionesCompletas();
            if (!seleccionesCompletas) {
                alert('Todos los jugadores deben seleccionar un número único');
                return;
            }

            // Verificar nombres completos
            let todosNombresValidos = true;
            $('.nombre-jugador').each(function() {
                if (!$(this).val().trim()) {
                    todosNombresValidos = false;
                    return false; // Salir del each
                }
            });
            
            if (!todosNombresValidos) {
                alert('Todos los jugadores deben tener un nombre');
                return;
            }

            // Recolectar datos válidos
            this.jugadores = [];
            const selecciones = await API.obtenerSelecciones();
            
            for (let i = 1; i <= 10; i++) {
                const nombre = $(`#jugador${i}`).val().trim();
                const numero = parseInt(selecciones[`numero${i}`]);
                this.jugadores.push({ nombre, numero });
            }

            // Generar y mostrar resultado
            this.generarNumeroGanador();
            const ganador = this.determinarGanador();
            this.mostrarResultado(ganador);
            
        } catch (error) {
            console.error('Error al iniciar juego:', error);
            alert('Ocurrió un error al iniciar el juego');
        }
    }
    
    generarNumeroGanador() {
        this.numeroGanador = Math.floor(Math.random() * 10);
    }
    
    determinarGanador() {
        return this.jugadores.find(jugador => jugador.numero === this.numeroGanador) || null;
    }
    
    mostrarResultado(ganador) {
        this.$resultadoContainer.show();
        
        if (ganador) {
            this.$resultadoTexto.html(`
                <p>¡El número ganador es <span class="ganador">${this.numeroGanador}</span>!</p>
                <p>¡<span class="ganador">${ganador.nombre}</span> gana!</p>
            `);
        } else {
            this.$resultadoTexto.html(`
                <p>El número ganador era <span class="ganador">${this.numeroGanador}</span></p>
                <p>¡Ningún jugador acertó el número!</p>
            `);
        }
    }
    
    async reiniciarJuego() {
        try {
            await API.reiniciarJuego();
            
            this.jugadores = [];
            this.numeroGanador = null;
            
            $('.nombre-jugador').val('');
            $('.numero-jugador').val('').css({
                'background-color': '',
                'font-weight': ''
            });
            
            this.actualizarDropdowns({});
            $('.mensaje-error').hide();
            this.$resultadoContainer.hide();
            
        } catch (error) {
            console.error('Error al reiniciar:', error);
        }
    }
}

// Iniciar el juego cuando se carga la página
$(document).ready(() => {
    new Juego();
});