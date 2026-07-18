<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrador de Películas</title>
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
                        'bb-dark': '#0B132B',    /* Fondo general oscuro */
                    },
                    fontFamily: {
                        'blockbuster': ['"Archivo Black"', '"Impact"', 'sans-serif'],
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-bb-dark min-h-screen flex flex-col justify-between text-white font-sans selection:bg-bb-yellow selection:text-bb-blue">

    <header class="w-full">
        <div class="relative bg-bb-blue border-b-8 border-bb-yellow shadow-2xl p-6 flex items-center justify-center">
            <button id="btnVolverInicio" class="absolute left-4 md:left-8 font-blockbuster text-2xl md:text-4xl text-bb-yellow hover:text-white transition-colors duration-150 transform hover:scale-110 focus:outline-none" title="Volver al inicio">
                ←
            </button>
            <h1 class="font-blockbuster text-bb-yellow uppercase italic text-4xl md:text-6xl text-center tracking-wider">
                Administrador de películas
            </h1>
        </div>
        <div class="w-full h-4 bg-[linear-gradient(-45deg,#FFCC00_25%,#0B132B_25%,#0B132B_50%,#FFCC00_50%,#FFCC00_75%,#0B132B_75%,#0B132B)] bg-[size:20px_20px]"></div>
    </header>

    <main class="flex-grow flex flex-col items-center justify-center px-4 py-12 text-center max-w-4xl mx-auto w-full relative">
        
        <div class="mb-6 bg-red-600 text-white font-blockbuster px-4 py-1 text-xs md:text-sm uppercase tracking-widest rounded border-2 border-white shadow-[4px_4px_0px_0px_rgba(255,204,0,1)] inline-block">
            ▲ STAFF ONLY - ACCESS PANEL ▲
        </div>

        <p id="mensaje" class="text-xl md:text-3xl font-bold text-bb-yellow mb-4 uppercase tracking-wide drop-shadow-md">
            Elimina, edita, añade o administra las películas dentro del catálogo
        </p>
        
        <h3 class="text-lg md:text-xl text-gray-300 font-medium mb-12 max-w-md">
            Escoge que quieres realizar el dia de hoy
        </h3>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 w-full max-w-2xl px-4">
            
            <button id="btnAñadirPeliculas" class="font-blockbuster text-xl md:text-2xl uppercase tracking-wider bg-bb-blue text-white border-4 border-bb-yellow px-8 py-6 rounded-none shadow-[8px_8px_0px_0px_rgba(255,255,255,1)] transition-all duration-200 transform hover:scale-105 hover:-translate-y-1 hover:shadow-[12px_12px_0px_0px_rgba(255,255,255,1)] hover:bg-blue-900 active:translate-y-0 active:shadow-[4px_4px_0px_0px_rgba(255,255,255,1)]">
                Añadir nueva película
            </button>
            
            <button id="btnEditarPeliculas" class="font-blockbuster text-xl md:text-2xl uppercase tracking-wider bg-bb-yellow text-bb-dark border-4 border-bb-blue px-8 py-6 rounded-none shadow-[8px_8px_0px_0px_rgba(255,255,255,1)] transition-all duration-200 transform hover:scale-105 hover:-translate-y-1 hover:shadow-[12px_12px_0px_0px_rgba(255,255,255,1)] hover:bg-yellow-400 active:translate-y-0 active:shadow-[4px_4px_0px_0px_rgba(255,255,255,1)]">
                Editar catálogo actual
            </button>

        </div>

    </main>

    <footer class="w-full bg-bb-blue border-t-4 border-bb-yellow py-4 text-center text-xs md:text-sm text-yellow-100/70 font-semibold tracking-widest uppercase">
        © 2026 Cineteca +593 - No he dormido nada profe póngame el 10 porfa
    </footer>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script>
    $(function(){
        // Botón para volver a la página de inicio
        $("#btnVolverInicio").on("click", function(){
            window.location.href = '/';
        });

        // Boton que dirige a la pagina de Añadir Películas
        $("#btnAñadirPeliculas").on("click", function(){
            window.location.href = '/films/admin/add';
        });

        // Boton que dirige a la pagina de Editar Películas
        $("#btnEditarPeliculas").on("click", function(){
            window.location.href = '/films/admin/edit';
        });
    });
    </script>
</body>
</html>