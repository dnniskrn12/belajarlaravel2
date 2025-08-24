<?php

namespace App\View\Components;

use Illuminate\View\Component;

class PageHeader extends Component
{
    public $title;
    public $icon;
    public $breadcrumbs;

    public function __construct($title, $icon = 'mdi mdi-file', $breadcrumbs = [])
    {
        $this->title = $title;
        $this->icon = $icon;
        $this->breadcrumbs = $breadcrumbs;
    }

    public function render()
    {
        return view('components.page-header');
    }
}
