<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;

class UserController extends Controller
{

    public function index()
    {
        return view('pages.user-management');
    }

    public function store(Request $request)
    {
        $rules = [
            'name' => [
                'required',
            ],
            'email' => [
                'required',
                'email',
                'string',
                'unique:users,email'
            ],
            'password' => [
                'required',
                'confirmed',
                'min:8'
            ]
        ];

        if (isset($request->user_id)) {
            $rules['email'] = [
                'required',
                'email',
                'string',
                Rule::unique('users', 'email')->ignore($request->user_id)
            ];

            $rules['password'] = [
                'nullable',
                'confirmed',
                'min:8'
            ];
        }

        $this->validate($request, $rules);

        try {
            $user = User::updateOrCreate([
                'id' => $request->user_id,
            ], [
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password)
            ]);

            // if (isset($request->password)) {
            //     $user->password = Hash::make($request->password);
            //     $user->save();
            // }

            return redirect('/user_management')->with('statusMassage', 'Berhasil nih buat/update data User!!');
        } catch (\Throwable $th) {
            Log::info($th);

            return redirect('/user_management')->with('statusMassage', 'Ups, Kamu gagall. ada yang salah');
        }
    }
}
