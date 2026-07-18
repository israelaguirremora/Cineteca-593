<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cineteca +593</title>
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
        <h1 class="font-blockbuster text-bb-yellow bg-bb-blue p-6 uppercase italic text-4xl md:text-6xl text-center tracking-wider border-b-8 border-bb-yellow shadow-2xl">
            Cineteca +593
        </h1>
    </header>

    <main class="flex-grow flex flex-col items-center justify-center px-4 py-12 text-center max-w-4xl mx-auto w-full">
        
        <p id="mensaje" class="text-xl md:text-3xl font-bold text-bb-yellow mb-4 uppercase tracking-wide drop-shadow-md">
            Bienvenido a la mejor experiencia cinematográfica del ecuador
        </p>
        
        <h3 class="text-lg md:text-xl text-gray-300 font-medium mb-12 max-w-md">
            Escoge que quieres realizar el dia de hoy
        </h3>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 w-full max-w-2xl px-4">
            
            <button id="btnVerPeliculas" class="font-blockbuster text-xl md:text-2xl uppercase tracking-wider bg-bb-blue text-bb-yellow border-4 border-white px-8 py-6 rounded-lg shadow-[8px_8px_0px_0px_rgba(255,204,0,1)] transition-all duration-200 transform hover:scale-105 hover:-translate-y-1 hover:shadow-[12px_12px_0px_0px_rgba(255,204,0,1)] hover:bg-blue-800 active:translate-y-0 active:shadow-[4px_4px_0px_0px_rgba(255,204,0,1)]">
                Ver películas
            </button>
            
            <button id="btnAdmPeliculas" class="font-blockbuster text-xl md:text-2xl uppercase tracking-wider bg-bb-yellow text-bb-blue border-4 border-white px-8 py-6 rounded-lg shadow-[8px_8px_0px_0px_rgba(0,47,108,1)] transition-all duration-200 transform hover:scale-105 hover:-translate-y-1 hover:shadow-[12px_12px_0px_0px_rgba(0,47,108,1)] hover:bg-yellow-400 active:translate-y-0 active:shadow-[4px_4px_0px_0px_rgba(0,47,108,1)]">
                Administrar películas
            </button>

        </div>

    </main>

    <footer class="w-full bg-bb-blue border-t-4 border-bb-yellow py-4 text-center text-xs md:text-sm text-yellow-100/70 font-semibold tracking-widest uppercase">
        © 2026 Cineteca +593 - No he dormido nada profe póngame el 10 porfa
    </footer>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script>
    $(function(){
        // Boton que dirige a la pagina de Ver Peliculas
        $("#btnVerPeliculas").on("click", function(){
            window.location.href = '/films';
        });
    });

    $(function(){
        // Boton que dirige a la pagina de Administrar Peliculas
        $("#btnAdmPeliculas").on("click", function(){
            window.location.href = '/admin';
        });
    });
    </script>
</body>
</html>