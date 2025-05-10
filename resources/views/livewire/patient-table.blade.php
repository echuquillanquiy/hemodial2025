<div>
    <div class="mb-4">
        <input type="text" wire:model.live.debounce.300ms="filtroDni" class="shadow appearance-none border rounded w-1/4 py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Filtrar por DNI">
        <input type="text" wire:model.live.debounce.300ms="filtroPrimerApellido" class="shadow appearance-none border rounded w-1/4 py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline ml-2" placeholder="Filtrar por Primer Apellido">
        <select wire:model.live="filtroTurno" class="shadow appearance-none border rounded w-1/6 py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline ml-2">
            <option value="">Todos los Turnos</option>
            <option value="I">TURNO I</option>
            <option value="II">TURNO II</option>
            <option value="III">TURNO III</option>
            <option value="IV">TURNO IV</option>
        </select>
        <select wire:model.live="filtroSecuencia" class="shadow appearance-none border rounded w-1/6 py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline ml-2">
            <option value="">Todas las Secuencias</option>
            <option value="L-M-V">L-M-V</option>
            <option value="M-J-S">M-J-S</option>
        </select>

        <button wire:click="mostrarModal('crear')" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline float-right">
            Crear Nuevo
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

    <table class="table-auto w-full">
        <thead>
            <tr class="bg-gray-100">
                <th class="px-4 py-2">DNI</th>
                <th class="px-4 py-2">Primer Nombre</th>
                <th class="px-4 py-2">Primer Apellido</th>
                <th class="px-4 py-2">Turno</th>
                <th class="px-4 py-2">Secuencia</th>
                <th class="px-4 py-2">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($pacientes as $paciente)
                <tr>
                    <td class="border px-4 py-2">{{ $paciente->dni }}</td>
                    <td class="border px-4 py-2">{{ $paciente->primer_nombre }}</td>
                    <td class="border px-4 py-2">{{ $paciente->primer_apellido }}</td>
                    <td class="border px-4 py-2">{{ $paciente->turno }}</td>
                    <td class="border px-4 py-2">{{ $paciente->secuencia }}</td>
                    <td class="border px-4 py-2">
                        <button wire:click="mostrarModal('ver', {{ $paciente->id }})" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-2 rounded focus:outline-none focus:shadow-outline text-xs">Ver</button>
                        <button wire:click="mostrarModal('editar', {{ $paciente->id }})" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-1 px-2 rounded focus:outline-none focus:shadow-outline text-xs ml-1">Editar</button>
                        <button wire:click="eliminarPacienteConfirmacion({{ $paciente->id }})" class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-2 rounded focus:outline-none focus:shadow-outline text-xs ml-1">Eliminar</button>
                    </td>
                </tr>
            @empty
                <tr><td class="border px-4 py-2 text-center" colspan="6">No se encontraron pacientes.</td></tr>
            @endforelse
        </tbody>
    </table>

    <div class="mt-4">
        {{ $pacientes->links() }}
    </div>

    @if ($modalVisible)
        <div class="fixed z-10 inset-0 overflow-y-auto">
            <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                    <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
                </div>

                <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

                <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-3xl sm:w-full">
                    <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-lg leading-6 font-medium text-gray-900">
                                @if ($modalModo === 'ver') Ver Paciente @elseif ($modalModo === 'editar') Editar Paciente @elseif ($modalModo === 'crear') Crear Nuevo Paciente @elseif ($modalModo === 'eliminar-confirmacion') Confirmar Eliminación @endif
                            </h3>
                            <button wire:click="cerrarModal()" class="text-gray-500 hover:text-gray-700">
                                <svg class="h-6 w-6 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </button>
                        </div>

                        <div class="mt-2">
                            @if ($modalModo === 'ver')
                                <div class="grid grid-cols-3 gap-4">
                                    <div><label class="block text-gray-700 text-sm font-bold mb-2">Primer Nombre:</label><div class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">{{ $primer_nombre }}</div></div>
                                    <div><label class="block text-gray-700 text-sm font-bold mb-2">Otros Nombres:</label><div class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">{{ $otros_nombres }}</div></div>
                                    <div><label class="block text-gray-700 text-sm font-bold mb-2">Primer Apellido:</label><div class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">{{ $primer_apellido }}</div></div>
                                    <div><label class="block text-gray-700 text-sm font-bold mb-2">Segundo Apellido:</label><div class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">{{ $segundo_apellido }}</div></div>
                                    <div><label class="block text-gray-700 text-sm font-bold mb-2">DNI:</label><div class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">{{ $dni }}</div></div>
                                    <div><label class="block text-gray-700 text-sm font-bold mb-2">Secuencia:</label><div class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">{{ $secuencia }}</div></div>
                                    <div><label class="block text-gray-700 text-sm font-bold mb-2">Turno:</label><div class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">{{ $turno }}</div></div>
                                    <div><label class="block text-gray-700 text-sm font-bold mb-2">Módulo:</label><div class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">{{ $modulo ?? '-' }}</div></div>
                                    <div><label class="block text-gray-700 text-sm font-bold mb-2">Peso Seco:</label><div class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">{{ $peso_seco ?? '-' }}</div></div>
                                    <div><label class="block text-gray-700 text-sm font-bold mb-2">Acceso Arterial:</label><div class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">{{ $acceso_arterial }}</div></div>
                                    <div><label class="block text-gray-700 text-sm font-bold mb-2">Acceso Venoso:</label><div class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">{{ $acceso_venoso }}</div></div>
                                    <div><label class="block text-gray-700 text-sm font-bold mb-2">N° Historia:</label><div class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">{{ $n_historia ?? '-' }}</div></div>
                                    <div class="col-span-3"><label class="block text-gray-700 text-sm font-bold mb-2">Justificación:</label><div class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">{{ $justificacion ?? '-' }}</div></div>
                                    <div><label class="block text-gray-700 text-sm font-bold mb-2">Código CS:</label><div class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">{{ $codigo_cs }}</div></div>
                                    <div><label class="block text-gray-700 text-sm font-bold mb-2">N° HD:</label><div class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">{{ $n_hd }}</div></div>
                                </div>
                            @elseif ($modalModo === 'editar' || $modalModo === 'crear')
                                <div class="grid grid-cols-3 gap-4">
                                    <div class="col-span-1"><label for="primer_nombre" class="block text-gray-700 text-sm font-bold mb-2">Primer Nombre:</label><input type="text" wire:model="primer_nombre" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="primer_nombre">@error('primer_nombre') <span class="text-red-500 text-xs italic">{{ $message }}</span> @enderror</div>
                                    <div class="col-span-1"><label for="otros_nombres" class="block text-gray-700 text-sm font-bold mb-2">Otros Nombres:</label><input type="text" wire:model="otros_nombres" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="otros_nombres">@error('otros_nombres') <span class="text-red-500 text-xs italic">{{ $message }}</span> @enderror</div>
                                    <div class="col-span-1"><label for="primer_apellido" class="block text-gray-700 text-sm font-bold mb-2">Primer Apellido:</label><input type="text" wire:model="primer_apellido" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="primer_apellido">@error('primer_apellido') <span class="text-red-500 text-xs italic">{{ $message }}</span> @enderror</div>
                                    <div class="col-span-1"><label for="segundo_apellido" class="block text-gray-700 text-sm font-bold mb-2">Segundo Apellido:</label><input type="text" wire:model="segundo_apellido" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="segundo_apellido">@error('segundo_apellido') <span class="text-red-500 text-xs italic">{{ $message }}</span> @enderror</div>
                                    <div class="col-span-1"><label for="dni" class="block text-gray-700 text-sm font-bold mb-2">DNI:</label><input type="text" wire:model="dni" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="dni">@error('dni') <span class="text-red-500 text-xs italic">{{ $message }}</span> @enderror</div>
                                    <div class="col-span-1"><label for="secuencia" class="block text-gray-700 text-sm font-bold mb-2">Secuencia:</label><select wire:model="secuencia" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="secuencia"><option value="">Seleccionar Secuencia</option><option value="L-M-V">L-M-V</option><option value="M-J-S">M-J-S</option></select>@error('secuencia') <span class="text-red-500 text-xs italic">{{ $message }}</span> @enderror</div>
                                    <div class="col-span-1"><label for="turno" class="block text-gray-700 text-sm font-bold mb-2">Turno:</label><select wire:model="turno" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="turno"><option value="">Seleccionar Turno</option><option value="I">TURNO I</option><option value="II">TURNO II</option><option value="III">TURNO III</option><option value="IV">TURNO IV</option></select>@error('turno') <span class="text-red-500 text-xs italic">{{ $message }}</span> @enderror</div>
                                    <div class="col-span-1"><label for="modulo" class="block text-gray-700 text-sm font-bold mb-2">Modulo:</label><select wire:model="modulo" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="modulo"><option value="">Seleccionar Modulo</option><option value="MODULO 1">MODULO 1</option><option value="MODULO 2">MODULO 2</option><option value="MODULO 3">MODULO 3</option><option value="MODULO 4">MODULO 4</option></select>@error('turno') <span class="text-red-500 text-xs italic">{{ $message }}</span> @enderror</div>
                                    <div class="col-span-1"><label for="peso_seco" class="block text-gray-700 text-sm font-bold mb-2">Peso Seco:</label><input type="text" wire:model="peso_seco" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="peso_seco">@error('peso_seco') <span class="text-red-500 text-xs italic">{{ $message }}</span> @enderror</div>
                                    <div class="col-span-1"><label for="acceso_arterial" class="block text-gray-700 text-sm font-bold mb-2">Acceso Arterial:</label><select wire:model="acceso_arterial" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="acceso_arterial"><option value="">Seleccionar Acceso</option><option value="FAV">FAV</option><option value="INJ">INJ</option><option value="CVCL">CVCL</option><option value="CVCLP">CVCLP</option><option value="CVCT">CVCT</option></select>@error('acceso_arterial') <span class="text-red-500 text-xs italic">{{ $message }}</span> @enderror</div>
                                    <div class="col-span-1"><label for="acceso_venoso" class="block text-gray-700 text-sm font-bold mb-2">Acceso Venoso:</label><select wire:model="acceso_venoso" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="acceso_venoso"><option value="">Seleccionar Acceso</option><option value="FAV">FAV</option><option value="INJ">INJ</option><option value="CVCL">CVCL</option><option value="CVCLP">CVCLP</option><option value="CVCT">CVCT</option></select>@error('acceso_venoso') <span class="text-red-500 text-xs italic">{{ $message }}</span> @enderror</div>
                                    <div class="col-span-1"><label for="n_historia" class="block text-gray-700 text-sm font-bold mb-2">N° Historia:</label><input type="text" wire:model="n_historia" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="n_historia">@error('n_historia') <span class="text-red-500 text-xs italic">{{ $message }}</span> @enderror</div>
                                    <div class="col-span-3"><label for="justificacion" class="block text-gray-700 text-sm font-bold mb-2">Justificación:</label><textarea wire:model="justificacion" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="justificacion"></textarea>@error('justificacion') <span class="text-red-500 text-xs italic">{{ $message }}</span> @enderror</div>
                                    <div class="col-span-1"><label for="codigo_cs" class="block text-gray-700 text-sm font-bold mb-2">Código CS:</label><input type="text" wire:model="codigo_cs" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="codigo_cs">@error('codigo_cs') <span class="text-red-500 text-xs italic">{{ $message }}</span> @enderror</div>
                                    <div class="col-span-1"><label for="n_hd" class="block text-gray-700 text-sm font-bold mb-2">N° HD:</label><input type="text" wire:model="n_hd" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="n_hd">@error('n_hd') <span class="text-red-500 text-xs italic">{{ $message }}</span> @enderror</div>
                                </div>
                            @elseif ($modalModo === 'eliminar-confirmacion')
                                <div class="mt-2">
                                @if ($modalModo === 'eliminar-confirmacion')
                                    <p class="text-gray-700">¿Estás seguro de que deseas eliminar al paciente: {{ $nombrePacienteAEliminar }}</p>
                                @endif
                            </div>
                            @endif
                        </div>
                    </div>
                    <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                        @if ($modalModo === 'eliminar-confirmacion')
                            <button wire:click="eliminarPaciente()" type="button" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm">
                                Eliminar
                            </button>
                            <button wire:click="cerrarModal()" type="button" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                                Cancelar
                            </button>
                        @elseif ($modalModo === 'ver')
                            <button wire:click="cerrarModal()" type="button" class="w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:ml-3 sm:w-auto sm:text-sm">
                                Cerrar
                            </button>
                        @elseif ($modalModo === 'editar' || $modalModo === 'crear')
                            <button wire:click="guardarPaciente()" type="button" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-green-600 text-base font-medium text-white hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 sm:ml-3 sm:w-auto sm:text-sm">
                                Guardar
                            </button>
                            <button wire:click="cerrarModal()" type="button" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                                Cancelar
                            </button>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>