<?php

namespace App\Http\Controllers;

use App\Models\ReporteFinanciero;
use Illuminate\Http\Request;

class ReporteFinancieroController extends Controller
{
    public function index()
    {
        $reportes = ReporteFinanciero::orderBy('fecha', 'desc')->get();
        $totalIngresos = $reportes->sum('monto');
        
        return view('reportes.index', compact('reportes', 'totalIngresos'));
    }

    public function create() 
    { 
        return view('reportes.create'); 
    }

    public function store(Request $request) 
    { 
        $request->validate([
            'fecha' => 'required|date',
            'monto' => 'required|numeric',
            'concepto' => 'required|string',
            'atendido_por' => 'required|string',
        ]);

        ReporteFinanciero::create($request->all());

        return redirect()->route('reportes.index');
    }

    public function show(ReporteFinanciero $reporte) { }
    public function edit(ReporteFinanciero $reporte) { }
    public function update(Request $request, ReporteFinanciero $reporte) { }
    
    public function destroy(ReporteFinanciero $reporte) 
    { 
        $reporte->delete();
        return redirect()->route('reportes.index');
    }
}