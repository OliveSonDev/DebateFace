@extends('layouts.app')
 
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Start a Debate') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('gostart') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-md-5 col-form-label text-md-right">{{ __('Topic of your Debate ?') }}</label>

                            <div class="col-md-6">
                                <input id="topic" type="text" placeholder = "{{ __('Your answer') }}" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="topic" value="{{ old('email') }}" required autofocus>

                                @if ($errors->has('topic'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('topic') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-5 col-form-label text-md-right">{{ __('Public or Private ?') }}</label>

                            <div class="col-md-6 ">
                                <div class="form-check">
                                    <div>
                                        <input class="form-check-input" type="radio" name="debatetype" id="publictype" value = "0" checked>

                                        <label class="form-check-label" for="publictype">
                                            {{ __('Public') }}
                                        </label>
                                    </div>
                                    <div>
                                        <input class="form-check-input" type="radio" name="debatetype" id="privatetype" value = "1" >

                                        <label class="form-check-label" for="privatetype">
                                            {{ __('Private') }}
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-5 col-form-label text-md-right">{{ __('Password of Debate') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="text" placeholder = "{{ __('Your Password') }}" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" >

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="rule" class="col-md-5 col-form-label text-md-right">{{ __('Rules or Instructions') }}</label>

                            <div class="col-md-6">
                                <input id="rule" type="text" placeholder = "{{ __('Your answer') }}" class="form-control{{ $errors->has('rule') ? ' is-invalid' : '' }}" name="rule" >

                                @if ($errors->has('rule'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('rule') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="invite" class="col-md-5 col-form-label text-md-right">{{ __('Invite User 1 email :') }}</label>

                            <div class="col-md-6">
                                <input id="debator_one" type="text" placeholder = "{{ __('debator Email') }}" class="form-control{{ $errors->has('debator_one') ? ' is-invalid' : '' }}" name="debator_one" >

                                @if ($errors->has('debator_one'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('debator_one') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="invite" class="col-md-5 col-form-label text-md-right">{{ __('Invite User 2 email :') }}</label>

                            <div class="col-md-6">
                                <input id="debator_two" type="text" placeholder = "{{ __('debator Email') }}" class="form-control{{ $errors->has('debator_two') ? ' is-invalid' : '' }}" name="debator_two" >

                                @if ($errors->has('debator_two'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('debator_two') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-5">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('SUBMIT') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection