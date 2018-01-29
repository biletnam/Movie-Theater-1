<?php

namespace Cinema\Http\Controllers;

use Illuminate\Http\Request;
use Cinema\Http\Requests;
use Cinema\Http\Controllers\Controller;
use Cinema\Gender;
use Cinema\Movie;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Session;
use Cinema\Http\Requests\MovieRequest;
class MovieController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $movies = Movie::Movies();
        return view('pelicula.index',compact('movies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $genders = Gender::pluck('gender', 'id');
        return view('pelicula.create',compact('genders'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MovieRequest $request)
    {
        Movie::create($request->all());
        Session::flash('message','Pelicula Creada Correctamente');
        return Redirect::to('/pelicula');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $movie=Movie::find($id);
        $genders = Gender::pluck('gender', 'id');
        return view('pelicula.edit',['movie'=>$movie,'genders'=>$genders]);
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
        $movie=Movie::find($id);
        //\Storage::delete($movie->path);
        $movie->fill($request->all());
        $movie->save();
        Session::flash('message','Pelicula Editada Correctamente');
        return Redirect::to('/pelicula');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $movie=Movie::find($id);
        $movie->delete();
        \Storage::delete($movie->path);
        Session::flash('message','Pelicula Eliminada Correctamente');
        return Redirect::to('/pelicula');
    }
}
