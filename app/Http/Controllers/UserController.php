<?php

namespace App\Http\Controllers;

use App\Contracts\CounterContract;
use App\Facades\CounterFacade;
use App\Http\Requests\UserRequest;
use App\Models\Image;
use App\Models\User;
use App\Services\Counter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->authorizeResource(User::class, 'user');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return view('user.show', ['user' => $user,'counter'=> CounterFacade::increament("user-$user->id")]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        return view('user.edit', [
            'user' => $user,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserRequest $request, User $user)
    {
        $request->validated();
        $path = $request->file('avatar')->store('avatars');
        if($user->image){
            Storage::delete($user->image->thumnail);
            $user->image->thumnail = $path;
            $user->image->save();
        }else{
            $user->image()->save(
                Image::make([
                    'thumnail'=>$path
                ])
            );
        }
        $user->update([
            'name'=>$request->name,
            'local'=>$request->local
        ]);
        return redirect()->back()->withStatus("User profile updated");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }

}
