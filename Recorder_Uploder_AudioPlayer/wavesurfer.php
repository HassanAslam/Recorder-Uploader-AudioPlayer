<!DOCTYPE html>
<html>
<head>
    <!-- Latest compiled and minified CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Latest compiled JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/wavesurfer.js"></script>
    <script src="jquery.min.js"></script>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Audio Player</title>
</head>
<body>
    <div class="container-fluid text-center p-5">
        <div class="row align-items-center">
        <div class="col-sm-12">
            <p class="display-4 text-center"> Audio Player </p>
<div id="wave"></div>
<button class="btn btn-primary" data-action="play">Play</button>
<button class="btn btn-primary" data-action="pause">Pause</button>
<button class="btn btn-primary" data-action="destroy">Exit</button>
<button class="btn btn-primary" data-action="mute">Mute/Un-Mute</button>
<div class="isPlaying">
    <b style="color:green;display:none;" class="playing">Playing</b>
    <b style="color:red;display:none;" class="paused">Paused</b><br>
    <p class="display-6">Audios List</p>



<script>
var wavesurfer = WaveSurfer.create({
    container: document.querySelector('#wave'),
     waveColor: 'violet',
    progressColor: 'purple',
    backend: 'MediaElement',
    backgroundColor: 'black',
    barWidth: 10 ,
    mediaControls: false,
    responsive: true
});
    // toggle play button
   // document.querySelector('[data-action="isPlaying"]').addEventListener('click', playings);
    document.querySelector('[data-action="destroy"]').addEventListener('click', wavesurfer.destroy.bind(wavesurfer));
    document.querySelector('[data-action="play"]').addEventListener('click', playPlz);
    document.querySelector('[data-action="pause"]').addEventListener('click', pausePlz);
    document.querySelector('[data-action="mute"]').addEventListener('click', mute);
    
wavesurfer.on('finish', function () {
    //playPlz();
});

function load(file){
        wavesurfer.load(file);
        playPlz();
}

    function isPlaying(){
        var p = wavesurfer.isPlaying();
        if(p){
            $('.isPlaying>.paused').show();
            $('.isPlaying>.playing').hide();
        }else{
            $('.isPlaying>.paused').hide();
            $('.isPlaying>.playing').show();
        }
        return p;
    }
    function playPlz(){
         
        var isPaused = isPlaying();
        if(!isPaused){
            wavesurfer.play();
        }
    }
    function pausePlz(){
        var isPaused = isPlaying();
        if(isPaused) wavesurfer.pause();
    }
    function mute(){

        wavesurfer.toggleMute();
    }
    </script>


</body>
</html>


    <?php 
    function getFiles($path = 'audio') {

    // Open the path set
    if ($handle = opendir($path)) {

        // Loop through each file in the directory
        while ( false !== ($file = readdir($handle)) ) {

            // Remove the . and .. directories
            if ( $file != "." && $file != ".." ) {

                // Check to see if the file is a directory
                if( is_dir($path . '/' . $file) ) {

                    // The file is a directory, therefore run a dir check again
                    getFiles($path . '/' . $file);

                }

                // Get the information about the file
                $fileInfo = pathinfo($file);

                // Set multiple extension types that are allowed
                $allowedExtensions = array('mp3', 'wav', 'ogg', 'flac');
                 
                // Check to ensure the file is allowed before returning the results
                if( in_array($fileInfo['extension'], $allowedExtensions) ) {
                    echo '<li style="list-style-type:none;cursor:pointer;"><b><a onclick="load(\''.$path.'/'.$file .'\')">' . $file . '</a></b></li>';
                }

            }
        }

        // Close the handle
        closedir($handle);
    }
}
echo '<ul>';
getFiles(); 
echo '</ul>';
?>
</div>
</div>
</div>
</div>