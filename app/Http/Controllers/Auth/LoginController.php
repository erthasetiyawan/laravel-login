<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function username()
    {
        $login = request()->input('username');
        $field = filter_var($login, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
        request()->merge([$field => $login]);
        return $field;
    }

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email|exists:users,email',
            'password' => 'required'
        ]);
        $auth = $request->except(['remember_me']);
        if (auth()->once($auth, $request->remember_me)) {
            auth()->user()->update(['api_token' => Str::random(40)]);
            return response()->json(['status' => 'success', 'data' => auth()->user()->api_token], 200);
        }
        return response()->json(['status' => 'failed']);
    }

    public function profile(Request $request)
    {
        $token = ($request->bearerToken());
        $user = DB::table('users')
                ->select('name','username','email','phone','date_of_birth','photo')
                ->where('api_token', $token)->first();
        
        $list_user = [];
        if($user) {
            $list_user['name'] = $user->name;
            $list_user['username'] = $user->username;
            $list_user['email'] = $user->email;
            $list_user['phone'] = $user->phone;
            $list_user['date'] = $user->date_of_birth;
            $list_user['photo'] = asset(('storage/' . $user->photo));
        }

        return response()->json(['status' => 'success', 'data' => $list_user], 200);
    }

    public function logout(Request $request)
    {
        $token = ($request->bearerToken());
        $user = DB::table('users')
        ->select('*')
        ->where('api_token', $token)->first();
        if($user) {
            DB::table('users')->where(['id' => $user->id])->update(['api_token' => '']);
        }
        return response()->json(['status' => 'success'], 200);
    }
}
