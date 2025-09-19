<?php

namespace App\Http\Controllers\Auth;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\User;
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
        $request->validate(['username' => $request->username, 'password' => $request->password]);

        try {
            $validate = Auth::attempt($request->username, $request->password);

            if ($validate):

                return redirect()->route('Home');

            else:

                return $this->login();

            endif;
        } catch (Throwable $th) {

            report($th);

            return $this->login();
        }
    }

    public function register()
    {
        return view('auth.register');
    }

    public function postRegister(Request $request)
    {
        $request->validate([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
        ]);

        try {

            $user = User::createUserProfile($request->name, $request->email, $request->password);

            return $this->login();
        } catch (Throwable $th) {

            report($th);

            return $this->register();
        }
    }
}
