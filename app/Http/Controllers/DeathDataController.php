<?php

namespace App\Http\Controllers;

use App\Models\DeathData;
use App\Models\FamilyCard;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
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
        Log::info($request);


        $this->validate($request, [
            "fullname" => ['required', 'max:25'],
            "family_card_id" => [
                'required',
                'array',
            ],
            "family_card_id.*" => isset($request->death_data_id) ? [
                'exists:family_cards,id,' . $request->death_data_id
            ] : [
                'exists:family_cards,id'
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

        DeathData::updateOrCreate([
            'id' => $request->death_data_id
        ], [
            'full_name' => $request->fullname,
            'family_card_id' => $request->family_card_id[0],
            'NIK' => $request->NIK,
            'religion' => $request->religion,
            'birth_place' => $request->birth_place,
            'birthdate' => Carbon::parse($request->birthdate),
            'deathdate' => Carbon::parse($request->deathdate),
            'address' => $request->address
        ]);

        return redirect('/death_data')->with('statusMassage', 'Berhasil Hore!!');
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
