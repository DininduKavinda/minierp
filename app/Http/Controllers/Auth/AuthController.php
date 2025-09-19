<?php

namespace App\Http\Controllers\Auth;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Throwable;

class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function login()
    {
        return view('auth.login');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function postLogin(Request $request)
    {
        //
        $validate = Validator::make($request->all(), [
            'name' => 'required',
            'password' => 'required',
        ]);

        if ($validate->fails()):

            return response()->json(['success' => false, 'errors' => $validate->errors()]);

        endif;

        try {
            $validate = Auth::attempt(['name' => $request->name, 'password' => $request->password]);

            if ($validate):

                return response()->json(['success' => true, 'message' => 'Logged In Successfully!', 'redirect' => route('Home')]);

            else:

                return response()->json(['success' => false, 'redirect' => route('login')]);

            endif;
        } catch (Exception $e) {

            return response()->json(['success' => false, 'errors' => $e->getMessage()]);
        }
    }

    public function register()
    {
        return view('auth.register');
    }

    public function postRegister(Request $request, User $user)
    {
        $validate = Validator::make($request->all(), ([
            'name' => 'required|string|max:255|unique:users',
            'password' => 'required|string|confirmed',
            'email' => 'required|email',
        ]));

        if ($validate->fails()):

            return response()->json(['success' => false, 'errors' => $validate->errors(), 'redirect' => route('login')], 422);

        endif;

        try {

            $user = $user->createUserProfile($request->name, $request->email, $request->password);

            return response()->json(['success' => true, 'message' => 'Success'], 200);
        } catch (Exception $e) {

            return response()->json(['success' => false, 'errors' => $e->getMessage()], 500);
        }
    }
}
