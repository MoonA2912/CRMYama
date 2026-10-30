<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Customer;
use App\Services\VoucherService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        $user = $request->user();
        $customer = $user->customer;

        if ($customer) {
            $voucherService = new VoucherService();
            $voucherService->createBirthdayVoucher($customer);
        }

        return view('profile.edit', [
            'user' => $user,
            'customer' => $customer,
        ]);
    }

    /**
     * Update account and customer information.
     */
    public function update(Request $request): RedirectResponse
    {
        $user = $request->user();

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'lowercase',
                'email',
                'max:255',
                'unique:users,email,' . $user->id,
            ],
            'phone' => ['required', 'string', 'max:20'],
            'address' => ['nullable', 'string', 'max:255'],
            'birth_date' => ['nullable', 'date', 'before_or_equal:today'],
        ]);

        DB::transaction(function () use ($user, $validated) {
            $user->name = $validated['name'];

            if ($user->email !== $validated['email']) {
                $user->email = $validated['email'];
                $user->email_verified_at = null;
            }

            $user->save();

            $customer = $user->customer;

            if (!$customer) {
                $customer = new Customer();
                $customer->user_id = $user->id;
                $customer->membership_level = 'none';
            }

            $customer->name = $validated['name'];
            $customer->phone = $validated['phone'];
            $customer->address = $validated['address'] ?? null;
            $customer->birth_date = $validated['birth_date'] ?? null;

            $customer->save();
        });

        return Redirect::route('profile.edit')
            ->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}