<?= $this->extend('plantilla') ?>
<?= $this->section('contenido') ?>

<div class="max-w-lg mx-auto mt-10 bg-white p-6 rounded shadow">
    <h2 class="text-2xl font-semibold text-center mb-6">Cancelar Cita</h2>

    <?php if (session()->getFlashdata('mensaje')): ?>
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-2 rounded mb-4">
            <?= session()->getFlashdata('mensaje') ?>
        </div>
    <?php endif; ?>

    <form action="<?= site_url('citas/cancelar-cita') ?>" method="post" onsubmit="return confirmarCancelacion();">
        <div class="mb-4">
            <label for="token" class="block mb-1 font-medium text-gray-700">Folio de cancelación:</label>
            <input type="text" name="token" id="token" required
                   class="w-full border px-3 py-2 rounded shadow-sm focus:ring-blue-500 focus:border-blue-500"
                   placeholder="Ingresa tu folio de cancelación">
        </div>

        <div class="text-center">
            <button type="submit"
                    class="bg-red-600 hover:bg-red-700 text-white px-6 py-2 rounded">
                Cancelar Cita
            </button>
        </div>
    </form>
</div>

<script>
    function confirmarCancelacion() {
        return confirm("¿Estás seguro de que deseas cancelar esta cita?");
    }
</script>

<?= $this->endSection() ?>
