document.addEventListener('DOMContentLoaded', function () {
  // Validación para campos que solo deben contener letras
  const soloLetras = ['primer_nombre', 'segundo_nombre', 'primer_apellido', 'segundo_apellido'];

  soloLetras.forEach(id => {
    const input = document.getElementById(id);
    if (input) {
      input.addEventListener('input', function () {
        this.value = this.value
          .toUpperCase()
          .replace(/[^A-ZÁÉÍÓÚÑ ]/g, ''); // solo letras mayúsculas, espacios y caracteres especiales en español
      });

      // Agregar evento keypress para mejor experiencia de usuario
      input.addEventListener('keypress', function (e) {
        const key = e.key;
        // Permitir solo letras, espacio y teclas de control
        if (!/^[A-ZÁÉÍÓÚÑ ]$|Backspace|Delete|ArrowLeft|ArrowRight|Tab$/i.test(key)) {
          e.preventDefault();
        }
      });
    }
  });

  // Validación para número de documento (solo números)
  const numeroDocumento = document.getElementById('numero_documento');
  if (numeroDocumento) {
    numeroDocumento.addEventListener('keypress', function (e) {
      const key = e.key;
      // Solo permitir teclas numéricas (0-9)
      if (!/^[0-9]$/.test(key)) {
        e.preventDefault(); // bloquea letras, símbolos y espacios
      }
    });

    numeroDocumento.addEventListener('input', function () {
      // Borra cualquier carácter no numérico (por si se pegó texto)
      this.value = this.value.replace(/[^0-9]/g, '');
      // Limita a 13 caracteres
      if (this.value.length > 13) {
        this.value = this.value.slice(0, 13);
      }
    });
  }

  // Validación opcional para celular (similar al número de documento)
  const celular = document.getElementById('celular');
  if (celular) {
    celular.addEventListener('keypress', function (e) {
      const key = e.key;
      if (!/^[0-9]$/.test(key)) {
        e.preventDefault();
      }
    });

    celular.addEventListener('input', function () {
      this.value = this.value.replace(/[^0-9]/g, '');
      if (this.value.length > 13) {
        this.value = this.value.slice(0, 13);
      }
    });
  }
});
