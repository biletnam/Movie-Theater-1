<?php namespace Cinema\Http\Controllers;

class PruebaC extends Controller{
    public function index(){
        return "ABC";
    }
    public function nombre($nombre){
        return "Mi nombre es: ".$nombre;
    }
}