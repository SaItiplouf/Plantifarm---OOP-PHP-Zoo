<?php

class Telephone
{
    private $db;
    public function __construct(PDO $db)
    {
        $this->setDb($db);
    }

    public function getEnclos($id)
    {
        $query = $this->db->prepare("SELECT * FROM enclos WHERE enclos.id=:id");
        $query->execute([
            "id" => $id
        ]);
        $data = $query->fetch(PDO::FETCH_ASSOC);
        return new Enclosure($data);
    }
    public function getAllEnclos()
    {
        $query = $this->db->query("SELECT * FROM enclos");
        $enclos = array();
        while ($data = $query->fetch(PDO::FETCH_ASSOC)) {
            $enclos[] = new Enclosure($data);
        }
        return $enclos;
    }
    public function getAnimalFromEnclosure(Enclosure $enclosure)
    {
        $query = $this->db->prepare("SELECT * FROM animal WHERE enclos_id=:id AND dead=0");
        $query->bindValue(":id", $enclosure->getId(), PDO::PARAM_INT);
        $query->execute();
        $animalsData = $query->fetchAll(PDO::FETCH_ASSOC);

        foreach ($animalsData as $data) {
            $animal = new Animal($data);


            $this->checkBouffe($animal);

            $this->updateBouffe($animal);
            $this->updateVie($animal);
            $enclosure->setAnimals($animal);
            $this->updateAge($animal);
            $this->updateEnclosAnimalCount($enclosure->getId());

            // $this->regenVie($animal);
        }
    }
    public function getDeadAnimalFromEnclosure(Enclosure $enclosure)
    {
        $query = $this->db->prepare("SELECT * FROM animal WHERE dead=1");
        $query->execute();
        $animalsData = $query->fetchAll(PDO::FETCH_ASSOC);

        foreach ($animalsData as $data) {
            $animal = new Animal($data);
            $enclosure->setAnimals($animal);
            $this->updateDeadAnimalCount();
        }
    }
    public function updateVie($animal)
    {
        date_default_timezone_set('Europe/Paris');
        $timestamp = round((time() - strtotime($animal->getLastFoodUpdate())) / (60 * 60), 1);


        if ($timestamp >= 1 && $animal->getBouffe() >= 40) {
            $vieaajouter = $timestamp * 20.0;
            $nouvelleVie = $animal->getVie() + 20;
            if ($nouvelleVie > 100) {
                $nouvelleVie = 100;
            }
            $animal->setVie($nouvelleVie);
            try {
                $stmt = $this->db->prepare("UPDATE animal SET vie = :vie, lastfrauduleuxvieupdate = NOW() WHERE id = :id");
                $stmt->bindValue(':vie', $nouvelleVie, PDO::PARAM_INT);
                $stmt->bindValue(':id', $animal->getId(), PDO::PARAM_INT);
                $stmt->execute();
            } catch (PDOException $e) {
                echo "Erreur lors de la mise à jour de la vie de l'animal : " . $e->getMessage();
            }
        }
    }
    public function updateBouffe($animal)
    {
        date_default_timezone_set('Europe/Paris');
        $diff_hours = round((time() - strtotime($animal->getLastFoodUpdate())) / (60 * 60), 1);

        if ($diff_hours >= 1 && $animal->getBouffe() > 0) {
            $food_to_subtract = round((time() - strtotime($animal->getLastFoodUpdate())) / (60 * 60), 1) * 20.0;
            $animal->setBouffe($animal->getBouffe() - $food_to_subtract);

            $stmt = $this->db->prepare("UPDATE animal SET bouffe = :bouffe, lastfoodupdate = NOW() WHERE id = :id");
            $stmt->bindValue(':bouffe', $animal->getBouffe(), PDO::PARAM_INT);
            $stmt->bindValue(':id', $animal->getId(), PDO::PARAM_INT);
            $stmt->execute();
        }
    }


    public function updateAge($animal)
    {
        date_default_timezone_set('Europe/Paris');
        $diff_hours = round((time() - strtotime($animal->getLastAgeUpdate())) / (60 * 60), 1);

        if ($diff_hours >= 1) {
            $animal->setAge($animal->getAge() + ($diff_hours * 5));

            $stmt = $this->db->prepare("UPDATE animal SET age = :age , lastageupdate = NOW() WHERE id = :id");
            $stmt->bindValue(':age', $animal->getAge(), PDO::PARAM_INT);
            $stmt->bindValue(':id', $animal->getId(), PDO::PARAM_INT);
            $stmt->execute();


            if ($animal->getAge() > 100) {
                $stmt = $this->db->prepare("UPDATE animal SET dead = 1, deathcause = 'Vieux' WHERE id = :id");
                $stmt->bindValue(':id', $animal->getId(), PDO::PARAM_INT);
                $stmt->execute();
            }
        }
    }


