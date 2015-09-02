<?php namespace Idee\Core\Repositories;

use Idee\Core\Page;

class PageRepo {

    public function all()
    {
        return Page::select("pages.*")
            ->where("en_ligne", true)
            ->with("contenu")
            ->join("contenus", "pages.contenu_id", "=", "contenus.id")
            ->orderBy("contenus.ordre")
            ->get();
    }
}