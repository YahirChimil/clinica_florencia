<?= $this->extend('plantilla') ?>
<?= $this->section('contenido') ?>
<?php if (session()->getFlashdata('error') || session()->getFlashdata('mensaje')): ?>
    <div class="alert alert-<?= session()->getFlashdata('error') ? 'danger' : 'success' ?>">
        <?= session()->getFlashdata('error') ?? session()->getFlashdata('mensaje') ?>
    </div>
<?php endif; ?>



<div class="max-w-5xl mx-auto ">
    <div class="flex flex-col md:flex-row gap-6">

        <!-- Formulario para ver citas por fecha -->
        <form action="<?= base_url('citas') ?>" method="get" class="flex-1 bg-white p-6 rounded shadow space-y-4">
            <h3 class="text-lg font-semibold text-[#09476e]">Ver citas por fecha</h3>
            <label for="fecha" class="text-sm font-medium text-gray-700 block">Selecciona una fecha:</label>
            <input type="date" id="fecha" name="fecha" class=" w-full px-3 py-2 border border-gray-300 rounded-md" value="<?= esc($fechaSeleccionada) ?>" required>
            <button type="submit" class="mt-2 bg-[#09476e] text-white px-4 py-2 rounded hover:bg-[#0c3c4b] transition">Ver citas</button>
        </form>

        <!-- Formulario para guardar días no laborables -->
        <form action="<?= base_url('citas/guardar-dias-no-laborables') ?>" method="post" class="flex-1 bg-white p-6 rounded shadow space-y-4">
            <h3 class="text-lg font-semibold text-[#09476e]">Registrar días no laborables</h3>
            <label for="dias_no_laborables" class="text-sm font-medium text-gray-700 block">Selecciona los días no laborables:</label>
            <input type="text" id="dias_no_laborables" name="dias_no_laborables" class="datepicker-multiple w-full px-3 py-2 border border-gray-300 rounded-md" placeholder="Haz clic para seleccionar fechas" readonly>
            <button type="submit" class="mt-2 bg-[#09476e] text-white px-4 py-2 rounded hover:bg-[#0c3c4b] transition">Guardar días</button>
        </form>

    </div>
</div>




<!-- Título de la fecha seleccionada -->
<h2 class="text-center text-lg font-semibold text-[#09476e] mt-8 mb-4">
    Citas para el día <?= date('d/m/Y', strtotime($fechaSeleccionada)) ?>
</h2>

<!-- Tabla de citas -->
<div class="overflow-x-auto my-5 flex justify-center">
  <table class="max-w-4xl w-full text-sm text-left text-gray-700 border border-gray-200 shadow-md rounded-lg overflow-hidden">
    <thead class="bg-sky-900 text-white">
      <tr>
        <th class="px-6 py-3">ID</th>
        <th class="px-6 py-3">Paciente</th>
        <th class="px-6 py-3">Fecha</th>
        <th class="px-6 py-3">Hora</th>
        <th class="px-6 py-3">Motivo</th>
        <th class="px-6 py-3">Correo</th>
      </tr>
    </thead>
    <tbody class="bg-white divide-y divide-gray-200">
      <?php if (empty($citas)): ?>
          <tr><td colspan="6" class="text-center py-4 text-gray-500 ">No hay citas para esta fecha.</td></tr>
      <?php else: ?>
          <?php foreach ($citas as $cita): ?>
            <tr class="hover:bg-gray-100 transition duration-200 fila-cita"
            data-fecha-hora="<?= esc($cita['fecha']) . ' ' . esc($cita['hora']) ?>">

            <td class="px-6 py-4"><?= esc($cita['id']) ?></td>
            <td class="px-6 py-4"><?= esc($cita['nombre_paciente']) ?></td>
            <td class="px-6 py-4"><?= esc($cita['fecha']) ?></td>
            <td class="px-6 py-4"><?= esc($cita['hora']) ?></td>
            <td class="px-6 py-4"><?= esc($cita['motivo']) ?></td>
            <td class="px-6 py-4"><?= esc($cita['correo']) ?></td>
          </>
          <?php endforeach; ?>
      <?php endif; ?>
    </tbody>
  </table>
