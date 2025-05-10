<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Fua;
use Livewire\WithPagination;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Config;

class FuaTable extends Component
{
    use WithPagination;

    public $modalVisible = false;
    public $modalModo = 'crear'; // 'crear', 'editar', 'eliminar'
    public $fuaId;
    public $codigo_empresa;
    public $anio;
    public $numero_fua;
    public $fuaAEliminar; // Para mostrar el número de FUA al eliminar
    public $listeners = ['cerrarModal' => 'cerrarModal'];

    protected $rules = [
        'codigo_empresa' => 'required|string|max:8',
        'anio' => 'required|string|max:2',
        'numero_fua' => 'required|string|max:8',
    ];

    public function mount(): void
    {
        $this->resetInputFields();
        $this->codigo_empresa = Config::get('app.codigo_empresa_default', 'XXXX'); //Valor por defecto.
    }

    public function resetInputFields(): void
    {
        $this->fuaId = null;
        $this->codigo_empresa =  Config::get('app.codigo_empresa_default', 'XXXX');
        $this->anio = date('y'); // Año actual de 2 dígitos
        $this->numero_fua = '';
        $this->fuaAEliminar = null;
        $this->resetValidation();
    }

    public function mostrarModal(string $modo, ?int $id = null): void
    {
        $this->resetInputFields();
        $this->modalModo = $modo;
        $this->modalVisible = true;

        if ($modo === 'editar' || $modo === 'eliminar') {
            $fua = Fua::findOrFail($id);
            $this->fuaId = $fua->id;
            $this->codigo_empresa = $fua->codigo_empresa;
            $this->anio = $fua->anio;
            $this->numero_fua = $fua->numero_fua;
            if ($modo === 'eliminar') {
                $this->fuaAEliminar = $fua->serie_completa;
            }
        }
    }

    public function crearFua(): void
    {
        $this->validate();

        Fua::create([
            'codigo_empresa' => $this->codigo_empresa,
            'anio' => $this->anio,
            'numero_fua' => $this->numero_fua,
        ]);

        session()->flash('mensaje', 'FUA creado exitosamente.');
        $this->cerrarModal();
        $this->resetPage(); // Para refrescar la paginación
    }

    public function actualizarFua(): void
    {
        $this->validate();

        $fua = Fua::findOrFail($this->fuaId);
        $fua->update([
            'codigo_empresa' => $this->codigo_empresa,
            'anio' => $this->anio,
            'numero_fua' => $this->numero_fua,
        ]);

        session()->flash('mensaje', 'FUA actualizado exitosamente.');
        $this->cerrarModal();
        $this->resetPage();
    }

    public function eliminarFuaConfirmacion(int $id): void
    {
        $this->mostrarModal('eliminar', $id);
    }

    public function eliminarFua(): void
    {
        if ($this->fuaId) {
            Fua::destroy($this->fuaId);
            session()->flash('mensaje', 'FUA eliminado exitosamente.');
            $this->cerrarModal();
            $this->resetPage();
        }
    }

    public function cerrarModal(): void
    {
        $this->modalVisible = false;
        $this->resetInputFields();
    }

    public function render(): View
    {
        $fuas = Fua::orderBy('serie_completa')->paginate(10);
        return view('livewire.fua-table', compact('fuas'));
    }
}

