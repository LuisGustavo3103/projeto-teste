<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

<body>
    <div class="max-w-7xl mx-auto h-screen flex justify-center items-center">
        <div class="bg-gray-50 p-10 items-center">
            <div>
                <h2 class="mb-10 text-center uppercase ">Login</h2>
                <form class="grid gap-4" action="{{ route('users.login') }}" method="POST">
                    @csrf
                    <x-forms.input field="email" placeholder="E-mail" autofocus />
                    <x-forms.input field="password" placeholder="Senha" type="password" />

                    <button type="submit"
                        class="bg-gray-600 rounded-2xl text-white p-1 cursor-pointer hover:bg-gray-400">
                        Login
                    </button>
                </form>
            </div>
            <div class="my-3">
                <p class="text-center">Caso não tenha conta</p>
                <a href="{{ route('users.index') }}">
                    <p class="uppercase hover:underline text-center">Registre-se</p>
                </a>
            </div>
        </div>
    </div>
</body>

</html>
