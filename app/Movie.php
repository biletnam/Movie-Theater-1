<?php

namespace Cinema;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class Movie extends Model
{
    protected $table = "movies";
    protected $fillable = ['name','path','cast','direction','duration','gender_id'];
    //mutador
    public function setPathAttribute($path){
        $name = Carbon::now()->second.$path->getClientOriginalName();
        $this->attributes['path'] = $name;
        \Storage::disk('local')->put($name, \File::get($path));
    }

    public static function Movies(){
        return DB::table('movies')
            ->join('genders','genders.id','=','movies.gender_id')
            ->select('movies.*', 'genders.gender')
            ->get();
    }
}
