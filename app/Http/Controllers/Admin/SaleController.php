<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateSaleRequest;
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

    public function update(UpdateSaleRequest $request, $id)
    {
        $sale = Sale::query()->findOrFail($id);
        $validated = $request->safe();
        $sale->update([
            'sale_date' => $validated['sale_date'],
            'status' => $validated['status']
        ]);
        session()->flash('success', 'Updated Successfully');
        return redirect()->route('admin.sales.index');
    }

}
