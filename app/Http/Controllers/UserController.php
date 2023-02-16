<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;

class UserController extends Controller
{
  public function register(Request $request){
    //recoger los datos
    $json= $request->input('json', null);//el null es por si mandan algo sin nada
    $params= json_decode($json);//pasa a objeto
    $params_array= json_decode($json,true);//pasa a array


    if(!empty($params) && !empty($params_array)){

    //limpiar datos por espacios etc..
    $params_array = array_map('trim',$params_array);
    //Validar datos
    $validate =   Validator::make($params_array, [
        'name'      => 'required|alpha',
        'email'     => 'required|email|unique:users',
        'surname'   => 'required|alpha',
        'password'  => 'required'
    ]);

    if($validate->fails()){
        $data= array(
            'status' => 'error',
            'code'  => '404',
            'message'   =>'El usuario no se ha creado',
            'errors' => $validate->errors()
        );

        }else{
            //encriptado de la contraseña se encripta 4 veces
            $pwd=password_hash($params->password,PASSWORD_BCRYPT, ['cost' => 4]);

            try{
            
                //crea un objeto de la clase modelo y enlaza parametros con los valores del modelo
            $user= new User();

            $user->name=$params_array['name'];
            $user->email=$params_array['email'];
            $user->surname=$params_array['surname'];
            $user->password = $pwd;

           //guarda el objeto a la base de datos;
            $user->save();

            //Muestra el error 
            } catch(\Exception $e){
                
                echo $e->getMessage();   // insert query
             }

            $data= array(
               'status' => 'succes',
                'code'  => '200',
               'message'   =>'El usuario se ha registrado correctamente',
               'user'    => $user
            );
        
    }
    }else{
        $data= array(
            'status' => 'error',
            'code'  => '404',
            'message'   =>'Faltan datos'
        );
    }



    
    return response()->json($data);
  }




  public function login(Request $request){

  }
}
