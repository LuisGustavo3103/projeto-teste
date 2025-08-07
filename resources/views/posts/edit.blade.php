<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

<body class="bg-gray-100">
    <div class="bg-white flex justify-between w-full p-2">
        <h1 class="text-3xl ">
            Edite seu post, {{ auth()->user()->name }}
        </h1>

        <form action="{{ route('users.logout') }}" method="POST">
            @csrf
            <button type="submit" class="bg-gray-600 rounded text-white p-2 cursor-pointer hover:bg-gray-400">
                Sair
            </button>
        </form>
    </div>
    <div class="max-w-7xl mx-auto mt-10 shadow-xl rounded-b rounded-t-xl">
        <div class="bg-gray-200 py-6 px-2 rounded-t-xl">
            <h1 class="text-3xl text-center">Editar post</h1>
        </div>
        <div class="bg-white p-2">
            <form class="grid" action="{{ route('posts.update', $post) }}" enctype="multipart/form-data"
                method="POST">
                @csrf
                @method('PUT')
                <input value="{{ $post->title }}" class="border rounded p-1 m-2 " name="title" field="title"
                    type="text" placeholder="Titulo" autofocus required>
                <textarea class="border rounded p-1 block  m-2" placeholder="Descrição" name="description" id="description"
                    cols="30" rows="10" required>{{ $post->description }}</textarea>

                <img class="rounded" src="{{ Storage::url($post->image) }}" alt="">
                <input class="border rounded p-1 m-2" type="file" accept=".png, .jpg, .jpeg" name="image">
                <div class="flex justify-end ">
                    <a href="{{ route('posts.index') }}">
                        <button type="button"
                            class="bg-gray-600 p-2 rounded text-white hover:bg-gray-400 cursor-pointer my-2">
                            Voltar
                        </button>
                    </a>
                    <button type="submit"
                        class="bg-green-500 p-2 rounded text-white hover:bg-green-400 cursor-pointer m-2">Salvar</button>
                </div>

                @error('image')
                    <div class="text-red-500">{{ $message }}</div>
                @enderror
            </form>
        </div>
    </div>
</body>

</html>
