<?php

class Pack
{
    private $id; 
    private $nom; 
    private $description; 
    private $prix; 
    private $image; 
    private $date_achat;

    public function __construct($id, $nom, $description, $prix, $image, $date_achat) 
    {
        $this->id = $id;
        $this->nom = $nom;
        $this->description = $description;
        $this->prix = $prix;
        $this->image = $image;
        $this->date_achat = $date_achat;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    public function getNom()
    {
        return $this->nom;
    }

    public function setNom($nom)
    {
        $this->nom = $nom;
        return $this;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription($description)
    {
        $this->description = $description;
        return $this;
    }

    public function getPrix()
    {
        return $this->prix;
    }

    public function setPrix($prix)
    {
        $this->prix = $prix;
        return $this;
    }

    public function getImage()
    {
        return $this->image;
    }

    public function setImage($image)
    {
        $this->image = $image;
        return $this;
    }

    public function getDateAchat()
    {
        return $this->date_achat;
    }

    public function setDateAchat($date_achat)
    {
        $this->date_achat = $date_achat;
        return $this;
    }
}
