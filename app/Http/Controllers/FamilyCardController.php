<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FamilyCardController extends Controller
{
    public function index()
    {
        return view('pages.family-card');
    }

    public function store(Request $request)
    {
    }

    public function update(Request $request)
    {
    }
}
