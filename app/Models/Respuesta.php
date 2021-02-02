<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Respuesta extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'pregunta',
        'respuesta',
        'correcta',
    ];
    protected $casts = [
        'correcta' => 'boolean',
    ];
    public function preguntas(){
        return $this->belongsTo(Pregunta::class,"pregunta","id");
    }
    public function toJsonArray(): array
    {
        return ["respuesta"=>$this->respuesta,"correcta"=>$this->correcta];
    }
}
