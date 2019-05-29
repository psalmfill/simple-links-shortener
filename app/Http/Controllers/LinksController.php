<?php

namespace App\Http\Controllers;

use App\Http\Requests\LinkRequest;
use App\Repositories\LinkRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class LinksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $repository;

    public function __construct(LinkRepository $linkRepository)
    {
        $this->middleware('auth')->except('show');
        $this->repository = $linkRepository;
    }

    public function index()
    {
        $links =  $this->repository->getUserLinks(auth()->id());
        return view('user.link.index',compact('links'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('user.link.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(LinkRequest $request)
    {

         $this->repository->create($request->except(['_token']));
         return redirect()->route('links.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $link = $this->repository->getLinkById($id);
        $this->repository->updateView($id);

        return redirect()->away($this->formatUrl($link->url));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $link = $this->repository->getLinkById($id);
        return view('user.link.edit',compact('link'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->repository->update($request->except(['_token']),$id);
        return redirect()->route('links.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->repository->delete($id);
        return redirect()->route('links.index');
    }

    public function formatUrl($string)
    {   $http = ['https://', 'http://'];
        if(strpos($string,$http[0]) || strpos($string,$http[1]))
        {
            return $string;
        }else{

            return $http[1].$string;
        }
    }
}
