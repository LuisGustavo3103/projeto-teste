<h1>
    Olá {{ $user->name }}!, você está logado!
</h1>
<h2>
    Seu email: {{ $user->email }}
</h2>

<form action="{{ route('users.logout') }}" method="POST">
    @csrf
    <button type="submit" class="bg-gray-600 rounded-2xl text-white p-1 cursor-pointer hover:bg-gray-400">
        Sair
    </button>
</form>
