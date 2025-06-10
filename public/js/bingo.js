$(document).ready(function () {
    $('#generateRandomCard').click(generateRandomCard);
    $('#generateEmptyCard').click(generateEmptyCard);
    $('#exportPDF').click(exportToPDF);

    function generateRandomCard() {
        const columns = {
            'B': generateUniqueNumbers(1, 15, 5),
            'I': generateUniqueNumbers(16, 30, 5),
            'N': generateUniqueNumbers(31, 45, 4),
            'G': generateUniqueNumbers(46, 60, 5),
            'O': generateUniqueNumbers(61, 75, 5)
        };

        columns['N'].splice(2, 0, 'FREE');
        renderCard(columns, true);
    }

    function generateEmptyCard() {
        const columns = {
            'B': Array(5).fill(''),
            'I': Array(5).fill(''),
            'N': Array(5).fill(''),
            'G': Array(5).fill(''),
            'O': Array(5).fill('')
        };

        columns['N'][2] = 'FREE';
        renderCard(columns, false);
    }

    function renderCard(columns, isRandom) {
        let table = `<table id="bingoCard" class="${isRandom ? 'random-card' : 'custom-card'}"><thead><tr>`;

        // Cabeceras
        for (let letter in columns) {
            table += `<th>${letter}</th>`;
        }
        table += '</tr></thead><tbody>';

        // Filas
        for (let i = 0; i < 5; i++) {
            table += '<tr>';
            for (let letter in columns) {
                const value = columns[letter][i];
                const isFree = value === 'FREE';
                const cellClass = isFree ? 'free-space' : '';
                const content = isFree ? 'FREE' : (value || '');

                // MISMA ESTRUCTURA PARA AMBOS TIPOS
                table += `
                    <td class="${cellClass}">
                        <div class="cell-container">
                            ${isRandom ?
                                `<div class="cell-content">${content}</div>` :
                                `<input type="text"
                                       value="${content}"
                                       class="bingo-input cell-content"
                                       data-col="${letter}"
                                       ${isFree ? 'disabled' : ''}>`
                            }
                        </div>
                    </td>`;
            }
            table += '</tr>';
        }

        table += '</tbody></table>';

        $('#bingoCardContainer').html(table);

        /*$('#bingoCardContainer').html(`
            <div class="bingo-title">Cartón de Bingo</div>
            ${table}
        `);*/

        if (!isRandom) {
            $('.bingo-input').on('blur', function() {
                validateInput(this);
            });
        }
    }

    function generateUniqueNumbers(min, max, count) {
        const numbers = new Set();
        while (numbers.size < count) {
            numbers.add(Math.floor(Math.random() * (max - min + 1)) + min);
        }
        return Array.from(numbers);
    }

    function validateInput(input) {
        const $input = $(input);
        const value = $input.val().trim();
        const col = $input.data('col');
        const [min, max] = getRangeForColumn(col);

        if (value === '') {
            clearInvalid($input);
            return;
        }

        if (!/^\d+$/.test(value)) {
            showValidationError($input, "Solo se permiten números.");
            return;
        }

        const num = parseInt(value);
        if (isNaN(num) || num < min || num > max) {
            showValidationError($input, `Número fuera de rango (${min}-${max}) para columna ${col}.`);
            return;
        }

        if ($(`.bingo-input[data-col="${col}"]`).filter((i, el) =>
            el !== input && $(el).val().trim() === value).length > 0) {
            showValidationError($input, `El número ${value} ya existe en la columna ${col}.`);
            return;
        }

        clearInvalid($input);
    }

    function showValidationError($input, message) {
        alert(message);
        setInvalid($input);
        $input.val('').focus();
    }

    function getRangeForColumn(col) {
        const ranges = {
            'B': [1, 15], 'I': [16, 30], 'N': [31, 45],
            'G': [46, 60], 'O': [61, 75]
        };
        return ranges[col];
    }

    function setInvalid($input) {
        $input.addClass('invalid');
    }

    function clearInvalid($input) {
        $input.removeClass('invalid');
    }

    function exportToPDF() {
        try {
            const { jsPDF } = window.jspdf;
            if (!jsPDF || typeof html2canvas === 'undefined') {
                throw new Error("Librerías no disponibles");
            }

            // Configuración del PDF
            const pdfWidth = 105; // 10.5 cm
            const pdfHeight = 110; // 11 cm
            const margin = 5; // 5mm de margen

            const doc = new jsPDF({
                orientation: "portrait",
                unit: "mm",
                format: [pdfWidth, pdfHeight]
            });

            const element = document.getElementById("bingoCardContainer");

            // Convertir temporalmente los inputs en divs para la exportación
            const inputs = $('.bingo-input');
            const originalValues = [];

            inputs.each(function(index) {
                originalValues[index] = $(this).val();
                $(this).replaceWith(`<div class="cell-content">${$(this).val() || ''}</div>`);
            });

            html2canvas(element, {
                scale: 4, // Alta resolución
                useCORS: true,
                allowTaint: true,
                backgroundColor: '#FFFFFF',
                logging: true,
                onclone: function(clonedDoc) {
                    // Asegurar estilos consistentes en el clon
                    const containers = clonedDoc.querySelectorAll('.cell-container');
                    containers.forEach(container => {
                        container.style.display = 'flex';
                        container.style.justifyContent = 'center';
                        container.style.alignItems = 'center';
                    });

                    const contents = clonedDoc.querySelectorAll('.cell-content');
                    contents.forEach(content => {
                        content.style.display = 'flex';
                        content.style.alignItems = 'center';
                        content.style.justifyContent = 'center';
                        content.style.fontSize = '24px';
                        content.style.fontWeight = 'bold';
                        content.style.width = '100%';
                        content.style.height = '100%';
                    });
                }
            }).then(canvas => {
                const imgData = canvas.toDataURL("image/png");
                const imgWidth = pdfWidth - 2 * margin;
                const imgHeight = (canvas.height * imgWidth) / canvas.width;
                const yPos = (pdfHeight - imgHeight) / 2;

                doc.addImage(imgData, 'PNG', margin, yPos, imgWidth, imgHeight);
                doc.save("carton_bingo.pdf");

                // Restaurar los inputs después de la exportación
                $('.cell-content').each(function(index) {
                    if (index < originalValues.length) {
                        $(this).replaceWith(`
                            <input type="text"
                                   value="${originalValues[index]}"
                                   class="bingo-input cell-content"
                                   data-col="${$(this).closest('td').find('input').data('col') || ''}">
                        `);
                    }
                });

                const cell = document.createElement("td");
                if (r === 2 && c === 2 && isRandom) {
                    cell.textContent = "FREE";
                    cell.classList.add("free"); // 👈 importante
                } else {
                    cell.textContent = number;
                }


                // Reasignar eventos blur si es necesario
                if ($('#bingoCard').hasClass('custom-card')) {
                    $('.bingo-input').on('blur', function() {
                        validateInput(this);
                    });
                }
            }).catch(err => {
                console.error("Error en html2canvas:", err);
                alert("Error al exportar: " + err.message);

                // Intentar restaurar los inputs incluso si hay error
                $('.cell-content').each(function(index) {
                    if (index < originalValues.length) {
                        $(this).replaceWith(`
                            <input type="text"
                                   value="${originalValues[index]}"
                                   class="bingo-input cell-content"
                                   data-col="${$(this).closest('td').find('input').data('col') || ''}">
                        `);
                    }
                });
            });

        } catch (err) {
            console.error("Error en exportToPDF:", err);
            alert("Error al generar PDF: " + err.message);
        }
    }
});
