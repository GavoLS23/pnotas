<?php

use Gavols\Notas\models\Note;


if(count($_POST)>0){
    $title = (isset($_POST['title'])) ? $_POST['title'] : "Titulo de prueba";
    $content = (isset($_POST['content'])) ?  $_POST['content'] : "Contenido de prueba";  

    $note = new Note($title, $content);

    $note->save();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="src/views/resources/main.css">
    
    <title>Create note</title>
</head>
<body>
    <h1>Create a note</h1>
    <?php require 'resources/navbar.php'?>
    <form action="?view=create" method="POST">
        <input name="title" type="text" placeholder="Title..." />
        <textarea name="content" placeholder="Content..." id="" cols="30" rows="10"></textarea>
        <input type="submit" value="Create note"/>
    </form>
</body>
</html>