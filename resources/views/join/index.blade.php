@extends('layouts.app')
 
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Browse/Join a Debate') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group row">
                            <div class = "col-md-6">
                                <div class = "offset-md-1"> <strong> {{ __('Watch a Debate') }} </strong> </div>
                                <div class="form-group row">
                                    <label for="watchDebateId" class="col-md-4 offset-md-1 col-form-label text-md-right">{{ __('Debate #:') }}</label>
                                    <div class="col-md-6">
                                        <input id="watchDebateId" type="text" onfocus = "changeFocus('watch')" placeholder = "{{ __('Your answer') }}" class="form-control{{ $errors->has('watchDebateId') ? ' is-invalid' : '' }}" name="watchDebateId" required>

                                        @if ($errors->has('watchDebateId'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('watchDebateId') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="watchPassword" class="col-md-4 offset-md-1 col-form-label text-md-right">{{ __('Password:') }}</label>
                                    <div class="col-md-6">
                                        <input id="watchPassword" type="password" onfocus = "changeFocus('watch')" placeholder = "{{ __('Your answer') }}" class="form-control{{ $errors->has('watchPassword') ? ' is-invalid' : '' }}" name="watchPassword" required>

                                        @if ($errors->has('watchPassword'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('watchPassword') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class = "offset-md-1"> <strong> {{ __('Join a Debate') }} </strong> </div>
                                <div class="form-group row">
                                    <label for="joinDebateId" class="col-md-4 offset-md-1 col-form-label text-md-right">{{ __('Debate #:') }}</label>
                                    <div class="col-md-6">
                                        <input id="joinDebateId" type="text" onfocus = "changeFocus('join')" placeholder = "{{ __('Your answer') }}" class="form-control{{ $errors->has('joinDebateId') ? ' is-invalid' : '' }}" name="joinDebateId" required>

                                        @if ($errors->has('joinDebateId'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('joinDebateId') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="joinPassword" class="col-md-4 offset-md-1 col-form-label text-md-right">{{ __('Password:') }}</label>
                                    <div class="col-md-6">
                                        <input id="joinPassword" type="password" onfocus = "changeFocus('join')" placeholder = "{{ __('Your answer') }}" class="form-control{{ $errors->has('joinPassword') ? ' is-invalid' : '' }}" name="joinPassword" required>

                                        @if ($errors->has('joinPassword'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('joinPassword') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class = "col-md-6">
                                <div class = "form-group row">
                                    <div class = "col-md-10 offset-md-1">
                                        <div> <strong>{{ __('Last Debate you watched:') }}</strong> </div>
                                        <div> Debate: 9538 </div>
                                        <div class = "mb-30"> Topic: Chocolate or Vanilla </div>

                                        <div> <strong>{{ __('Trending Debate Topics:') }}</strong> </div>
                                        <div> 1. Is Tom brady the best QB? </div>
                                        <div> 2. Will Trump Win 2020 Election? </div>
                                        <div> 3. Will the healthcare bill pass? </div>
                                        <div> 4. Who's more powerful JLo or Arod? </div>
                                        <div> 5. What's better for you? Tea vs Coffee </div>
                                    </div>
                                </div>
                            </div>
                            <div class = "col-md-6">
                                <div class = "form-group row">
                                    <div class = "col-md-10 offset-md-1">
                                        <div> <strong>{{ __('Last Debate you joined:') }}</strong> </div>
                                        <div> Debate: 5136 </div>
                                        <div class = "mb-30"> Who's better? Mets or Rays </div>

                                        <div> <strong>{{ __('Most Popular Debate:') }}</strong> </div>
                                        <div> Debate: 6234 </div>
                                        <div class = "mb-30"> Should the US invade Iran </div>

                                        <div> <strong>{{ __('Fastest Growing Debate:') }}</strong> </div>
                                        <div> Debate: 1791 </div>
                                        <div > MJ was the king, not Elvis </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-3 text-md-center">
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