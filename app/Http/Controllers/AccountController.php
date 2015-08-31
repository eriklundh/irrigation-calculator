<?php

namespace App\Http\Controllers;

use Validator;
use Illuminate\Http\Request;
use Auth;

class AccountController extends Controller {

    public function getSignIn() {
        return view('account.signin');
    }
    public function postSignIn(Request $request) {
        $validator = Validator::make($request->all(),
            array(
                'username' => 'required',
                'password' => 'required'
            )
        );

        if($validator->fails()) {
            return redirect()->route('account-sign-in')
                    ->withErrors($validator)->withInput();
        } else {

            $remember = ($request->has('remember')) ? true : false;

            $auth = Auth::attempt(array(
                'username' => $request->get('username'),
                'password' => $request->get('password'),
                'active' => 1
            ), $remember);

            if($auth) {
                //Logging::sign_in_success();
                // redirect to the intended page
                return redirect()->intended('/');
            } else {
                //Logging::sign_in_fail($request->get('username'));
                return  redirect()->route('account-sign-in')
                        ->with('global', 'Email/password wrong, or account not activated');
            }
        }

    }

    public function getSignOut() {
        //$username = Auth::user()->username;
        Auth::logout();
        //Logging::sign_out($username);
        return redirect()->route('home');
    }

    public function getChangePassword() {
        return View::make('account.password');
    }
    public function postChangePassword() {
        $validator = Validator::make(Input::all(),
            array(
                'old_password'      => 'required',
                'password'          => 'required|min:6',
                'password_again'    => 'required|same:password'
            )
        );

        if($validator->fails()) {
            return  Redirect::route('account-change-password')
                    ->withErrors($validator);
        } else {
            $user           = User::find(Auth::user()->id);

            $old_password   = Input::get('old_password');
            $password       = Input::get('password');

            if(Hash::check($old_password, $user->getAuthPassword())) {
                $user->password = Hash::make($password);
                if($user->save()) {
                    Logging::change_password_success();
                    return  Redirect::route('home')
                            ->with('global', 'Your password has been changed.');
                }
                else Logging::change_password_fail();
            } else {
                Logging::change_password_fail();
                return  Redirect::route('account-change-password')
                        ->with('global', 'Your old password is incorrect.');
            }

        }

        return Redirect::route('account-change-password')
                ->with('global', 'Your password could not be changed.');
    }

    public function getForgotPassword() {
        return View::make('account.forgot');
    }
    public function postForgotPassword() {
        $validator = Validator::make(Input::all(),
            array(
                'email' => 'required|email'
            )
        );

        if($validator->fails()) {
            return  Redirect::route('account-forgot-password')
                    ->withErrors($validator)
                    ->withInput();
        } else {

            $user = User::where('email', '=', Input::get('email'));

            if($user->count()) {
                $user                   = $user->first();

                // Generate a new code and password
                $code                   = str_random(60);
                $password               = str_random(10);

                $user->code             = $code;
                $user->password_temp    = Hash::make($password);

                if($user->save()) {
                    Mail::send('emails.auth.forgot', array('link' => URL::route('account-recover', $code), 'username' => $user->username, 'password' => $password), function($message) use ($user) {
                        $message->to($user->email, $user->username)->subject('Your new password');
                    });

                    Logging::password_recovery_email_sent_success($user->email);
                    return  Redirect::route('home')
                            ->with('global', 'We have sent you a new password by email.');
                }
            }
        }

        Logging::password_recovery_email_sent_fail(Input::get('email'));
        return  Redirect::route('account-forgot-password')
                ->with('global', 'Could not request new password.');
    }

    public function getRecover($code) {
        $user = User::where('code', '=', $code)
                ->where('password_temp', '!=', '');
        if($user->count()) {
            $user = $user->first();

            $user->password = $user->password_temp;
            $user->password_temp = '';
            $user->code = '';

            if($user->save()) {
                return  Redirect::route('home')
                        ->with('global', 'Your account has been recovered and you can sign in with your new password.');

            }
        }

        return Redirect::route('home')
                ->with('global', 'Could not recover your account.');
    }

}
