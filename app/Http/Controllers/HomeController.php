<?php namespace Idee\Http\Controllers;

use Idee\Core\Repositories\PageRepo;
use Idee\Core\Repositories\ProjetRepo;

class HomeController extends Controller {
    /**
     * @var ProjetRepo
     */
    private $projetRepo;

    /**
     * @var PageRepo
     */
    private $pageRepo;

    /**
     * @param ProjetRepo $projetRepo
     */
    function __construct(ProjetRepo $projetRepo, PageRepo $pageRepo)
    {
        $this->projetRepo = $projetRepo;
        $this->pageRepo = $pageRepo;
    }

    public function index()
	{
		return $this->projet(null);
	}

    public function projet($id, $slug=null)
    {
        $projets = $this->projetRepo->all();
        $pages = $this->pageRepo->all();

        $projet = $id ? $projets->find($id) : null;
        if( ! $projet) $projet = $projets[0];

        return view('home', ["bloc"=>$projet->id, "deplie"=>$id, "projets" => $projets, "pages"=>$pages]);
    }

    public function page($key)
    {
        $projets = $this->projetRepo->all();
        $pages = $this->pageRepo->all();

        $page = $pages->filter(function($item) use($key) {
            return $item->key == $key;
        })->first();

        if( ! $page) return redirect()->to("/");

        return view('home', ["bloc"=>$key, "deplie"=>true, "projets" => $projets, "pages"=>$pages]);
    }

}
