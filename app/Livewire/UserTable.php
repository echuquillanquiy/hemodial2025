<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rules\Password;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Illuminate\Support\Facades\Storage;
use Livewire\WithFileUploads;

class UserTable extends Component
{
    use WithPagination, WithFileUploads;

    public $apellidos = '';
    public $dniNumber = '';

    // Properties for creating and editing
    public $nombresApellidos;
    public $dniNumberModal;
    public $username;
    public $colegiatura;
    public $rne;
    public $profile;
    public $rol;
    public $modulo;
    public $email;
    public $password;
    public $passwordConfirmation;

    public bool $showCreateModal = false;
    public bool $showEditModal = false;
    public ?User $editingUser = null;
    public ?User $deletingUser = null;
    public bool $confirmingDelete = false;

    protected $queryString = [
        'apellidos' => ['except' => ''],
        'dniNumber' => ['except' => ''],
        'page' => ['except' => 1],
    ];

    protected function rules(): array
    {
        return [
        'nombresApellidos' => 'required|string|max:255',
        'dniNumberModal' => 'required|string|max:8|unique:users,dni,' . ($this->editingUser ? $this->editingUser->id : null),
        'username' => 'required|string|max:255|unique:users,username,' . ($this->editingUser ? $this->editingUser->id : null),
        'colegiatura' => 'nullable|string|max:20|unique:users,colegiatura,' . ($this->editingUser ? $this->editingUser->id : null),
        'rne' => 'nullable|string|max:20|unique:users,rne,' . ($this->editingUser ? $this->editingUser->id : null),
        'profile' => [
            'nullable',
            'image',
            'mimes:jpg,png',
            'max:2048',
            function ($attribute, $value, $fail) {
                if ($this->showCreateModal && !$value) {
                    $fail('El sello es requerido al crear un nuevo usuario.');
                }
            },
        ],
        'email' => 'required|email|max:255|unique:users,email,' . ($this->editingUser ? $this->editingUser->id : null),
        'password' => [
            $this->editingUser ? 'nullable' : 'required',
            Password::min(8),
            // 'confirmed', // Puedes habilitar esto si quieres confirmación al editar
        ],
        // 'passwordConfirmation' => 'required|same:password', // Ya no es necesario para la creación
    ];
    }

    protected $validationAttributes = [
        'nombresApellidos' => 'nombres y apellidos',
        'dniNumberModal' => 'DNI',
        'username' => 'nombre de usuario',
        'colegiatura' => 'colegiatura',
        'rne' => 'RNE',
        'profile' => 'sello',
        'email' => 'correo electrónico',
        'password' => 'contraseña',
        //'passwordConfirmation' => 'confirmación de contraseña',
    ];

    public function updatingApellidos()
    {
        $this->resetPage();
    }

    public function updatingDniNumber()
    {
        $this->resetPage();
    }

    public function render()
    {
        $users = User::orderBy('nombres_apellidos')
            ->when($this->apellidos, fn ($query) => $query->where('nombres_apellidos', 'like', '%' . $this->apellidos . '%'))
            ->when($this->dniNumber, fn ($query) => $query->where('dni', 'like', '%' . $this->dniNumber . '%'))
            ->paginate(10);

        return view('livewire.user-table', [
            'users' => $users,
        ]);
    }

    public function openCreateModal()
    {
        $this->resetErrorBag();
        $this->reset(['nombresApellidos', 'dniNumberModal', 'username', 'colegiatura', 'rne', 'profile','rol','modulo', 'email', 'password', 'passwordConfirmation', 'editingUser']);
        $this->showCreateModal = true;
    }

    public function createUser()
    {
        $this->validate();

        $profilePath = $this->profile->store('sellos', 'public');

        User::create([
            'nombres_apellidos' => $this->nombresApellidos,
            'dni' => $this->dniNumberModal,
            'username' => $this->username,
            'colegiatura' => $this->colegiatura,
            'rne' => $this->rne,
            'profile' => $profilePath,
            'rol' => $this->rol,
            'modulo' => $this->modulo,
            'email' => $this->email,
            'password' => Hash::make($this->password),
        ]);

        $this->closeModal();
        Session::flash('success', 'Usuario creado exitosamente.');
    }

    public function openEditModal(User $user)
    {
        $this->resetErrorBag();
        $this->editingUser = $user;
        $this->nombresApellidos = $user->nombres_apellidos;
        $this->dniNumberModal = $user->dni;
        $this->username = $user->username;
        $this->colegiatura = $user->colegiatura;
        $this->rne = $user->rne;
        $this->email = $user->email;
        $this->profile = null; // Reset profile for editing
        $this->rol = $user->rol;
        $this->modulo = $user->modulo;
        $this->password = '';
        $this->passwordConfirmation = '';
        $this->showEditModal = true;
    }

    public function updateUser()
    {
        $this->validate();

        if ($this->profile instanceof TemporaryUploadedFile) {
        // Verifica si el usuario ya tenía una imagen antes de intentar eliminarla
        if ($this->editingUser->profile) {
            Storage::disk('public')->delete($this->editingUser->profile);
        }
        $this->editingUser->profile = $this->profile->store('sellos', 'public');
    }

        $this->editingUser->update([
            'nombres_apellidos' => $this->nombresApellidos,
            'dni' => $this->dniNumberModal,
            'username' => $this->username,
            'colegiatura' => $this->colegiatura,
            'rne' => $this->rne,
            'profile' => $this->editingUser->profile,
            'rol' => $this->rol,
            'modulo' => $this->modulo,
            'email' => $this->email,
        ]);

        if ($this->password) {
            $this->editingUser->update(['password' => Hash::make($this->password)]);
        }

        $this->closeModal();
        Session::flash('success', 'Usuario actualizado exitosamente.');
    }

    public function confirmDelete(User $user)
    {
        $this->deletingUser = $user;
        $this->confirmingDelete = true;
    }

    public function deleteUser()
    {
        if ($this->deletingUser->profile) {
            Storage::disk('public')->delete($this->deletingUser->profile);
        }
        $this->deletingUser->delete();
        $this->confirmingDelete = false;
        $this->deletingUser = null;
        Session::flash('success', 'Usuario eliminado exitosamente.');
        $this->resetPage();
    }

    public function closeModal()
    {
        $this->showCreateModal = false;
        $this->showEditModal = false;
        $this->confirmingDelete = false;
        $this->resetErrorBag();
        $this->reset(['nombresApellidos', 'dniNumberModal', 'username', 'colegiatura', 'rne', 'profile', 'email', 'password', 'passwordConfirmation', 'editingUser', 'deletingUser']);
    }
}