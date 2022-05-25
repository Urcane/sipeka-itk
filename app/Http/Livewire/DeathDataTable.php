<?php

namespace App\Http\Livewire;

use App\Models\DeathData;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\DateColumn;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;
use Mediconesystems\LivewireDatatables\NumberColumn;

class DeathDataTable extends LivewireDatatable
{
    public function builder()
    {
        return DeathData::query()
            ->leftJoin("family_cards", "family_cards.id", "family_card_id");
    }

    public function columns()
    {
        return [
            Column::index($this),

            Column::name('full_name')
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
                ->label('Alamat')
        ];
    }
}
