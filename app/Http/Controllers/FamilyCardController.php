<?php

namespace App\Http\Controllers;

use App\Models\FamilyCard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;

class FamilyCardController extends Controller
{
    public function index()
    {
        return view('pages.family-card');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'head_family_name' => ['required'],
            'family_card_number' => ['required', 'integer', 'unique:family_cards,family_card_number'],
            'family_card_file' => ['nullable', 'mimes:jpg,jpeg,png,pdf'],
        ]);

        try {
            $familyCard = FamilyCard::create([
                "head_family_name" => $request->head_family_name,
                "family_card_number" => $request->family_card_number
            ]);
    
            if ($request->file('family_card_file') != NULL) {
                $filename = auth()->id() . '_' . time() . '_' . $request->file('family_card_file')->extension();
    
                $request->file('family_card_file')->move(public_path('file'), $filename);
    
                $familyCard->family_card_url = $filename;
                $familyCard->save();
            }

            return view('pages.family-card')->with('statusMessage', "Horray, Berhasil menambahkan kartu keluarga!");

        } catch (\Throwable $th) {
            Log::error($th);

            return view('pages.family-card')->with('statusMessage', "Error: " . substr($th, 0, 50));
        }
    }

    public function update(Request $request)
    {
        $this->validate($request, [
            'head_family_name' => ['required'],
            'family_card_number' => ['required', 'integer', Rule::unique('family_cards', 'family_card_number')->ignore($request->family_card_id)],
            'family_card_file' => ['nullable', 'mimes:jpg,jpeg,png,pdf'],
        ]);


        try {
            $familyCard = FamilyCard::find($request->family_card_id);

            $familyCard->head_family_name = $request->head_family_name;
            $familyCard->family_card_number = $request->family_card_number;

            if ($request->file('family_card_file') != NULL) {
                $filename = auth()->id() . '_' . time() . '_' . $request->file('family_card_file')->extension();
    
                $request->file('family_card_file')->move(public_path('file'), $filename);
    
                $familyCard->family_card_url = $filename;
            }
            $familyCard->save();

            return redirect('/family_card')->with('statusMessage', "Horray, Berhasil update kartu keluarga!");

        } catch (\Throwable $th) {
            Log::error($th);

            return redirect('/family_card')->with('statusMessage', "Error: " . substr($th, 0, 50));
        }
    }
}
