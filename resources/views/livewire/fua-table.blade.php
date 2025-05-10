<div>
    <div class="mb-4">
        <button wire:click="mostrarModal('crear')" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
            Crear Nuevo FUA
        </button>
    </div>

    @if (session()->has('mensaje'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
            <strong class="font-bold">{{ session('mensaje') }}</strong>
            <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
                <svg wire:click="$set('mensaje', null)" class="fill-current h-6 w-6 text-green-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><title>Close</title><path fill-rule="evenodd" d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l3.029-2.651-3.029-2.651a1.2 1.2 0 0 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-3.031 2.651 3.031 2.651a1.2 1.2 0 0 1 0 1.697z" clip-rule="evenodd"/></svg>
            </span>
        </div>
    @endif

    <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Serie Completa</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Código Empresa</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Año</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Número FUA</th>
                    <th scope="col" class="relative px-6 py-3">
                        <span class="sr-only">Acciones</span>
                    </th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse ($fuas as $fua)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $fua->serie_completa }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $fua->codigo_empresa }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $fua->anio }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $fua->numero_fua }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            <button wire:click="mostrarModal('editar', {{ $fua->id }})" class="text-indigo-600 hover:text-indigo-900 mr-2">Editar</button>
                            <button wire:click="eliminarFuaConfirmacion({{ $fua->id }})" class="text-red-600 hover:text-red-900">Eliminar</button>
                        </td>
                    </tr>
                @empty
                    <tr><td class="px-6 py-4 whitespace-nowrap" colspan="5">No se encontraron FUAs.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $fuas->links() }}
    </div>

    @if ($modalVisible)
        <div class="fixed z-10 inset-0 overflow-y-auto" id="modal" aria-labelledby="modal-title" role="dialog" aria-modal="true">
            <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>

                <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

                <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-2xl sm:w-full">
                    <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                        <div class="sm:flex sm:items-start">
                            <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left w-full">
                                <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">
                                    @if ($modalModo === 'crear') Crear Nuevo FUA @elseif ($modalModo === 'editar') Editar FUA @elseif ($modalModo === 'eliminar') Eliminar FUA @endif
                                </h3>
                                <div class="mt-2">
                                    @if ($modalModo === 'crear' || $modalModo === 'editar')
                                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                            <div>
                                                <label for="codigo_empresa" class="block text-gray-700 text-sm font-bold mb-2">Código Empresa:</label>
                                                <input type="text" wire:model.defer="codigo_empresa" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="codigo_empresa">
                                                @error('codigo_empresa') <span class="text-red-500 text-xs italic">{{ $message }}</span> @enderror
                                            </div>
                                            <div>
                                                <label for="anio" class="block text-gray-700 text-sm font-bold mb-2">Año (2 dígitos):</label>
                                                <input type="text" wire:model.defer="anio" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="anio">
                                                @error('anio') <span class="text-red-500 text-xs italic">{{ $message }}</span> @enderror
                                            </div>
                                            <div>
                                                <label for="numero_fua" class="block text-gray-700 text-sm font-bold mb-2">Número FUA:</label>
                                                <input type="text" wire:model.defer="numero_fua" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="numero_fua">
                                                @error('numero_fua') <span class="text-red-500 text-xs italic">{{ $message }}</span> @enderror
                                            </div>
                                            <div>
                                                </div>
                                        </div>
                                    @elseif ($modalModo === 'eliminar')
                                        <p class="text-gray-700">¿Estás seguro de que deseas eliminar el FUA con número:</p>
                                        <p class="font-bold text-red-500">{{ $fuaAEliminar }}?</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                        <button wire:click="cerrarModal()" type="button" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                            Cancelar
                        </button>
                        @if ($modalModo === 'crear')
                            <button wire:click="crearFua()" type="button" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-green-600 text-base font-medium text-white hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 sm:ml-3 sm:w-auto sm:text-sm">
                                Crear
                            </button>
                        @elseif ($modalModo === 'editar')
                            <button wire:click="actualizarFua()" type="button" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-blue-600 text-base font-medium text-
white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:ml-3 sm:w-auto sm:text-sm">
                                Guardar
                            </button>
                        @elseif ($modalModo === 'eliminar')
                            <button wire:click="eliminarFua()" type="button" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm">
                                Eliminar
                            </button>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
