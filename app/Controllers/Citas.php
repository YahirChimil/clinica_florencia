<?php

namespace App\Controllers;

use App\Models\CitasModel;
use CodeIgniter\HTTP\ResponseInterface;
use App\Controllers\BaseController;
use App\Models\DiasNoLaborablesModel;
use App\Libraries\EmailService;

class Citas extends BaseController
{
    /**
     * Return an array of resource objects, themselves in array format.
     *
     * @return ResponseInterface
     */
    public function index()
    {
        $citasModel = new CitasModel();
    
        // Obtener la fecha desde el parámetro GET o usar la fecha actual
        $fecha = $this->request->getGet('fecha') ?? date('Y-m-d');
    
        // Buscar las citas solo de la fecha seleccionada
        $data['citas'] = $citasModel
            ->where('fecha', $fecha)
            ->orderBy('hora', 'ASC')
            ->findAll();
    
        // Pasar la fecha seleccionada a la vista
        $data['fechaSeleccionada'] = $fecha;
    
        return view('citas/index', $data);
    }
    

    /**
     * Return the properties of a resource object.
     *
     * @param int|string|null $id
     *
     * @return ResponseInterface
     */
    public function show($id = null)
    {
        //
    }

    /**
     * Return a new resource object, with default properties.
     *
     * @return ResponseInterface
     */
    public function new()
    {
        
    return view('citas/registrocita');

    }

    /**
     * Create a new resource object, from "posted" parameters.
     *
     * @return ResponseInterface
     */
    public function create()
    {
        $validation = \Config\Services::validation();
    
        $validation->setRules([
            'nombre_paciente' => 'required|min_length[3]|max_length[255]',
            'fecha'           => 'required|valid_date[Y-m-d]',
            'hora'            => 'required',
            'correo'          => 'required',
            'motivo'          => 'permit_empty'
        ]);
    
        if (!$this->validate($validation->getRules())) {
            return redirect()->back()->withInput()->with('validation', $validation);
        }
    
        $citasModel = new CitasModel();
        $data = [
            'nombre_paciente' => $this->request->getPost('nombre_paciente'),
            'fecha'           => $this->request->getPost('fecha'),
            'hora'            => $this->request->getPost('hora'),
            'correo'          => $this->request->getPost('correo'),
            'motivo'          => $this->request->getPost('motivo') ?? null,
        ];
    
        $datosMedicos = [
            'edad'       => $this->request->getPost('edad'),
            'peso'       => $this->request->getPost('peso'),
            'sexo'       => $this->request->getPost('sexo'),
            'sangre'     => $this->request->getPost('sangre'),
            'alergias'   => $this->request->getPost('alergias'),
            'enfermedad' => $this->request->getPost('enfermedad'),
        ];
    
        $idCita = $citasModel->insert($data);
        $data['id'] = $idCita;
    
        // Armar mensaje
        $mensaje = "Hola {$data['nombre_paciente']}, tu cita fue registrada exitosamente.\n";
        $mensaje .= "N° de Cita: {$data['id']}\nFecha: {$data['fecha']}\nHora: {$data['hora']}\nMotivo: {$data['motivo']}\n\n";
        $mensaje .= "Datos Médicos:\nEdad: {$datosMedicos['edad']}\nPeso: {$datosMedicos['peso']} kg\nSexo: {$datosMedicos['sexo']}\n";
        $mensaje .= "Tipo de sangre: {$datosMedicos['sangre']}\nAlergias: {$datosMedicos['alergias']}\n";
        $mensaje .= "Enfermedades crónicas: {$datosMedicos['enfermedad']}\n\nGracias por confiar en nosotros.";
    
        // Detectar si es correo o teléfono
        if (filter_var($data['correo'], FILTER_VALIDATE_EMAIL)) {
            // Enviar correo
            
        $email = new EmailService();
        $resultado = $email->enviarCorreo(
      $data['correo'],
     'Confirmación de Cita - Clínica Florencia',
    nl2br($mensaje)
);

if ($resultado != 202) {
    log_message('error', 'No se pudo enviar el correo con SendGrid: Código ' . $resultado);
}

        } elseif (preg_match('/^\+?\d{10,15}$/', $data['correo'])) {
            // Enviar WhatsApp si es un número válido
            $this->enviarWhatsapp($data['correo'], $mensaje);
        }
    
        return redirect()->to(base_url('citas/new'))->with('success', 'Cita registrada correctamente y mensaje enviado.');
    }


