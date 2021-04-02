<?php

namespace App\Http\Controllers;

use App\Models\Reserva;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ReservaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Listar Reserva
        try {
            //Listar las reservas
            $reservas = Reserva::all();
            $response = $reservas;
            return response()->json($response, 200);
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 422);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        DB::beginTransaction();
        try{
            //Instancia reserva
            $reserva = new Reserva();
            $reserva->CreationDate = Carbon::parse($request->input('CreationDate'))->format('Y-m-d');
            $reserva->startDate = Carbon::parse($request->input('startDate'))->format('Y-m-d');
            $reserva->finalDate = Carbon::parse($request->input('finalDate'))->format('Y-m-d');
            $reserva->reservecol =$request->input('reservecol');
            $reserva->numPersons = $request->input('numPersons');

            //Guardar encabezado
            $reserva->save();

            //Instancia Detalle reserva
            $detalles = $request->input('detalles');
            foreach ($detalles as $item) {
                $reserva->productos()->attach($item['idItem'], [
                    'precio' => $item['precio']
                ]);
            }

            DB::commit();
            $response = 'Reserva creada!';
            return response()->json($response, 201);

        }catch(\Exception $e){
            DB::rollback();
            return response()->json($e->getMessage(), 422);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Reserva  $reserva
     * @return \Illuminate\Http\Response
     */
    public function show(Reserva $reserva)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Reserva  $reserva
     * @return \Illuminate\Http\Response
     */
    public function edit(Reserva $reserva)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Reserva  $reserva
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Reserva $reserva)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Reserva  $reserva
     * @return \Illuminate\Http\Response
     */
    public function destroy(Reserva $reserva)
    {
        //
    }
}
