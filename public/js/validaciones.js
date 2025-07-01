document.addEventListener('DOMContentLoaded', function () {
  // Validación para campos que solo deben contener letras
  const soloLetras = ['primer_nombre', 'segundo_nombre', 'primer_apellido', 'segundo_apellido'];
  const paisSelect = document.getElementById('pais_nacimiento');
    const departamentoSelect = document.getElementById('departamento_nacimiento');
    const ciudadSelect = document.getElementById('ciudad_nacimiento');

    const departamentoResidencia = document.getElementById('departamento_residencia');
    const ciudadResidencia = document.getElementById('ciudad_residencia');

    // ========= INICIO - VALIDACIÓN PARA CAMPOS DE TEXTO EN MAYÚSCULAS EN FORMULARIO ESTABLECIMIENTO =========
  const camposMayusculas = ['nombre_establecimiento', 'tipo_establecimiento'];

  camposMayusculas.forEach(nombreCampo => {
    const input = document.querySelector(`input[name="${nombreCampo}"]`);

    if (input) {
      // Convertir a mayúsculas al escribir
      input.addEventListener('input', function () {
        this.value = this.value
          .toUpperCase()
          .replace(/[^A-ZÁÉÍÓÚÑÜ 0-9.,-]/g, ''); // Permitimos números, puntos, comas y guiones para nombres comerciales
      });

      // Validar teclas permitidas
      input.addEventListener('keypress', function (e) {
        const key = e.key;
        // Permitir letras, números, espacios, algunos símbolos y teclas de control
        if (!/^[A-ZÁÉÍÓÚÑÜ0-9 .,-]$|Backspace|Delete|ArrowLeft|ArrowRight|Tab$/i.test(key)) {
          e.preventDefault();
        }
      });

      // Validar al perder foco
      input.addEventListener('blur', function() {
        if (this.value.trim() === '') {
          Swal.fire({
            icon: 'warning',
            title: 'Campo requerido',
            text: `El campo ${input.labels[0].textContent} no puede estar vacío`,
            confirmButtonText: 'Entendido'
          });
          this.focus();
        }
      });
    }
  });
  // ========= FIN VALIDACIÓN PARA CAMPOS DE TEXTO EN MAYÚSCULAS EN FORMULARIO ESTABLECIMIENTO =========

    // ========= INICIO - VALIDACIÓN PARA NIT DE ESTABLECIMIENTO =========
  const nitEstablecimiento = document.querySelector('input[name="nit_establecimiento"]');

  if (nitEstablecimiento) {
    // Agregar placeholder con ejemplo
    nitEstablecimiento.placeholder = "Ejemplo: 123456789-0";

    // Función de validación
    function validarNIT(nit) {
      const regex = /^[0-9]{5,10}-[0-9]{1}$/;
      return regex.test(nit);
    }

    // Validar al perder foco
    nitEstablecimiento.addEventListener('blur', function() {
      const valor = this.value.trim();

      if (valor && !validarNIT(valor)) {
        Swal.fire({
          icon: 'error',
          title: 'Formato de NIT incorrecto',
          text: 'Por favor ingresa el NIT en el formato correcto: solo números y un guion. Ejemplo: 123456789-0',
          confirmButtonText: 'Entendido'
        });
        this.focus();
        this.value = ''; // Limpiar el campo si no es válido
      }
    });

    // Validación en tiempo real mientras escribe
    nitEstablecimiento.addEventListener('input', function(e) {
      // Permitir solo números y guiones
      this.value = this.value.replace(/[^0-9-]/g, '');

      // Limitar a 12 caracteres (10 números + guion + 1 número)
      if (this.value.length > 12) {
        this.value = this.value.slice(0, 12);
      }

      // Auto-insertar el guion después de 9-10 dígitos
      const digits = this.value.replace(/-/g, '');
      if (digits.length > 9 && this.value.indexOf('-') === -1) {
        const firstPart = digits.slice(0, 9);
        const secondPart = digits.slice(9);
        this.value = `${firstPart}-${secondPart}`;
      }
    });
  }
  // ========= FIN VALIDACIÓN PARA NIT DE ESTABLECIMIENTO =========

if (departamentoResidencia && ciudadResidencia) {
    departamentoResidencia.addEventListener('change', function () {
      const departamentoId = this.value;

      ciudadResidencia.innerHTML = '<option value="">Seleccione una ciudad</option>';
      ciudadResidencia.disabled = true;

      if (departamentoId) {
        fetch(`/get-ciudades?departamento_id=${departamentoId}`)
          .then(response => response.json())
          .then(data => {
            data.forEach(ciudad => {
              const option = document.createElement('option');
              option.value = ciudad.id;
              option.textContent = ciudad.nombre;
              ciudadResidencia.appendChild(option);
            });
            ciudadResidencia.disabled = false;
          })
          .catch(error => {
            console.error('Error al obtener ciudades:', error);
          });
      }
    });
  }

     if (paisSelect) {
        paisSelect.addEventListener('change', function() {
            const paisId = this.value;

            // Limpiar y deshabilitar selects dependientes
            departamentoSelect.innerHTML = '<option value="">Seleccione un departamento</option>';
            ciudadSelect.innerHTML = '<option value="">Seleccione una ciudad</option>';
            ciudadSelect.disabled = true;

            if (paisId) {
                fetch(`/get-departamentos?pais_id=${paisId}`)
                    .then(response => response.json())
                    .then(data => {
                        data.forEach(departamento => {
                            const option = document.createElement('option');
                            option.value = departamento.id;
                            option.textContent = departamento.nombre;
                            departamentoSelect.appendChild(option);
                        });
                        departamentoSelect.disabled = false;
                    });
            } else {
                departamentoSelect.disabled = true;
            }
        });
    }

    if (departamentoSelect) {
        departamentoSelect.addEventListener('change', function() {
            const departamentoId = this.value;

            // Limpiar select de ciudades
            ciudadSelect.innerHTML = '<option value="">Seleccione una ciudad</option>';

            if (departamentoId) {
                fetch(`/get-ciudades?departamento_id=${departamentoId}`)
                    .then(response => response.json())
                    .then(data => {
                        data.forEach(ciudad => {
                            const option = document.createElement('option');
                            option.value = ciudad.id;
                            option.textContent = ciudad.nombre;
                            ciudadSelect.appendChild(option);
                        });
                        ciudadSelect.disabled = false;
                    });
            } else {
                ciudadSelect.disabled = true;
            }
        });
    }

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

// Validación para teléfono de contacto (igual que celular)
const telefono = document.getElementById('telefono_contacto');
if (telefono) {
  telefono.addEventListener('keypress', function (e) {
    const key = e.key;
    if (!/^[0-9]$/.test(key)) {
      e.preventDefault();
    }
  });

  telefono.addEventListener('input', function () {
    this.value = this.value.replace(/[^0-9]/g, '');
    if (this.value.length > 13) {
      this.value = this.value.slice(0, 13);
    }
  });
}


$(document).ready(function () {
        $('#departamento_nacimiento').on('change', function () {
            var departamentoID = $(this).val();
            var $ciudadSelect = $('#ciudad_nacimiento');

            if (departamentoID) {
                $.ajax({
                    url: '/ciudades-por-departamento/' + departamentoID,
                    type: 'GET',
                    success: function (data) {
                        $ciudadSelect.empty().prop('disabled', false);
                        $ciudadSelect.append('<option value="">Seleccione una ciudad</option>');
                        data.forEach(function (ciudad) {
                            $ciudadSelect.append('<option value="' + ciudad.id + '">' + ciudad.nombre + '</option>');
                        });
                    }
                });
            } else {
                $ciudadSelect.empty().append('<option value="">Seleccione una ciudad</option>').prop('disabled', true);
            }
        });
    });

