<?php

namespace Cinema\Http\Controllers;

use Cinema\Http\Requests\UserCreateRequest;
use Cinema\Http\Requests\UserUpdateRequest;
use Illuminate\Http\Request;
use Cinema\User;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Routing\Route;

class UsuarioController extends Controller
{
    /*public function __construct(){
        $this->beforeFilter('@find',['only' => ['edit','update','destroy']]);
    }
    public function find(Route $route){
        $this->user = User::find($route->getParameter('usuario'));

        Si se logra usar cambiar el $user por $this->user en los metodos
    }*/
    public function __construct()
    {
        $this->middleware('admin',['only'=>['create','edit']]);
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        //
        //$users= \Cinema\User::all();
        //$users= User::all();
        //OPcional para mostrar los eliminados
        $users= User::paginate(10);
        //$users= User::onlyTrashed()->paginate(10);
        return view('usuario.index',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('usuario.crear');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserCreateRequest $request)
    {
        User::create([
            'name'=> $request['name'],
            'email'=>$request['email'],
            //'password'=>bcrypt($request['password'])
            'password'=>$request['password'],
        ]);
        /*Otra manera*/
        /*
         * User::create($request->all());
         * */
        Session::flash('message','Usuario Registrado Correctamente');
        return Redirect::to('/usuario');
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
        $user=User::find($id);
        return view('usuario.edit',['user'=>$user]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserUpdateRequest $request, $id)
    {
        $user = User::find($id);
        $user->fill($request->all())->save();
        Session::flash('message','Usuario Actualizado Correctamente');
        return Redirect::to('/usuario');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //User::destroy($id);
        //Softdeletetin
        $user=User::find($id);
        $user->delete();
        //
        Session::flash('message','Usuario Eliminado Correctamente');
        return Redirect::to('/usuario');
    }
}
