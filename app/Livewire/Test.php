<?php

namespace App\Livewire;

use Livewire\Attributes\Computed;
use Livewire\Component;

class Test extends Component
{
    public $value = 0 ;

    public function increase(){
        sleep(1) ;
        $this->value++ ;
    }
    #[Computed()]
    public function value(){
        return $this->value*100 ;
    }
    public function render()
    {
        return view('livewire.test');
    }
}
