<?php 

namespace Gavols\Notas\models;

use Gavols\Notas\lib\Database;
use PDO;
use PDOException;


class Note extends Database{
    
    private string $uuid;

    public function __construct(private string $title, private string $content)
    {
        parent::__construct();
        $this->uuid = uniqid();
    }
    public function save(){
        $query = $this->connect()->prepare("INSERT INTO notes (uuid, title, content, updated) VALUES (:uuid, :title, :content, NOW());");
        $query->execute([':title' => $this->title, ':uuid' => $this->uuid, ':content'=>$this->content]);

    }

    public function update(){
        $query = $this->connect()->prepare("UPDATE notes SET title = :title, content = :content, updated = NOW() WHERE uuid = :uuid ;");
        $query->execute([':title' => $this->title, ':uuid' => $this->uuid, ':content'=>$this->content]);
    }

    public function delete(){
        $query = $this->connect()->prepare("DELETE FROM notes WHERE uuid = :uuid ;");
        $query->execute([':uuid' => $this->uuid]);
    }
    

    public static function getNote($id){
        $db = new Database();
        
        $query = $db->connect()->prepare(" SELECT * FROM notes WHERE uuid = :id; ");
        $query->execute([':id' => $id]);

        try{
            $note = Note::createFromArray($query->fetch(PDO::FETCH_ASSOC));
        }catch(PDOException $e){
            return $e;
        }

        return $note;
    }

    public static function getAll(){
        $db = new Database();
        $notes = [];
        $query = $db->connect()->query(" SELECT * FROM notes; ");

        while($r = $query->fetch(PDO::FETCH_ASSOC)){
            $note = Note::createFromArray($r);

            array_push($notes, $note);
        }


        return $notes;
    }

    public static function createFromArray($arr): Note{
        $note = new Note($arr['title'],$arr['content']);
        $note->setUUID($arr['uuid']);

        return $note;
    }

    public function getUUID(){
        return $this->uuid;
    }
    public function setUUID($value){
        $this->uuid = $value;
    }
    public function getTitle(): string{
        return $this->title;
    }
    public function setTitle($value){
        $this->title = $value;
    }
    public function getContent(): string{
        return $this->content;
    }
    public function setContent($value){
        $this->content = $value;
    }
}

