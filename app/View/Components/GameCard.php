<?php

namespace App\View\Components;

use Illuminate\View\Component;

class GameCard extends Component{
    private array $juego;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(array $juego){
        $this->juego=$juego;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render(){
        return view('components.game-card',["juego"=>$this->juego]);
    }
    public function comprobarImagen($image):bool{
        if (@getimagesize($image)) {
            return true;
        } else {
            return false;
        }
    }
}
