<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function index() 
    {
        $users = User::orderBy('id', 'DESC')->paginate(2);

        return response()->json([
            'users' => $users,
            'status' => true
        ], 200);
    }

    public function show(User $user) : JsonResponse
    {
        return response()->json([
            'user' => $user,
            'status' => true
        ], 200);
    }

    public function store(UserRequest $request) : JsonResponse
    {
        DB::beginTransaction();

        try 
        {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => $request->password
            ]);

            DB::commit();

            return response()->json([
                'message' => "Usuário cadastrado",
                'user' => $user,
                'status' => true
            ], 201);

        } catch (Exception $e) {
            DB::rollBack();

            return response()->json([
                'message' => "Usuário não cadastrado",
                'status' => false
            ], 400);
        }
    }

    public function update(UserRequest $request, User $user) : JsonResponse
    {
        DB::beginTransaction();

        try{
            $user->update([
                'name' => $request->name,
                'email' => $request->email,
                'password' => $request->password
            ]);

            DB::commit();

            return response()->json([
                'message' => "Usuário editado com sucesso",
                'user' => $user,
                'status' => true
            ], 200);
        } catch (Exception $e) {
            DB::rollBack();

            return response()->json([
                'message' => "Usuário não editado",
                'status' => false
            ], 400);
        }

        return response()->json([
            'message' => "Usuário editado com sucesso",
            'user' => $user,
            'status' => true
        ], 200);
    }

    public function destroy(User $user) : JsonResponse
    {
        try {
            $user->delete();

            return response()->json([
                'message' => "Usuário apagado com sucesso",
                'user' => $user,
                'status' => true
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'message' => "Usuário não foi apagado",
                'status' => false
            ], 400);
        }
    }
}
