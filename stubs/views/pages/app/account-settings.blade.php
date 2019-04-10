@extends('layouts.app')
@section('title','Account Settings')

@section('content')

    <div class="bg-white-no bg-transparent shadow-no rounded-xl md:m-8 p-8">

        <div class="mw-1/2 lg:w-1/2">

            {{--<form action="{{ route('app.account.update') }}" method="POST">--}}
            {{--@csrf--}}
            <div class="flex flex-wrap mb-6">
                <label class="block text-grey-darker font-medium mb-2" for="name">Full Name</label>
                <input id="name" disabled
                       class="shadow appearance-none border rounded w-full py-2 px-3 text-grey-darker leading-tight"
                       placeholder="Name" type="text" name="name" value="{{ old('name',auth()->user()->name) }}">
                @if ($errors->has('name'))
                    <p class="text-red text-xs italic mt-4">
                        {{ $errors->first('name') }}
                    </p>
                @endif
            </div>

            <div class="flex flex-wrap mb-6">
                <label class="block text-grey-darker font-medium mb-2" for="email">E-mail</label>
                <input id="email" disabled
                       class="shadow appearance-none border rounded w-full py-2 px-3 text-grey-darker leading-tight"
                       placeholder="Email" type="email" name="email" value="{{ old('email',auth()->user()->email) }}">
                @if ($errors->has('email'))
                    <p class="text-red text-xs italic mt-4">
                        {{ $errors->first('email') }}
                    </p>
                @endif
            </div>

            <form action="{{ route('app.account.update') }}" method="POST">
                @csrf
                <div class="flex flex-wrap mb-6">
                    <label class="block font-medium mb-2" for="password">Current Password</label>
                    <input id="password" required
                           class="shadow appearance-none rounded w-full py-2 px-3 leading-tight"
                           placeholder="" type="password" name="password" value="">
                    @if ($errors->has('password'))
                        <p class="text-red-500 text-xs italic mt-4">
                            {{ $errors->first('password') }}
                        </p>
                    @endif
                </div>
                <div class="flex flex-wrap mb-6">
                    <label class="block  font-medium mb-2" for="new_password">New Password</label>
                    <input id="new_password" required
                           class="shadow appearance-none rounded w-full py-2 px-3 leading-tight"
                           placeholder="" type="password" name="new_password" value="">
                    @if ($errors->has('new_password'))
                        <p class="text-red-500 text-xs italic mt-4">
                            {{ $errors->first('new_password') }}
                        </p>
                    @endif
                </div>
                <div class="flex flex-wrap mb-6">
                    <label class="block font-medium mb-2" for="new_password_confirmation">Confirm New Password</label>
                    <input id="new_password_confirmation" required
                           class="shadow appearance-none rounded w-full py-2 px-3 leading-tight"
                           placeholder="" type="password" name="new_password_confirmation" value="">
                    @if ($errors->has('new_password_confirmation'))
                        <p class="text-red-500 text-xs italic mt-4">
                            {{ $errors->first('new_password_confirmation') }}
                        </p>
                    @endif
                </div>

                <button type="submit" class="rounded-lg px-8 py-4 text-white bg-red-500">Update Password</button>
            </form>
        </div>
    </div>

@endsection
