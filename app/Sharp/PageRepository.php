<?php namespace Idee\Sharp;

use Dvlpp\Sharp\ListView\SharpEntitiesListParams;
use Dvlpp\Sharp\Repositories\SharpCmsRepository;
use Dvlpp\Sharp\Repositories\SharpEloquentRepositoryUpdaterTrait;
use Dvlpp\Sharp\Repositories\SharpEloquentRepositoryUpdaterWithUploads;
use Dvlpp\Sharp\Repositories\SharpHasActivateState;
use Dvlpp\Sharp\Repositories\SharpIsReorderable;
use Idee\Core\Contenu;
use Idee\Core\Page;
use Idee\Sharp\Utils\IllustrableUpdaterTrait;
use Idee\Sharp\Utils\UploadsUpdaterTrait;

class PageRepository implements SharpCmsRepository, SharpIsReorderable, SharpHasActivateState, SharpEloquentRepositoryUpdaterWithUploads {

    use SharpEloquentRepositoryUpdaterTrait;

    use UploadsUpdaterTrait;

    use IllustrableUpdaterTrait;

    /**
     * Find an instance with the given id.
     *
     * @param $id
     * @return mixed
     */
    function find($id)
    {
        return Page::find($id);
    }

    /**
     * List all instances, with optional sorting and search.
     *
     * @param \Dvlpp\Sharp\ListView\SharpEntitiesListParams $params
     * @return mixed
     */
    function listAll(SharpEntitiesListParams $params)
    {
        return Page::select('pages.*')
            ->join("contenus", "pages.contenu_id", "=", "contenus.id")
            ->orderBy("contenus.ordre")
            ->get();
    }

    /**
     * Paginate instances.
     *
     * @param $count
     * @param \Dvlpp\Sharp\ListView\SharpEntitiesListParams $params
     * @return mixed
     */
    function paginate($count, SharpEntitiesListParams $params) {}

    /**
     * Create a new instance for initial population of create form.
     *
     * @return mixed
     */
    function newInstance()
    {
        return new Page();
    }

    /**
     * Persists an instance.
     *
     * @param array $data
     * @return mixed
     */
    function create(Array $data)
    {
        return $this->update(null, $data);
    }

    /**
     * Update an instance.
     *
     * @param $id
     * @param array $data
     * @return mixed
     */
    function update($id, Array $data)
    {
        if( ! $id)
        {
            $p = $this->newInstance();
            $c = new Contenu();
            $c->save();
            $p->contenu()->associate($c);
        }
        else
        {
            $p = $this->find($id);
        }

        return $this->updateEntity("contenu", "page", $p, $data);
    }

    /**
     * Delete an instance.
     *
     * @param $id
     * @return mixed
     */
    function delete($id)
    {
        return $this->find($id)->delete();
    }

    /**
     * Reorder instances to match the given id array.
     *
     * @param array $entitiesIds
     * @return mixed
     */
    function reorder(Array $entitiesIds)
    {
        $pages = Page::with("contenu")
            ->whereIn("id", $entitiesIds)
            ->get();

        foreach($pages as $page)
        {
            $page->contenu->ordre = array_search($page->id, $entitiesIds) + 1;
            $page->contenu->save();
        }
    }

    /**
     * @param $id
     * @return mixed
     */
    function activate($id)
    {
        $this->activateDesactivate($id, true);
    }

    /**
     * @param $id
     * @return mixed
     */
    function deactivate($id)
    {
        $this->activateDesactivate($id, false);
    }

    private function activateDesactivate($id, $activate)
    {
        $page = Page::with("contenu")->where("id", $id)->first();
        $page->contenu->en_ligne = $activate;
        $page->contenu->save();
    }
}