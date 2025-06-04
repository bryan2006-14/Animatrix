@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
    <div class="bg-white rounded-xl shadow-sm p-6 sm:p-8">
        <div class="flex justify-between items-center mb-8">
            <div>
                <h1 class="text-2xl sm:text-3xl font-bold text-gray-800">Crear Nueva Animación</h1>
                <p class="text-gray-600 mt-1">Completa los campos para registrar una animación.</p>
            </div>
            <a href="{{ route('animaciones.index') }}"
               class="text-sm text-indigo-600 hover:text-indigo-800 font-medium">
                ← Volver a lista
            </a>
        </div>

        <form action="{{ route('animaciones.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                {{-- Columna Izquierda --}}
                <div class="space-y-5">
                    {{-- Título --}}
                    <div>
                        <label for="titulo" class="block text-sm font-medium text-gray-700">Título</label>
                        <input type="text" id="titulo" name="titulo" value="{{ old('titulo') }}"
                               placeholder="Ej: Toy Story"
                               class="mt-1 block w-full rounded-lg border border-gray-300 px-4 py-2 shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                        @error('titulo')
                            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Duración --}}
                    <div>
                        <label for="duracion" class="block text-sm font-medium text-gray-700">Duración</label>
                        <input type="text" id="duracion" name="duracion" value="{{ old('duracion') }}"
                               placeholder="Ej: 1h 40min"
                               class="mt-1 block w-full rounded-lg border border-gray-300 px-4 py-2 shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                        @error('duracion')
                            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Estudio --}}
                    <div>
                        <label for="estudio_id" class="block text-sm font-medium text-gray-700">Estudio</label>
                        <select id="estudio_id" name="estudio_id"
                                class="mt-1 block w-full rounded-lg border border-gray-300 px-4 py-2 shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                            <option value="" disabled selected>Selecciona un estudio</option>
                            @foreach($estudios as $estudio)
                                <option value="{{ $estudio->id }}" {{ old('estudio_id') == $estudio->id ? 'selected' : '' }}>
                                    {{ $estudio->nombre }}
                                </option>
                            @endforeach
                        </select>
                        @error('estudio_id')
                            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                {{-- Columna Derecha: Imagen --}}
                <div class="space-y-4">
                    <label class="block text-sm font-medium text-gray-700">Imagen</label>
                    <div class="flex flex-col items-center justify-center h-full border-2 border-dashed border-gray-300 rounded-lg px-6 py-10 text-center">
                        <div id="preview" class="hidden mb-3">
                            <img id="preview-image" class="h-40 w-40 object-cover rounded-lg mx-auto">
                        </div>

                        <div id="upload-icon">
                            <svg class="h-12 w-12 text-gray-400 mx-auto mb-2" fill="none" viewBox="0 0 48 48" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M14 22l10-10 10 10M24 12v24"/>
                            </svg>
                            <label for="file-upload"
                                   class="cursor-pointer text-indigo-600 hover:text-indigo-500 font-medium">
                                Selecciona una imagen
                            </label>
                            <input id="file-upload" name="imagen" type="file" class="sr-only" accept="image/*" onchange="previewImage(event)">
                            <p class="text-xs text-gray-500 mt-1">PNG o JPG, máximo 2MB.</p>
                        </div>

                        @error('imagen')
                            <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            {{-- Botones --}}
            <div class="flex justify-end gap-4 pt-6 border-t border-gray-200">
                <a href="{{ route('animaciones.index') }}"
                   class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 border border-gray-300 bg-white rounded-lg hover:bg-gray-50">
                    Cancelar
                </a>
                <button type="submit"
                        class="inline-flex items-center gap-2 px-4 py-2 text-sm font-medium text-white bg-indigo-600 rounded-lg hover:bg-indigo-700">
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M5 13l4 4L19 7"/>
                    </svg>
                    Crear Animación
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
    function previewImage(event) {
        const file = event.target.files[0];
        const preview = document.getElementById('preview');
        const previewImage = document.getElementById('preview-image');
        const uploadIcon = document.getElementById('upload-icon');

        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                previewImage.src = e.target.result;
                preview.classList.remove('hidden');
                uploadIcon.classList.add('hidden');
            };
            reader.readAsDataURL(file);
        } else {
            preview.classList.add('hidden');
            uploadIcon.classList.remove('hidden');
        }
    }
</script>
@endpush