    private function enviarWhatsapp($telefono, $mensaje)
{
    $instanceId = 'instance116501';  // Reemplaza con el tuyo
    $token = 'dih7sob8p6d8dkj7';     
    $prefijo='+521';   // Reemplaza con el tuyo

    $url = "https://api.ultramsg.com/{$instanceId}/messages/chat";

    $data = [
        'to' => $prefijo.$telefono,
        'body' => $mensaje
    ];

    $client = \Config\Services::curlrequest();
    $response = $client->post($url, [
        'headers' => [
            'Content-Type' => 'application/x-www-form-urlencoded'
        ],
        'form_params' => $data,
        'query' => ['token' => $token]
    ]);

    if ($response->getStatusCode() != 200) {
        log_message('error', 'No se pudo enviar el WhatsApp: ' . $response->getBody());
    }
}

    






    /**
     * Return the editable properties of a resource object.
     *
     * @param int|string|null $id
     *
     * @return ResponseInterface
     */
    public function edit($id = null)
    {
        //
    }

    /**
     * Add or update a model resource, from "posted" properties.
     *
     * @param int|string|null $id
     *
     * @return ResponseInterface
     */
    public function update($id = null)
    {
        //
    }

    public function horasDisponibles()
{
    $fecha = $this->request->getGet('fecha');
    
    if (!$fecha) {
        return $this->response->setJSON([]);
    }

    $model = new CitasModel();
    $citas = $model->where('fecha', $fecha)->findAll();
    $horasOcupadas = array_column($citas, 'hora');

    return $this->response->setJSON($horasOcupadas);
}


    /**
     * Delete the designated resource object from the model.
     *
     * @param int|string|null $id
     *
     * @return ResponseInterface
     */
    public function delete($id = null)
    {
        //
        return view('citas/cancelar');


    }

    public function formCancelarCita()
{
    return view('citas/cancelar_cita');
}

public function cancelar()
{
    $id = $this->request->getPost('id');
    $citasModel = new CitasModel();
    $cita = $citasModel->find($id);

    if (!$cita) {
        return redirect()->back()->with('mensaje', 'Cita no encontrada.');
    }

    if (empty($cita['correo'])) {
        return redirect()->back()->with('mensaje', 'La cita no tiene un correo registrado. No se puede cancelar.');
    }

    // Cancelar (eliminar la cita)
    $citasModel->delete($id);

    // Mensaje de cancelación
    $mensaje = "
        <h3>Confirmación de Cancelación</h3>
        <p><strong>Paciente:</strong> {$cita['nombre_paciente']}</p>
        <p><strong>Fecha:</strong> {$cita['fecha']}</p>
        <p><strong>Hora:</strong> {$cita['hora']}</p>
        <p>La cita ha sido cancelada exitosamente.</p>
    ";

    // Detectar si es email o teléfono
    if (filter_var($cita['correo'], FILTER_VALIDATE_EMAIL)) {
        // Es un correo
        $emailService = new \App\Libraries\EmailService();

        $resultadoPaciente = $emailService->enviarCorreo(
            $cita['correo'],
            'Cita Cancelada - Clínica Florencia',
            $mensaje
        );

        $resultadoHost = $emailService->enviarCorreo(
            'xxkcronozsxx@gmail.com',
            'Cita Cancelada - Clínica Florencia',
            $mensaje
        );

        if ($resultadoPaciente != 202) {
            log_message('error', 'Error al enviar correo de cancelación al paciente: Código ' . $resultadoPaciente);
        }
        if ($resultadoHost != 202) {
            log_message('error', 'Error al enviar correo de cancelación al host: Código ' . $resultadoHost);
        }

    } elseif (preg_match('/^\+?\d{10,15}$/', $cita['correo'])) {
        // Es un teléfono válido
        $mensajeWhatsapp = "Hola {$cita['nombre_paciente']}, tu cita programada para el día {$cita['fecha']} a las {$cita['hora']} ha sido cancelada exitosamente. Clínica Florencia.";
        $this->enviarWhatsapp($cita['correo'], $mensajeWhatsapp);
    }

    return redirect()->back()->with('mensaje', 'Cita cancelada correctamente y notificación enviada.');
}
}