@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="boards">
                    <div class="card">
                        <div class="card-header">Cards</div>
                        <div class="col-md-4">
                            @if($errors->has('message'))
                                <div class="error text-success">{{ $errors->first('message') }}</div>
                            @endif
                            <form method="POST" action="{{ route('userInvite') }}">
                                @csrf
                                <div class="form-row align-items-center">
                                    <div class="col-auto my-1">
                                        <label class="mr-sm-2" for="inlineFormCustomSelect">{{ __('Add user To board') }}</label>
                                        <select class="custom-select mr-sm-2" name="user"  id="inlineFormCustomSelect">
                                            <option selected>Choose...</option>
                                            @foreach ($users as $user)
                                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-auto">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
