<?php

namespace App\controllers;
use App\EntityManager;

class SongController extends Controller
{
    private $songServiceBDD;
    public function __construct() {
        $this->songServiceBDD = new EntityManager();
    }
    public function index() {
        $data = $this->songServiceBDD->executeQuery('SELECT * FROM `chanson` ch
INNER JOIN categorie ca ON ch.id_categorie = ca.id_categorie
INNER JOIN chanteur cha ON cha.id_chanteur = ch.id_chanteur', []);
        $this->render('allSong.html.twig', ['songs' => $data]);
    }
}