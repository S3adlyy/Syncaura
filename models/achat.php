<?php

class Achat
{
    private $ida; 
    private $nom_user; 
    private $email; 
    private $idPack;

    public function __construct($ida, $nom_user, $email, $idPack)
    {
        $this->ida = $ida;
        $this->nom_user = $nom_user;
        $this->email = $email;
        $this->idPack = $idPack;
    }
    

    public function getIda()
    {
        return $this->ida;
    }

    public function setIda($ida)
    {
        $this->ida = $ida;
        return $this;
    }

    public function getNomUser()
    {
        return $this->nom_user;
    }

    public function setNomUser($nom_user)
    {
        $this->nom_user = $nom_user;
        return $this;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
        return $this;
    }


    public function getIdPack()
    {
        return $this->idPack;
    }

    public function setIdPack($idPack)
    {
        $this->idPack = $idPack;
        return $this;
    }

}
