<?php

class GalleryImageRepository {

     function __construct(private PDO $pdo) {}

     function fetchAll() {
        $stmt = $this->pdo->prepare('SELECT * FROM `phpk_21_gallery` ORDER BY id ASC');
        $stmt->execute();
       
        $results = $stmt->fetchAll(PDO::FETCH_CLASS, GalleryImageModel::class);
        return $results;
    }

     function handleNewUpload(string $title, string $tmpImagePath) {
        $finalFileName = uniqid('', true) . '.jpg';
        $resizeOk = resizeImage($tmpImagePath, __DIR__ . "/../images/{$finalFileName}");

        if ($resizeOk) {
            $stmt = $this->pdo->prepare('INSERT INTO `phpk_21_gallery` (title, src) VALUES (:title, :src)');
            $stmt->bindValue(':title', $title);
            $stmt->bindValue(':src', $finalFileName);
            $stmt->execute();
            return true;
        }
        else {
            return false;
        }
    }

     function delete(int $id) {
        $stmt = $this->pdo->prepare('SELECT * FROM `phpk_21_gallery` WHERE id = :id');
        $stmt->bindValue(':id', $id);
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_CLASS, GalleryImageModel::class);
        if (empty($results) || empty($results[0])) {
            return false;
        }
        $entry = $results[0];

        unlink(__DIR__ . '/../images/' . $entry->src);
        
        $stmt2 = $this->pdo->prepare('DELETE FROM `phpk_21_gallery` WHERE id = :id');
        $stmt2->bindValue(':id', $id);
        $stmt2->execute();
    }

    function findById(int $id): ?GalleryImageModel {
        $stmt = $this->pdo->prepare('SELECT * FROM `phpk_21_gallery` WHERE id = :id');
        $stmt->bindValue(':id', $id);
        $stmt->setFetchMode(PDO::FETCH_CLASS, GalleryImageModel::class);
        $stmt->execute();
        $entry = $stmt->fetch();
        if (empty($entry)) {
            return null;
        }
        else{
            return $entry;
        }
    }
    
    //return $stmt->fetch(); --> d.h. Wenn kein Eintrag --> dann  "false" ausgegeben

    // daher lieber: Funktion tpyisierbar machen, sodass Funktion immer eine Instanz von Typ GalleryImageModel zurückgibt oder ein null
    // So kann man sich darauf verlassen dass die Funktion immer eine Instanz gibt.
    // Das wird durch ": ?GalleryImageModel" ermöglicht und die Implementierung ist möglich durch die if abfrage

    function update(int $id, string $newTitle){
        $stmt = $this->pdo->prepare('UPDATE `phpk_21_gallery` SET title = :newTitle WHERE id = :id');
        $stmt ->bindValue(':newTitle', $newTitle);
        $stmt ->bindValue(':id', $id);

        $stmt->execute();
    }
}
