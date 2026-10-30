<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\CustomFitting;
use Illuminate\Http\Request;

class CustomFittingController extends Controller
{
    // ==========================================
    // ADMIN: MENAMPILKAN DATA CUSTOM FITTING
    // ==========================================

    public function index()
    {
        $customFittings = CustomFitting::with('customer')
            ->latest('fitting_date')
            ->get();

        return view('custom-fittings.index', compact('customFittings'));
    }

    // ==========================================
    // ADMIN: MENAMBAHKAN CUSTOM FITTING
    // ==========================================

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

    // ==========================================
    // ADMIN: MELIHAT DETAIL CUSTOM FITTING
    // ==========================================

    public function show(CustomFitting $customFitting)
    {
        $customFitting->load('customer');

        return view('custom-fittings.show', compact('customFitting'));
    }

    // ==========================================
    // ADMIN: MENGEDIT CUSTOM FITTING
    // ==========================================

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

    // ==========================================
    // PELANGGAN: MELIHAT RIWAYAT CUSTOM FITTING
    // ==========================================

    public function customerIndex()
    {
        $customer = auth()->user()->customer;

        if (!$customer || blank($customer->phone)) {
            return redirect()
                ->route('profile.edit')
                ->with(
                    'error',
                    'Silakan lengkapi profil Anda, terutama nomor telepon, sebelum mengakses Custom Fitting.'
                );
        }

        $customFittings = $customer->customFittings()
            ->latest('fitting_date')
            ->get();

        return view(
            'customer-custom-fittings.index',
            compact('customFittings')
        );
    }

    // ==========================================
    // PELANGGAN: MEMBUKA FORM BOOKING
    // ==========================================

    public function customerCreate()
    {
        $customer = auth()->user()->customer;

        if (!$customer || blank($customer->phone)) {
            return redirect()
                ->route('profile.edit')
                ->with(
                    'error',
                    'Silakan lengkapi profil Anda, terutama nomor telepon, sebelum melakukan booking Custom Fitting.'
                );
        }

        return view(
            'customer-custom-fittings.create',
            compact('customer')
        );
    }

    // ==========================================
    // PELANGGAN: MENGAJUKAN BOOKING
    // ==========================================

    public function customerStore(Request $request)
    {
        $customer = auth()->user()->customer;

        if (!$customer || blank($customer->phone)) {
            return redirect()
                ->route('profile.edit')
                ->with(
                    'error',
                    'Silakan lengkapi profil Anda terlebih dahulu sebelum melakukan booking Custom Fitting.'
                );
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
            ->with('success', 'Booking Custom Fitting berhasil diajukan.');
    }

    // ==========================================
    // ADMIN: MENGONFIRMASI BOOKING
    // ==========================================

    public function confirm(CustomFitting $customFitting)
    {
        $customFitting->update([
            'status' => 'confirmed',
        ]);

        return redirect()
            ->route('custom-fittings.index')
            ->with('success', 'Booking custom fitting berhasil dikonfirmasi.');
    }

    // ==========================================
    // ADMIN: MENGHAPUS CUSTOM FITTING
    // ==========================================

    public function destroy(CustomFitting $customFitting)
    {
        $customFitting->delete();

        return redirect()
            ->route('custom-fittings.index')
            ->with('success', 'Data custom fitting berhasil dihapus.');
    }
}
