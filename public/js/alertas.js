// public/js/alertas.js
document.addEventListener('DOMContentLoaded', function () {
    const successMessage = document.querySelector('meta[name="swal-success"]');
    const errorMessage = document.querySelector('meta[name="swal-error"]');

    if (successMessage) {
        Swal.fire({
            icon: 'success',
            title: '✅ Registro Exitoso',
            text: successMessage.content,
            showConfirmButton: false,
            timer: 6000,
            timerProgressBar: true,
            position: 'center',
            backdrop: true,
        });
    }

    if (errorMessage) {
        Swal.fire({
            icon: 'error',
            title: '❌ Error',
            text: errorMessage.content,
            showConfirmButton: true,
            backdrop: true,
        });
    }
});
