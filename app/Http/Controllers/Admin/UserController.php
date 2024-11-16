<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\QueryException;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
        $title = 'Usuários';
        $users = User::paginate(12);

        return view('admin.user.index', compact('title', 'users'));
        } catch (QueryException $e) {
            // Log de erro
            return abort(500);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = 'Cadastrar usuário';
        return view('admin.user.create', compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserRequest $request)
    {
        try {

            $user = new User;
            $user->fill($request->all());

            $user->save();

            return response()->json([
                'trigger' => alert(
                    'Usuário <b class="text-danger">"' . $request->name .'"</b> cadastrado com sucesso!',
                    3000,
                    //route('admin.user.index')
                ),
            ]);
        } catch (QueryException $e) {
            dd($e->getMessage());
            // Log de erro
            return abort(500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $title = 'Editar usuário';

        $user = User::findOrFail($id);
        return view('admin.user.edit', compact('title', 'user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserRequest $request, string $id)
    {
        try {
            $user = User::find($id);
            $user->fill($request->all());            
            if($request->password) {
                $request->password = Hash::make($request->password);
                /**
                 * Futura atualização:
                 * caso altere a senha, fazer logout
                 */
            }
            $user->save();
            return response()->json([
                'trigger' => alert(
                    'Usuário <b class="text-danger">"' . $request->name .'"</b> alterado com sucesso!',
                    3000,
                    route('admin.user.index')
                ),
            ]);
        } catch (QueryException $e) {
            dd($e->getMessage());
            return abort(500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}