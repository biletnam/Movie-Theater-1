<?php

namespace Cinema\Http\Controllers;

use Cinema\Http\Requests\GenderRequest;
use Illuminate\Http\Request;
use Cinema\Gender;

class GenderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        if ($request->ajax()) {
            $genders = Gender::all();
            return response()->json($genders);
        }
        return view('genero.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('genero.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(GenderRequest $request)
    {
        if($request->ajax()){
            Gender::create($request->all());
            return response()->json([
                "mensaje" => "Se ha creado con exito"
            ]);
        }
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
        $gender = Gender::find($id);
        return response()->json($gender);
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
        $gender = Gender::find($id);
        $gender->fill($request->all());
        $gender->save();
        return response()->json(["mensaje" => "Se ha modificado con exito"]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $gender=Gender::find($id);
        $gender->delete();
        return response()->json(["mensaje"=>"borrado"]);
    }
}
