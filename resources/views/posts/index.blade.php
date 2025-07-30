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
    <div class="flex justify-between items-center py-3 my-3">
        <div>
            <h1 class="text-3xl ">
                Bem vindo, {{ auth()->user()->name }}!
            </h1>
            <form action="{{ route('users.logout') }}" method="POST">
                @csrf
                <button type="submit" class="bg-gray-600 rounded text-white p-2 cursor-pointer hover:bg-gray-400">
                    Sair
                </button>
            </form>
        </div>
        <a href="{{ route('posts.create') }}">
            <button class="bg-green-500 p-2 rounded text-white hover:bg-green-400 cursor-pointer">Criar Post</button>
        </a>
    </div>
    <div>
        @foreach ($posts as $post)
            <div class="h-min my-2 border rounded bg-gray-200 p-2 flex justify-between items-center">
                <div>
                    <p>
                        {{ $post->title }}
                    </p>
                    <small>
                        {{ $post->description }}
                    </small>
                    <div class="flex gap-x-3">
                        <p>
                            Criado por: {{ $post->user->name }}
                        </p>
                        <p>Criado em: {{ $post->created_at->format('d/m/Y H:i') }} </p>
                    </div>

                </div>
                @if ($post->user_id === auth()->user()->id)
                    <form action="{{ route('posts.delete', $post) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                            class="bg-red-500 p-2 rounded text-white hover:bg-red-400 cursor-pointer">Excluir</button>
                    </form>
                @endif
            </div>
        @endforeach
    </div>
</body>

</html>
