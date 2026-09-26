<!DOCTYPE html>
<html lang="es" class="dark">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>404 - Acceso Denegado</title>

  <!-- Tailwind CSS CDN -->
  <script src="https://cdn.tailwindcss.com"></script>

  <!-- Fuente Inter desde Google Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700;800;900&display=swap" rel="stylesheet">

  <style>
    /* Aplicar la fuente como predeterminada */
    body {
      font-family: 'Inter', sans-serif;
    }
  </style>
</head>
<body class="bg-slate-950 text-slate-100 antialiased selection:bg-red-500 selection:text-white">

  <!-- Pantalla 404 -->
  <div class="relative min-h-screen w-full flex flex-col items-center justify-center overflow-hidden select-none">
    
    <!-- Efectos de Fondo (Luz Neón y Luces Glitch) -->
    <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[350px] sm:w-[500px] h-[350px] sm:h-[500px] bg-gradient-to-tr from-red-600/30 to-violet-600/30 blur-[120px] sm:blur-[140px] rounded-full pointer-events-none"></div>
    <div class="absolute inset-0 bg-[radial-gradient(#1e293b_1px,transparent_1px)] [background-size:24px_24px] opacity-40 pointer-events-none"></div>

    <!-- Contenido Principal -->
    <div class="relative z-10 text-center px-6 max-w-4xl mx-auto">
      
      <!-- Tag Agresivo Superpuesto -->
      <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full border border-red-500/30 bg-red-950/40 text-red-400 text-xs md:text-sm font-mono tracking-widest uppercase mb-6 backdrop-blur-md shadow-[0_0_15px_rgba(239,68,68,0.2)]">
        <span class="w-2 h-2 rounded-full bg-red-500 animate-ping"></span>
        Error de Sistema // Acceso Denegado
      </div>

      <!-- Número 404 Gigante -->
      <h1 class="text-8xl sm:text-[13rem] font-black tracking-tighter leading-none text-transparent bg-clip-text bg-gradient-to-b from-white via-slate-200 to-red-600 drop-shadow-[0_10px_35px_rgba(225,29,72,0.4)]">
        404
      </h1>

      <!-- Título Impactante -->
      <h2 class="text-2xl sm:text-4xl font-extrabold text-white tracking-tight uppercase mt-2 mb-4">
        Te has adentrado en el <span class="text-transparent bg-clip-text bg-gradient-to-r from-red-500 to-violet-500">Vacío Indebido</span>
      </h2>

      <!-- Subtexto -->
      <p class="text-slate-400 text-base sm:text-lg max-w-lg mx-auto mb-10 font-normal leading-relaxed">
        Las coordenadas solicitadas no existen o fueron exterminadas. Regresa antes de que la brecha se cierre definitivamente.
      </p>

      <!-- Botones de Acción -->
      <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
        
        <!-- Botón Primario -->
        <a href="{{ route('post.index') }}" class="w-full sm:w-auto px-8 py-4 rounded-xl bg-gradient-to-r from-red-600 to-violet-600 text-white font-bold tracking-wide uppercase text-sm shadow-[0_0_25px_rgba(225,29,72,0.5)] hover:shadow-[0_0_35px_rgba(225,29,72,0.8)] hover:scale-105 transition-all duration-300 active:scale-95 text-center">
          Evacuar al Inicio
        </a>

        <!-- Botón Secundario -->
        <a href="#" class="w-full sm:w-auto px-8 py-4 rounded-xl border border-slate-700 bg-slate-900/50 hover:bg-slate-800/80 text-slate-300 hover:text-white font-bold tracking-wide uppercase text-sm backdrop-blur-md hover:border-slate-500 transition-all duration-300 text-center">
          Reportar Anomalía
        </a>

      </div>

    </div>

    <!-- Detalle Inferior Tipo Terminal -->
    <div class="absolute bottom-6 left-1/2 -translate-x-1/2 text-slate-600 text-xs font-mono tracking-widest uppercase">
      SYS_ERR_CODE: 0x800404_NULL_POINTER
    </div>

  </div>

</body>
</html>