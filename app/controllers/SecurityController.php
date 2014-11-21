<?php

class SecurityController extends \BaseController {


    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $errors = [];
        if (Session::has('error')) {
            $errors[] = Session::get('error');
        }
        return View::make('pages.login')->with('errors',$errors);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        if (Auth::attempt(array('username' => Input::get('username'), 'password' => Input::get('password'))))
        {
            return Redirect::to('/');
        } else {
            return Redirect::to('/login')
                ->with('error', 'Login fallido');;            
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy()
    {
        Auth::logout();
    }

}
