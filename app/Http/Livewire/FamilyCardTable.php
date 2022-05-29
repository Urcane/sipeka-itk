<?php

namespace App\Http\Livewire;

use App\Models\FamilyCard;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;
use Mediconesystems\LivewireDatatables\NumberColumn;

class FamilyCardTable extends LivewireDatatable
{

    public $beforeTableSlot = 'components.family-card-button';

    public function builder()
    {
        return FamilyCard::query();
    }

    public function columns()
    {
        return [
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

            Column::callback(['id'], function ($id) {
                return $id;
            })
                ->label('Action')
                ->alignCenter(),
        ];
    }
}
