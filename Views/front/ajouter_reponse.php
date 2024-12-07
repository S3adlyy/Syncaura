<?php
include 'C:\wamp64\www\crud kooli\config.php';
include 'C:\wamp64\www\crud kooli\model\Reponse.php';
include 'C:\wamp64\www\crud kooli\controller\reponseC.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les données du formulaire
    $id_reponse = $_POST['id_reponse'];
    $contenu = $_POST['contenu'];
    $date_reponse = $_POST['date_reponse'];
    $id_question = $_POST['id_question'];

    // Créer un objet Reponse et initialiser les valeurs
    $reponse = new Reponse($id_reponse, $contenu, new DateTime($date_reponse), $id_question);

    // Créer un objet reponseC et appeler la fonction addReponse
    $reponseController = new reponseC();
    $reponseController->addReponse($reponse);
}
?>