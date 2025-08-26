<?php

// File: app/View/Components/Sidebar/Links.php
namespace App\View\Components\Sidebar;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Links extends Component
{
    public string $title, $route, $icon;
    public bool $active;

    public function __construct($title, $route, $icon)
    {
        $this->title = $title;
        $this->route = $route;
        $this->icon = $icon;
        $this->active = request()->routeIs($this->route);
    }

    public function render(): View|Closure|string
    {
        return view('components.sidebar.links');
    }
}
