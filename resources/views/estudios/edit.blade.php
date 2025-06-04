@extends('layouts.app')

@section('content')
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="bg-white rounded-xl shadow-sm p-6 sm:p-8 border border-gray-100">
            <div class="mb-8">
                <div class="flex items-center mb-4">
                    <div class="bg-indigo-100 p-3 rounded-lg mr-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                        </svg>
                    </div>
                    <div>
                        <h1 class="text-2xl sm:text-3xl font-bold text-gray-800">Editar Estudio</h1>
                        <p class="text-gray-600">Actualiza la información del estudio</p>
                    </div>
                </div>
            </div>

            <form action="{{ route('estudios.update', $estudio) }}" method="POST" class="space-y-6">
                @csrf
                @method('PUT')

                <!-- Campo Nombre -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Nombre del Estudio</label>
                    <input type="text"
                           name="nombre"
                           value="{{ old('nombre', $estudio->nombre) }}"
                           class="focus:ring-indigo-500 focus:border-indigo-500 block w-full px-4 py-3 sm:text-sm border-gray-300 rounded-lg"
                           placeholder="Ej: Warner Bros Animation">
                    @error('nombre')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Campo Año de Fundación -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Año de Fundación</label>
                    <input type="number"
                           name="anio_fundacion"
                           value="{{ old('anio_fundacion', $estudio->anio_fundacion) }}"
                           class="focus:ring-indigo-500 focus:border-indigo-500 block w-full px-4 py-3 sm:text-sm border-gray-300 rounded-lg"
                           placeholder="Ej: 1990">
                    @error('anio_fundacion')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Botones de acción -->
                <div class="flex justify-end space-x-4 pt-6 border-t border-gray-200">
                    <a href="{{ route('estudios.index') }}"
                       class="inline-flex items-center px-4 py-2.5 border border-gray-300 shadow-sm text-sm font-medium rounded-lg text-gray-700 bg-white hover:bg-gray-50 transition">
                        Cancelar
                    </a>
                    <button type="submit"
                            class="inline-flex items-center px-4 py-2.5 border border-transparent text-sm font-medium rounded-lg shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 transition">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        Actualizar Estudio
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
