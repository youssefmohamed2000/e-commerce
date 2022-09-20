<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Sale;
use Illuminate\Http\Request;

class SaleController extends Controller
{

    public function index()
    {
        $sale = Sale::query()->findOrFail(1);
        return view('admin.sale.index', compact('sale'));
    }

    public function edit($id)
    {
        $sale = Sale::query()->findOrFail(1);
        return view('admin.sale.edit', compact('sale'));
    }

    public function update(Request $request, $id)
    {
        $sale = Sale::query()->findOrFail($id);
        $request->validate([
            'sale_date' => 'required|date',
            'status' => 'required|boolean'
        ]);
        $sale->update([
            'sale_date' => $request->sale_date,
            'status' => $request->status
        ]);
        session()->flash('success', 'Updated Successfully');
        return redirect()->route('admin.sales.index');
    }

}
