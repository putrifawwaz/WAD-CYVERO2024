@extends('layouts.guest')

    <div class="hero" style="position: relative; width: 100%; height: 100vh; background-image: url('{{ asset('photos/GREETINGS.png') }}'); background-size: cover; background-position: center; display: flex; justify-content: center; align-items: center; color: white;">
        <div class="hero-overlay" style="position: absolute; top: 0; left: 0; right: 0; bottom: 0; display: flex; justify-content: center; align-items: center; background-color: rgba(0, 0, 0, 0.5);">
            <div class="card" style="background-color: #dcecff; max-width: 600px; width: 100%; padding: 20px; border-radius: 10px;">

                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('A fresh verification link has been sent to your email address.') }}
                        </div>
                    @endif

                    {{ __('Before proceeding, please check your email for a verification link.') }}
                    {{ __('If you did not receive the email') }},
                    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ __('click here to request another') }}</button>.
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
