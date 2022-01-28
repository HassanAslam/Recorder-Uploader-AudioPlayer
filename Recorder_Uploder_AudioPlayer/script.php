<?php
    
 $allowedExts = array("mp3", "mp4", "wav");
 $temp = explode(".", $_FILES["file"]["name"]);
 $extension = end($temp);

    if ((($_FILES["file"]["type"] == "audio/mp3")
    || ($_FILES["file"]["type"] == "audio/mp4")
    || ($_FILES["file"]["type"] == "audio/wav"))
    && ($_FILES["file"]["size"] < 100000000)
    || in_array($extension, $allowedExts))
    {
        if ($_FILES["file"]["error"] > 0)
        {
            echo "Return Code: " . $_FILES["file"]["error"] . "<br />";
        }
        else
        {
            echo "Upload: " . $_FILES["file"]["name"] . "<br />";
            echo "Type: " . $_FILES["file"]["type"] . "<br />";
            echo "Size: " . ($_FILES["file"]["size"] / 1024) . " Kb<br />";
            echo "Temp file: " . $_FILES["file"]["tmp_name"] . "<br />";

            if (file_exists("upload/" . $_FILES["file"]["name"]))
            {
                echo $_FILES["file"]["name"] . " already exists. ";
            }
            else
            {
                move_uploaded_file($_FILES["file"]["tmp_name"], "audio/" . $_FILES["file"]["name"]);
                echo "Stored in: " . "audio/" . $_FILES["file"]["name"];
            }
        }
    }
    else
    {
        echo "Invalid file";
    }
?>