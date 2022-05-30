<?php

namespace App\Http\Livewire;

use App\Models\FamilyCard;
use Illuminate\Support\Facades\Log;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;
use Mediconesystems\LivewireDatatables\NumberColumn;
use Mediconesystems\LivewireDatatables\Traits\CanPinRecords;

class FamilyCardTable extends LivewireDatatable
{
    use CanPinRecords;

    public $beforeTableSlot = 'components.family-card-button';

    public function builder()
    {
        return FamilyCard::query();
    }

    public function columns()
    {
        return [
            Column::checkbox(),

            Column::name('id')
                ->label('ID')
                ->minWidth(20)
                ->maxWidth(20),

            Column::name('head_family_name')
                ->minWidth(200)
                ->maxWidth(200)
                ->label('Nama Kepala Keluarga')
                ->searchable(),

            NumberColumn::name('family_card_number')
                ->label('No. Kartu Keluarga')
                ->minWidth(300)
                ->maxWidth(300)
                ->searchable()
                ->alignCenter(),

            Column::callback(['family_cards.id', 'head_family_name', 'family_card_number', 'family_card_file_url'], function ($id, $head_family_name, $family_card_number, $family_card_file_url) {
                return view('components.family-card-action', [
                    'id' => $id, 
                    'head_family_name' => $head_family_name, 
                    'family_card_number' => $family_card_number, 
                    'family_card_file_url' => $family_card_file_url
                ]);
            })
                ->label('Action')
                ->alignCenter(),
        ];
    }

    public function deleteFamilyCard($id)
    {
        try {
            FamilyCard::where('id', $id)->delete();

            redirect('/family_card')->with('statusMessage', "Kamu Berhasil Menghapus data!");
        } catch (\Throwable $th) {
            Log::info($th);

            redirect('/family_card')->with('statusMessage', "Terjadi Kesalahan: " . substr($th, 0, 50));
        }
        
    }
}
