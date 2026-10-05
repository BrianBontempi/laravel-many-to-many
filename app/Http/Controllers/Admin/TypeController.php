<?php

namespace App\Http\Controllers\Admin;

use App\Models\Type;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;

class TypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $types = Type::withCount('projects')->orderBy('label')->get();
        return view('admin.types.index', compact('types'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $type = new Type();
        return view('admin.types.create', compact('type'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $this->validation($request);

        $type = new Type();
        $type->fill($data);
        $type->save();

        return to_route('admin.types.index')->with('message', "Tipologia $type->label creata con successo")->with('type', 'success');
    }

    /**
     * Display the specified resource.
     */
    public function show(Type $type)
    {
        return view('admin.types.show', compact('type'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Type $type)
    {
        return view('admin.types.edit', compact('type'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Type $type)
    {
        $data = $this->validation($request, $type->id);

        $type->update($data);

        return to_route('admin.types.index')->with('message', "Tipologia $type->label modificata con successo")->with('type', 'success');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Type $type)
    {
        $type->delete();

        return to_route('admin.types.index')->with('message', "Tipologia $type->label eliminata con successo")->with('type', 'success');
    }

    private function validation(Request $request, $id = null)
    {
        return $request->validate(
            [
                'label' => ['required', 'string', 'max:15', Rule::unique('types')->ignore($id)],
                'color' => ['required', 'regex:/^#[0-9a-fA-F]{6}$/'],
            ],
            [
                'label.required' => 'Il nome della tipologia è obbligatorio',
                'label.max' => 'Il nome deve essere di massimo :max caratteri',
                'label.unique' => 'Esiste già una tipologia con questo nome',
                'color.required' => 'Il colore è obbligatorio',
                'color.regex' => 'Il colore deve essere in formato esadecimale (es. #ff0000)',
            ]
        );
    }
}
