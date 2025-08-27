//webkitURL is deprecated but nevertheless
URL = window.URL || window.webkitURL;

var gumStream; 						//stream from getUserMedia()
var rec; 							//Recorder.js object
var input; 							//MediaStreamAudioSourceNode we'll be recording

// shim for AudioContext when it's not avb.
var AudioContext = window.AudioContext || window.webkitAudioContext;
var audioContext //audio context to help us record

var recordButton = document.getElementById("recordButton");
var stopButton = document.getElementById("stopButton");
var pauseButton = document.getElementById("pauseButton");

//add events to those 2 buttons
recordButton.addEventListener("click", startRecording);
stopButton.addEventListener("click", stopRecording);
pauseButton.addEventListener("click", pauseRecording);

function startRecording() {
	console.log("recordButton clicked");

	/*
		Simple constraints object, for more advanced audio features see
		https://addpipe.com/blog/audio-constraints-getusermedia/
	*/

    var constraints = { audio: true, video:false }

 	/*
    	Disable the record button until we get a success or fail from getUserMedia()
	*/

	recordButton.style.visibility = 'hidden';
	stopButton.style.visibility = 'visible';
	pauseButton.style.visibility = 'hidden';

	/*
    	We're using the standard promise based getUserMedia()
    	https://developer.mozilla.org/en-US/docs/Web/API/MediaDevices/getUserMedia
	*/

	navigator.mediaDevices.getUserMedia(constraints).then(function(stream) {
		console.log("getUserMedia() success, stream created, initializing Recorder.js ...");

		/*
			create an audio context after getUserMedia is called
			sampleRate might change after getUserMedia is called, like it does on macOS when recording through AirPods
			the sampleRate defaults to the one set in your OS for your playback device

		*/
		audioContext = new AudioContext();

		//update the format
		// document.getElementById("formats").innerHTML="Format: 1 channel pcm @ "+audioContext.sampleRate/1000+"kHz"

		/*  assign to gumStream for later use  */
		gumStream = stream;

		/* use the stream */
		input = audioContext.createMediaStreamSource(stream);

		/*
			Create the Recorder object and configure to record mono sound (1 channel)
			Recording 2 channels  will double the file size
		*/
		rec = new Recorder(input,{numChannels:1})

		//start the recording process
		rec.record()

		console.log("Recording started");

	}).catch(function(err) {
	  	//enable the record button if getUserMedia() fails
    	recordButton.style.visibility = 'visible';
    	stopButton.style.visibility = 'hidden';
    	pauseButton.style.visibility = 'hidden';
	});
}

function pauseRecording(){
	console.log("pauseButton clicked rec.recording=",rec.recording );
	if (rec.recording){
		//pause
		rec.stop();
		pauseButton.innerHTML="Resume";
	}else{
		//resume
		rec.record()
		pauseButton.innerHTML="Pause";

	}
}

function stopRecording() {
	console.log("stopButton clicked");

	//disable the stop button, enable the record too allow for new recordings
	stopButton.style.visibility = 'hidden';
	recordButton.style.visibility = 'visible';
	pauseButton.style.visibility = 'hidden';

	//reset button just in case the recording is stopped while paused
	pauseButton.innerHTML="Pause";

	//tell the recorder to stop the recording
	rec.stop();

	//stop microphone access
	gumStream.getAudioTracks()[0].stop();

	//create the wav blob and pass it on to createDownloadLink
	rec.exportWAV(createDownloadLink);
}

function createDownloadLink(blob) {

    // console.log(blob);
	var url = URL.createObjectURL(blob);
	var au = document.createElement('audio');
	var li = document.createElement('div');
	// var link = document.createElement('a');

	//name of .wav file to use during upload and download (without extendion)
	var filename = new Date().toISOString();

	//add controls to the <audio> element
	au.controls = false;
	au.src = url;

	//save to disk link
	// link.href = url;
	// link.download = filename+".wav"; //download forces the browser to donwload the file using the  filename
	// link.innerHTML = "Save to disk";

	//add the new audio element to li
	// li.appendChild(au);

	//add the filename to the li
	// li.appendChild(document.createTextNode(filename+".wav "))

	//add the save to disk link to li
	// li.appendChild(link);

	//upload link
	// var upload = document.createElement('button');
    // upload.setAttribute('type', 'button');
    // upload.className = "btn-ssearch";
	// upload.href="#";
	// upload.innerHTML = "<i class='fa fa-search' aria-hidden='true'></i>";

    var formData = new FormData();
    formData.append('audio_data', blob, filename);

    xhr('assets/voice_upload/upload.php', formData, function (fName) {
        console.log("Video succesfully uploaded !");
    });

    let timerInterval
    Swal.fire({
    title: 'Searching by your voice',
    html: 'Wating...',
    timer: 4000,
    timerProgressBar: true,
    didOpen: () => {
        Swal.showLoading()
    },
    willClose: () => {
        clearInterval(timerInterval)
    }
    }).then((result) => {
    /* Read more about handling dismissals below */
    if (result.dismiss === Swal.DismissReason.timer) {
        console.log('I was closed by the timer')
    }
    })

    setTimeout(function(){
        location.replace("http://127.0.0.1:8000/AISearch"); //Change this url when deploy on AZURE.
    }, 4000);


	// upload.addEventListener("click", function(event){
    //     xhr('assets/voice_upload/upload.php', formData, function (fName) {
    //         console.log("Video succesfully uploaded !");
    //     });

    //     setTimeout(function(){
    //         location.replace("http://127.0.0.1:8000/AISearch")
    //     }, 6000);
	// 	//   var xhr=new XMLHttpRequest();
	// 	//   xhr.onload=function(e) {
	// 	//       if(this.readyState === 4) {
	// 	//           console.log("Server returned: ",e.target.responseText);
	// 	//       }
	// 	//   };
	// 	//   var fd=new FormData();
	// 	//   fd.append("audio_data",blob, filename);
	// 	//   xhr.open("POST","assets/nigger/upload.php",true);
	// 	//   xhr.send(fd);
	// })
	// li.appendChild(document.createTextNode (" "))//add a space in between
	// li.appendChild(upload)//add the upload link to li


    function xhr(url, data, callback) {
        var request = new XMLHttpRequest();
        request.onreadystatechange = function () {
            if (request.readyState == 4 && request.status == 200) {
                callback(location.href + request.responseText);
            }
        };
        request.open('POST', url);
        request.send(data);
    }

	//add the li element to the ol
	// recordingsList.appendChild(li);
}
