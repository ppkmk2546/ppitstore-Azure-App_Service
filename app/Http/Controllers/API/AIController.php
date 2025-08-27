<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AIController extends Controller
{
    public $fileName;

    public function upload(Request $request){

        $predictVoice = $request->file("predict");

        $t=time();
        $this->fileName = $t ."vdata.mp3";

        $uploadDirectory = 'C:\\xampp\\htdocs\\vitzard-laravel\\public\\assets\\predict_data\\upload\\'. $this->fileName; //Change this path when deploy on AZURE.

        if(!move_uploaded_file($predictVoice, $uploadDirectory)){
            // Return response
            $response = [
                'result' => 'Not Match',
                'message' => 'Process Failed',
                'status' => 'true'
            ];
            return response($response, 500);
        }else{
            // $this->finalPredict();
            $path = "C:\\xampp\\htdocs\\vitzard-laravel\\app\\python\\speech_rec.py"; //Change this path when deploy on AZURE.

            $voice_2022 = $this->fileName;
            ob_start();
            // passthru("python $path $voice_2022");
            passthru("python $path $voice_2022");
            $output = preg_replace('~[\r\n]+~','', ob_get_clean());

            // Return response
            $response = [
                'result' => $output,
                'message' => 'Process Successfully',
                'status' => 'true'
            ];
            return response($response, 200);
        }

    }

}
