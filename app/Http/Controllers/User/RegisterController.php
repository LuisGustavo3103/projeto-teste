<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\RegisterRequest;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Log;

class RegisterController extends Controller
{
    public function index()
    {
        return view('register');
    }

    public function store(RegisterRequest $request)
    {
        $incomingFields = $request->validated();
        try {
            User::create([
                'name' => data_get($incomingFields, 'name'),
                'email' => data_get($incomingFields, 'email'),
                'password' => bcrypt(data_get($incomingFields, 'password')),
            ]);
        } catch (Exception $exception) {
            Log::error($exception);

            return response()->json('Erro inesperado', 500);
        }

        return redirect('/')->with('success', 'Usuário criado com sucesso!');
    }
}
