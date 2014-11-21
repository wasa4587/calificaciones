<?php

class SecurityController extends \BaseController {


    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return View::make('pages.login');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        $user = new User(Input::all());

        if ($user->save()) {
            return Response::json($user, 201);
        } else {
            return Response::json(['errors' => $user->getErrors()], 400);
        }
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $users = User::findOrFail();

        return Response::json($users);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {
        $user = User::findOrFail($id);

        $user->fill(Input::all());

        if ($user->save()) {
            return Response::json($user);
        } else {
            return Response::json(['errors' => $user->getErrors()], 400);
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);

        $user->delete();

        return Response::json($user);
    }

}
