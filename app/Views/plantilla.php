<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title><?= isset($titulo) ? $titulo : 'Mi App' ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- jQuery -->
    <!-- jQuery -->
<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- jQuery UI -->
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
<!-- Plugin MultiDatesPicker -->
<script src="https://cdn.jsdelivr.net/gh/dubrox/Multiple-Dates-Picker-for-jQuery-UI@master/jquery-ui.multidatespicker.js"></script>

<!-- Localización en español -->
<script src="<?= base_url('js/datepicker-es.js') ?>"></script>





</head>
<body class="bg-gray-100 text-gray-800 min-h-screen flex flex-col">

    <!-- NAVBAR -->
    <nav class="bg-[#09476e] py-4 shadow">
        <div class="container mx-auto px-4 flex items-center justify-between">
            <!-- LOGO -->
            <div class="flex items-center gap-3">
            <a href="<?= base_url('/') ?>">
            <img src="<?= base_url('/src/logo_clinica2.png') ?>" alt="Logo" class="h-20">
                </a>

            </div>

            <!-- TÍTULO -->
            <h1 class="text-white text-3xl font-bold tracking-wide">CLINICA FLORENCIA</h1>

            <!-- BOTÓN DE INICIO DE SESIÓN -->
            <a href="<?= site_url('login') ?>" class="bg-[#09476e] hover:bg-[#0c3c4b] text-white px-4 py-2 rounded-md">
                Inicio de sesión
            </a>
        </div>
    </nav>

    <!-- CONTENIDO GENERAL CON SIDEBAR -->
    <div class="flex flex-1">
        <!-- SIDEBAR -->
        <aside class="w-64 bg-white shadow-lg border-r border-gray-200 hidden md:block">
            <div class="p-6">
                <h2 class="text-xl font-semibold text-[#09476e] mb-6">Menú</h2>
                <ul class="space-y-3">
                <li>
                        <a href="<?= base_url('citas') ?>" class="block text-gray-700 hover:bg-gray-100 px-4 py-2 rounded transition">Citas</a>
                    </li>
                    <li>
                        <a href="<?= base_url('citas/new') ?>" class="block text-gray-700 hover:bg-gray-100 px-4 py-2 rounded transition">Agendar cita</a>
                    </li>
                    <li>
                        <a href="<?= site_url('citas/cancelar-cita') ?>" class="block text-gray-700 hover:bg-gray-100 px-4 py-2 rounded transition">cancelar cita</a>
                    </li>
                    
            </div>
        </aside>

        <!-- MAIN CONTENT -->
        <main class="flex-1 p-6">
            <?= $this->renderSection('contenido') ?>
        </main>
    </div>

</body>
</html>
