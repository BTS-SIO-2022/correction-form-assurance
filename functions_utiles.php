<?php

/* Je me rends compte que je vais devoir faire les mêmes types d'opérations plusieurs. Exemple, pour chacune de mes valeurs de POST, il va falloir que je vérifie bien que la données est "propre" c'est à dire sans menace de sécurtité et qu'elle correspond bien à un chiffre. 
Du coup, je vais créer une fonction dont c'est la mission de nettoyer mes données */

function getCleanNumericPostParam($index, $valeurParDefaut=0)
{
    // Dans un 1er temps, ma fonction vérifie que mon index n'est pas vide, s'il est vide, elle reverra ma valeur par défaut
    if(!isset($index)){
        return $valeurParDefaut;
    }

    // Dans un second temps, je veux que mon fonction vérifie que la valeur contenue dans ma super-globale POST soit propre et la convertisse en integer

    if(isset($_POST[$index])){
        $dataverif = trim($_POST[$index]);
        $dataverif = stripslashes($_POST[$index]);
        $dataverif = htmlspecialchars($_POST[$index]);
        $dataverif = intval($_POST[$index]);
        return $dataverif;
    }else{
        return $valeurParDefaut;
    }
}

function getTarif(int $age,int $anciennete, int $ancienneteAssurance,int $accident)
{
    // Par défaut, tout le monde commence au palier 1 
    $tarif = 1;

    // Le nombre d'accident réduit d'autant le nombre de palier
    $tarif -= $accident;

    // Un permis de plus de 2 ans me permet d'augmenter d'un palier
    if($anciennete > 2){
        $tarif++;
    }

    // Si l'utilisateur a plus de 25 ans, +1 palier
    if($age > 25){
        $tarif++;
    }
    // Une anciennete de + de 5 ans augmente le palier d'un niveau si le conducteur n'est pas déjà refusé.
    if($ancienneteAssurance > 5 && $tarif > 0){
        $tarif++;
    }

    // Je mets en place une condition pour ne pas avoir de palier négatif ou supérieur à 4
    if($tarif < 0){
        $tarif = 0;
    }

    if($tarif > 4){
        $tarif = 4;
    }

    return $tarif;
}

function getColorandMessage($tarif, $valeurParDefaut=0)
{
    switch($tarif){
        case 0:
          $info = [
            'message' => 'Refus d\'assurer',
            'class' => 'refus' 
          ];
        break;
        case 1:
            $info = [
                'message' =>' 1, Niveau Rouge',
                'class' =>'niveau-un', 
            ];
        break;
        case 2:
            $info = [
                'message' =>' 2, Niveau Orange',
                'class' =>'niveau-deux', 
            ];
        break;
        case 3:
            $info = [
                'message' =>' 3, Niveau Vert',
                'class' =>'niveau-trois', 
            ];
        break;
        case 4:
            $info = [
                'message' =>' 4, Niveau Bleu',
                'class' =>'niveau-quatre', 
            ];
        break;
    }
    return $info;
}