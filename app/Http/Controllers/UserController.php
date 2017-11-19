<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class UserController extends Controller
{
    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }

    public function achievements(User $user)
    {
        //game master
        $game = $user->todos()->where('status', 2)
                ->where('categories', 'gaming')->count() > 100;

        return response()->json();
    }

    public function analysis()
    {
        return view('users.analysis');
    }

    public function chart(User $user)
    {
        $finished = $user->todos()->where('status', 2)->count();

        $staged = $user->todos()->where('status', 1)->count();

        return response()->json([
            'user' => $user,
            'finished' => $finished,
            'staged' => $staged,
        ]);
    }
}
