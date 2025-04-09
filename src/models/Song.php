<?php

namespace App\models;
use App\Config\Database;


class Song extends Database
{

    private $errors = [];


    private $titre;
    private $dateSortie;
    private $chanteur;
    private $categorie;


    public function setTitre($titre)
    {
        if (strlen($titre) > 20 || strlen($titre) < 2 ) {
            $this->errors['titre'] = "Le champ titre n'est pas valide";
            return;
        }
        $this->titre = htmlspecialchars($titre);
    }
    public function setDate($date)
    {
        if (empty($date)) {
            $this->errors['date'] = "Le champ date n'est pas valide";
        }
        $this->dateSortie = htmlspecialchars($date);
    }
    public function setChanteur($chanteur)
    {
        $this->chanteur = htmlspecialchars($chanteur);
    }
    public function setCategorie($categorie)
    {
        $this->categorie = htmlspecialchars($categorie);
    }


    /**
     * Get validation errors.
     *
     * @return array The array of error messages.
     */
    public function getErrors()
    {
        return $this->errors;
    }
}