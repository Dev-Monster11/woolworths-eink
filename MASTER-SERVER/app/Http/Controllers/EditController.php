<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tag;
class EditController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){

        // return view('edit', ['devices' => ]);
        return view('edit', ['tags' => Tag::all()]);
    }
}
