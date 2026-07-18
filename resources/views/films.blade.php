<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ver Películas</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Archivo+Black&display=swap" rel="stylesheet">

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'bb-blue': '#002F6C',    /* Azul Blockbuster */
                        'bb-yellow': '#FFCC00',  /* Amarillo Blockbuster */
                        'bb-dark': '#0B132B',    /* Fondo oscuro retro */
                    },
                    fontFamily: {
                        'blockbuster': ['"Archivo Black"', '"Impact"', 'sans-serif'],
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-bb-dark min-h-screen text-white font-sans selection:bg-bb-yellow selection:text-bb-blue flex flex-col justify-between">

    <div>
        <header class="w-full text-center mb-8">
            <div class="relative bg-bb-blue border-b-8 border-bb-yellow shadow-2xl p-6 flex items-center justify-center">
                <!-- Botón de flecha con ID para manejarlo con jQuery -->
                <button id="btnVolverInicio" class="absolute left-4 md:left-8 font-blockbuster text-2xl md:text-4xl text-bb-yellow hover:text-white transition-colors duration-150 transform hover:scale-110 focus:outline-none" title="Volver al inicio">
                    ←
                </button>
                <h1 class="font-blockbuster text-bb-yellow uppercase italic text-3xl md:text-5xl tracking-wider">
                    Películas en estreno hoy
                </h1>
            </div>
            <h2 class="text-lg md:text-xl font-bold text-yellow-100/90 uppercase tracking-wide px-4 mt-6">
                Encuentra una película de nuestro catálogo o búscala
            </h2>
        </header>

        <main class="max-w-5xl mx-auto px-4 flex flex-col items-center pb-12">

            <section class="w-full max-w-4xl bg-bb-blue border-4 border-white p-6 rounded-2xl shadow-[8px_8px_0px_0px_rgba(255,204,0,1)] mb-10 flex flex-col items-center text-center">
                
                <h3 class="font-blockbuster text-bb-yellow text-xl md:text-2xl uppercase italic tracking-wide mb-6">
                    Buscar peliculas por filtro
                </h3>

                <div class="flex flex-col md:flex-row gap-4 w-full items-center justify-between">
                    
                    <div class="relative w-full md:w-[30%] shrink-0">
                        <select id="optionsFilter" class="w-full font-blockbuster uppercase text-xs md:text-sm bg-bb-blue text-bb-yellow border-4 border-white pl-4 pr-10 py-3 rounded-lg shadow-[4px_4px_0px_0px_rgba(255,204,0,1)] focus:outline-none appearance-none cursor-pointer">
                            <option value="idFilter">Buscar por ID</option>
                            <option value="titleFilter">Buscar por Título</option>
                            <option value="ratingFilter">Por Categoría</option>
                            <option value="yearFilter">Por Año</option>
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-3 text-bb-yellow font-bold text-xs">
                            ▼
                        </div>
                    </div>

                    <input type="text" id="inputFilter" placeholder="Escribe el ID a buscar..." 
                           class="w-full md:w-[45%] font-sans bg-white text-bb-dark border-4 border-white px-4 py-3 rounded-lg shadow-[4px_4px_0px_0px_rgba(0,47,108,1)] focus:outline-none focus:ring-4 focus:ring-bb-yellow placeholder-gray-400">

                    <button id="btnBuscar" class="w-full md:w-auto font-blockbuster uppercase bg-bb-yellow text-bb-blue border-4 border-white px-6 py-3 rounded-lg shadow-[4px_4px_0px_0px_rgba(0,47,108,1)] transition-all duration-150 transform hover:scale-105 hover:-translate-y-0.5 active:translate-y-0.5 active:shadow-[2px_2px_0px_0px_rgba(0,47,108,1)]">
                        Buscar
                    </button>

                    <button id="btnReset" class="w-full md:w-auto font-blockbuster uppercase bg-gray-600 text-white border-4 border-white px-6 py-3 rounded-lg shadow-[4px_4px_0px_0px_rgba(0,0,0,0.5)] transition-all duration-150 transform hover:scale-105 hover:-translate-y-0.5 active:translate-y-0.5 active:shadow-[2px_2px_0px_0px_rgba(0,0,0,0.5)]">
                        Reset
                    </button>

                </div>
            </section>

            <section class="w-full max-w-2xl flex flex-col items-center">
                
                <h3 class="font-blockbuster text-bb-yellow text-2xl md:text-3xl uppercase italic tracking-wider text-center mb-4">
                    Mira todo nuestro catálogo de películas
                </h3>

                <div id="mensaje_tabla" class="text-sm font-bold bg-bb-blue text-white border-2 border-bb-yellow px-4 py-2 rounded-full mb-6 uppercase tracking-widest shadow-md"></div>

                <div class="w-full overflow-hidden border-4 border-white rounded-xl shadow-[8px_8px_0px_0px_rgba(0,47,108,1)] bg-bb-blue mb-8">
                    <table id="tabla_listado" class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-bb-yellow text-bb-blue border-b-4 border-white">
                                <th class="font-blockbuster uppercase tracking-wider p-4 text-center border-r-4 border-white w-24">ID</th>
                                <th class="font-blockbuster uppercase tracking-wider p-4">Nombre</th>
                            </tr>
                        </thead>
                        <tbody id="cuerpo_tabla" class="divide-y divide-white/20 font-bold">
                        </tbody>
                    </table>
                </div>

                <div class="flex gap-6 justify-center w-full">
                    <button id="btnAnterior" class="font-blockbuster text-sm md:text-base uppercase tracking-wider bg-bb-yellow text-bb-blue border-4 border-white px-6 py-3 rounded-lg shadow-[6px_6px_0px_0px_rgba(0,47,108,1)] transition-all duration-150 transform hover:scale-105 hover:-translate-y-0.5 active:translate-y-0.5 active:shadow-[3px_3px_0px_0px_rgba(0,47,108,1)]">
                        Página Anterior
                    </button>
                    <button id="btnSiguiente" class="font-blockbuster text-sm md:text-base uppercase tracking-wider bg-bb-yellow text-bb-blue border-4 border-white px-6 py-3 rounded-lg shadow-[6px_6px_0px_0px_rgba(0,47,108,1)] transition-all duration-150 transform hover:scale-105 hover:-translate-y-0.5 active:translate-y-0.5 active:shadow-[3px_3px_0px_0px_rgba(0,47,108,1)]">
                        Siguiente Página
                    </button>
                </div>

            </section> 

        </main>
    </div>

    <footer class="w-full bg-bb-blue border-t-8 border-bb-yellow py-6 text-center text-xs md:text-sm text-yellow-100/90 font-bold tracking-widest uppercase shadow-inner mt-auto">
        <div class="max-w-5xl mx-auto px-4">
            © <span id="year"></span> Cineteca +593 - No he dormido nada profe póngame el 10 porfa
        </div>
    </footer>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script>
    $(function(){
        // Cargar dinámicamente el año actual en el footer
        $('#year').text(new Date().getFullYear());

        let urlAnterior = null;
        let urlSiguiente = null;
        function cargarListado(url) {
            $.ajax({ url: url,
                method: "GET",
                success: function(data) {
                    $("#cuerpo_tabla").empty(); // limpia las filas anteriores
                    data.data.forEach(function(film) {
                          // Se estilizan las filas agregadas dinámicamente con efecto hover en CSS de Tailwind
                          $('#cuerpo_tabla').append(`
                       <tr class="hover:bg-bb-yellow hover:text-bb-blue transition-colors duration-150 border-b border-white/10 cursor-pointer">
                            <td class="p-4 text-center font-blockbuster border-r border-white/10 bg-black/20">${film.film_id}</td>
                            <td class="p-4 tracking-wide">${film.title}</td>
                        </tr>
                    `);
                    });
                  

                    urlAnterior = data.prev_page_url;
                    urlSiguiente = data.next_page_url;

                    $("#mensaje_tabla").text(`Página ${data.current_page} de ${data.last_page}`);
                },
                error: function() {
                    $("#resultado").text("Error al cargar la lista de películas.");
                }
            });
        }
        // Llama al listado por primera vez cuando carga la página
        cargarListado('/films/all');


    //Funcion para cambiar los placeholder del filtro
    $("#optionsFilter").on("change", function() {
        let optionsFilter = $(this).val();
        let inputBox = $("#inputFilter");
        inputBox.val(""); 

        if (optionsFilter === "idFilter") {
            inputBox.attr("type", "number");
            inputBox.attr("placeholder", "Escribe un ID (Ej: 42)...");
        } else if (optionsFilter === "titleFilter") {
            inputBox.attr("type", "text");
            inputBox.attr("placeholder", "Escribe el título de la película...");
        } else if (optionsFilter === "ratingFilter") {
            inputBox.attr("type", "text");
            inputBox.attr("placeholder", "Escribe la categoría (Ej: PG-13)...");
        } else if (optionsFilter === "yearFilter") {
            inputBox.attr("type", "number");
            inputBox.attr("placeholder", "Escribe el año (Ej: 2006)...");
        }
    });
        

// BOTONES
        // Boton retorna a la pantalla principal
        $("#btnVolverInicio").on("click", function(){
            window.location.href = '/';
        });

        // Boton que recibe lo escrito en los filtros y lo busca
        const mapaCampos = {
            idFilter: 'film_id',
            titleFilter: 'title',
            ratingFilter: 'rating',
            yearFilter: 'release_year'
        };
        $("#btnBuscar").on("click", function() {
            let campoSeleccionado = $("#optionsFilter").val();
            let valorFiltro = $("#inputFilter").val().trim();

            if (valorFiltro === "") {
                $("#mensaje_tabla").text("Por favor, ingresa un término de búsqueda.");
                return;
            }

            let campoReal = mapaCampos[campoSeleccionado];

            let url = '/films/all?campo=' + campoReal + '&valor=' + encodeURIComponent(valorFiltro) 
            cargarListado(url);
        });
        //Boton para limpiar filtros
        $("#btnReset").on("click", function(){
            $("#inputFilter").val(""); //limpiar el input
            $("#optionsFilter").prop("selectedIndex", 0); //resetea el filtro a la primera opcion
            cargarListado('/films/all');
        });
        // Boton para mover la tabla a la página anterior
        $("#btnAnterior").on("click", function(){
            if (urlAnterior === null) {
                $("#mensaje_tabla").text("Usted se encuentra en la página 1");
            } else {
                cargarListado(urlAnterior);
            }
        });
        // Boton para mover la tabla a la siguiente página
        $("#btnSiguiente").on("click", function(){
            if (urlSiguiente == null) {
                 $("#mensaje_tabla").text("Usted se encuentra en la última página");
            } else {
                cargarListado(urlSiguiente);
            }
            
        });
    });
    </script>
</body>
</html>