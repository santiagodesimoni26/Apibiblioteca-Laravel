<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
 use App\Book;
 use JWTAuth;
 use Validator;
 use Response;
 use App\User;

class BookController extends Controller

{


    
    /**
     * 
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //

        $libros= Book::all();

        return response()->json(array(
            'libros' => $libros,
            'status' => 'success',


        ), 200 );

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //

        try{
            $validator = Validator::make($request->all(), [
                'titulo' => 'required|min:5',
                'descripcion' => 'required',
                'autor' => 'required',
                'alquilado' => 'required'
            ]);
     
            if ($validator->fails()) {
                return Response::json(['errors' => $validator->errors()], 400);
            }
     
            $libro = new Book;
     
            $libro->titulo = $request->titulo;
            $libro->descripcion = $request->descripcion;
            $libro->autor = $request->autor;
            $libro->alquilado = $request->alquilado;
            $libro->save();
            
            return Response::json(['data' => 'added successfully'],200);
     
        }catch(Exception $e){
            return Response::json(['errors' => 'Bad Request'], 400);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
  

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $libro= Book::find($id);
        return response()->json(array(
            'libro' => $libro,
            'status' => 'success'
        ), 200);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //

        try{
            
            $validator = Validator::make($request->all(), [
                'titulo' => 'required|min:5',
                'descripcion' => 'required',
                'autor' => 'required',
                'alquilado' => 'required',
            ]);
     
            if ($validator->fails()) {
                return Response::json(['errors' => $validator->errors()],400);
            }
     
            $libro = Book::where('id', $id)->first();
     
            $libro->titulo = $request->titulo;
            $libro->descripcion = $request->descripcion;
            $libro->autor = $request->autor;
            $libro->alquilado = $request->alquilado;
            $libro->update();
            
            return Response::json(['data' => 'updated successfully'],200);
        }catch(Exception $e){
            return Response::json(['errors' => 'Bad Request'], 400);
        }
     

    

      

    }     

    public function destroy($id)
        {
        //
        try{
            $libro = Book::where('id', $id)->delete();
            
            return Response::json(['data' => 'deleted successfully'],200);
        }catch(Exception $e){
            return Response::json(['errors' => 'Bad Request'], 400);
        }


         }

      

}         