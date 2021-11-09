@extends('layouts.app')

@section('title', 'Page Title')

@section('content')


    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div>
       
            @if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::updateProfileInformation()))
                @livewire('profile.update-profile-information-form')

                <x-jet-section-border />
            @endif
            <div style="margin-top:15px;"> </div>
            @if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::updatePasswords()))
             
                    @livewire('profile.update-password-form')
               

                <x-jet-section-border />
            @endif
            <div style="margin-top:15px;"> </div>
            @if (Laravel\Fortify\Features::canManageTwoFactorAuthentication())
                
                    @livewire('profile.two-factor-authentication-form')
               

                <x-jet-section-border />
            @endif
            <div style="margin-top:15px;"> </div>
    
                @livewire('profile.logout-other-browser-sessions-form')
          
                <div style="margin-top:15px;"> </div>
            <x-jet-section-border />

           
                @livewire('profile.delete-user-form')
           
        </div>
    </div>
    

@endsection