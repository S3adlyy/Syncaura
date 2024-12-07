<?php
if (!class_exists("reponse")) 
{
class reponse
{
    private ?int $id_reponse;
    private ?string $contenu;
    private ?DateTime $date_reponse;
    private ?int $id_question;

    // Le constructeur doit être à l'intérieur de la classe
    public function __construct(?int $id_reponse, ?string $contenu, ?DateTime $date_reponse, ?int $id_question)
    {
        $this->id_reponse = $id_reponse;
        $this->contenu = $contenu;
        $this->date_reponse = $date_reponse;
        $this->id_question = $id_question;
    }

//getters and setters

public function getid_reponse(): ?int{
    return $this->id_reponse;
}
public function setid_reponse(?int $id_reponse): void{
    $this->id_reponse=$id_reponse;
}


public function getcontenu(): ?string{
    return $this->contenu;
}
public function setcontenu(?string $contenu): void{
    $this->contenu=$contenu;
}

public function getdate_reponse(): ?DateTime{
    return $this->date_reponse;
}
public function setdate_reponse(?DateTime $date_reponse): void{
    $this->date_reponse=$date_reponse;
}

public function getid_question(): ?int{
    return $this->id_question;
}
public function setid_question(?int $id_question): void{
    $this->id=$id_question;
}





}
}
?>