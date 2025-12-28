<?php
namespace App\Http\Controllers;

use App\Models\EnergyEvent;
use Illuminate\Http\Request;
use App\Services\EnergyReportGuard;

class EnergyEventController extends Controller
{
   public function store(Request $request, EnergyReportGuard $guard)
{
    $request->validate([
        'type' => 'required|in:on,off,problem',
        'description' => 'nullable|string|max:1000',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120', // 5MB max
    ]);

    $user = auth()->user();

    $error = $guard->canReport(
        $user->id,
        $user->zone_id,
        $request->type
    );

    if ($error) {
        return back()->withErrors(['report' => $error]);
    }

    $imagePath = null;
    $textFilePath = null;

    // Handle image upload
    if ($request->hasFile('image')) {
        $image = $request->file('image');
        $imageName = time() . '_' . $user->id . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
        $imagePath = $image->storeAs('problem_reports/images', $imageName, 'public');
    }

    // Generate text file from description if provided
    if ($request->description) {
        $textFileName = time() . '_' . $user->id . '_' . uniqid() . '.txt';
        $textFilePath = 'problem_reports/texts/' . $textFileName;
        \Storage::disk('public')->put($textFilePath, $request->description);
    }

    EnergyEvent::create([
        'user_id' => $user->id,
        'zone_id' => $user->zone_id,
        'type' => $request->type,
        'description' => $request->description,
        'image_path' => $imagePath,
        'text_file_path' => $textFilePath,
    ]);

    return back()->with('status', 'Report submitted.');
}
    
}
