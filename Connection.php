<?php

class Connection {

    public PDO $pdo;

    public function __construct() {
        $this->pdo = new PDO('mysql:server=localhost;dbname=notes', 'root', 'root');
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public function getNotes() {
        $statement = $this->pdo->prepare("select * from notes order by create_date desc");
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function addNote($note) {
        $statement = $this->pdo->prepare("insert into notes (title, description, create_date) values (:title, :description, :date)");
        $statement->bindValue('title', $note['title']);
        $statement->bindValue('description', $note['description']);
        $statement->bindValue('date', date('Y-m-d H:i:s'));
        return $statement->execute();
    }

    public function getNoteById($id) {
        $statement = $this->pdo->prepare("select * from notes where id = :id");
        $statement->bindValue('id', $id);
        $statement->execute();
        return $statement->fetch(PDO::FETCH_ASSOC);
    }

    public function updateNote($id, $note) {
        $statement = $this->pdo->prepare("update notes set title = :title, description = :description where id = :id");
        $statement->bindValue('id', $id);
        $statement->bindValue('title', $note['title']);
        $statement->bindValue('description', $note['description']);
        return $statement->execute();
    }

    public function removeNote($id) {
        $statement = $this->pdo->prepare("DELETE FROM notes WHERE id = :id");
        $statement->bindValue('id', $id);
        $statement->execute();
    }


}
return $connection = new Connection();