    public function checkBouffe($animal)
    {
        // On calcule la limite de temps de nourriture
        $feed_limit_time = round((time() - strtotime($animal->getLastFoodUpdate())) / (60 * 60), 1);
        $vie = round((time() - strtotime($animal->getLastVieUpdate())) / (60 * 60), 1);
        // On vérifie si l'heure limite est dépassée
        if ($feed_limit_time >= 5) {
            // Animal est mort
            $stmt = $this->db->prepare("UPDATE animal SET dead = 1, deathcause = 'Famine' WHERE id = :id");
            $stmt->bindValue(':id', $animal->getId(), PDO::PARAM_INT);
            $stmt->execute();
        } else if ($feed_limit_time >= 1 && $animal->getVie() > 0) {
            // On calcule les points de vie à retirer
            $hp_loss = floor($vie) * 20;

            // On retire les points de vie
            $animal->setVie($animal->getVie() - $hp_loss);

            // On met à jour la date de dernière mise à jour de nourriture
            $stmt = $this->db->prepare("UPDATE animal SET vie = :vie, lastvieupdate = NOW() WHERE id = :id");
            $stmt->bindValue(':vie', $animal->getVie(), PDO::PARAM_INT);
            $stmt->bindValue(':id', $animal->getId(), PDO::PARAM_INT);
            $stmt->execute();
        }
    }


    // public function regenVie($animal)
    // {
    //     date_default_timezone_set('Europe/Paris');
    //     $bouffe = $animal->getBouffe();
    //     $vie = $animal->getVie();
    //     $last_vie_update = strtotime($animal->getLastVieUpdate());
    //     $current_time = time();

    //     // Si la nourriture est à 100, régénérer 1 point de vie par minute
    //     if ($bouffe == 100) {
    //         $regen_rate = 1; // Taux de régénération
    //         $elapsed_time = $current_time - $last_vie_update; // Temps écoulé depuis la dernière mise à jour de nourriture
    //         $hp_to_add = floor($elapsed_time / 60) * $regen_rate; // Nombre de points de vie à ajouter

    //         $vie += $hp_to_add;

    //         // Mettre à jour la vie et la date de dernière mise à jour de nourriture
    //         $stmt = $this->db->prepare("UPDATE animal SET vie = :vie, lastvieupdate = NOW() WHERE id = :id");
    //         $stmt->bindValue(':vie', $vie, PDO::PARAM_INT);
    //         $stmt->bindValue(':id', $animal->getId(), PDO::PARAM_INT);
    //         $stmt->execute();
    //     } else if ($bouffe <= 0) {
    //         $death_time = $last_vie_update + (5 * 60); // 5 minutes avant la mort

    //         if ($current_time >= $death_time) {
    //             // Animal est mort
    //             $this->deleteAnimal($animal->getId());
    //         } else {
    //             // Calcul de la vie restante
    //             $remaining_time = $death_time - $current_time;
    //             $hp_to_subtract = ceil($vie / $remaining_time);
    //             $vie -= $hp_to_subtract;

    //             if ($vie <= 0) {
    //                 $this->deleteAnimal($animal->getId());
    //             } else {
    //                 // Mettre à jour la vie et la date de dernière mise à jour de nourriture
    //                 $stmt = $this->db->prepare("UPDATE animal SET vie = :vie, lastvieupdate = NOW() WHERE id = :id");
    //                 $stmt->bindValue(':vie', $vie, PDO::PARAM_INT);
    //                 $stmt->bindValue(':id', $animal->getId(), PDO::PARAM_INT);
    //                 $stmt->execute();
    //             }
    //         }
    //     }
    // }
    // public function getAnimalbyId($id)
    // {
    //     $query = $this->db->prepare("SELECT * FROM animal WHERE id=:id");
    //     $query->bindValue(":id", $id);
    //     $query->execute();
    //     $animalsData = $query->fetchAll(PDO::FETCH_ASSOC);
    // }

