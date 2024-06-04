<?php

namespace App\Http\Controllers\Auth;

use App\Enums\UserRoleEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\User;
use App\Project\User\Services\UserService;
use App\Traits\Common;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class RegisterController extends Controller
{
    use Common;

    public function store(RegisterRequest $request, UserService $userService)
    {

        DB::beginTransaction();
        try {
            $user = $userService->save($request->all());

            DB::commit();

            Auth::loginUsingId($user->id);
            $request->session()->regenerate();

            return response()->json(['type' => 'success', 'title' => 'Cadastro realizado com sucesso!', 'msg' => 'Seja bem-vindo!', 'url' => route('dashboard')]);

        } catch (\Exception $e) {
            Log::error('Erro durante o registro de usuário: '. $e->getMessage());
            DB::rollback();

            return back()->withErrors(['error' => 'Houve um problema inesperado. Tente se cadastrar novamente.']);
        }
    }
}
