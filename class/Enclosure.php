<?php
// Une classe Enclosures qui permet de stocker 6 animaux maximum de la même espèce, la classe a également les attributs suivants : id, nom, degré de propreté (mauvaise, correcte, bonne) et le nombre d'animaux qu'il contient
class Enclosure
{
    private $id;
    private $name;
    private $type;
    private $dirty;
    private $animals_amount;
    private $animals = [];

    public function __construct(array $data)
    {
        $this->hydrate($data);
    }

    public function hydrate(array $data)
    {
        $this->setId($data["id"]);
        $this->setName($data["name"]);
        $this->setType($data["type"]);
        $this->setDirty($data["dirty"]);
        $this->setAnimals_amount($data["animals_amount"]);
    }

    // Chaque enclos doit pouvoir être nettoyé, afficher le nombre d'animaux qu'il contient et afficher le nombre d'animaux maximum qu'il peut contenir
    public function clean()
    {
        echo "Je suis nettoyé";
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
     * Get the value of type
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set the value of type
     *
     * @return  self
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get the value of dirty
     */
    public function getDirty()
    {
        return $this->dirty;
    }

    /**
     * Set the value of dirty
     *
     * @return  self
     */
    public function setDirty($dirty)
    {
        $this->dirty = $dirty;

        return $this;
    }

    /**
     * Get the value of animals_amount
     */
    public function getAnimals_amount()
    {
        return $this->animals_amount;
    }

    /**
     * Set the value of animals_amount
     *
     * @return  self
     */
    public function setAnimals_amount($animals_amount)
    {
        $this->animals_amount = $animals_amount;

        return $this;
    }

    /**
     * Get the value of animals
     */
    public function getAnimals()
    {
        return $this->animals;
    }

    /**
     * Set the value of animals
     *
     * @return  self
     */
    public function setAnimals(Animal $animals)
    {

        $this->animals[] = $animals;

        return $this;
    }
}
