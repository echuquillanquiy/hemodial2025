<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Usuarios') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 sm:px-20 bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700">
                    <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-4">
                        {{ __('Filtrar Usuarios') }}
                    </h3>

                    <form method="GET" action="{{ route('users.index') }}" class="mb-4">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <x-label for="apellidos" value="{{ __('Apellidos:') }}" />
                                <x-input id="apellidos" class="block mt-1 w-full dark:bg-gray-900 dark:text-gray-300" type="text" name="apellidos" :value="request('apellidos')" autofocus />
                            </div>
                            <div>
                                <x-label for="dni" value="{{ __('DNI:') }}" />
                                <x-input id="dni" class="block mt-1 w-full dark:bg-gray-900 dark:text-gray-300" type="text" name="dni" :value="request('dni')" />
                            </div>
                        </div>

                        <div class="flex items-center justify-start mt-4 gap-4">
                            <x-button class="bg-gray-800 hover:bg-gray-700 dark:bg-gray-600 dark:hover:bg-gray-500">
                                {{ __('Filtrar') }}
                            </x-button>
                            <a href="{{ route('users.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-200 dark:bg-gray-700 border border-transparent rounded-md font-semibold text-xs text-gray-700 dark:text-gray-300 uppercase tracking-widest hover:bg-gray-300 dark:hover:bg-gray-600 focus:outline-none focus:bg-gray-300 dark:focus:bg-gray-600 active:bg-gray-900 dark:active:bg-gray-500 focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                                {{ __('Limpiar') }}
                            </a>
                            <a href="{{ route('users.create') }}" class="inline-flex items-center px-4 py-2 bg-green-500 dark:bg-green-700 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 dark:hover:bg-green-600 focus:outline-none focus:bg-green-700 dark:focus:bg-green-600 active:bg-green-900 dark:active:bg-green-800 focus:ring-2 focus:ring-green-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                                {{ __('Crear Nuevo Usuario') }}
                            </a>
                        </div>
                    </form>

                    <div class="mt-8">
                        @livewire('user-table') {{-- Aquí se renderizará el componente de Livewire para la tabla --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>