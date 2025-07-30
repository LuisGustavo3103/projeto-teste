<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-gray-100">
    <div class="max-w-7xl mx-auto h-screen flex justify-center items-center">
        <div class="bg-gray-50 p-10 flex flex-col items-center justify-center min-w-xl">
            <h2 class="mb-10 text-center uppercase">Registrar</h2>
            <form class="grid gap-4 text-center" action="{{ route('users.store') }}" method="POST">
                @csrf
                <x-forms.input field="name" placeholder="Nome" autofocus />
                <x-forms.input field="email" placeholder="E-mail" />
                <x-forms.input field="password" placeholder="Senha" type="password" />
                <x-forms.input field="password_confirmation" placeholder="Confirmação de senha" type="password" />

                <button type="submit" class="bg-gray-600 rounded-2xl text-white p-1 cursor-pointer hover:bg-gray-400">
                    Registrar
                </button>
            </form>
            <a href="{{ route('home') }}">
                <button class="bg-gray-600 p-2 rounded text-white hover:bg-gray-400 cursor-pointer my-2">
                    Voltar
                </button>
            </a>
        </div>
    </div>

</body>

</html>
