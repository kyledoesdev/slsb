@extends('layouts.app')

@section('content')
    <div class="container">
        @if (!auth()->user()->isTwitchUser())
            <a class="btn btn-info" href="/login/twitch">Connect to Twitch</a>
            <br>
        @else
            <div class="d-flex row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="mt-2">Disconnect From Twitch</h3>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('user.disconnect_from_twitch', ['id' => auth()->user()->username]) }}" method="POST">
                                @csrf
                                <div class="row mb-3">
                                    <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Set a new Password') }}</label>
                                    <div class="col-md-6">
                                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirm new Password') }}</label>
                                    <div class="col-md-6">
                                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                    </div>
                                </div>
                                <div class="row justify-content-center">
                                    <div class="col-md-6 text-center">
                                        <button type="submit" class="btn btn-danger">Disconnect</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="card-footer">
                            <h5 class="row fw-bold mx-1">PLEASE NOTE</h5>
                            <span class="row text-muted mx-1">
                                Disconnecting your account will do the following:
                                <ul>
                                    <li>Reset your profile photo to a randomly generated image</li>
                                    <li>Reset your profile to have no bio</li>
                                    <li>Required you to set a new password above for the platofrm as you will no longer be using your twitch password.</li>
                                </ul>
                            </span>
                            <span class="row text-muted mx-1">
                                Disconnecting your account will not do the following:
                                <ul>
                                    <li>Delete any of your Posts, Comments, Likes or any content on the platform</li>
                                    <li>You will not be able to reconnect your twitch account for the next 24 hours.</li>
                                </ul>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection
