@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="bg-white rounded-xl shadow-sm p-6 sm:p-8">
        <div class="mb-8">
            <h1 class="text-2xl sm:text-3xl font-bold text-gray-800">Editar Animación</h1>
            <p class="text-gray-600 mt-2">Actualiza la información de la animación</p>
        </div>

        <form action="{{ route('animaciones.update', $animacion->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Columna Izquierda -->
                <div class="space-y-6">
                    <!-- Campo Título -->
                    <div>
                        <label for="titulo" class="block text-sm font-medium text-gray-700 mb-1">Título</label>
                        <input id="titulo" type="text" name="titulo" value="{{ old('titulo', $animacion->titulo) }}"
                               class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500 px-4 py-2"
                               placeholder="Título de la animación">
                        @error('titulo')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Campo Duración -->
                    <div>
                        <label for="duracion" class="block text-sm font-medium text-gray-700 mb-1">Duración</label>
                        <input id="duracion" type="text" name="duracion" value="{{ old('duracion', $animacion->duracion) }}"
                               class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500 px-4 py-2"
                               placeholder="Duración (por ejemplo, 1h 30m)">
                        @error('duracion')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Campo Estudio -->
                    <div>
                        <label for="estudio_id" class="block text-sm font-medium text-gray-700 mb-1">Estudio</label>
                        <select id="estudio_id" name="estudio_id"
                                class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500 px-4 py-2">
                            @foreach($estudios as $estudio)
                                <option value="{{ $estudio->id }}" {{ old('estudio_id', $animacion->estudio_id) == $estudio->id ? 'selected' : '' }}>
                                    {{ $estudio->nombre }}
                                </option>
                            @endforeach
                        </select>
                        @error('estudio_id')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Columna Derecha - Imagen -->
                <div class="space-y-6">
                    <!-- Imagen actual -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Imagen Actual</label>
                        <div class="mt-1 flex flex-col items-center">
                            @if($animacion->imagen)
                                <img src="{{ Storage::url($animacion->imagen) }}" class="w-40 h-40 object-cover rounded-lg border border-gray-200 shadow-sm">
                            @else
                                <div class="w-40 h-40 bg-gray-100 flex items-center justify-center rounded-lg border border-gray-200 shadow-sm text-gray-400 text-sm">
                                    Sin imagen
                                </div>
                            @endif
                            <span class="mt-2 text-xs text-gray-500">Vista previa actual</span>
                        </div>
                    </div>

                    <!-- Subir nueva imagen -->
                    <div>
                        <label for="file-upload" class="block text-sm font-medium text-gray-700 mb-1">Actualizar Imagen</label>
                        <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-lg">
                            <div class="space-y-1 text-center">
                                <div id="preview" class="hidden mb-3">
                                    <img id="preview-image" class="mx-auto h-32 w-32 object-cover rounded-lg">
                                </div>

                                <div id="upload-icon">
                                    <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                                        <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02"
                                              stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                </div>

                                <div class="flex text-sm text-gray-600 justify-center items-center gap-1">
                                    <label for="file-upload" class="relative cursor-pointer bg-white rounded-md font-medium text-indigo-600 hover:text-indigo-500">
                                        <span>Subir imagen</span>
                                        <input id="file-upload" name="imagen" type="file" class="sr-only" accept="image/png,image/jpeg,image/jpg" onchange="previewImage(event)">
                                    </label>
                                    <p>o arrastra y suelta</p>
                                </div>
                                <p id="file-name" class="text-xs text-gray-500 mt-1"></p>
                                <p class="text-xs text-gray-500">PNG, JPG hasta 2MB</p>
                            </div>
                        </div>
                        @error('imagen')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Botones -->
            <div class="flex justify-end space-x-4 pt-6 border-t border-gray-200">
                <a href="{{ route('animaciones.index') }}"
                   class="inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-lg text-gray-700 bg-white hover:bg-gray-50">
                    Cancelar
                </a>
                <button type="submit"
                        class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-lg text-white bg-indigo-600 hover:bg-indigo-700">
                    Actualizar Animación
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
        const fileName = document.getElementById('file-name');

        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                previewImage.src = e.target.result;
                preview.classList.remove('hidden');
                uploadIcon.classList.add('hidden');
                if (fileName) fileName.textContent = file.name;
            };
            reader.readAsDataURL(file);
        } else {
            preview.classList.add('hidden');
            uploadIcon.classList.remove('hidden');
            if (fileName) fileName.textContent = '';
        }
    }
</script>
@endpush
