<?php

namespace App\Http\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Log;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;
use Mediconesystems\LivewireDatatables\Traits\CanPinRecords;

class UserTable extends LivewireDatatable
{

    use CanPinRecords;

    public $beforeTableSlot = 'components.user-management-button';

    public function builder()
    {
        return User::query();
    }

    public function columns()
    {
        return [
            Column::checkbox(),

            Column::index($this),

            Column::name('name')
                ->label('user name')
                ->searchable(),

            Column::name('email')
                ->label('email')
                ->searchable(),

            Column::name('created_at')
                ->label('Created at'),

            Column::callback([
                'id',
                'name',
                'email',
            ], function (
                $id,
                $name,
                $email
            ) {
                return view('components.user-management-action', [
                    'id' => $id,
                    'name' => $name,
                    'email' => $email,
                ]);
            })
                ->label('Action')
                ->alignCenter(),
        ];
    }

    public function deleteUser($id)
    {
        try {
            User::where('id', $id)->delete();

            redirect('/user_management')->with('statusMessage', "Kamu Berhasil Menghapus data!");
        } catch (\Throwable $th) {
            Log::info($th);

            redirect('/user_management')->with('statusMessage', "Terjadi Kesalahan: " . substr($th, 0, 50));
        }
    }
}
