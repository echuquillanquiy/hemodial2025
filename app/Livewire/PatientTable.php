<?php

namespace App\Livewire;

use App\Models\Patient;
use Livewire\Component;
use Livewire\WithPagination;

class PatientTable extends Component
{
    use WithPagination;

    public $filtroDni = '';
    public $filtroPrimerApellido = '';
    public $filtroTurno = '';
    public $filtroSecuencia = '';

    public $pacienteSeleccionadoId;
    public $nombrePacienteAEliminar;
    public $modalModo = '';
    public $modalVisible = false;

    public $primer_nombre;
    public $otros_nombres;
    public $primer_apellido;
    public $segundo_apellido;
    public $dni;
    public $secuencia;
    public $turno;
    public $modulo;
    public $peso_seco;
    public $acceso_arterial;
    public $acceso_venoso;
    public $n_historia;
    public $justificacion;
    public $codigo_cs;
    public $n_hd;

    protected $rules = [
        'primer_nombre' => 'required|string|max:255',
        'dni' => 'required|string|max:20|unique:patients,dni',
        'secuencia' => 'required|string|max:255',
        'turno' => 'required|string|max:255',
        'codigo_cs' => 'required|string|max:255|unique:patients,codigo_cs',
        'n_hd' => 'required|string|max:255',
        'otros_nombres' => 'nullable|string|max:255',
        'primer_apellido' => 'nullable|string|max:255',
        'segundo_apellido' => 'nullable|string|max:255',
        'modulo' => 'nullable|string|max:255',
        'peso_seco' => 'nullable|string|max:255',
        'acceso_arterial' => 'required|string|max:255',
        'acceso_venoso' => 'required|string|max:255',
        'n_historia' => 'nullable|string|max:255',
        'justificacion' => 'nullable|string',
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function mostrarModal($modo, $pacienteId = null)
    {
        $this->modalModo = $modo;
        $this->modalVisible = true;
        $this->pacienteSeleccionadoId = $pacienteId;

        if ($modo === 'ver' || $modo === 'editar') {
            $paciente = Patient::findOrFail($pacienteId);
            $this->primer_nombre = $paciente->primer_nombre;
            $this->otros_nombres = $paciente->otros_nombres;
            $this->primer_apellido = $paciente->primer_apellido;
            $this->segundo_apellido = $paciente->segundo_apellido;
            $this->dni = $paciente->dni;
            $this->secuencia = $paciente->secuencia;
            $this->turno = $paciente->turno;
            $this->modulo = $paciente->modulo;
            $this->peso_seco = $paciente->peso_seco;
            $this->acceso_arterial = $paciente->acceso_arterial;
            $this->acceso_venoso = $paciente->acceso_venoso;
            $this->n_historia = $paciente->n_historia;
            $this->justificacion = $paciente->justificacion;
            $this->codigo_cs = $paciente->codigo_cs;
            $this->n_hd = $paciente->n_hd;
            
            // Muevo la definición de las reglas de validación AQUÍ
            if ($modo === 'editar') {
                $this->rules['dni'] = 'required|string|max:20|unique:patients,dni,' . $pacienteId;
                $this->rules['codigo_cs'] = 'required|string|max:255|unique:patients,codigo_cs,' . $pacienteId;
                //$this->rules['n_hd'] = 'required|string|max:255|unique:patients,n_hd,' . $pacienteId;
            } else { //Reseteo las reglas a su estado original para crear.
                $this->rules['dni'] = 'required|string|max:20|unique:patients,dni';
                $this->rules['codigo_cs'] = 'required|string|max:255|unique:patients,codigo_cs';
                //$this->rules['n_hd'] = 'required|string|max:255|unique:patients,n_hd';
            }
        } else if ($modo === 'crear') {
            $this->resetInputFields();
            // Reseteo las reglas a su estado original para crear un nuevo paciente.
            $this->rules['dni'] = 'required|string|max:20|unique:patients,dni';
            $this->rules['codigo_cs'] = 'required|string|max:255|unique:patients,codigo_cs';
            //$this->rules['n_hd'] = 'required|string|max:255|unique:patients,n_hd';
        }
    }

    public function cerrarModal()
    {
        $this->modalVisible = false;
        $this->resetErrorBag();
        $this->resetValidation();
        $this->resetInputFields();
    }

    public function resetInputFields()
    {
        $this->pacienteSeleccionadoId = null;
        $this->primer_nombre = '';
        $this->otros_nombres = '';
        $this->primer_apellido = '';
        $this->segundo_apellido = '';
        $this->dni = '';
        $this->secuencia = '';
        $this->turno = '';
        $this->modulo = '';
        $this->peso_seco = '';
        $this->acceso_arterial = '';
        $this->acceso_venoso = '';
        $this->n_historia = '';
        $this->justificacion = '';
        $this->codigo_cs = '';
        $this->n_hd = '';
    }

    public function guardarPaciente()
    {
        // Define las reglas de validación ANTES de llamar a validate().
        if ($this->modalModo === 'editar') {
            $this->rules['dni'] = 'required|string|max:20|unique:patients,dni,' . $this->pacienteSeleccionadoId;
            $this->rules['codigo_cs'] = 'required|string|max:255|unique:patients,codigo_cs,' . $this->pacienteSeleccionadoId;
            $this->rules['n_hd'] = 'required|string|max:255|unique:patients,n_hd,' . $this->pacienteSeleccionadoId;
        } else {
            $this->rules['dni'] = 'required|string|max:20|unique:patients,dni';
            $this->rules['codigo_cs'] = 'required|string|max:255|unique:patients,codigo_cs';
            $this->rules['n_hd'] = 'required|string|max:255|unique:patients,n_hd';
        }
        
        $this->validate(); // Llama a validate() DESPUÉS de definir las reglas.

        $data = [
            'primer_nombre' => $this->primer_nombre,
            'otros_nombres' => $this->otros_nombres,
            'primer_apellido' => $this->primer_apellido,
            'segundo_apellido' => $this->segundo_apellido,
            'dni' => $this->dni,
            'secuencia' => $this->secuencia,
            'turno' => $this->turno,
            'modulo' => $this->modulo,
            'peso_seco' => $this->peso_seco,
            'acceso_arterial' => $this->acceso_arterial,
            'acceso_venoso' => $this->acceso_venoso,
            'n_historia' => $this->n_historia,
            'justificacion' => $this->justificacion,
            'codigo_cs' => $this->codigo_cs,
            'n_hd' => $this->n_hd,
        ];

        if ($this->pacienteSeleccionadoId) {
            Patient::find($this->pacienteSeleccionadoId)->update($data);
            session()->flash('mensaje', 'Paciente actualizado exitosamente.');
        } else {
            Patient::create($data);
            session()->flash('mensaje', 'Paciente creado exitosamente.');
        }

        $this->cerrarModal();
    }

    public function eliminarPacienteConfirmacion($pacienteId)
    {
        $paciente = Patient::findOrFail($pacienteId);
        $this->pacienteSeleccionadoId = $pacienteId;
        $this->nombrePacienteAEliminar = $paciente->primer_nombre . ' ' . $paciente->primer_apellido; // O como quieras mostrar el nombre
        $this->modalModo = 'eliminar-confirmacion';
        $this->modalVisible = true;
    }

    public function eliminarPaciente()
    {
        if ($this->pacienteSeleccionadoId) {
            Patient::destroy($this->pacienteSeleccionadoId);
            session()->flash('mensaje', 'Paciente eliminado exitosamente.');
            $this->cerrarModal();
            $this->reset(['pacienteSeleccionadoId', 'nombrePacienteAEliminar']); // Limpiar las propiedades
        }
    }

    public function render()
    {
        $pacientes = Patient::query()
            ->when($this->filtroDni, function ($query) {
                $query->where('dni', 'like', '%' . $this->filtroDni . '%');
            })
            ->when($this->filtroPrimerApellido, function ($query) {
                $query->where('primer_apellido', 'like', '%' . $this->filtroPrimerApellido . '%');
            })
            ->when($this->filtroTurno, function ($query) {
                $query->where('turno', $this->filtroTurno);
            })
            ->when($this->filtroSecuencia, function ($query) {
                $query->where('secuencia', $this->filtroSecuencia);
            })
            ->paginate(10);

        return view('livewire.patient-table', compact('pacientes'));
    }
}