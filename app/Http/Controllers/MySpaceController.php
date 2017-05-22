<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

/**
 * Class MySpaceController
 * @package App\Http\Controllers
 */
class MySpaceController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * render my_space view
     */
    public function my_space_view(){
        return view('my_space.index');
    }
}
