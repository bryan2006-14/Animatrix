@extends('layouts.app')

@section('content')
<div class="mb-8">
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6 gap-4">
        <h1 class="text-2xl md:text-3xl font-bold text-gray-800">Lista de Animaciones</h1>
        <a href="{{ route('animaciones.create') }}"
           class="bg-indigo-600 text-white px-5 py-2.5 rounded-lg hover:bg-indigo-700 transition-colors duration-200 flex items-center gap-2 shadow-sm hover:shadow-md">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
            </svg>
            Nueva Animación
        </a>
    </div>

    {{-- Mensaje de éxito --}}
    @if(session('success'))
        <div class="mb-4 p-4 bg-green-100 text-green-800 rounded-lg shadow-sm">
            {{ session('success') }}
        </div>
    @endif

    @if($animaciones->isEmpty())
        <div class="bg-white rounded-xl shadow-sm p-6 text-center text-gray-500">
            No hay animaciones registradas aún.
        </div>
    @else
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($animaciones as $animacion)
                <div class="bg-white rounded-xl shadow-sm overflow-hidden hover:shadow-md transition-shadow duration-200 border border-gray-100">
                    <div class="relative h-48">
                        @if($animacion->imagen)
                            <img src="{{ asset('storage/' . $animacion->imagen) }}"
                                 alt="{{ $animacion->titulo }}"
                                 class="absolute h-full w-full object-cover">
                        @else
                            <div class="absolute h-full w-full bg-gray-200 flex items-center justify-center">
                                <svg class="h-20 w-20 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                            </div>
                        @endif
                    </div>

                    <div class="p-5">
                        <div class="mb-3">
                            <h3 class="text-lg font-semibold text-gray-800">{{ $animacion->titulo }}</h3>
                            <p class="text-indigo-600 font-medium">Duración: {{ $animacion->duracion }}</p>
                            <p class="text-gray-500 text-sm mt-1 flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none"
                                     viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M4 6h16M4 10h16M4 14h16M4 18h16" />
                                </svg>
                                {{ $animacion->estudio->nombre ?? 'Sin estudio' }}
                            </p>
                        </div>

                        <div class="flex justify-end space-x-3 border-t border-gray-100 pt-4">
                            {{-- Botón editar --}}
                            <a href="{{ route('animaciones.edit', $animacion) }}"
                               class="text-indigo-500 hover:text-indigo-700 flex items-center gap-1 text-sm font-medium">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                     viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                </svg>
                                Editar
                            </a>

                            {{-- Botón eliminar --}}
                            <form action="{{ route('animaciones.destroy', $animacion) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        onclick="return confirm('¿Estás seguro de eliminar esta animación?')"
                                        class="text-red-500 hover:text-red-700 flex items-center gap-1 text-sm font-medium">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                         viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                    Eliminar
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
