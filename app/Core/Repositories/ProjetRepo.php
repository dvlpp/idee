<?php namespace Idee\Core\Repositories;

use Idee\Core\Projet;

class ProjetRepo {

    public function all()
    {
        $projets = Projet::select("projets.*")
            ->where("en_ligne", true)
            ->with(["contenu", "visuels", "visuels.photo", "visuel", "fichiers", "fichiers.fichier", "partenaires"])
            ->join("contenus", "projets.contenu_id", "=", "contenus.id")
            ->orderBy("contenus.ordre")
            ->get();

        $this->affecterNumeroToProjets($projets);

        return $projets;
    }

    /**
     * @param $projets
     * @return mixed
     */
    protected function affecterNumeroToProjets(&$projets)
    {
        $nbProjetsNonActus = $projets->reduce(function ($carry, $item)
        {
            return $carry + ($item->is_mode_actu ? 0 : 1);
        });

        foreach ($projets as &$projet)
        {
            if ($projet->is_mode_actu) continue;
            $projet->numero = $nbProjetsNonActus--;
        }
    }
}