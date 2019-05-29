<?php


namespace App\Repositories;


use App\Link;

class LinkRepository
{
    protected $link;

    public function __construct(Link $link)
    {

        $this->link = $link;

    }


    public function getLinkById($id)
    {
        return $this->link->findOrFail($id);
    }


    public function getAll()
    {
        return $this->link->all();
    }

    public function create($params)
    {

        $link = new Link($params);

        $link->save();

        return $link;

    }

    public function update($params,$id)
    {

        return $this->link->find($id)->update($params);

    }


    public function delete($id)
    {

        return $this->link->destroy($id);

    }

    public function getUserLinks($id)
    {

        return $this->link->where('user_id',$id)->get();

    }

    public function updateView($id)
    {
        $this->link->find($id)->increment('view',1);
    }
}