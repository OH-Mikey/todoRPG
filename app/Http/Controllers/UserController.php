<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //view
    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }

    //data
    public function achievements(User $user)
    {
        return response()->success([
            'user' => $user,
            'gaming' => $user->todos()->gaming()->count() > 10,
            'working' => $user->todos()->working()->count() > 10,
            'thinking' => $user->todos()->thinking()->count() > 10,
            'eating' => $user->todos()->eating()->count() > 10,
            'reading' => $user->todos()->reading()->count() > 10,
            'drinking' => $user->todos()->drinking()->count() > 10,
        ]);
    }

    //view
    public function analysis(User $user)
    {
        return view('users.analysis', compact('user'));
    }

    //data
    public function chart(User $user)
    {
        $finished = $user->todos()->where('status', 2)->count();

        $staged = $user->todos()->where('status', 1)->count();

        return response()->success([
            'user' => $user,
            'finished' => $finished,
            'staged' => $staged,
        ]);
    }
}
