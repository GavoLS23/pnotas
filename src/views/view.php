<?php

use Gavols\Notas\models\Note;


if(count($_POST)>0){
    $title = (isset($_POST['title'])) ? $_POST['title'] : "Titulo de prueba";
    $content = (isset($_POST['content'])) ?  $_POST['content'] : "Contenido de prueba";
    $uuid = ($_POST['id']);

    $note = Note::getNote($uuid);

    $note->setTitle($title);
    $note->setContent($content);

    $note->update();

}else if(isset($_GET['id'])){
    $note = Note::getNote($_GET['id']);
}else{
    header('Location: http://localhost/PortafolioPHP/pnotas?viwe=home');
}
 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="src/views/resources/main.css">
    <title>View</title>
</head>
<body>
    <h1>View a note</h1>
    <?php require 'resources/navbar.php'?>

    
    <form action="?view=view&id=<?php echo $note->getUUID()?>" method="POST">
        <input value="<?php echo $note->getTitle()?>" name="title" type="text" placeholder="Title..." />
        <input type="hidden" name="id" value="<?php echo $note->getUUID()?>"> 
        <textarea name="content" placeholder="Content..." id="" cols="30" rows="10"><?php echo $note->getContent()?></textarea>
        <input class="upd-b" type="submit" value="Update note"/>
        <div class="del-b" type="submit">
            <a class="del-b" href="?view=del&id=<?php echo $note->getUUID()?>">Delete note</a>
        </div>
    </form>

</body>
</html>