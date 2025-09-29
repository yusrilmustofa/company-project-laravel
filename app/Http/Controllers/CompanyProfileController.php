<?php

namespace App\Http\Controllers;

use App\Models\CompanyProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CompanyProfileController extends Controller
{
    // HAPUS __construct dengan middleware

    public function index()
    {
        $profile = CompanyProfile::first();
        return view('company-profile.index', compact('profile'));
    }

    public function edit()
    {
        $profile = CompanyProfile::first();
        return view('company-profile.edit', compact('profile'));
    }

    public function update(Request $request)
    {
        $profile = CompanyProfile::first();

        $validated = $request->validate([
            'company_name' => 'required|max:255',
            'description' => 'required',
            'address' => 'required',
            'phone' => 'required',
            'email' => 'required|email',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'vision' => 'required',
            'mission' => 'required',
            'facebook' => 'nullable|url',
            'instagram' => 'nullable|url',
            'twitter' => 'nullable|url',
            'linkedin' => 'nullable|url',
        ]);

        if ($request->hasFile('logo')) {
            if ($profile->logo) {
                Storage::disk('public')->delete($profile->logo);
            }
            $validated['logo'] = $request->file('logo')->store('company', 'public');
        }

        $validated['social_media'] = [
            'facebook' => $request->facebook,
            'instagram' => $request->instagram,
            'twitter' => $request->twitter,
            'linkedin' => $request->linkedin,
        ];

        $profile->update($validated);

        return redirect()->route('company-profile.index')
            ->with('success', 'Company profile updated successfully.');
    }
}