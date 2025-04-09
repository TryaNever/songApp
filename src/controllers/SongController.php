<?php

namespace App\controllers;

use App\EntityManager;
use App\Validator;
use App\models\SongFiltre;

class SongController extends Controller
{
    private $songServiceBDD;

    public function __construct()
    {
        $this->songServiceBDD = new EntityManager();
    }

    public function index()
    {
        $data = $this->songServiceBDD->executeQuery('SELECT * FROM `chanson` ch INNER JOIN categorie ca ON ch.id_categorie = ca.id_categorie INNER JOIN chanteur cha ON cha.id_chanteur = ch.id_chanteur', []);
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $validation = new Validator();
                $error = $validation->validate($_POST, SongFiltre::class);
                if (!$error->getErrors()) {
                    if (isset($_POST['titre']) && !empty($_POST['titre'])) {
                        $data = $this->songServiceBDD->executeQuery('SELECT * FROM `chanson` ch INNER JOIN categorie ca ON ch.id_categorie = ca.id_categorie INNER JOIN chanteur cha ON cha.id_chanteur = ch.id_chanteur WHERE titre LIKE :titre', [':titre' => '%' . $_POST['titre'] . '%']);
                    }
                    if (isset($_POST['chanteur']) && !empty($_POST['chanteur'])) {
                        $data = $this->songServiceBDD->executeQuery('SELECT * FROM `chanson` ch INNER JOIN categorie ca ON ch.id_categorie = ca.id_categorie INNER JOIN chanteur cha ON cha.id_chanteur = ch.id_chanteur WHERE cha.nom_chanteur LIKE :chanteur', [':chanteur' => '%' . $_POST['chanteur'] . '%']);
                    }
                    if (isset($_POST['titre']) && !empty($_POST['titre']) || isset($_POST['chanteur']) && !empty($_POST['chanteur'])) {
                        $data = $this->songServiceBDD->executeQuery('SELECT * FROM `chanson` ch INNER JOIN categorie ca ON ch.id_categorie = ca.id_categorie INNER JOIN chanteur cha ON cha.id_chanteur = ch.id_chanteur WHERE titre LIKE :titre AND nom_chanteur LIKE :chanteur', [':titre' => '%' . $_POST['titre'] . '%', ':chanteur' => '%' . $_POST['chanteur'] . '%']);
                    }
                }
                if ($error->getErrors()) {
                    return $this->render('allSong.html.twig', ['songs' => $data, 'error' => $error->getErrors()]);
                }

        }
        $this->render('allSong.html.twig', ['songs' => $data]);
    }
}