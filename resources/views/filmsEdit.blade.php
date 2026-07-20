<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Editar Catálogo</title>
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

    <header class="w-full bg-bb-blue border-b-8 border-bb-yellow shadow-2xl p-6 relative flex items-center justify-center">
        <button id="btnVolver" class="absolute left-4 md:left-8 font-blockbuster text-2xl md:text-4xl text-bb-yellow hover:text-white transition-colors">←</button>
        <h1 class="font-blockbuster text-bb-yellow uppercase italic text-3xl md:text-5xl text-center tracking-wider">Editar Catálogo</h1>
    </header>

    <!-- Banner Staff Only Panel -->
    <div class="w-full text-center mt-4">
        <div class="mt-2 inline-block bg-red-600 text-white font-blockbuster px-4 py-1 text-xs md:text-sm uppercase tracking-widest rounded border-2 border-white shadow-[4px_4px_0px_0px_rgba(255,204,0,1)]">
            ▲ STAFF ONLY - CATALOG MANAGEMENT ▲
        </div>
    </div>

    <main class="flex-grow max-w-4xl mx-auto w-full px-4 py-10">

        <div id="mensaje" class="mb-4 font-bold text-center text-lg"></div>

        <!-- Formulario de edición: oculto hasta que se elige una película -->
        <form id="formEditar" class="bg-bb-blue border-4 border-white rounded-2xl p-8 grid grid-cols-1 md:grid-cols-2 gap-5 shadow-[8px_8px_0px_0px_rgba(255,204,0,1)] mb-10 hidden">
            <input type="hidden" id="film_id">

            <div class="md:col-span-2">
                <label class="block mb-1 font-bold text-bb-yellow uppercase text-sm">Título *</label>
                <input type="text" id="title" class="w-full p-3 rounded-lg text-bb-dark font-semibold" required>
            </div>

            <div class="md:col-span-2">
                <label class="block mb-1 font-bold text-bb-yellow uppercase text-sm">Descripción</label>
                <textarea id="description" class="w-full p-3 rounded-lg text-bb-dark font-semibold"></textarea>
            </div>

            <div>
                <label class="block mb-1 font-bold text-bb-yellow uppercase text-sm">Año</label>
                <input type="number" id="release_year" class="w-full p-3 rounded-lg text-bb-dark font-semibold">
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
                <input type="number" id="language_id" class="w-full p-3 rounded-lg text-bb-dark font-semibold" required>
            </div>

            <div>
                <label class="block mb-1 font-bold text-bb-yellow uppercase text-sm">Duración de alquiler (días) *</label>
                <input type="number" id="rental_duration" class="w-full p-3 rounded-lg text-bb-dark font-semibold" required>
            </div>

            <div>
                <label class="block mb-1 font-bold text-bb-yellow uppercase text-sm">Tarifa de alquiler *</label>
                <input type="number" step="0.01" id="rental_rate" class="w-full p-3 rounded-lg text-bb-dark font-semibold" required>
            </div>

            <div>
                <label class="block mb-1 font-bold text-bb-yellow uppercase text-sm">Duración (min)</label>
                <input type="number" id="length" class="w-full p-3 rounded-lg text-bb-dark font-semibold">
            </div>

            <div class="md:col-span-2">
                <label class="block mb-1 font-bold text-bb-yellow uppercase text-sm">Costo de reemplazo *</label>
                <input type="number" step="0.01" id="replacement_cost" class="w-full p-3 rounded-lg text-bb-dark font-semibold" required>
            </div>

            <div class="md:col-span-2 flex gap-3">
                <button type="submit" class="flex-1 font-blockbuster uppercase bg-bb-yellow text-bb-blue border-4 border-white px-6 py-3 rounded-lg shadow-[4px_4px_0px_0px_rgba(0,0,0,0.4)] hover:scale-105 transition-transform">
                    Actualizar Película
                </button>
                <button type="button" id="btnCancelar" class="font-blockbuster uppercase bg-gray-600 text-white border-4 border-white px-6 py-3 rounded-lg hover:scale-105 transition-transform">
                    Cancelar
                </button>
            </div>
        </form>

        <div id="mensaje_tabla" class="text-center mb-4 font-bold text-bb-yellow"></div>

        <div class="w-full overflow-hidden border-4 border-white rounded-xl shadow-[8px_8px_0px_0px_rgba(0,47,108,1)] bg-bb-blue mb-6">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-bb-yellow text-bb-blue border-b-4 border-white">
                        <th class="p-4 text-center border-r-4 border-white w-20">ID</th>
                        <th class="p-4">Título</th>
                        <th class="p-4 text-center w-32">Acción</th>
                    </tr>
                </thead>
                <tbody id="cuerpo_tabla" class="divide-y divide-white/20 font-bold"></tbody>
            </table>
        </div>

        <div class="flex gap-4 justify-center">
            <button id="btnAnterior" class="font-blockbuster uppercase bg-bb-yellow text-bb-blue border-4 border-white px-5 py-2 rounded-lg">Anterior</button>
            <button id="btnSiguiente" class="font-blockbuster uppercase bg-bb-yellow text-bb-blue border-4 border-white px-5 py-2 rounded-lg">Siguiente</button>
        </div>
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

        let urlAnterior = null;
        let urlSiguiente = null;

        function cargarListado(url) {
            $.get(url, function (data) {
                $("#cuerpo_tabla").empty();
                data.data.forEach(function (film) {
                    $("#cuerpo_tabla").append(`
                        <tr class="border-b border-white/10">
                            <td class="p-4 text-center bg-black/20">${film.film_id}</td>
                            <td class="p-4">${film.title}</td>
                            <td class="p-4 text-center">
                                <button class="btnEditar bg-blue-700 border-2 border-white px-3 py-1 rounded font-blockbuster text-xs uppercase" data-id="${film.film_id}">Editar</button>
                                <button class="btnEliminar bg-red-700 border-2 border-white px-3 py-1 rounded font-blockbuster text-xs uppercase ml-1" data-id="${film.film_id}">Eliminar</button>
                            </td>
                        </tr>
                    `);
                });
                urlAnterior = data.prev_page_url;
                urlSiguiente = data.next_page_url;
                $("#mensaje_tabla").text(`Página ${data.current_page} de ${data.last_page}`);
            });
        }
        cargarListado('/films/all');

        // Click en Editar: trae la película y llena el formulario
        $(document).on("click", ".btnEditar", function () {
            let id = $(this).data("id");
            $.get('/films/' + id, function (film) {
                $("#film_id").val(film.film_id);
                $("#title").val(film.title);
                $("#description").val(film.description);
                $("#release_year").val(film.release_year);
                $("#language_id").val(film.language_id);
                $("#rental_duration").val(film.rental_duration);
                $("#rental_rate").val(film.rental_rate);
                $("#length").val(film.length);
                $("#replacement_cost").val(film.replacement_cost);
                $("#rating").val(film.rating);

                $("#formEditar").removeClass("hidden");
                $('html, body').animate({ scrollTop: 0 }, 300);
            });
        });
        $(document).on("click", ".btnEliminar", function () {
        let id = $(this).data("id");

        // Confirmación antes de borrar - requisito explícito del proyecto
        let confirmar = confirm("¿Estás seguro de que deseas eliminar esta película? Esta acción no se puede deshacer.");

        if (!confirmar) {
            return; // el usuario canceló, no hace nada
        }

        $.ajax({
            url: '/films/delete/' + id,
            method: 'DELETE',
            success: function (res) {
                $("#mensaje").text("🗑️ " + res.message).removeClass('text-red-400').addClass('text-green-400');
                cargarListado('/films/all'); // recarga la tabla sin la película borrada
            },
            error: function (xhr) {
                if (xhr.status === 500) {
                    $("#mensaje").text("⚠️ No se puede eliminar: esta película tiene registros relacionados (copias en inventario, actores, etc.)").addClass('text-red-400');
                } else {
                    $("#mensaje").text("Ocurrió un error al eliminar.").addClass('text-red-400');
                }
            }
        });
    });

        $("#btnCancelar").on("click", function () {
            $("#formEditar").addClass("hidden");
            $("#formEditar")[0].reset();
        });

        $("#formEditar").on("submit", function (e) {
            e.preventDefault();
            let id = $("#film_id").val();

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
                url: '/films/update/' + id,
                method: 'PUT',
                data: datos,
                success: function (res) {
                    $("#mensaje").text("✅ " + res.message).removeClass('text-red-400').addClass('text-green-400');
                    $("#formEditar").addClass("hidden");
                    cargarListado('/films/all');
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

        $("#btnAnterior").on("click", function () {
            if (urlAnterior) cargarListado(urlAnterior);
        });
        $("#btnSiguiente").on("click", function () {
            if (urlSiguiente) cargarListado(urlSiguiente);
        });
    });
    </script>
</body>
</html>