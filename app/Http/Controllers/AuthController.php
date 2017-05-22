<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

/**
 * Class AuthController
 * @package App\Http\Controllers
 */
class AuthController extends Controller
{
    /**
     * Render register view
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function register_view()
    {
        return view('auth.register');
    }

    /**
     * @param Request $request
     * $request = user data
     * @return \Illuminate\Http\JsonResponse
     * return validation errors || boolean saved
     */
    public function register(Request $request)
    {
        $this->validate($request, [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8|confirmed',
            'password_confirmation' => 'required|same:password'
        ]);

        $user = new User();
        $user->first_name = $request->input('first_name');
        $user->last_name = $request->input('last_name');
        $user->email = $request->input('email');
        $user->password = Hash::make($request->input('password'));
        $user->key = str_random(40);
        $user->confirmed = false;
        // Saving User
        if ($user->save()) {

            //Sending Email
            Mail::send('emails.register', ['user' => $user], function ($message) use ($user) {
                $message->from('Support@MonFeed.fr', 'MonFeed');
                $message->to($user->email);
            });

            return response()->json(['saved' => true]);
        } else {
            return response()->json(['saved' => false]);
        }
    }

    /**
     * @param $key
     * $key = $user->key
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
     * Set $user.confirmed = true && Render view || Redirect
     */
    public function email_confirmation($key)
    {
        if ($user = User::where('key', $key)->first()) {
            if ($user->confirmed == 0) {
                $user->confirmed = 1;
                $user->save();
                return view('auth.confirmed', compact('user'));
            } else {
                return redirect('/');
            }
        } else {
            return redirect('/');
        }

    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * Render login view
     */
    public function login_view()
    {
        return view('auth.login');
    }

    /**
     * @param Request $request
     * $request = $user->email && $user->password && boolean stayConnected
     * @return \Illuminate\Http\JsonResponse
     * return boolean loggedIn
     */
    public function login(Request $request)
    {
        if (Auth::attempt(['email' => $request->input('email'), 'password' => $request->input('password'), 'confirmed' => 1], $request->input('stayConnected'))) {
            return response()->json(['loggedIn' => true]);
        } else {
            return response()->json(['loggedIn' => false]);
        }
    }

    /**
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * return Logout && redirect
     */
    public function logout()
    {
        Auth::logout();
        return Redirect('/');
    }
}
