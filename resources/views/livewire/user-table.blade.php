<div>
    <div class="mb-4 flex items-center justify-between">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <x-label for="apellidos" value="{{ __('Buscar por Apellidos') }}" />
                <x-input wire:model.live="apellidos" placeholder="{{ __('Buscar por Apellidos') }}" class="block mt-1 w-full" />
            </div>
            <div>
                <x-label for="dniNumber" value="{{ __('Buscar por DNI') }}" />
                <x-input wire:model="dniNumber" placeholder="{{ __('Buscar por DNI') }}" class="block mt-1 w-full" />
            </div>
        </div>
        <x-button wire:click="openCreateModal">
            {{ __('Crear Nuevo Usuario') }}
        </x-button>
    </div>

    <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('Nombres y Apellidos') }}</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('DNI') }}</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('Username') }}</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('Email') }}</th>
                <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('Acciones') }}</th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
            @forelse ($users as $user)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $user->nombres_apellidos }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $user->dni }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $user->username }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $user->email }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-right">
                        <x-button wire:click="openEditModal({{ $user }})" class="bg-blue-500 hover:bg-blue-700 text-white mr-2">
                            {{ __('Editar') }}
                        </x-button>
                        <x-danger-button wire:click="confirmDelete({{ $user }})">
                            {{ __('Eliminar') }}
                        </x-danger-button>
                    </td>
                </tr>
            @empty
                <tr><td class="px-6 py-4 whitespace-nowrap" colspan="5">{{ __('No se encontraron usuarios.') }}</td></tr>
            @endforelse
        </tbody>
    </table>

    <div class="mt-4">
        {{ $users->links() }}
    </div>

    <x-dialog-modal wire:model.live="showCreateModal" maxWidth="2xl">
        <x-slot name="title">
            {{ __('Crear Nuevo Usuario') }}
        </x-slot>

        <x-slot name="content">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <x-label for="nombresApellidos" value="{{ __('Nombres y Apellidos') }}" />
                    <x-input id="nombresApellidos" class="block mt-1 w-full" wire:model="nombresApellidos" />
                    @error('nombresApellidos') <span class="error">{{ $message }}</span> @enderror
                </div>
                <div>
                    <x-label for="dniNumberModal" value="{{ __('DNI') }}" />
                    <x-input id="dniNumberModal" class="block mt-1 w-full" wire:model="dniNumberModal" />
                    @error('dniNumberModal') <span class="error">{{ $message }}</span> @enderror
                </div>
                <div>
                    <x-label for="username" value="{{ __('Username') }}" />
                    <x-input id="username" class="block mt-1 w-full" wire:model="username" />
                    @error('username') <span class="error">{{ $message }}</span> @enderror
                </div>
                <div>
                    <x-label for="email" value="{{ __('Email') }}" />
                    <x-input id="email" class="block mt-1 w-full" wire:model="email" type="email" />
                    @error('email') <span class="error">{{ $message }}</span> @enderror
                </div>
                <div>
                    <x-label for="colegiatura" value="{{ __('Colegiatura') }}" />
                    <x-input id="colegiatura" class="block mt-1 w-full" wire:model="colegiatura" />
                    @error('colegiatura') <span class="error">{{ $message }}</span> @enderror
                </div>
                <div>
                    <x-label for="rne" value="{{ __('RNE') }}" />
                    <x-input id="rne" class="block mt-1 w-full" wire:model="rne" />
                    @error('rne') <span class="error">{{ $message }}</span> @enderror
                </div>

                <div>
                    <x-label for="rol" value="{{ __('Rol') }}" />
                    <select id="rol" wire:model="rol" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block w-full">
                        <option value="Administrador del Sistema">{{ __('Administrador del Sistema') }}</option>
                        <option value="Medico">{{ __('Medico') }}</option>
                        <option value="Licenciado">{{ __('Licenciado(a)') }}</option>
                        <option value="Adminitrativo">{{ __('Adminitrativo') }}</option>
                        <option value="Auditor">{{ __('Auditor') }}</option>
                        <option value="Tecnico">{{ __('Tecnico') }}</option>
                    </select>
                    @error('rol') <span class="error">{{ $message }}</span> @enderror
                </div>

                <div>
                    <x-label for="modulo" value="{{ __('Módulo') }}" />
                    <select id="modulo" wire:model="modulo" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block w-full">
                        <option value="TODOS">{{ __('TODOS') }}</option>
                        <option value="MODULO 1">{{ __('MODULO 1') }}</option>
                        <option value="MODULO 2">{{ __('MODULO 2') }}</option>
                        <option value="MODULO 3">{{ __('MODULO 3') }}</option>
                        <option value="MODULO 4">{{ __('MODULO 4') }}</option>
                        {{-- Agrega más módulos según sea necesario --}}
                    </select>
                    @error('modulo') <span class="error">{{ $message }}</span> @enderror
                </div>

                <div>
                    <x-label for="profile" value="{{ __('Sello (JPG o PNG)') }}" />
                    <x-input id="profile" type="file" class="block mt-1 w-full" wire:model="profile" />
                    @error('profile') <span class="error">{{ $message }}</span> @enderror
                    @if ($profile instanceof \Livewire\Features\SupportFileUploads\TemporaryUploadedFile)
                        <img src="{{ $profile->temporaryUrl() }}" class="mt-2 max-h-20" alt="Sello temporal">
                    @endif
                </div>
                <div>
                    <x-label for="password" value="{{ __('Contraseña') }}" />
                    <x-input id="password" type="password" class="block mt-1 w-full" wire:model="password" />
                    @error('password') <span class="error">{{ $message }}</span> @enderror
                </div>
            </div>
        </x-slot>

        <x-slot name="footer">
            <x-secondary-button wire:click="closeModal">{{ __('Cancelar') }}</x-secondary-button>
            <x-button class="ml-3" wire:click="createUser" wire:loading.attr="disabled">
                {{ __('Guardar') }}
            </x-button>
        </x-slot>
    </x-dialog-modal>

    <x-dialog-modal wire:model.live="showEditModal" maxWidth="2xl">
        <x-slot name="title">
            {{ __('Editar Usuario') }}
        </x-slot>

        <x-slot name="content">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <x-label for="nombresApellidos" value="{{ __('Nombres y Apellidos') }}" />
                    <x-input id="nombresApellidos" class="block mt-1 w-full" wire:model="nombresApellidos" />
                    @error('nombresApellidos') <span class="error">{{ $message }}</span> @enderror
                </div>
                <div>
                    <x-label for="dniNumberModal" value="{{ __('DNI') }}" />
                    <x-input id="dniNumberModal" class="block mt-1 w-full" wire:model="dniNumberModal" />
                    @error('dniNumberModal') <span class="error">{{ $message }}</span> @enderror
                </div>
                <div>
                    <x-label for="username" value="{{ __('Username') }}" />
                    <x-input id="username" class="block mt-1 w-full" wire:model="username" />
                    @error('username') <span class="error">{{ $message }}</span> @enderror
                </div>
                <div>
                    <x-label for="email" value="{{ __('Email') }}" />
                    <x-input id="email" class="block mt-1 w-full" wire:model="email" type="email" />
                    @error('email') <span class="error">{{ $message }}</span> @enderror
                </div>
                <div>
                    <x-label for="colegiatura" value="{{ __('Colegiatura') }}" />
                    <x-input id="colegiatura" class="block mt-1 w-full" wire:model="colegiatura" />
                    @error('colegiatura') <span class="error">{{ $message }}</span> @enderror
                </div>
                <div>
                    <x-label for="rne" value="{{ __('RNE') }}" />
                    <x-input id="rne" class="block mt-1 w-full" wire:model="rne" />
                    @error('rne') <span class="error">{{ $message }}</span> @enderror
                </div>

                <div>
                    <x-label for="rol" value="{{ __('Rol') }}" />
                    <select id="rol" wire:model="rol" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block w-full">
                        <option value="Administrador del Sistema">{{ __('Administrador del Sistema') }}</option>
                        <option value="Medico">{{ __('Medico') }}</option>
                        <option value="Licenciado">{{ __('Licenciado(a)') }}</option>
                        <option value="Adminitrativo">{{ __('Adminitrativo') }}</option>
                        <option value="Auditor">{{ __('Auditor') }}</option>
                        <option value="Tecnico">{{ __('Tecnico') }}</option>
                        {{-- Agrega más roles según sea necesario --}}
                    </select>
                    @error('rol') <span class="error">{{ $message }}</span> @enderror
                </div>

                <div>
                    <x-label for="modulo" value="{{ __('Módulo') }}" />
                    <select id="modulo" wire:model="modulo" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block w-full">
                        <option value="TODOS">{{ __('TODOS') }}</option>
                        <option value="MODULO 1">{{ __('MODULO 1') }}</option>
                        <option value="MODULO 2">{{ __('MODULO 2') }}</option>
                        <option value="MODULO 3">{{ __('MODULO 3') }}</option>
                        <option value="MODULO 4">{{ __('MODULO 4') }}</option>
                        {{-- Agrega más módulos según sea necesario --}}
                    </select>
                    @error('modulo') <span class="error">{{ $message }}</span> @enderror
                </div>

                <div>
                    <x-label for="profile" value="{{ __('Sello (JPG o PNG)') }}" />
                    <x-input id="profile" type="file" class="block mt-1 w-full" wire:model="profile" />
                    @error('profile') <span class="error">{{ $message }}</span> @enderror
                    @if ($profile instanceof \Livewire\Features\SupportFileUploads\TemporaryUploadedFile)
                        <img src="{{ $profile->temporaryUrl() }}" class="mt-2 max-h-20" alt="Nuevo sello">
                    @elseif ($editingUser && $editingUser->profile)
                        <img src="{{ Storage::url($editingUser->profile) }}" class="mt-2 max-h-20" alt="Sello actual">
                    @endif
                </div>
                <div>
                    <x-label for="password" value="{{ __('Nueva Contraseña (Opcional)') }}" />
                    <x-input id="password" type="password" class="block mt-1 w-full" wire:model="password" />
                    @error('password') <span class="error">{{ $message }}</span> @enderror
                </div>
            </div>
        </x-slot>

        <x-slot name="footer">
            <x-secondary-button wire:click="closeModal">{{ __('Cancelar') }}</x-secondary-button>
            <x-button class="ml-3" wire:click="updateUser" wire:loading.attr="disabled">
                {{ __('Guardar Cambios') }}
            </x-button>
        </x-slot>
    </x-dialog-modal>

    <x-confirmation-modal wire:model.live="confirmingDelete">
        <x-slot name="title">
            {{ __('Eliminar Usuario') }}
        </x-slot>

        <x-slot name="content">
            {{ __('¿Estás seguro de que deseas eliminar a') }} <strong>{{ $deletingUser?->nombres_apellidos }}</strong>? {{ __('Esta acción es irreversible.') }}
        </x-slot>

        <x-slot name="footer">
            <x-secondary-button wire:click="$set('confirmingDelete', false)">{{ __('Cancelar') }}</x-secondary-button>
            <x-danger-button class="ml-3" wire:click="deleteUser" wire:loading.attr="disabled">
                {{ __('Eliminar') }}
            </x-danger-button>
        </x-slot>
    </x-confirmation-modal>
</div>