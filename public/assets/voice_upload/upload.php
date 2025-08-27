<?php

if(isset($_FILES["audio_data"])){
    // Define a name for the file
    $t=time();
    $fileName = $t ."vdata.wav";

    // In this case the current directory of the PHP script
    $uploadDirectory = 'C:\\xampp\\htdocs\\vitzard-laravel\\public\\assets\\predict_data\\'. $fileName; #Change this path when deploy on AZURE.

    header("Location: http://127.0.0.1:8000/predict/".$fileName); #Change this url when deploy on AZURE.

    // Move the file to your server
    if (!move_uploaded_file($_FILES["audio_data"]["tmp_name"], $uploadDirectory)) {
        echo("Couldn't upload Audio !");
    }

}else{
    echo "No file uploaded";
}

?>

