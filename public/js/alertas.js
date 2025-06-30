// public/js/alertas.js
document.addEventListener("DOMContentLoaded", function () {
    console.log("Script alertas.js cargado correctamente");

    // Verificar si SweetAlert2 está disponible
    if (typeof Swal === "undefined") {
        console.error("SweetAlert2 no está cargado");
        return;
    }

    const successMessage = document.querySelector('meta[name="swal-success"]');
    const errorMessage = document.querySelector('meta[name="swal-error"]');

    console.log("Meta tags encontrados:", {
        success: successMessage,
        error: errorMessage,
    });

    if (successMessage) {
        Swal.fire({
            icon: "success",
            title: "✅ Registro Exitoso",
            text: successMessage.content,
            showConfirmButton: false,
            timer: 6000,
            timerProgressBar: true,
            position: "center",
            backdrop: true,
        });
    }

    if (errorMessage) {
        Swal.fire({
            icon: "error",
            title: "❌ Error",
            text: errorMessage.content,
            showConfirmButton: true,
            backdrop: true,
        });
    }
});
