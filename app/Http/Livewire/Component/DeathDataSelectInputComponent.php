<?php

namespace App\Http\Livewire\Component;

use App\Models\FamilyCard;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;

class DeathDataSelectInputComponent extends Component
{

    public string $searchText = '';
    public Collection $items;
    public array $selectedIds = [];
    public string $name;
    public string $model = FamilyCard::class;
    public string $label;

    public function fetch()
    {
        $this->items = $this->model::query()
            ->where('family_card_number', 'like', "$this->searchText%")
            ->whereNotIn('id', $this->selectedIds)
            ->limit(10)
            ->get();

        return FamilyCard::query()->whereIn('id', $this->selectedIds)->get();
    }

    public function choose($id)
    {
        $this->selectedIds[0] = $id;
    }

    public function remove($id)
    {
        $this->selectedIds = array_filter($this->selectedIds, function ($el) use ($id) {
            return $el !== $id;
        });
    }

    public function render()
    {
        return view('livewire.component.death-data-select-input-component', [
            'selectedItems' => $this->fetch()
        ]);
    }
}
