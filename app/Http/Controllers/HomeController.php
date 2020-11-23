<?php namespace Idee\Http\Controllers;

use Idee\Core\Repositories\PageRepo;
use Idee\Core\Repositories\ProjetRepo;
use Illuminate\Contracts\Filesystem\Filesystem;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

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

        return view('home', [
            "bloc" => $projet ? $projet->id : null,
            "deplie" => $id,
            "projets" => $projets,
            "mainPages" => $pages->take(2),
            "pages" => $pages->slice(2)
        ]);
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

    public function dl($projetFichierId, $nom, $fichier, Filesystem $filesystem)
    {
        $path = "/data/ProjetFichier/$projetFichierId/$fichier";

        if($filesystem->exists($path))
        {
            return response()->download(storage_path("app/$path"), "$nom." . $this->extension($fichier));
        }

        throw new NotFoundHttpException;
    }

    private function extension($fichier)
    {
        $tab = explode(".", $fichier);

        return sizeof($tab) ? $tab[sizeof($tab)-1] : null;
    }

}
