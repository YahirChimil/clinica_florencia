<?php

namespace App\Controllers;

use App\Models\DiasNoLaborablesModel;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\RESTful\ResourceController;

class DiasNoLaborales extends ResourceController
{
    /**
     * Return an array of resource objects, themselves in array format.
     *
     * @return ResponseInterface
     */
    public function index()
    {
        //
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
        //
    }
    public function obtenerJSON()
    {
        $modelo = new DiasNoLaborablesModel();
        $fechas = $modelo->select('fecha')->findAll();

        $fechasSolo = array_column($fechas, 'fecha');

        return $this->response->setJSON($fechasSolo);
    }

    /**
     * Create a new resource object, from "posted" parameters.
     *
     * @return ResponseInterface
     */
    public function guardarDiasNoLaborables()
{
    // Obtener las fechas como string y separarlas por coma
    $fechas = $this->request->getPost('dias_no_laborables');
    $fechasArray = explode(',', $fechas);

    // Modelo para guardar (o puedes usar directamente DB::table si no usas modelo)
    $modelo = new DiasNoLaborablesModel();

    // Limpia las fechas anteriores si es necesario
    $modelo->truncate(); // Cuidado: elimina todo

    // Guarda cada fecha en la base de datos
    foreach ($fechasArray as $fecha) {
        $modelo->insert(['fecha' => $fecha]);
    }

    // Redirigir con mensaje
    return redirect()->back()->with('mensaje', 'Días no laborables guardados correctamente.');
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
    }
}
