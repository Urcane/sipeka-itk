<?php

namespace App\Http\Controllers;

use App\Models\FamilyCard;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class DeathDataController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.deathdata');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            "fullname" => ['required', 'max:25'],
            "family_card_number" => [
                'required',
                'integer',
                'exists:family_cards,family_card_number'
            ],
            "NIK" => [
                'required',
                'integer',
            ],
            "religion" => [
                "required",
                Rule::in(["Islam", "Kristen", "Budha", "Hindu", "Konghucu", "Katolik"]),
            ],
            "birth_place" => [
                "required",
            ],
            "birthdate" => [
                "required",
                "date"
            ],
            "deathdate" => [
                "required",
                "date"
            ],
            "address" => [
                "required",
                "max:255"
            ]
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
