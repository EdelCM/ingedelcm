document.addEventListener('DOMContentLoaded', function () {
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
});