</div>
<script>
$(function() {
    

    // Obtener los días no laborables desde el backend
    $.getJSON('<?= base_url('citas/dias-no-laborables') ?>', function(diasNoLaborables) {
        $(".datepicker-single").datepicker({
            dateFormat: "yy-mm-dd",
            minDate: 0, // desde hoy en adelante
            beforeShowDay: function(date) {
                const day = date.getDay();
                const formattedDate = $.datepicker.formatDate('yy-mm-dd', date);

                const isDomingo = day === 0;
                const esNoLaborable = diasNoLaborables.includes(formattedDate);

                return [!isDomingo && !esNoLaborable];
            }
        });
    });
});
</script>
<style>
    .ui-datepicker td.selected-date a {
        background: #ef4444 !important; /* rojo tailwind */
        color: white !important;
        border-radius: 50%;
    }
</style>

<script>
$(function () {
    $.datepicker.setDefaults($.datepicker.regional['es']);

    let diasSeleccionados = new Set();

    $.getJSON("<?= base_url('citas/dias-no-laborables') ?>", function (diasDesdeBackend) {
        diasDesdeBackend.forEach(fecha => diasSeleccionados.add(fecha));

        $(".datepicker-multiple").datepicker({
            dateFormat: 'yy-mm-dd',
            minDate: 0,
            showAnim: '',
            beforeShow: function(input, inst) {
                setTimeout(() => $('.ui-datepicker').css('z-index', 9999), 0);
            },
            beforeShowDay: function (date) {
                const day = date.getDay();
                const fecha = $.datepicker.formatDate('yy-mm-dd', date);

                const activo = day !== 0;
                const marcado = diasSeleccionados.has(fecha);
                const clase = marcado ? 'selected-date' : '';
                return [activo, clase];
            },
            onSelect: function (fechaSeleccionada, inst) {
    const currentMonth = inst.drawMonth;
    const currentYear = inst.drawYear;

    // Alternar selección
    if (diasSeleccionados.has(fechaSeleccionada)) {
        diasSeleccionados.delete(fechaSeleccionada);
    } else {
        diasSeleccionados.add(fechaSeleccionada);
    }

    // Actualizar input y refrescar visual
    $("#dias_no_laborables").val(Array.from(diasSeleccionados).join(','));
    $(".datepicker-multiple").datepicker('refresh');

    // Mantener el mes y año visibles sin cambiar selección
    const currentDate = new Date(currentYear, currentMonth, 1);
    $(".datepicker-multiple").datepicker('gotoDate', currentDate);

    // Reenfocar
    setTimeout(() => $(".datepicker-multiple").focus(), 0);
}
,

            onClose: function () {
                return false;
            }
        });

        $("#dias_no_laborables").val(Array.from(diasSeleccionados).join(','));
    });
});


</script>
<script>
function resaltarProximaCita() {
    const ahora = new Date();
    let proximaFila = null;
    let menorDiferencia = Infinity;

    $('.fila-cita').removeClass('proxima-cita'); // Limpia resaltado anterior

    $('.fila-cita').each(function () {
        const fila = $(this);
        const fechaHoraStr = fila.data('fecha-hora');
        if (!fechaHoraStr) return;

        const citaDate = new Date(fechaHoraStr.replace(' ', 'T'));
        const diferencia = citaDate - ahora;

        if (diferencia >= 0 && diferencia < menorDiferencia) {
            menorDiferencia = diferencia;
            proximaFila = fila;
        }
    });

    if (proximaFila) {
        proximaFila.addClass('proxima-cita');
    }
}

$(function () {
    resaltarProximaCita(); // Ejecutar al cargar
    setInterval(resaltarProximaCita, 60000); // Repetir cada minuto
});
</script>

<style>
.proxima-cita {
    background-color: #d1fae5 !important; /* verde claro */
    border-left: 5px solid #10b981;
    font-weight: bold;
}
</style>




<?= $this->endSection() ?>








