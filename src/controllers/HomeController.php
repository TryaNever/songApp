<?php

namespace App\Controllers;


class HomeController extends Controller
{
    /**
     * Render the homepage view.
     *
     * @return mixed The rendered view of home.html.twig.
     */
    public function index()
    {
        $currentUser = $_SESSION['user'] ?? null;
        return $this->render('home.html.twig', ["currentUser" => $currentUser]);
    }
}
