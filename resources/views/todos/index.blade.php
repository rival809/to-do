@extends('layouts.app')

@section('content')
    <div class="flex justify-center items-center min-h-[70vh] bg-gray-100 py-8">
        <div class="w-full max-w-lg bg-white rounded-2xl shadow-2xl px-10 py-10">
            <div class="flex flex-col items-center mb-8">
                <h2 class="text-3xl font-extrabold text-blue-700 flex items-center gap-3">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M12 4v16m8-8H4"/></svg>
                    To-Do List
                </h2>
                <span class="text-base text-gray-400 mt-1">{{ now()->format('l, d M Y') }}</span>
            </div>

            @if (session('success'))
                <div class="mb-5 p-3 rounded-lg bg-green-100 text-green-800 text-center text-base font-medium shadow">
                    {{ session('success') }}
                </div>
            @endif

            {{-- FORM TAMBAH TODO --}}
            <form action="{{ route('todos.store') }}" method="POST" class="flex gap-0 mb-8">
                @csrf
                <input
                    type="text"
                    name="title"
                    class="flex-1 px-5 py-3 rounded-l-xl border-t border-b border-l border-gray-300 focus:ring-2 focus:ring-blue-400 outline-none text-base"
                    placeholder="Apa yang ingin kamu lakukan?"
                    required
                >
                <button
                    type="submit"
                    class="px-6 py-3 bg-gray-300 text-gray-900 font-bold rounded-r-xl hover:bg-blue-700 flex items-center gap-2 transition-all shadow"
                >
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24"><path d="M12 4v16m8-8H4"/></svg>
                    Tambah
                </button>
            </form>

            {{-- LIST TODO --}}
            <div class="space-y-4">
                @forelse ($todos as $todo)
                    <div class="flex items-center justify-between bg-gray-50 rounded-xl px-5 py-4 shadow group">
                        <form action="{{ route('todos.update', $todo) }}" method="POST" class="flex items-center gap-4 w-full">
                            @csrf
                            @method('PATCH')
                            <input type="checkbox" name="is_done" onchange="this.form.submit()" {{ $todo->is_done ? 'checked' : '' }} class="accent-blue-600 w-6 h-6">
                            <span class="flex-1 text-lg break-words {{ $todo->is_done ? 'line-through text-gray-400' : 'text-gray-700' }}">
                                {{ $todo->title }}
                            </span>
                        </form>
                        <form action="{{ route('todos.destroy', $todo) }}" method="POST" onsubmit="return confirm('Hapus todo ini?')" class="ml-3">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500 hover:text-red-700 p-2 rounded-full hover:bg-red-100 transition shadow">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M6 18L18 6M6 6l12 12"/></svg>
                            </button>
                        </form>
                    </div>
                @empty
                    <div class="py-10 text-center text-gray-400 text-lg">
                        Tidak ada tugas hari ini. Tambah tugas baru yuk!
                    </div>
                @endforelse
            </div>
        </div>
    </div>
@endsection
