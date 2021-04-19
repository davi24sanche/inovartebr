<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use PhpParser\Node\Stmt\TryCatch;
use Symfony\Component\Console\Input\Input;

use function PHPUnit\Framework\isNull;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Facades\File;


class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            //Listar los productos
            return response()->json(Producto::orderBy('price')->get(), 200);
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
        //Validacion para los campos del producto
        $validar = Validator::make(
            $request->all(),
            [
                'name' => 'required|min:4',
                'description' => 'required|min:5',
                'price' => 'required|numeric',
                'state' => 'required|min:5'
            ]
        );

        if ($validar->fails()) {
            return response()->json($validar->messages(), 422);
        }

        try {
            //Instancia de Producto
            $prod = new Producto();
            $prod->name = $request->input('name');
            $prod->description = $request->input('description');
            $prod->price = $request->input('price');
            $prod->state = $request->input('state');

            //Guardar Imagen
            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $naameImage = time() . "foto." . $file->getClientOriginalExtension();
                $imageUpload = Image::make($file->getRealPath());
                $path = 'images/';
                $imageUpload->save(public_path($path) . $naameImage);

                //Revisar los campos de la Tabla de Producto en la DB
                //Se Asocia los campos de la tabla con las variables creadas para guardar la Imagen
                $prod->naameImage = $naameImage;
                $prod->pathImage = url($path) . "/" . $naameImage;
            }


            //Guardar el producto en la BD
            if ($prod->save()) {

                //Asociar varios detalles
                //Relacion muchos a muchos

                //SIN LA IMAGEN
                /* $detalles = $request->input('detalle_id');
                if(!is_null($request->input('detalle_id'))){

                    $prod->detalles()->attach($detalles);
                }
                $response ='Producto creado';
                return response()->json($response,201);*/


                //Solo se utiliza con la Imagen
                $detalles = $request->input('detalle_id');

                if (!is_array($request->input('detalle_id'))) {
                    //Formato array relacion muchos a muchos
                    $detalles =
                        explode(',', $request->input('detalle_id'));
                }

                if (!is_null($request->input('detalle_id'))) {
                    //Agregar detalles
                    $prod > detalles()->attach($detalles);
                }
                $response = 'Producto creado!';
                return response()->json($response, 201);
            } else {
                $response = ['msg' => 'Error durante la creación del producto'];
                return response()->json($response, 404);
            }
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 422);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            //Obtener un producto
            $producto = Producto::find($id);
            $response = $producto;
            return response()->json($response, 200);
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 422);
        }
    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //Validaciones
        $validar = Validator::make(
            $request->all(),
            [
                'name' => 'required|min:4',
                'description' => 'required|min:5',
                'price' => 'required|numeric',
                'state' => 'required|min:5'
            ]
        );
        if ($validar->fails()) {
            return response()->json($validar->messages(), 422);
        }

        //Datos del producto
        $prod = Producto::find($id);
        $prod->name = $request->input('name');
        $prod->description = $request->input('description');
        $prod->price = $request->input('price');
        $prod->state = $request->input('state');

        //Información de la Imagen

        if ($request->hasFile('image')) {

            //obtener archivo de imagen anterior
            $productoImagen = public_path("images/{$prod->naameImage}");
            if (File::exists($productoImagen)) {
                //Borra Imagen anterior
                File::delete($productoImagen);
            }
            $file = $request->file('image');
            $naameImage = time() . "foto." . $file->getClientOriginalExtension();
            $imageUpload = Image::make($file->getRealPath());
            $path = 'images/';
            $imageUpload->save(public_path($path) . $naameImage);

            //Revisar los campos de la Tabla de Producto en la DB
            //Se Asocia los campos de la tabla con las variables creadas para guardar la Imagen
            $prod->naameImage = $naameImage;
            $prod->pathImage = url($path) . "/" . $naameImage;
        }

        //Actualizar Producto
        if ($prod->update()) {

            //SIN IMAGEN
            /*$detalles = explode(',',$request->input('detalle_id'));

            if(!isNull($request->input('detalle_id'))){

                $prod->detalles()->sync($detalles);
            }*/

            //Solo se utiliza con la Imagen
            $detalles = $request->input('detalle_id');

            if (!is_array($request->input('detalle_id'))) {
                //Formato array relacion muchos a muchos
                $detalles =
                    explode(',', $request->input('detalle_id'));
            }

            if (!is_null($request->input('detalle_id'))) {
                //Agregar detalles
                $prod > detalles()->attach($detalles);
            }

            $response = 'Producto actualizado correctamente';
            return response()->json($response, 200);
        }
        $response = ['msg' => 'Error al momento de actualizar'];
        return response()->json($response, 404);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $producto)

    {
        try {
            //eliminar
            $productos = Producto::destroy($producto);
            return response()->json($productos, 200);
        } catch (Exception $ex) {
            return response()->json($ex->getMessage(), 422);
        }
    }
}
