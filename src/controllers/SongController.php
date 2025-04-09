<?php

namespace App\controllers;

use App\EntityManager;
use App\Validator;
use App\models\Song;

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
            $model = $validation->validate($_POST, SongFiltre::class);
            if (!$model->getErrors()) {
                if (isset($_POST['titre']) && !empty($_POST['titre'])) {
                    $data = $this->songServiceBDD->executeQuery('SELECT * FROM `chanson` ch INNER JOIN categorie ca ON ch.id_categorie = ca.id_categorie INNER JOIN chanteur cha ON cha.id_chanteur = ch.id_chanteur WHERE titre LIKE :titre', [':titre' => '%' . $model->getTitre() . '%']);
                }
                if (isset($_POST['chanteur']) && !empty($_POST['chanteur'])) {
                    $data = $this->songServiceBDD->executeQuery('SELECT * FROM `chanson` ch INNER JOIN categorie ca ON ch.id_categorie = ca.id_categorie INNER JOIN chanteur cha ON cha.id_chanteur = ch.id_chanteur WHERE cha.nom_chanteur LIKE :chanteur', [':chanteur' => '%' . $model->getChanteur() . '%']);
                }
                if (isset($_POST['titre']) && !empty($_POST['titre']) || isset($_POST['chanteur']) && !empty($_POST['chanteur'])) {
                    $data = $this->songServiceBDD->executeQuery('SELECT * FROM `chanson` ch INNER JOIN categorie ca ON ch.id_categorie = ca.id_categorie INNER JOIN chanteur cha ON cha.id_chanteur = ch.id_chanteur WHERE titre LIKE :titre AND nom_chanteur LIKE :chanteur', [':titre' => '%' . $model->getTitre() . '%', ':chanteur' => '%' . $model->getChanteur() . '%']);
                }
            }
            if ($model->getErrors()) {
                return $this->render('allSong.html.twig', ['songs' => $data, 'error' => $model->getErrors()]);
            }

        }
        return $this->render('allSong.html.twig', ['songs' => $data]);
    }

    public function createSong()
    {
        $categorie = $this->songServiceBDD->findAll('categorie');
        $chanteur = $this->songServiceBDD->findAll('chanteur');
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $validation = new Validator();
            $model = $validation->validate($_POST, Song::class);
            if (empty($model->getErrors())) {
                $this->songServiceBDD->executeQuery('INSERT INTO `chanson`(`titre`, `date`, `id_chanteur`, `id_categorie`) VALUES (:titre,:date,:id_chanteur,:id_categorie)', [':titre' => $_POST['titre'], ':date' => $_POST['date'], ':id_chanteur' => $_POST['chanteur'], ':id_categorie' => $_POST['categorie']]);
                return $this->render('createSong.html.twig', ['categories' => $categorie, 'chanteurs' => $chanteur, 'succes' => true]);

            }
            return $this->render('createSong.html.twig', ['categories' => $categorie, 'chanteurs' => $chanteur, 'error' => $model->getErrors()]);
        }

        return $this->render('createSong.html.twig', ['categories' => $categorie, 'chanteurs' => $chanteur]);
    }

    public function deleteSong($id)
    {

        $this->songServiceBDD->executeQuery('DELETE FROM `chanson` WHERE id_chanson = :id', [':id' => $id]);
        header('location:/song');

    }
}