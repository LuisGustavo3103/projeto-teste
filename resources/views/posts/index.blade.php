<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

<body class="bg-gray-100">
    <div class="bg-white flex justify-between w-full p-2">
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
    <div class="max-w-7xl mx-auto mt-10">
        <div class="bg-white shadow-xl rounded-b rounded-t-xl">
            <div class="bg-gray-200 py-6 px-2 rounded-t-xl">
                <form class="flex justify-between items-end" action="{{ route('posts.index') }}" method="GET">
                    <div>
                        <input class="border bg-white rounded p-1" type="text" name="title"
                            placeholder="Pesquisar Título" value={{ request()->input('title') }}>
                        <input class="border bg-white rounded p-1" type="text" name="description"
                            placeholder="Pesquisar Descrição" value={{ request()->input('description') }}>
                    </div>
                    <div>
                        @if (request()->input('title') || request()->input('description'))
                            <a href="{{ route('posts.index') }}">
                                <button type="button"
                                    class="bg-gray-600 p-2 rounded text-white hover:bg-gray-400 cursor-pointer">
                                    Limpar Busca
                                </button>
                            </a>
                        @endif

                        <button type="submit"
                            class="bg-gray-600 rounded text-white p-2 cursor-pointer hover:bg-gray-400">
                            Buscar
                        </button>
                        <a href="{{ route('posts.create') }}">
                            <button type="button"
                                class="bg-green-500 p-2 rounded text-white hover:bg-green-400 cursor-pointer">
                                Criar Post
                            </button>
                        </a>
                    </div>

                </form>
            </div>
            <div class="p-2">
                @forelse ($posts as $post)
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
                                <button onclick="return confirm('Deseja realmente excluir?')" type="submit"
                                    class="bg-red-500 p-2 rounded text-white hover:bg-red-400 cursor-pointer">Excluir</button>
                            </form>
                        @endif
                    </div>
                @empty
                    <div>
                        <p class="uppercase">sem resultados</p>
                    </div>
                @endforelse
                <div class="my-3">{{ $posts->links() }}</div>
            </div>
        </div>
    </div>

</body>

</html>
