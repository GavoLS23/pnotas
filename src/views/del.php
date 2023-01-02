<?php

use Gavols\Notas\models\Note;

    $uuid = ($_GET['id']);

    $note = Note::getNote($uuid);

    $note->delete();

    header('Location: http://localhost/PortafolioPHP/pnotas?viwe=home');
