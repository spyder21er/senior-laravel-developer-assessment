<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\UserServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    /**
     * The user service pattern for this controller.
     *
     * @var App\Services\UserServiceInterface
     */
    protected $user_service;

    /**
     * Create a new user controller instance.
     *
     * @return void
     */
    public function __construct(UserServiceInterface $user_service)
    {
        $this->middleware('auth');
        $this->user_service = $user_service;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        
        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'prefixname' => 'nullable|in:Mr,Mrs,Ms',
            'firstname' => 'required|string',
            'middlename' => 'nullable|string',
            'lastname' => 'required|string',
            'suffixname' => 'nullable|string',
            'username' => 'required|string|unique:App\Models\User',
            'email' => 'required|email|unique:App\Models\User',
            'password' => 'required|confirmed|min:8',
            'photo' => 'nullable|image',
            'type' => 'nullable|string',
        ];
        $validated_user = $request->validate($rules);
        if ($request->hasFile('photo') && $request->file('photo')->isValid()) {
            $validated_user['photo'] = $request->photo->storeAs('images', Str::random() . "." . $request->photo->extension(), 'public');
        }
        $validated_user['password'] = bcrypt($validated_user['password']);
        if ($validated_user['type'] === null) 
            unset($validated_user['type']);
        User::create($validated_user);

        return back()->with('success', 'User created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $rules = [
            'prefixname' => 'nullable|in:Mr,Mrs,Ms',
            'firstname' => 'required|string',
            'middlename' => 'nullable|string',
            'lastname' => 'required|string',
            'suffixname' => 'nullable|string',
            'username' => ['required', 'string', Rule::unique('users')->ignore($user->id)],
            'email' => ['required', 'email', Rule::unique('users')->ignore($user->id)],
            'photo' => 'nullable|image',
            'type' => 'nullable|string',
        ];
        $new_attributes = $request->validate($rules);
        if ($request->hasFile('photo') && $request->file('photo')->isValid()) {
            $new_attributes['photo'] = $request->photo->storeAs('images', Str::random() . "." . $request->photo->extension(), 'public');
        }
        if ($new_attributes['type'] === null)
            unset($new_attributes['type']);
        $user->update($new_attributes);

        return back()->with('success', 'User updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();

        return back()->with('success', "User deleted!");
    }

    /**
     * Display a listing of trashed resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function trashed()
    {
        $users = User::onlyTrashed()->get();

        return view('users.trashed', compact('users'));
    }

    /**
     * Restore the specified soft deleted resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        $user = User::onlyTrashed()->findOrFail($id);
        $user->restore();

        return back()->with(['success' => 'User restored successfully!']);
    }

    /**
     * Permanently delete the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $user = User::onlyTrashed()->findOrFail($id);
        $user->forceDelete();

        return back()->with(['success' => 'User permanently deleted!']);
    }
}
