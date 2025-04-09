<?php

namespace App\models;

use App\Config\Database;


class SongFiltre extends Database
{
    /**
     * Errors array to store validation messages.
     *
     * @var array
     */
    private $errors = [];

    /**
     * SongFiltre properties.
     */
    private $titre;
    private $chanteur;


    public function setTitre($titre)
    {
        if (strlen($titre) > 20 ) {
            $this->errors['error'] = "Le champ titre est trop long";
            return;
        }
        $this->titre = htmlspecialchars($titre);
    }
    public function setChanteur($chanteur)
    {
        if (strlen($chanteur) > 20 ) {
            $this->errors['error'] = "Le champ chanteur est trop long";
            return;
        }
        if (empty($this->titre) && empty($chanteur)) {
            $this->errors['error'] = "Les deux champs sont vides";
        }
        $this->titre = htmlspecialchars($chanteur);
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

    public function getTitre()
    {
        return $this->titre;
    }

    public function getChanteur()
    {
        return $this->chanteur;
    }
}
