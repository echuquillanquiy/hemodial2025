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
    public function index(Request $request)
    {
        $users = User::orderBy('id', 'asc')
            ->when($request->has('apellidos'), function ($query) use ($request) {
                $apellidos = $request->input('apellidos');
                $query->where('nombres_apellidos', 'LIKE', '%' . $apellidos . '%');
            })
            ->when($request->has('dni'), function ($query) use ($request) {
                $dni = $request->input('dni');
                $query->where('dni', 'LIKE', '%' . $dni . '%');
            })
            ->paginate(10);

        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nombres_apellidos' => 'nullable|string|max:255',
            'dni' => 'nullable|string|max:8|unique:users',
            'username' => 'required|string|max:255|unique:users',
            'colegiatura' => 'nullable|string|max:20|unique:users',
            'rne' => 'nullable|string|max:20|unique:users',
            'profile' => 'nullable|string|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            return redirect()->route('users.create')
                ->withErrors($validator)
                ->withInput();
        }

        User::create([
            'nombres_apellidos' => $request->nombres_apellidos,
            'dni' => $request->dni,
            'username' => $request->username,
            'colegiatura' => $request->colegiatura,
            'rne' => $request->rne,
            'profile' => $request->profile,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('users.index')->with('success', 'Usuario creado exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $validator = Validator::make($request->all(), [
            'nombres_apellidos' => 'nullable|string|max:255',
            'dni' => 'nullable|string|max:8|unique:users,dni,' . $user->id,
            'username' => 'required|string|max:255|unique:users,username,' . $user->id,
            'colegiatura' => 'nullable|string|max:20|unique:users,colegiatura,' . $user->id,
            'rne' => 'nullable|string|max:20|unique:users,rne,' . $user->id,
            'profile' => 'nullable|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            return redirect()->route('users.edit', $user)
                ->withErrors($validator)
                ->withInput();
        }

        $user->nombres_apellidos = $request->nombres_apellidos;
        $user->dni = $request->dni;
        $user->username = $request->username;
        $user->colegiatura = $request->colegiatura;
        $user->rne = $request->rne;
        $user->profile = $request->profile;
        $user->email = $request->email;
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }
        $user->save();

        return redirect()->route('users.index')->with('success', 'Usuario actualizado exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('users.index')->with('success', 'Usuario eliminado exitosamente.');
    }
}