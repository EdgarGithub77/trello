<?php

namespace App\Http\Controllers;

use App\Board;
use App\Http\Requests\BoardRequests;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
            'boards' => $getBoards->boards
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

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