    public function getAllAnimalFromEnclosure(array $enclosures)
    {
        foreach ($enclosures as $enclosure) {
            $query = $this->db->prepare("SELECT * FROM animal WHERE enclos_id=:id");
            $query->bindValue(":id", $enclosure->getId());
            $query->execute();
            $animalsData = $query->fetchAll(PDO::FETCH_ASSOC);

            foreach ($animalsData as $data) {
                $animal = new Animal($data);
                $enclosure->setAnimals($animal);
            }
        }
    }
    public function nourrir($animal_id)
    {
        // Prépare la requête de suppression de l'animal
        $query = "UPDATE animal SET bouffe = 100 WHERE id = ?";
        $statement = $this->db->prepare($query);
        $statement->execute([$animal_id]);
        // Vérifie si la suppression a été effectuée avec succès
        $num_rows_updated = $statement->rowCount();
        if ($num_rows_updated == 0) {
            echo ("Impossible de nourrir l'animal avec l'ID $animal_id.");
        }
    }
    public function hasRenard($enclosId)
    {
        $stmt = $this->db->prepare('SELECT COUNT(*) FROM animal WHERE enclos_id = :enclosId AND race = "Renard"');
        $stmt->bindParam(':enclosId', $enclosId, PDO::PARAM_INT);
        $stmt->execute();
        $count = $stmt->fetchColumn();
        return $count > 0;
    }
    public function newkill($animal_id, $cause)
    {
        $stmt = $this->db->prepare("UPDATE animal SET dead = 1, deathcause = '$cause' WHERE id = :id");
        $stmt->bindValue(':id', $animal_id, PDO::PARAM_INT);
        $stmt->execute();
    }
    public function modifierProprete($enclos_id)
    {

        $random_number = rand(1, 5);
        $proprete = 'Bonne';

        // Récupérer la propreté actuelle de l'enclos dans la base de données
        $query = "SELECT dirty FROM enclos WHERE id = ?";
        $statement = $this->db->prepare($query);
        $statement->execute([$enclos_id]);
        $result = $statement->fetch(PDO::FETCH_ASSOC);
        $proprete = $result['dirty'];

        // Déterminer aléatoirement la nouvelle propreté
        $random_number = rand(1, 20);
        if ($proprete == 'Bonne') {
            if ($random_number == 1) {
                $proprete = 'Moyen';
            } else {
                $proprete = 'Bonne';
            }
        } elseif ($proprete == 'Moyen') {
            if ($random_number == 1) {
                $proprete = 'Mauvaise';
            } else {
                $proprete = 'Moyen';
            }
        } elseif ($proprete == 'Mauvaise') {
            $proprete = 'Mauvaise';
        }


        // Requete mise à jour propreté
        $query = "UPDATE enclos SET dirty = ? WHERE id = ?";
        $statement = $this->db->prepare($query);
        $statement->execute([$proprete, $enclos_id]);
        $num_rows_updated = $statement->rowCount();
        if ($num_rows_updated == 0) {
            echo ("<script>msg='Impossible de mettre à jour la propreté de l\'enclos avec l\'ID $enclos_id'; console.log(msg); </script>");
        } else {
            echo ("<script>msg='Mise à jour de la propreté de l'enclos avec l\'ID $enclos_id'; console.log(msg); </script>");
        }
    }

    public function nettoyer($enclos_id)
    {
        // Prépare la requête de suppression de l'animal
        $query = "UPDATE enclos SET dirty = 'Bonne' WHERE id = ?";
        $statement = $this->db->prepare($query);
        $statement->execute([$enclos_id]);
        // Vérifie si la suppression a été effectuée avec succès
        $num_rows_updated = $statement->rowCount();
        if ($num_rows_updated == 0) {
            echo ("Impossible de rendre propre l'enclos avec l'ID $enclos_id.");
        }
    }
    public function updateEnclosAnimalCount($enclos_id)
    {
        // Compte le nombre d'animaux dans l'enclos correspondant
        $query = "SELECT COUNT(*) as count FROM animal WHERE enclos_id = ? AND dead = 0";
        $statement = $this->db->prepare($query);
        $statement->execute([$enclos_id]);
        $result = $statement->fetch(PDO::FETCH_ASSOC);
        $animal_count = $result['count'];

        // Met à jour le nombre d'animaux dans la table enclos correspondante
        $query = "UPDATE enclos SET animals_amount = ? WHERE id = ?";
        $statement = $this->db->prepare($query);
        $statement->execute([$animal_count, $enclos_id]);
    }
    public function updateDeadAnimalCount()
    {
        // Compte le nombre d'animaux dans l'enclos correspondant
        $query = "SELECT COUNT(*) as count FROM animal WHERE dead = 1";
        $statement = $this->db->prepare($query);
        $statement->execute();
        $result = $statement->fetch(PDO::FETCH_ASSOC);
        $animal_count = $result['count'];

        // Met à jour le nombre d'animaux dans la table enclos correspondante
        $query = "UPDATE enclos SET animals_amount = ? WHERE id = 5";
        $statement = $this->db->prepare($query);
        $statement->execute([$animal_count]);
    }

    public function deleteAnimal($animal_id)
    {
        // Prépare la requête de suppression de l'animal
        $query = "DELETE FROM animal WHERE id = ?";
        $statement = $this->db->prepare($query);
        $statement->execute([$animal_id]);
        // Vérifie si la suppression a été effectuée avec succès
        $num_rows_deleted = $statement->rowCount();
        if ($num_rows_deleted == 0) {
            throw new Exception("Impossible de supprimer l'animal avec l'ID $animal_id.");
        }
    }
    public function switchAnimal($animal_id, $idEnclos2)
    {
        // Prépare la requête de mise à jour de l'animal
        $query = "UPDATE animal SET enclos_id = ? WHERE id = ?";
        $statement = $this->db->prepare($query);
        $statement->bindValue(1, $idEnclos2);
        $statement->bindValue(2, $animal_id);
        $statement->execute();
        // Vérifie si la mise à jour a été effectuée avec succès
        $num_rows_updated = $statement->rowCount();
        if ($num_rows_updated == 0) {
            echo ("Impossible de mettre à jour l'enclos de l'animal");
        }
    }

    public function pretyDump($data)
    {
        highlight_string("<?php\n\$data =\n" . var_export($data, true) . ";\n?>");
    }
    /**
     * Get the value of db
     */
    public function getDb()
    {
        return $this->db;
    }

    /**
     * Set the value of db
     *
     * @return  self
     */
    public function setDb($db)
    {
        $this->db = $db;

        return $this;
    }
}
