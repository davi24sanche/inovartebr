<?php

namespace App\Http\Controllers;

use App\Models\Detalle;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use DB;

class DetalleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            //Listar los detalles
            return response()->json(Detalle::orderBy('price')->get(), 200);
        } catch (Exception $ex) {
            return response()->json($ex->getMessage(), 422);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'name' => 'required|min:3',
                'description' => 'required|min:5',
                'state' => 'required|min:6',
                'price' => 'required|numeric',
                'tipo_id' => 'required|numeric'
            ]
        );
        if ($validator->fails()) {
            return response()->json($validator->messages(), 422);
        }
        try {
            //Instancia
            $dtail = new Detalle();
            $dtail->name = $request->input('name');
            $dtail->description = $request->input('description');
            $dtail->state = $request->input('state');
            $dtail->price = $request->input('price');
            $dtail->tipo_id = $request->input('tipo_id');

            //Guardar el detalle en la BD
            if ($dtail->save()) {
                $response = 'Detalle creado!';
                return response()->json($response, 201);
            } else {
                $response = [
                    'msg' => 'Error durante la creación'
                ];
                return response()->json($response, 404);
            }
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 422);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Detalle  $detalle
     * @return \Illuminate\Http\Response
     */
    public function show(Detalle $detalle)
    {
    }

    public function detallado()
    {
        try {
            //Listar los detalles a desplegar
            $detalles =
                DB::table('detalles')
                ->join('tipos', 'detalles.tipo_id', '=', 'tipos.id')
                ->select('detalles.*', 'tipos.name as tipoName')
                ->get();

            return response()->json($detalles, 200);
        } catch (Exception $ex) {
            return response()->json($ex->getMessage(), 422);
        }
    }

    public function detallado_id(int $id)
    {
        try {
            //Listar el detalle especifico en el id
            $detalles = Detalle::find($id);
            return response()->json($detalles, 200);
        } catch (Exception $ex) {
            return response()->json($ex->getMessage(), 422);
        }
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Detalle  $detalle
     * @return \Illuminate\Http\Response
     */
    public function edit(Detalle $detalle)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Detalle  $detalle
     * @return \Illuminate\Http\Response
     */
    public function actualizar(Request $request, $id)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'name' => 'required|min:3',
                'description' => 'required|min:5',
                'state' => 'required|min:6',
                'price' => 'required|numeric',
                'tipo_id' => 'required|numeric'
            ]
        );
        if ($validator->fails()) {
            return response()->json($validator->messages(), 422);
        }

        $dtail = Detalle::find($id);
        $dtail->name = $request->input('name');
        $dtail->description = $request->input('description');
        $dtail->state = $request->input('state');
        $dtail->price = $request->input('price');
        $dtail->tipo_id = $request->input('tipo_id');

        if ($dtail->update()) {
            $response = 'Detalle actualizado!';
            return response()->json($response, 200);
        }
        $response = [
            'msg' => 'Error durante la actualización'
        ];
        return response()->json($response, 404);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Detalle  $detalle
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $detalle)
    {
        try {
            //eliminar
            $detalles = Detalle::destroy($detalle);
            return response()->json($detalles, 200);
        } catch (Exception $ex) {
            return response()->json($ex->getMessage(), 422);
        }
    }
}
