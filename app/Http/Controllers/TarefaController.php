<?php

namespace App\Http\Controllers;

use App\Models\Tarefa;
use Illuminate\Http\Request;

class TarefaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('tarefas.index', [
            'tarefas' => Tarefa::with('user')->latest()->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'message' => 'required|string|max:255',
        ]);

        $request->user()->tarefas()->create($validated);

        return redirect(route('tarefas.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Tarefa $tarefa)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tarefa $tarefa)
    {
        $this->authorize('update', $tarefa);

        return view('tarefas.edit', [
            'tarefa' => $tarefa,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tarefa $tarefa)
    {
        $this->authorize('update', $tarefa);

        $validated = $request->validate([
            'message' => 'required|string|max:255',
        ]);

        $tarefa->update($validated);

        return redirect(route('tarefas.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tarefa $tarefa)
    {
        $this->authorize('delete', $tarefa);

        $tarefa->delete();

        return redirect(route('tarefas.index'));
    }
}
