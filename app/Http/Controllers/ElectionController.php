<?php

namespace App\Http\Controllers;

use App\Models\ElectionResult;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ElectionController extends Controller
{
    public function index()
    {
        $latestResult = ElectionResult::latest()->first();

        $previousResults = ElectionResult::where('created_at', '<', Carbon::now())->orderBy('created_at', 'desc')->get();

        return view('results', compact('latestResult', 'previousResults'));
    }

    public function indexUpload()
    {
        $latestResult = ElectionResult::latest()->first();

        $previousResults = ElectionResult::where('created_at', '<', Carbon::now())->orderBy('created_at', 'desc')->get();

        return view('upload', compact('latestResult', 'previousResults'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $imageName = time() . '.' . $request->image->extension();
        $request->image->move(public_path('images'), $imageName);

        ElectionResult::create([
            'image_path' => $imageName,
        ]);

        return redirect()->back()->with('success', 'Election result uploaded successfully!');
    }

    public function destroy($id)
    {
        $result = ElectionResult::find($id);

        if ($result) {
            Storage::delete('images/' . $result->image_path);
            $result->delete();
            return redirect()->back()->with('success', 'Result deleted successfully.');
        }

        return redirect()->back()->with('error', 'Result not found.');
    }
}
