@extends('layouts.app')

@section('content')
    <div class="container mx-auto">
        <div class="flex flex-wrap justify-center">
            <div class="w-full max-w-sm">

                @if (session('status'))
                    <div class="text-sm border border-t-8 rounded text-green-700 border-green-600 bg-green-100 px-3 py-4 mb-4" role="alert">
                        {{ session('status') }}
                    </div>
                @endif

                <div class="flex flex-col break-words bg-card border border-2 rounded shadow-md">

                    <div class="font-semibold text-default text-xl text-center py-3 px-6 mt-1 border-b-2 mx-6">
                        {{ __('Reset Password') }}
                    </div>

                    <form class="w-full p-6" method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <div class="flex flex-wrap mb-6">
                            <label for="email" class="block text-muted text-sm font-bold mb-2">
                                {{ __('E-Mail Address') }}:
                            </label>

                            <input id="email" type="email" class="form-input w-full bg-page @error('email') border-red-500 @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                            @error('email')
                                <p class="text-red-500 text-xs italic mt-4">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <div class="flex flex-wrap">
                            <button type="submit" class="button w-full">
                                {{ __('Send Password Reset Link') }}
                            </button>

                            <p class="w-full text-xs text-center text-muted mt-8 -mb-4">
                                <a class="text-accent no-underline" href="{{ route('login') }}">
                                    {{ __('Back to login') }}
                                </a>
                            </p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
