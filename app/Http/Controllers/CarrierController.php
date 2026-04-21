<?php

namespace App\Http\Controllers;

use App\Models\Carrier;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CarrierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $carriers = Carrier::query()->latest()->paginate(10);

        return view('carriers.index', compact('carriers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('carriers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'cnpj' => ['required', 'string', 'max:18', 'unique:carriers,cnpj'],
            'cep' => ['required', 'string', 'max:9'],
            'state' => ['required', 'string', 'size:2'],
            'city' => ['required', 'string', 'max:255'],
            'district' => ['required', 'string', 'max:255'],
            'street' => ['required', 'string', 'max:255'],
            'number' => ['required', 'string', 'max:20'],
            'complement' => ['nullable', 'string', 'max:255'],
        ]);

        // normaliza CEP/CNPJ (remove tudo que não é dígito) — opcional mas ajuda muito
        $data['cep'] = preg_replace('/\D+/', '', $data['cep']);
        $data['cnpj'] = preg_replace('/\D+/', '', $data['cnpj']);

        Carrier::create($data);

        return redirect()
            ->route('carriers.index')
            ->with('success', 'Transportadora cadastrada com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Carrier $carrier)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Carrier $carrier)
    {
        return view('carriers.edit', compact('carrier'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Carrier $carrier)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'cnpj' => [
                'required',
                'string',
                'max:18',
                Rule::unique('carriers', 'cnpj')->ignore($carrier->id),
            ],
            'cep' => ['required', 'string', 'max:9'],
            'state' => ['required', 'string', 'size:2'],
            'city' => ['required', 'string', 'max:255'],
            'district' => ['required', 'string', 'max:255'],
            'street' => ['required', 'string', 'max:255'],
            'number' => ['required', 'string', 'max:20'],
            'complement' => ['nullable', 'string', 'max:255'],
        ]);
        $data['cep'] = preg_replace('/\D+/', '', $data['cep']);
        $data['cnpj'] = preg_replace('/\D+/', '', $data['cnpj']);
        $carrier->update($data);
        return redirect()
            ->route('carriers.index')
            ->with('success', 'Transportadora atualizada com sucesso!');
      
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Carrier $carrier)
    {
        $carrier->delete();

        return redirect()
            ->route('carriers.index')
            ->with('success', 'Transportadora removida com sucesso!');
    }
}
