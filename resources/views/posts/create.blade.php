<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

<body class="max-w-7xl mx-auto">
    <div class="bg-gray-50 p-2">
        <div>
            <h1 class="text-3xl">Criar novo post</h1>
            <a href="{{ route('posts.index') }}">
                <button type="submit" class="bg-gray-600 p-2 rounded text-white hover:bg-gray-400 cursor-pointer my-2">
                    Voltar
                </button>
            </a>
        </div>

        <form action="{{ route('posts.store') }}" method="POST">
            @csrf
            <input class="border rounded-2xl p-1 my-2" name="title" field="title" type="text" placeholder="Titulo"
                autofocus required>
            <textarea class="border rounded-2xl p-1 block w-auto my-2" placeholder="Descrição" name="description" id="description"
                cols="30" rows="4" required></textarea>
            <button type="submit"
                class="bg-green-500 p-2 rounded text-white hover:bg-green-400 cursor-pointer my-2">Salvar</button>
        </form>
    </div>
</body>

</html>
