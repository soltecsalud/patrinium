<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PDF Interactivo en Navegador</title>
    <style>
        body { margin: 0; }
        #pdf-render { width: 100%; height: 100vh; border: 1px solid black; }
    </style>
</head>
<body>

    <canvas id="pdf-render"></canvas> <!-- Aquí se mostrará el PDF -->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.10.377/pdf.min.js"></script>

    <script>
        const url = '127.0.0.1/patrinium/views/PDF/Company_Information_Details_plantilla.pdf'; // Ruta del PDF en el servidor

        // Inicializar PDF.js
        const pdfjsLib = window['pdfjs-dist/build/pdf'];
        pdfjsLib.GlobalWorkerOptions.workerSrc = 'https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.10.377/pdf.worker.min.js';

        // Asignar el Canvas para renderizar el PDF
        const canvas = document.getElementById('pdf-render');
        const ctx = canvas.getContext('2d');

        // Cargar el PDF
        pdfjsLib.getDocument(url).promise.then(pdfDoc => {
            // Renderizar la primera página del PDF
            pdfDoc.getPage(1).then(page => {
                const viewport = page.getViewport({ scale: 1.5 }); // Aumenta la escala si es necesario
                canvas.height = viewport.height;
                canvas.width = viewport.width;

                const renderContext = {
                    canvasContext: ctx,
                    viewport: viewport
                };
                
                // Renderizar el PDF en el canvas
                page.render(renderContext).promise.then(function () {
                    console.log('PDF renderizado con éxito.');
                });
            }).catch(error => {
                console.error('Error al cargar la página del PDF: ', error);
            });
        }).catch(error => {
            console.error('Error al cargar el documento PDF: ', error);
        });
    </script>
</body>
</html>
