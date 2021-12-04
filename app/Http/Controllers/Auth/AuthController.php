<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function store(Request $request){
        $data = $request->all();
        
        $validator = Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|email|string|max:255|unique:users',
            'password' => 'required:min:6',
        ]);

        if($validator->fails()){
            return response()->json(['errors' => $validator->errors()], 200);
        }

        $date = Carbon::now();
        $deleteAccount = clone($date);

        $user = new User();
        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->password = Hash::make( $data['password'] );
        $user->next_expiration = $date->addDays(7);
        $user->delete_account = $deleteAccount->addDays(15);
        $user->save();

        if($user->id){
            return response()->json([
                'access_token' => $user->createToken('auth-api')->accessToken
            ],200);
        }

        return response()->json(['error' => 'Erro ao Cadastrar o Usuário.'], 200);
    }
}
