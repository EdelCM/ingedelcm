/**
 * API simulada para manejo de selecciones
 */
const API = {
    _data: {
        selecciones: {},
        numerosDisponibles: [0,1,2,3,4,5,6,7,8,9]
    },

    guardarSeleccion: function(jugadorId, numero) {
        return new Promise((resolve) => {
            setTimeout(() => {
                this._data.selecciones[`numero${jugadorId}`] = numero;
                this._data.numerosDisponibles = this._data.numerosDisponibles.filter(n => n !== numero);
                resolve();
            }, 200);
        });
    },

    obtenerSelecciones: function() {
        return new Promise((resolve) => {
            setTimeout(() => {
                resolve({...this._data.selecciones});
            }, 100);
        });
    },

    reiniciarJuego: function() {
        return new Promise((resolve) => {
            setTimeout(() => {
                this._data = {
                    selecciones: {},
                    numerosDisponibles: [0,1,2,3,4,5,6,7,8,9]
                };
                resolve();
            }, 200);
        });
    },

    // Nuevo método para verificar selecciones completas
    verificarSeleccionesCompletas: function() {
        return Object.keys(this._data.selecciones).length === 10;
    }
};