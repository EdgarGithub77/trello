<?php

namespace App\Http\Controllers;

use App\Board;
use App\BoardUser;
use App\Http\Requests\BoardRequests;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class BoardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $getBoards = User::with('boards')->where('users.id', Auth::id())->first();

        return view('boards.index', [
            'boards' => $getBoards->boards,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * @param BoardRequests $request
     */
    public function store(BoardRequests $request)
    {
        $createBoard = Board::create($request->except('_token'));

        if ($createBoard) {
            $createBoard->users()->attach(Auth::id());
        }

        return redirect()->route('boards.index')->with(['message' => __('Success Create')]);
    }


    public function userInvite(Request $request)
    {
        $user = User::userIsActive()->findOrFail($request->user);

        $boardUser = BoardUser::where(['board_id' => Session::get('board_id'), 'user_id' => $user->id])->first();

        if (!$boardUser) {
            $board = Board::where('id', Session::get('board_id'))->first();
            $board->users()->attach($user->id);

            return redirect()->route('boards.index')->with(['message' => __('User Invited')]);
        }

        return redirect()->route('boards.index')->with(['message' => __('User Already Invited')]);

    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $showBoard = Board::findOrFail($id);

        $getUsers = User::userIsActive()->get();

        Session::put('board_id', $id);

        return view('boards.show', [
            'board' => $showBoard,
            'users' => $getUsers,

        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $board = Board::findOrFail($id);
        $board->delete();

        return redirect()->route('boards.index')->with(['message' => __('Success Delete')]);
    }
}
