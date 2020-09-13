<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use JWTAuth;
use App\Http\Requests\RegisterFormRequest;
use Tymon\JWTAuth\Exceptions\JWTException;
use Validator;


class AuthController extends Controller
{
    //
    public function register(Request $request){
        

        $validator = Validator::make($request->all(), [
         
            'email' => 'required|string|email|max:255|unique:users',
            'nombre' => 'required',
            'password' => 'required',
            'apellido' => 'required',
            'telefono' => 'required',
            'idrol' => 'required',



        ]);

        if($validator->fails()){

            return response()->json($validator->errors());

        }

        $user = new User();

        $user->nombre = $request->nombre;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->apellido = $request->apellido;
        $user->telefono =$request->telefono;
        $user->idrol = $request->idrol;
        $user->save();
        $user = User::first();
        $token = JWTAuth::fromUser($user);

        return response()->json([
          'success' => true,
          'token' => $token,  
        ]);

    }

    public function login(Request $request) {

        $validator = Validator::make($request->all(), [
         
            'email' => 'required|email|max:255',
            
            'password' => 'required',



        ]);

        if($validator->fails()){

            return response()->json($validator->errors());

        }

        $input = $request->only('email', 'password');
        $jwt_token =null ;

        if(!$jwt_token = JWTAuth::attempt($input)){

            return response()->json([

                'success' => false,
                'message' => 'verifique el email o el password',


            ], 401);


        }
        $user = JWTAuth::user();
        return response()->json(compact('token', 'user'));



    }

        public function logout(Request $request){

            $this->validate($request, [

                'token' => 'required'


            ]);

            try{
                JWTAuth::invalidate($request->token);
                return response()->json([
                    'success' => true,
                    'message' => 'usuario deslogueado correctamente'

                ]);



            } catch (JWTException $exception) {

                return response()->json([
                    'success' => false,
                    'message' => 'el usuario no puede desloguearse'

                ], 500);



            }

        }


        public function getAuthUser(Request $request){
            

            $this->validate($request, [

                'token' => 'required'


            ]);
            
           // $token = $request->input('token');
            

           

            
            return response()->json(['user' => $user]);


        }
   /* public function toUser($token = false)
    {
    $payload = $this->getPayload($token);

    if (! $user = $this->user->getBy($this->identifier, $payload['sub'])) 
        {
        return false;
        }

    return $user;
    }*/



}   
