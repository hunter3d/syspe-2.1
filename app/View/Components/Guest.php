<?php
# (c) PremierExpo 2022

namespace App\View\Components;

use Illuminate\View\Component;

class Guest extends Component
{
    public $headTitle;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct( $headTitle )
    {
        //
        $this->headTitle = $headTitle;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('layouts.guest');
    }
}
