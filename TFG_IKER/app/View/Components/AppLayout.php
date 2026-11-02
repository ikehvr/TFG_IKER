<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\View\View;

class AppLayout extends Component
{
    /**
     * Consigue la vista / contenido que representa al componenente
     */
    public function render(): View
    {
        return view('layouts.app');
    }
}
