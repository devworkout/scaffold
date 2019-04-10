<?php

namespace App\Http\Controllers\App;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AccountSettingsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware( 'auth' );
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view( 'pages.app.account-settings' );
    }

    public function update( Request $request )
    {

        if ( !Hash::check( $request->get( 'password' ), auth()->user()->getAuthPassword() ) )
        {
            flash()->error( 'Current password is incorrect' );
        }

        $this->validate( $request, [
            'new_password' => 'required|confirmed|min:6',
        ] );

        auth()->user()->update( [
            'password' => bcrypt( $request->get( 'new_password' ) ),
        ] );

        flash()->success( 'Password updated' );

        return back();

    }
}
