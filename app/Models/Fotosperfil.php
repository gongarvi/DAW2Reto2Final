<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Mujer;

class Fotosperfil extends Model
{
    use HasFactory;

    protected $table = "fotosperfil";
    protected $fillable = [
        'id',
        'usuario',
        'mujer'
    ];
    // public function user(){
    //     return $this->hasMany(User::class);
    // }
    // public function mujer(){
    //     return $this->hasMany(Mujer::class);
    // }
}
