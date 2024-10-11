<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style.css">
    <title>FileUpload</title>
</head>
<body>
    
<div class="con">
    <h1>Select file to upload</h1>
    <form action="" method="post" enctype="multipart/form-data">
        <input 
        type="file" name="imageToUpload" id="imageToUpload" 
        accept=".jpg, .jpeg, .gif, .png, .mp3, .doc, .docx, .xls, .xlsx, .ppt, .pptx, .txt, .rtf, .pdf, .odt, .odf, .odp, .ods, .odg, .zip, .rar, .tar, .gz, .bz2, .epub, .mobi, .fb2">
        <input type="submit" value="Upload Image" name="submit">
    </form>
</div>

</body>
</html>


<?php
$target_dir = "uploads/";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $target_file = $target_dir . basename($_FILES["imageToUpload"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    $check = getimagesize($_FILES["imageToUpload"]["tmp_name"]);
    if ($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }

    if (file_exists($target_file)) {
        echo "Sorry, file already exists.";
        $uploadOk = 0;
    }

    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }

    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
    } else {
        if (move_uploaded_file($_FILES["imageToUpload"]["tmp_name"], $target_file)) {
            echo "The file " . htmlspecialchars(basename($_FILES["imageToUpload"]["name"])) . " has been uploaded.";
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
}
?>


