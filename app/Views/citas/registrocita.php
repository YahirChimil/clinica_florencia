<?php echo $this->extend('plantilla'); ?>
<?= $this->section('contenido') ?>
<div class="max-w-6xl mx-auto mt-10 bg-white p-8 shadow-lg rounded-lg">
    <h2 class="text-2xl font-semibold text-[#09476e] mb-6 text-center">Registrar Cita</h2>

    <?php if (isset($validation)): ?>
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-2 rounded mb-4">
        <?= $validation->listErrors() ?>
    </div>
    <?php endif; ?>

    <?php if (session()->getFlashdata('success')): ?>
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4 text-center">
        <?= session()->getFlashdata('success') ?>
    </div>
    <?php endif; ?>

    <form action="<?= base_url('citas') ?>" method="post">
        <div class="flex flex-col md:flex-row gap-8">
            <!-- Columna izquierda: formulario de registro de cita -->
            <div class="md:w-1/2 space-y-5">
                <div>
                    <label for="nombre_paciente" class="block text-sm font-medium text-gray-700 mb-1">Nombre del paciente</label>
                    <input type="text" name="nombre_paciente" id="nombre_paciente" required
                           class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-[#09476e] focus:border-[#09476e]">
                </div>

                <div>
                    <label for="fecha" class="block text-sm font-medium text-gray-700 mb-1">Fecha</label>
                    <input type="text" id="fecha" name="fecha"
                           class="datepicker-single w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-[#09476e] focus:border-[#09476e]">
                </div>

                <div class="text-right">
                    <button type="button" id="consultarHoras"
                            class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-4 py-2 rounded-md transition">
                        Consultar Horas Disponibles
                    </button>
                </div>

                <div>
                    <label for="hora" class="block text-sm font-medium text-gray-700 mb-1">Hora</label>
                    <select name="hora" id="hora" required
                            class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-[#09476e] focus:border-[#09476e]">
                        <option value="">Selecciona una hora</option>
                    </select>
                </div>

                <div>
    <label for="correo" class="block text-sm font-medium text-gray-700 mb-1"> número de WhatsApp</label>
    <input type="text" name="correo" id="correo" required
           class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-[#09476e] focus:border-[#09476e]"
           placeholder="ej.  9512563171">
</div>


                <div>
                    <label for="motivo" class="block text-sm font-medium text-gray-700 mb-1">Motivo de la cita (opcional)</label>
                    <textarea name="motivo" id="motivo" rows="3"
                              class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-[#09476e] focus:border-[#09476e]"></textarea>
                </div>
            </div>

            <!-- Columna derecha: datos médicos -->
            <div class="md:w-1/2 space-y-5">
                <h3 class="text-lg font-semibold text-[#09476e] mb-4">Datos Médicos del Paciente</h3>

                <div>
                    <label for="edad" class="block text-sm font-medium text-gray-700 mb-1">Edad</label>
                    <input type="number" name="edad" id="edad" class="w-full px-4 py-2 border border-gray-300 rounded-md">
                </div>

                <div>
                    <label for="peso" class="block text-sm font-medium text-gray-700 mb-1">Peso (kg)</label>
                    <input type="number" name="peso" id="peso" step="0.1" class="w-full px-4 py-2 border border-gray-300 rounded-md">
                </div>

                <div>
                    <label for="sexo" class="block text-sm font-medium text-gray-700 mb-1">Sexo</label>
                    <select name="sexo" id="sexo" class="w-full px-4 py-2 border border-gray-300 rounded-md">
                        <option value="">Selecciona</option>
                        <option value="Femenino">Femenino</option>
                        <option value="Masculino">Masculino</option>
                        <option value="Otro">Otro</option>
                    </select>
                </div>

                <div>
                    <label for="sangre" class="block text-sm font-medium text-gray-700 mb-1">Tipo de sangre</label>
                    <select name="sangre" id="sangre" class="w-full px-4 py-2 border border-gray-300 rounded-md">
                        <option value="">Selecciona</option>
                        <option value="A+">A+</option>
                        <option value="A-">A-</option>
                        <option value="B+">B+</option>
                        <option value="B-">B-</option>
                        <option value="AB+">AB+</option>
                        <option value="AB-">AB-</option>
                        <option value="O+">O+</option>
                        <option value="O-">O-</option>
                    </select>
                </div>

                <div>
                    <label for="alergias" class="block text-sm font-medium text-gray-700 mb-1">¿Es alérgico a algún medicamento o sustancia?</label>
                    <textarea name="alergias" id="alergias" rows="2" class="w-full px-4 py-2 border border-gray-300 rounded-md"></textarea>
                </div>

                <div>
                    <label for="enfermedad" class="block text-sm font-medium text-gray-700 mb-1">¿Sufre alguna enfermedad crónica?</label>
                    <textarea name="enfermedad" id="enfermedad" rows="2" class="w-full px-4 py-2 border border-gray-300 rounded-md"></textarea>
                </div>
            </div>
        </div>

        <div class="text-center mt-8">
            <button type="submit"
                    class="bg-[#09476e] hover:bg-[#0c3c4b] text-white font-semibold px-6 py-2 rounded-md transition">
                Registrar Cita
            </button>
        </div>
    </form>
</div>



<script>
document.getElementById('consultarHoras').addEventListener('click', function () {
    const fecha = document.getElementById('fecha').value;
    const selectHora = document.getElementById('hora');

    if (!fecha) {
        alert('Por favor selecciona una fecha primero.');
        return;
    }

    selectHora.innerHTML = '<option value="">Cargando...</option>';

    fetch(`<?= base_url('citas/horas-disponibles') ?>?fecha=${fecha}`)
        .then(response => response.json())
        .then(ocupadasRaw => {
            const ocupadas = ocupadasRaw.map(hora => hora.slice(0, 5)); // Eliminar los segundos
            const diaSemana = new Date(fecha).getDay(); // 0 = domingo, 6 = sábado
            const dias = [ 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado','Domingo'];
            console.log(`Día seleccionado: ${dias[diaSemana]} (${diaSemana})`);

            if (diaSemana === 7) {
                // Domingo: no se trabaja
                selectHora.innerHTML = '<option value="">No hay atención los domingos</option>';
                return;
            }

            selectHora.innerHTML = '<option value="">Selecciona una hora</option>';
            const intervalo = 40; // Intervalo de 40 minutos
            const bloques = {};

            if (diaSemana === 5) {
                // Sábado: solo de 11:00 a 14:00
                bloques["Horario de Sábado"] = { inicio: 11 * 60, fin: 14 * 60 };
            } else {
                // Lunes a Viernes
                bloques["Mañana"] = { inicio: 8 * 60, fin: 13 * 60 };
                bloques["Tarde"] = { inicio: 16 * 60, fin: 18 * 60 };
            }

            for (const [etiqueta, { inicio, fin }] of Object.entries(bloques)) {
                const grupo = document.createElement('optgroup');
                grupo.label = etiqueta;

                for (let mins = inicio; mins < fin; mins += intervalo) {
                    const h = Math.floor(mins / 60).toString().padStart(2, '0');
                    const m = (mins % 60).toString().padStart(2, '0');
                    const hora = `${h}:${m}`;
                    if (!ocupadas.includes(hora)) {
                        const option = document.createElement('option');
                        option.value = hora;
                        option.textContent = hora;
                        grupo.appendChild(option);
                    }
                }

                if (grupo.children.length > 0) {
                    selectHora.appendChild(grupo);
                }
            }

            if (selectHora.querySelectorAll('option').length <= 1) {
                selectHora.innerHTML = '<option value="">No hay horas disponibles</option>';
            }
        })
        .catch(error => {
            console.error('Error al consultar horas:', error);
            selectHora.innerHTML = '<option value="">Error al cargar horas</option>';
        });
});
</script>
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

<script>
document.querySelector("form").addEventListener("submit", function(e) {
    const input = document.getElementById("correo").value.trim();
    const isEmail = /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(input);
    const isPhone = /^\+?\d{10}$/.test(input);

    if (!isEmail && !isPhone) {
        e.preventDefault();
        alert("Por favor, ingresa un correo válido o un número de teléfono con formato internacional.");
    }
});
</script>


<script>
    document.getElementById('correo').addEventListener('input', function (e) {
        // Elimina todo lo que no sea dígito
        this.value = this.value.replace(/\D/g, '');

        // Opcional: Limita a 10 dígitos
        if (this.value.length > 10) {
            this.value = this.value.slice(0, 10);
        }
    });
</script>

<?= $this->endSection() ?>