<?php namespace Idee\Core\Repositories;

use Idee\Core\Projet;

class ProjetRepo {

    public function all()
    {
        $projets = Projet::select("projets.*")
            ->where("en_ligne", true)
            ->with(["contenu", "visuels", "visuels.photo", "visuel", "partenaires"])
            ->join("contenus", "projets.contenu_id", "=", "contenus.id")
            ->orderBy("contenus.ordre")
            ->get();

        $i = 1;
        foreach($projets as &$projet)
        {
            if($projet->is_mode_actu) continue;
            $projet->numero = $i++;
        }

        return $projets;
    }
}