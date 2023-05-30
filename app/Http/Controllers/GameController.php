<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\GameCompletion;
use App\Models\GameLikes;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GameController extends Controller
{
    public function show(Game $game)
    {
        $like = false;
        $liked = false;
        if (Auth::check()) {
            if (GameCompletion::where([
                ['user_id', Auth::user()->id],
                ['game_id', $game->id]
            ])->exists()) {
                $like = true;
            }
            if (GameLikes::where([
                ['user_id', Auth::user()->id],
                ['game_id', $game->id]
            ])->exists()) {
                $liked = true;
            }
        }
        return view('game', [
            'game' => $game,
            'like' => $like,
            'liked' => $liked,
        ]);
    }

    public function create()
    {
        return view('save');
    }

    public function upload(Request $request)
    {
        if (Auth::user()->banned === 0) {
            $request->validate([
                'name' => 'required|min:3|max:64|regex:/^[a-zA-Z0-9_-]+$/u|unique:games',
                'save' => 'required',
                'size' => 'required',
                'percentage' => 'required',
            ], [
                'name.required' => 'Please choose a name',
                'name.min' => 'name must be at least 3 characters long',
                'name.max' => 'name can\'t surpass 64 characters',
                'name.unique' => 'name is already taken',
                'name.regex' => 'please only use A-Z, 0-9, \'-\', \'_\' and \'#\'',
            ]);

            $game = new Game();
            $game->name = strtolower($request->name);
            $game->game = $request->save;
            $game->size = $request->size;
            $game->percentage = $request->percentage;
            $game->user_id = Auth::user()->id;
            $game->colors = '';
            $game->save();

            Auth::user()->levels++;
            Auth::user()->save();

            return redirect()->route('profile')->with(['err' => 'Your level has been created successfully!']);
        }

        return redirect()->route('profile')->with(['msg' => 'Something went wrong...']);
    }

    public function play(Game $game)
    {
        $game->plays++;
        $game->save();
    }

    public function win(Game $game)
    {
        if (!GameCompletion::where([
            ['user_id', Auth::user()->id],
            ['game_id', $game->id]
        ])->exists()) {
            $win = new GameCompletion();
            $win->game_id = $game->id;
            $win->user_id = Auth::user()->id;
            $win->save();
        }
    }

    public function like(Game $game)
    {
        if (GameLikes::where([
            ['user_id', Auth::user()->id],
            ['game_id', $game->id]
        ])->exists()) {
            GameLikes::where([
                ['user_id', Auth::user()->id],
                ['game_id', $game->id]
            ])->delete();
            $game->likes--;
            $game->save();
        } else {
            $like = new GameLikes();
            $like->user_id = Auth::user()->id;
            $like->game_id = $game->id;
            $like->save();
            $game->likes++;
            $game->save();
        }
    }

    public function destroy(Request $request, Game $game)
    {
        if ($game->user_id === Auth::user()->id || Auth::user()->admin === 1) {
            GameLikes::where('game_id', $game->id)->delete();
            GameCompletion::where('game_id', $game->id)->delete();
            $user = User::where('id', $game->user_id)->get()->first();
            $user->levels--;
            $user->save();
            $game->delete();
            return redirect()->route('profile')->with([
                'message' => 'Level deleted successfully!'
            ]);
        }
        Auth::user()->banned = 2;
        Auth::user()->reason = "Playing around with stuff that shouldn't be played around with.";
        Auth::user()->save();
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
