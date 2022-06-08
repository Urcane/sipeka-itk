<?php

namespace App\Http\Livewire;

use App\Models\DeathData;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\DateColumn;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;
use Mediconesystems\LivewireDatatables\NumberColumn;
use Mediconesystems\LivewireDatatables\TimeColumn;
use Mediconesystems\LivewireDatatables\Traits\CanPinRecords;

class DeathDataTable extends LivewireDatatable
{

    use CanPinRecords;

    public $beforeTableSlot = 'components.deathdata-button';

    public function builder()
    {
        return DeathData::query()
            ->leftJoin("family_cards", "family_cards.id", "family_card_id");
    }

    public function columns()
    {
        return [
            Column::checkbox(),

            Column::index($this),

            Column::name('full_name')
                ->minWidth(200)
                ->maxWidth(200)
                ->label('Nama Lengkap')
                ->searchable(),

            NumberColumn::name('family_cards.family_card_number')
                ->label('No. Kartu Keluarga')
                ->searchable(),

            Column::name('NIK')
                ->label('NIK')
                ->searchable(),

            Column::name('religion')
                ->label('Agama')
                ->filterable(),

            Column::name('birth_place')
                ->label('Tempat Lahir')
                ->filterable(),

            DateColumn::name('birthdate')
                ->label('Tanggal Lahir')
                ->filterable(),

            DateColumn::name('deathdate')
                ->label('Tanggal Kematian')
                ->filterable(),

            Column::name('address')
                ->minWidth(200)
                ->maxWidth(200)
                ->label('Alamat'),

            Column::callback([
                'death_data.id',
                'full_name',
                'family_card_id',
                'family_cards.family_card_number',
                'NIK',
                'religion',
                'birth_place',
                'birthdate',
                'deathdate',
                'address',
            ], function (
                $id,
                $full_name,
                $family_card_id,
                $family_card_number,
                $NIK,
                $religion,
                $birth_place,
                $birthdate,
                $deathdate,
                $address
            ) {
                return view('components.deathdata-action', [
                    'id' => $id,
                    'full_name' => $full_name,
                    'family_card_id' => $family_card_id,
                    'family_card_number' => $family_card_number,
                    'NIK' => $NIK,
                    'religion' => $religion,
                    'birth_place' => $birth_place,
                    'birthdate' => Carbon::parse($birthdate)->format('Y-m-d'),
                    'deathdate' => Carbon::parse($deathdate)->format('Y-m-d'),
                    'address' => $address
                ]);
            })
                ->label('Action')
                ->alignCenter(),
        ];
    }

    public function deleteDeathdata($id)
    {
        try {
            DeathData::where('id', $id)->delete();

            return redirect('/death_data')->with('statusMessage', "Kamu Berhasil Menghapus data!");
        } catch (\Throwable $th) {
            Log::info($th);

            return redirect('/death_data')->with('statusMessage', "Terjadi Kesalahan: " . substr($th, 0, 50));
        }
    }
}
