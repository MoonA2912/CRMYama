<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\CustomFitting;
use Illuminate\Http\Request;

class CustomFittingController extends Controller
{
    public function index()
    {
        $customFittings = CustomFitting::with('customer')
            ->latest('fitting_date')
            ->get();

        return view('custom-fittings.index', compact('customFittings'));
    }

    public function create()
    {
        $customers = Customer::orderBy('name')->get();

        return view('custom-fittings.create', compact('customers'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'fitting_date' => 'required|date',
            'height' => 'nullable|string|max:50',
            'weight' => 'nullable|string|max:50',
            'customer_needs' => 'nullable|string',
            'fitting_result' => 'nullable|string',
            'recommendation' => 'nullable|string',
        ]);

        CustomFitting::create($validated);

        return redirect()
            ->route('custom-fittings.index')
            ->with('success', 'Data custom fitting berhasil ditambahkan.');
    }

    public function show(CustomFitting $customFitting)
    {
        $customFitting->load('customer');

        return view('custom-fittings.show', compact('customFitting'));
    }

    public function edit(CustomFitting $customFitting)
    {
        $customers = Customer::orderBy('name')->get();

        return view('custom-fittings.edit', compact(
            'customFitting',
            'customers'
        ));
    }

    public function update(Request $request, CustomFitting $customFitting)
{
    $validated = $request->validate([
        'customer_id' => 'required|exists:customers,id',
        'fitting_date' => 'required|date',
        'booking_time' => 'nullable',
        'fitting_type' => 'nullable|string|max:255',
        'notes' => 'nullable|string',
        'status' => 'required|in:pending,confirmed,completed,cancelled,rejected',
        'height' => 'nullable|string|max:50',
        'weight' => 'nullable|string|max:50',
        'customer_needs' => 'nullable|string',
        'fitting_result' => 'nullable|string',
        'recommendation' => 'nullable|string',
    ]);

    $customFitting->update($validated);

    return redirect()
        ->route('custom-fittings.show', $customFitting)
        ->with('success', 'Data custom fitting berhasil diperbarui.');
}

    public function customerIndex()
    {
    $customer = auth()->user()->customer;

    if (!$customer) {
        abort(403);
    }

    $customFittings = $customer->customFittings()
        ->latest('fitting_date')
        ->get();

    return view('customer-custom-fittings.index', compact('customFittings'));
    }
    public function customerCreate()
{
    $customer = auth()->user()->customer;

    if (!$customer) {
        abort(403);
    }

    return view('customer-custom-fittings.create', compact('customer'));
}

    public function customerStore(Request $request)
{
    $customer = auth()->user()->customer;

    if (!$customer) {
        abort(403);
    }

    $validated = $request->validate([
        'fitting_date' => 'required|date|after_or_equal:today',
        'booking_time' => 'required',
        'fitting_type' => 'required|string|max:255',
        'notes' => 'nullable|string',
    ]);

    $validated['customer_id'] = $customer->id;
    $validated['status'] = 'pending';

    CustomFitting::create($validated);

    return redirect()
        ->route('customer.custom-fittings')
        ->with('success', 'Booking custom fitting berhasil diajukan.');
}

public function confirm(CustomFitting $customFitting)
{
    $customFitting->update([
        'status' => 'confirmed',
    ]);

    return redirect()
        ->route('custom-fittings.index')
        ->with('success', 'Booking custom fitting berhasil dikonfirmasi.');
}

    public function destroy(CustomFitting $customFitting)
    {
        $customFitting->delete();

        return redirect()
            ->route('custom-fittings.index')
            ->with('success', 'Data custom fitting berhasil dihapus.');
    }
}