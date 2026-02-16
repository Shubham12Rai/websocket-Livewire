<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Livewire App</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    {{-- Vite --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- Livewire styles (REQUIRED) --}}
    @livewireStyles
</head>
<body style="font-family: Arial, sans-serif; background:#f5f6fa;">

    {{-- Top Navbar --}}
    <div style="background:#111827;color:white;padding:15px 30px;display:flex;justify-content:space-between;">
        <div>
            <strong>My App</strong>
        </div>

        <div>
            @auth
                {{ auth()->user()->name }}
                |
                <form method="POST" action="{{ route('logout') }}" style="display:inline;">
                    @csrf
                    <button type="submit" style="background:none;border:none;color:white;cursor:pointer;">
                        Logout
                    </button>
                </form>
            @endauth
        </div>
    </div>

    {{-- Page Content --}}
    <div style="padding:30px;">
        @yield('content')
    </div>

    {{-- Livewire scripts (REQUIRED) --}}
    @livewireScripts

</body>
</html>
