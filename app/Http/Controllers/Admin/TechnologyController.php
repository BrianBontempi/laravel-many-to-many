<?php

namespace App\Http\Controllers\Admin;

use App\Models\Technology;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;

class TechnologyController extends Controller
{
    // Colori disponibili (classi Bootstrap text-bg-*)
    private $colors = ['primary', 'secondary', 'success', 'danger', 'warning', 'info', 'light', 'dark'];

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $technologies = Technology::withCount('projects')->orderBy('label')->get();
        return view('admin.technologies.index', compact('technologies'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $technology = new Technology();
        $colors = $this->colors;
        return view('admin.technologies.create', compact('technology', 'colors'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $this->validation($request);

        $technology = new Technology();
        $technology->fill($data);
        $technology->save();

        return to_route('admin.technologies.index')->with('message', "Tecnologia $technology->label creata con successo")->with('type', 'success');
    }

    /**
     * Display the specified resource.
     */
    public function show(Technology $technology)
    {
        return view('admin.technologies.show', compact('technology'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Technology $technology)
    {
        $colors = $this->colors;
        return view('admin.technologies.edit', compact('technology', 'colors'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Technology $technology)
    {
        $data = $this->validation($request, $technology->id);

        $technology->update($data);

        return to_route('admin.technologies.index')->with('message', "Tecnologia $technology->label modificata con successo")->with('type', 'success');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Technology $technology)
    {
        $technology->projects()->detach();
        $technology->delete();

        return to_route('admin.technologies.index')->with('message', "Tecnologia $technology->label eliminata con successo")->with('type', 'success');
    }

    private function validation(Request $request, $id = null)
    {
        return $request->validate(
            [
                'label' => ['required', 'string', 'max:15', Rule::unique('technologies')->ignore($id)],
                'color' => ['nullable', Rule::in($this->colors)],
            ],
            [
                'label.required' => 'Il nome della tecnologia è obbligatorio',
                'label.max' => 'Il nome deve essere di massimo :max caratteri',
                'label.unique' => 'Esiste già una tecnologia con questo nome',
                'color.in' => 'Colore non valido',
            ]
        );
    }
}
