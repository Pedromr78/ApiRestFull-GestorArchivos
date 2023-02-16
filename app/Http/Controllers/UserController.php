<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
  public function register(Request $request){
    //recoger los datos
    $json= $request->input('json', null);//el null es por si mandan algo sin nada
    $params= json_decode($json);//pasa a objeto
    $params_array= json_decode($json,true);//pasa a array


    if(!empty($params) && !empty($params_array)){

    //limpiar datos por espacios etc..
    $params_array = array_map('trimp',$params_array);
    //Validar datos
    $validate =   Validator::make($params_array, [
        'name'      => 'required|alpha',
        'email'     => 'required|email',
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


            




            $data= array(
               'status' => 'succes',
                'code'  => '200',
               'message'   =>'El usuario se ha registrado correctamente'
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
}
