<?php 
if(isset($_FILES['file']) and !$_FILES['file']['error']){
    $fname = time().".wav";
    move_uploaded_file($_FILES['file']['tmp_name'], "audio/" . $fname);
}