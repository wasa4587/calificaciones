<?php

class UsersController extends \BaseController {

    public function __construct()
    {
        $this->beforeFilter('auth', ['except' => ['getCreate', 'postIndex']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function getIndex()
    {
        $users = User::paginate(15);

        return View::make('pages.users.list')->with('users', $users);
    }

    public function getCreate()
    {
        return View::make('pages.users.create');
    }

    public function getEdit($id)
    {
        $user = User::findOrFail($id);
        return View::make('pages.users.edit')
                    ->with('user', $user);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function postIndex()
    {
        $user = new User(Input::all());

        if ($user->save()) {
            return Redirect::to('users/index');
        } else {
            return Redirect::to('users/create')
                ->withErrors($user->getValidator());
        }
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function getDelete($id)
    {
        $user = User::findOrFail($id);

        $user->delete();

        return Redirect::to(URL::previous());
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function putUpdate($id)
    {
        $user = User::findOrFail($id);

        $user->fill(Input::all());

        if ($user->save()) {
            return Redirect::to('users/index');
        } else {
            return Redirect::to('users/edit/'.$id)
                ->withErrors($user->getValidator());
        }
    }

}
