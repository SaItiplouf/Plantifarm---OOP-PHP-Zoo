<?php
// Une classe permettant d'ajouter un animal dans la base de données avec les attributs suuivants : id, nom de l'espèce, poids, taille et âge
class Animal
{
    private $id;
    private $name;
    private $poid;
    private $age;
    private $race;
    private $taille;
    private $enclos_id;
    private $imgid;
    private $vie;
    private $bouffe;
    private $created_at;
    private $lastfoodupdate;
    private $lastvieupdate;
    private $lastageupdate;
    private $lastfrauduleuxvieupdate;
    private $dead;
    private $deathcause;

    public function __construct(array $data)
    {
        $this->hydrate($data);
    }

    public function hydrate(array $data)
    {
        $this->setId($data["id"]);
        $this->setName($data["name"]);
        $this->setPoid($data["poid"]);
        $this->setAge($data["age"]);
        $this->setRace($data["race"]);
        $this->setTaille($data["taille"]);
        $this->setEnclos_id($data["enclos_id"]);
        $this->setImgid($data["imgid"] ?? null);
        $this->setVie($data["vie"]);
        $this->setBouffe($data["bouffe"]);
        $this->setCreatedAt($data["created_at"]);
        $this->setLastFoodUpdate($data["lastfoodupdate"]);
        $this->setLastVieUpdate($data["lastvieupdate"]);
        $this->setLastAgeUpdate($data["lastageupdate"]);
        $this->setLastVieUpdate($data["lastfrauduleuxvieupdate"]);
        $this->setDead($data["dead"]);
        $this->setDeathcause($data["deathcause"]);
    }

    // Chaque animal doit pouvoir manger, émettre un son, être soigné, dormir ou se réveiller
    public function eat()
    {
        echo "Je mange";
    }

    public function makeSound()
    {
        echo "Je fais un son";
    }

    public function heal()
    {
        echo "Je suis soigné";
    }

    public function sleep()
    {
        echo "Je dors";
    }

    public function wakeUp()
    {
        echo "Je me réveille";
    }

    /**
     * Get the value of id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of name
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set the value of name
     *
     * @return  self
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get the value of poid
     */
    public function getPoid()
    {
        return $this->poid;
    }

    /**
     * Set the value of poid
     *
     * @return  self
     */
    public function setPoid($poid)
    {
        $this->poid = $poid;

        return $this;
    }

    /**
     * Get the value of age
     */
    public function getAge()
    {
        return $this->age;
    }

    /**
     * Set the value of age
     *
     * @return  self
     */
    public function setAge($age)
    {
        $this->age = $age;

        return $this;
    }

    /**
     * Get the value of race
     */
    public function getRace()
    {
        return $this->race;
    }

    /**
     * Set the value of race
     *
     * @return  self
     */
    public function setRace($race)
    {
        $this->race = $race;

        return $this;
    }

    /**
     * Get the value of race
     */
    public function getCreatedAt()
    {
        return $this->created_at;
    }

    /**
     * Set the value of race
     *
     * @return  self
     */
    public function setCreatedAt($created_at)
    {
        $this->created_at = $created_at;

        return $this;
    }


    /**
     * Get the value of taille
     */
    public function getTaille()
    {
        return $this->taille;
    }

    /**
     * Set the value of taille
     *
     * @return  self
     */
    public function setTaille($taille)
    {
        $this->taille = $taille;

        return $this;
    }

    /**
     * Get the value of enclos_id
     */
    public function getEnclos_id()
    {
        return $this->enclos_id;
    }

    /**
     * Set the value of enclos_id
     *
     * @return  self
     */
    public function setEnclos_id($enclos_id)
    {
        $this->enclos_id = $enclos_id;

        return $this;
    }

    /**
     * Get the value of imgid
     */
    public function getImgid()
    {
        return $this->imgid;
    }

    /**
     * Set the value of imgid
     *
     * @return  self
     */
    public function setImgid($imgid)
    {
        $this->imgid = $imgid;

        return $this;
    }


    public function getVie()
    {
        return $this->vie;
    }


    public function setVie($vie)
    {
        $this->vie = $vie;

        return $this;
    }

    public function getBouffe()
    {
        return $this->bouffe;
    }


    public function setBouffe($bouffe)
    {
        $this->bouffe = $bouffe;

        return $this;
    }

    public function getLastFoodUpdate()
    {
        return $this->lastfoodupdate;
    }

    public function setLastFoodUpdate($lastfoodupdate)
    {
        $this->lastfoodupdate = $lastfoodupdate;

        return $this;
    }

    public function getLastVieUpdate()
    {
        return $this->lastvieupdate;
    }

    public function setLastVieUpdate($lastvieupdate)
    {
        $this->lastvieupdate = $lastvieupdate;

        return $this;
    }

    /**
     * Get the value of lastageupdate
     */
    public function getLastAgeUpdate()
    {
        return $this->lastageupdate;
    }

    /**
     * Set the value of lastageupdate
     *
     * @return  self
     */
    public function setLastAgeUpdate($lastageupdate)
    {
        $this->lastageupdate = $lastageupdate;

        return $this;
    }

    /**
     * Get the value of lastfrauduleuxvieupdate
     */
    public function getLastfrauduleuxvieupdate()
    {
        return $this->lastfrauduleuxvieupdate;
    }

    /**
     * Set the value of lastfrauduleuxvieupdate
     *
     * @return  self
     */
    public function setLastfrauduleuxvieupdate($lastfrauduleuxvieupdate)
    {
        $this->lastfrauduleuxvieupdate = $lastfrauduleuxvieupdate;

        return $this;
    }

    /**
     * Get the value of deathcause
     */
    public function getDeathcause()
    {
        return $this->deathcause;
    }

    /**
     * Set the value of deathcause
     *
     * @return  self
     */
    public function setDeathcause($deathcause)
    {
        $this->deathcause = $deathcause;

        return $this;
    }

    /**
     * Get the value of dead
     */
    public function getDead()
    {
        return $this->dead;
    }

    /**
     * Set the value of dead
     *
     * @return  self
     */
    public function setDead($dead)
    {
        $this->dead = $dead;

        return $this;
    }
}
