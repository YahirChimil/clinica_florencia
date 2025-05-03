<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title><?= isset($titulo) ? $titulo : 'Mi App' ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/alpinejs" defer></script> <!-- <- AlpineJS -->

    <!-- jQuery y otros -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
    <script src="https://cdn.jsdelivr.net/gh/dubrox/Multiple-Dates-Picker-for-jQuery-UI@master/jquery-ui.multidatespicker.js"></script>
    <script src="<?= base_url('js/datepicker-es.js') ?>"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">

</head>

<body class="bg-gray-100 text-gray-800 min-h-screen flex flex-col" x-data="{ open: false }">

    <!-- NAVBAR -->
    <nav class="bg-[#09476e] py-4 shadow">
        <div class="container mx-auto px-4 flex items-center justify-between">
            
           <!-- Logo + Titulo -->
<div class="flex items-center gap-3">
    <a href="<?= base_url('/') ?>">
        <img src="<?= base_url('/src/logo_clinica2.png') ?>" alt="Logo" class="h-16">
    </a>
    <h1 class="text-white text-2xl font-bold tracking-wide hidden md:block" style="font-family: 'Poppins', sans-serif;">CLINICA FLORENCIA</h1>
</div>

<!-- Titulo visible SOLO en móvil -->
<h1 class="text-white text-xl font-bold tracking-wide block md:hidden text-center mt-2" style="font-family: 'Poppins', sans-serif;">CLINICA FLORENCIA</h1>


            <!-- Botón Hamburguesa en Móvil -->
            <div class="md:hidden">
                <button @click="open = !open" class="text-white focus:outline-none">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                              d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
            </div>

            <!-- OPCIONES en Desktop -->
            <div class="hidden md:flex space-x-4 items-center">
                <?php if (auth()->loggedIn()): ?>
                    <a href="<?= site_url('/logout') ?>" 
                       class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-md transition-all">
                        Cerrar sesión
                    </a>
                <?php else: ?>
                    <a href="<?= site_url('/login') ?>" 
                       class="bg-[#0c3c4b] hover:bg-[#0d4d63] text-white px-4 py-2 rounded-md flex items-center gap-2 transition-all">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                  d="M15 12H3m12 0l-4-4m4 4l-4 4m10-4a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        Inicio de sesión
                    </a>
                <?php endif; ?>
            </div>
        </div>

        <!-- MENÚ RESPONSIVE para móviles -->
        <div x-show="open" class="md:hidden bg-[#09476e] px-4 py-2 space-y-2">
            <nav class="space-y-2">
                <a href="<?= base_url('citas') ?>" class="block text-white hover:bg-blue-700 px-4 py-2 rounded">Citas</a>
                <a href="<?= base_url('citas/new') ?>" class="block text-white hover:bg-blue-700 px-4 py-2 rounded">Agendar cita</a>
                <a href="<?= site_url('citas/cancelar-cita') ?>" class="block text-white hover:bg-blue-700 px-4 py-2 rounded">Cancelar cita</a>

                <div class="border-t border-white my-2"></div>

                <?php if (auth()->loggedIn()): ?>
                    <a href="<?= site_url('/logout') ?>" 
                       class="block text-white hover:bg-red-700 px-4 py-2 rounded">
                        Cerrar sesión
                    </a>
                <?php else: ?>
                    <a href="<?= site_url('/login') ?>" 
                       class="block text-white hover:bg-blue-700 px-4 py-2 rounded">
                        Inicio de sesión
                    </a>
                <?php endif; ?>
            </nav>
        </div>
    </nav>

    <!-- CONTENIDO GENERAL -->
    <div class="flex flex-1">
        <!-- SIDEBAR Desktop SOLAMENTE -->
        <aside class="w-64 bg-white shadow-lg border-r border-gray-200 hidden md:block">
            <div class="p-6">
                <h2 class="text-xl font-semibold text-[#09476e] mb-6">Menú</h2>
                <ul class="space-y-3">
                    <li><a href="<?= base_url('citas') ?>" class="block text-gray-700 hover:bg-gray-100 px-4 py-2 rounded transition">Citas</a></li>
                    <li><a href="<?= base_url('citas/new') ?>" class="block text-gray-700 hover:bg-gray-100 px-4 py-2 rounded transition">Agendar cita</a></li>
                    <li><a href="<?= site_url('citas/cancelar-cita') ?>" class="block text-gray-700 hover:bg-gray-100 px-4 py-2 rounded transition">Cancelar cita</a></li>
                </ul>
            </div>
        </aside>

        <!-- MAIN CONTENT -->
        <main class="flex-1 p-6">
            <?= $this->renderSection('contenido') ?>
        </main>
    </div>

</body>
</html>
