<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('users.index'); // Muestra la lista de usuarios (manejada por el componente UserTable)
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('users.create'); // Muestra el formulario de creación
    }

    /**
     * Store a newly created resource in storage.
     * (La lógica se manejará en un componente Livewire)
     */
    public function store(Request $request)
    {
        // No se utilizará directamente aquí si la lógica está en Livewire
        return redirect()->route('users.index'); // Redirección por defecto
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return view('users.show', compact('user')); // Muestra los detalles del usuario
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        return view('users.edit', compact('user')); // Muestra el formulario de edición
    }

    /**
     * Update the specified resource in storage.
     * (La lógica se manejará en un componente Livewire)
     */
    public function update(Request $request, User $user)
    {
        // No se utilizará directamente aquí si la lógica está en Livewire
        return redirect()->route('users.index'); // Redirección por defecto
    }

    /**
     * Remove the specified resource from storage.
     * (La lógica se manejará en un componente Livewire)
     */
    public function destroy(User $user)
    {
        // No se utilizará directamente aquí si la lógica está en Livewire
        return redirect()->route('users.index'); // Redirección por defecto
    }
}