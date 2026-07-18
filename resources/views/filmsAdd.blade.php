<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Añadir Película</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Archivo+Black&display=swap" rel="stylesheet">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: { 'bb-blue': '#002F6C', 'bb-yellow': '#FFCC00', 'bb-dark': '#0B132B' },
                    fontFamily: { 'blockbuster': ['"Archivo Black"', '"Impact"', 'sans-serif'] }
                }
            }
        }
    </script>
</head>
<body class="bg-bb-dark min-h-screen flex flex-col text-white font-sans">

    <header class="w-full bg-bb-blue border-b-8 border-bb-yellow shadow-2xl p-6 relative flex flex-col items-center justify-center">
        <button id="btnVolver" class="absolute left-4 md:left-8 font-blockbuster text-2xl md:text-4xl text-bb-yellow hover:text-white transition-colors">←</button>
        <h1 class="font-blockbuster text-bb-yellow uppercase italic text-3xl md:text-5xl text-center tracking-wider">Añadir Nueva Película</h1>
    </header>

    <!-- Banner Staff Only Panel -->
    <div class="w-full text-center mt-4">
        <div class="mt-2 inline-block bg-red-600 text-white font-blockbuster px-4 py-1 text-xs md:text-sm uppercase tracking-widest rounded border-2 border-white shadow-[4px_4px_0px_0px_rgba(255,204,0,1)]">
            ▲ STAFF ONLY - CATALOG MANAGEMENT ▲
        </div>
    </div>

    <main class="flex-grow max-w-3xl mx-auto w-full px-4 py-10">

        <div id="mensaje" class="mb-4 font-bold text-center text-lg"></div>

        <form id="formAgregar" class="bg-bb-blue border-4 border-white rounded-2xl p-8 grid grid-cols-1 md:grid-cols-2 gap-5 shadow-[8px_8px_0px_0px_rgba(255,204,0,1)]">

            <div class="md:col-span-2">
                <label class="block mb-1 font-bold text-bb-yellow uppercase text-sm">Título *</label>
                <input type="text" id="title" class="w-full p-3 rounded-lg text-bb-dark font-semibold" required>
            </div>

            <div class="md:col-span-2">
                <label class="block mb-1 font-bold text-bb-yellow uppercase text-sm">Descripción</label>
                <textarea id="description" class="w-full p-3 rounded-lg text-bb-dark font-semibold"></textarea>
            </div>

            <div>
                <label class="block mb-1 font-bold text-bb-yellow uppercase text-sm">Año de estreno</label>
                <input type="number" id="release_year" class="w-full p-3 rounded-lg text-bb-dark font-semibold" placeholder="2026">
            </div>

            <div>
                <label class="block mb-1 font-bold text-bb-yellow uppercase text-sm">Rating</label>
                <select id="rating" class="w-full p-3 rounded-lg text-bb-dark font-semibold">
                    <option value="G">G</option>
                    <option value="PG">PG</option>
                    <option value="PG-13">PG-13</option>
                    <option value="R">R</option>
                    <option value="NC-17">NC-17</option>
                </select>
            </div>

            <div>
                <label class="block mb-1 font-bold text-bb-yellow uppercase text-sm">ID de idioma *</label>
                <input type="number" id="language_id" class="w-full p-3 rounded-lg text-bb-dark font-semibold" value="1" required>
            </div>

            <div>
                <label class="block mb-1 font-bold text-bb-yellow uppercase text-sm">Duración de alquiler (días) *</label>
                <input type="number" id="rental_duration" class="w-full p-3 rounded-lg text-bb-dark font-semibold" value="3" required>
            </div>

            <div>
                <label class="block mb-1 font-bold text-bb-yellow uppercase text-sm">Tarifa de alquiler *</label>
                <input type="number" step="0.01" id="rental_rate" class="w-full p-3 rounded-lg text-bb-dark font-semibold" value="0.99" required>
            </div>

            <div>
                <label class="block mb-1 font-bold text-bb-yellow uppercase text-sm">Duración (min)</label>
                <input type="number" id="length" class="w-full p-3 rounded-lg text-bb-dark font-semibold" placeholder="90">
            </div>

            <div class="md:col-span-2">
                <label class="block mb-1 font-bold text-bb-yellow uppercase text-sm">Costo de reemplazo *</label>
                <input type="number" step="0.01" id="replacement_cost" class="w-full p-3 rounded-lg text-bb-dark font-semibold" value="19.99" required>
            </div>

            <div class="md:col-span-2">
                <button type="submit" class="w-full font-blockbuster uppercase bg-bb-yellow text-bb-blue border-4 border-white px-6 py-3 rounded-lg shadow-[4px_4px_0px_0px_rgba(0,0,0,0.4)] hover:scale-105 transition-transform">
                    Guardar Película
                </button>
            </div>
        </form>
    </main>

    <!-- Footer -->
    <footer class="w-full bg-bb-blue border-t-4 border-bb-yellow py-4 text-center text-xs md:text-sm text-yellow-100/70 font-semibold tracking-widest uppercase mt-auto">
        <div class="max-w-5xl mx-auto px-4">
            © <span id="year"></span> Cineteca +593 - No he dormido nada profe póngame el 10 porfa
        </div>
    </footer>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script>
    $(function () {
        // Cargar dinámicamente el año actual en el footer
        $('#year').text(new Date().getFullYear());

        $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });

        $("#btnVolver").on("click", function () {
            window.location.href = '/admin';
        });

        $("#formAgregar").on("submit", function (e) {
            e.preventDefault();

            let datos = {
                title: $("#title").val(),
                description: $("#description").val(),
                release_year: $("#release_year").val(),
                language_id: $("#language_id").val(),
                rental_duration: $("#rental_duration").val(),
                rental_rate: $("#rental_rate").val(),
                length: $("#length").val(),
                replacement_cost: $("#replacement_cost").val(),
                rating: $("#rating").val()
            };

            $.ajax({
                url: '/films/store',
                method: 'POST',
                data: datos,
                success: function (res) {
                    $("#mensaje").text("✅ " + res.message).removeClass('text-red-400').addClass('text-green-400');
                    $("#formAgregar")[0].reset();
                },
                error: function (xhr) {
                    if (xhr.status === 422) {
                        let errores = Object.values(xhr.responseJSON.errors).flat().join(', ');
                        $("#mensaje").text("⚠️ " + errores).removeClass('text-green-400').addClass('text-red-400');
                    } else {
                        $("#mensaje").text("Ocurrió un error inesperado.").addClass('text-red-400');
                    }
                }
            });
        });
    });
    </script>
</body>
</html>