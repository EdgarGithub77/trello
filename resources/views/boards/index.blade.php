@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="boards">
                    <div class="card">
                        <div class="card-header">Boards</div>
                        <div class="mx-auto mt-2 mb-2">
                            @if(session()->has('message'))
                                <div class="error text-success">{{ session()->get('message')}}</div>
                            @endif
                            @if($errors->has('name'))
                                <div class="error text-danger">{{ $errors->first('name') }}</div>
                            @endif
                            @if($errors->has('visibility'))
                                <div class="error text-danger">{{ $errors->first('visibility') }}</div>
                            @endif
                            <div class="text-center">
                                <button type="button" class="btn btn-secondary" data-toggle="modal"
                                        data-target="#exampleModal" data-whatever="@mdo">+ {{ __('Create') }}</button>
                            </div>
                        </div>
                        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
                             aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">{{ __('Create New Board') }}</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form method="POST" action="{{ route('boards.store') }}">
                                            @csrf
                                            <div>
                                                <div class="form-group">
                                                    <label for="recipient-name" class="col-form-label">Name:</label>
                                                    <input type="text" name="name" class="form-control"
                                                           id="recipient-name" required>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="visibility"
                                                           id="publicBoard" value="1" checked>
                                                    <label class="form-check-label"
                                                           for="exampleCheck1">{{ __('Public') }}</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="visibility"
                                                           id="privateBoard" value="0">
                                                    <label class="form-check-label"
                                                           for="exampleCheck1">{{ __('Privat') }}</label>
                                                </div>

                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">{{ __('Close') }}</button>
                                                    <button type="submit"
                                                            class="btn btn-primary">{{ __('Create') }}</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="row">
                            @foreach ($boards as $board)
                                <div class="col-sm-4">
                                    <div class="board-box">
                                        <div class="clearfix">
                                            <h5 class="card-title"><a href="#">{{ $board->name }}</a></h5>
                                            <form action="{{ route('boards.destroy', $board->id) }}" method="POST">
                                                @method('DELETE')
                                                @csrf
                                                <button>X</button>
                                            </form>
                                        </div>
                                        <p class="card-text">{{ $board->visibility ? __('Public') : __('Private') }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
