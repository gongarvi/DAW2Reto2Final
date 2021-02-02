<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Especialidad;
class Mujer extends Model
{
    use HasFactory;

    protected $table = "mujeres";
    protected $fillable = [
        'id',
        'nombre',
        'apellidos',
        'nacimiento',
        'fallecido',
        'nacionalidad',
        'especialidad',
        'foto',
        'descripcion'
    ];

    public function especialidades()
    {
        return $this->belongsTo(Especialidad::class, "especialidad", "id");
    }

    public function preguntas()
    {
        return $this->hasMany(Pregunta::class, "mujer", "id");
    }

    public static function getMujeresPorEspecializacion($especializacion)
    {
        $mujeres = Mujer::with([
            "preguntas" => function ($query) {
                $query->whereNotNull("preguntas.mujer");
            }])->where("especialidad", $especializacion)->where("foto","!=","")->get();
        $mujeres = $mujeres->filter(function ($mujer) {
            return count($mujer["preguntas"]) > 0;
        });
        return $mujeres;
    }

    public static function getMujeresAleatorias()
    {
        $mujeres = Mujer::with([
            "preguntas" => function ($query) {
                $query->whereNotNull("preguntas.mujer");
            }])->where("foto","!=","")->get();
        $mujeres = $mujeres->filter(function ($mujer) {
            return count($mujer["preguntas"]) > 0;
        });
        return $mujeres;
    }
}
