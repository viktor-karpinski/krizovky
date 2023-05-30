<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\GameCompletion;
use App\Models\GameLikes;
use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function home()
    {
        $games = Game::all();
        return view('home', [
            'games' => $games
        ]);
    }

    public function search()
    {
        return view('home');
    }

    public function create()
    {
        return view('create');
    }

    public function profile(User $user = null)
    {
        if ($user === null) {
            $user = Auth::user();
        }
        $games = Game::where('user_id', $user->id)->orderBy('id', 'DESC')->get();
        return view('profile', [
            'games' => $games,
            'user' => $user
        ]);
    }

    public function imprint()
    {
        return view('imprint');
    }

    public function privacy_policy()
    {
        return view('policy');
    }

    public function about()
    {
        return view('about');
    }

    public function settings()
    {
        return view('settings');
    }

    public function liked()
    {
        $games = [];
        foreach (GameLikes::where('user_id', Auth::user()->id)->get() as $game) {
            $games[] = Game::where('id', $game->game_id)->get();
        }
        return view('liked', [
            'games' => $games,
        ]);
    }

    public function won()
    {
        $games = [];
        foreach (GameCompletion::where('user_id', Auth::user()->id)->get() as $game) {
            $games[] = Game::where('id', $game->game_id)->get();
        }
        return view('won', [
            'games' => $games,
        ]);
    }
}
