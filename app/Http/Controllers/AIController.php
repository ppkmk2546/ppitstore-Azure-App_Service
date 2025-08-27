<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;

class AIController extends Controller
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;


    // public function AISearch()
    // {
    //     $clear = session('output');
    //     session()->forget('output');
    //     $name23 = array("cpu","Gaming","harddisk","headset","keyboard","monitor","mouse","notebook","ram");
    //     return redirect('/search?product_cat=All+Category&search=' . $name23[$clear]);
    // }

    public function AISearch()
    {
        $clear = session('output');
        session()->forget('output');
        return redirect('/search?product_cat=All+Category&search=' . $clear);
    }

    public function predict($recive)
    {
        session()->put('recive',$recive);
        // return response()->json($recive);
        $this->finalPredict();
    }

    public function finalPredict(){
        // $path = "D:\\xampp\\htdocs\\project\\vitzard-laravel\\app\\python\\voice_rec.py";
        $path = "C:\\xampp\\htdocs\\vitzard-laravel\\app\\python\\speech_rec.py"; //Change this path when deploy on AZURE.

        $voice_2022 = session('recive');
        ob_start();
        // passthru("python $path $voice_2022");
        passthru("python $path $voice_2022");
        $output = preg_replace('~[\r\n]+~','', ob_get_clean());
        // $output = substr($output, -1, 3);
        // $output = intval($output);
        // $this->img_error_status = $output;
        session()->put('output',$output);
    }
}
