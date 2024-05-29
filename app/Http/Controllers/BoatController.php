<?php

namespace App\Http\Controllers;

use App\Models\boat;
use Illuminate\Http\Request;

class BoatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $boats = Boat::all();
        return view('chatboat.index', compact('boats'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
       
        return view('chatboat.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = auth()->user();
   
        $validatedData = $request->validate([
            'boat_name' => 'required|string|max:255',
        ]);
        $boat = new Boat();
        $boat->boat_name = $validatedData['boat_name'];
        $boat->created_by = $user->id;
        $boat->save();
        
        return redirect()->route('chatboat')->with('success', 'Boat created successfully');

    }

    /**
     * Display the specified resource.
     */
    public function show(boat $boat)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, $id)
    {

        // Find the Boat model using the ID
        $boat = Boat::findOrFail($id);
        return view('chatboat.edit', compact('boat'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {

        $request->validate([
            'boat_name' => 'required|string|max:255',
            // Add other validation rules as needed
        ]);

        // Find the Boat model using the ID
        $boat = Boat::findOrFail($request->id);

        // Update the boat with the request data
        $boat->update($request->all());

        // Redirect to a relevant route with a success message
        return redirect()->route('chatboat')->with('success', 'Boat updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, $id)
    {
        // Find the Boat record by its ID
        $boat = Boat::find($id);
    
        // Check if the Boat record exists
        if (!$boat) {
            return redirect()->back()->with('error', 'Boat not found.');
        }
    
        // Delete the Boat record
        $boat->delete();
    
        // Redirect back with a success message
        return redirect()->back()->with('success', 'Boat deleted successfully.');
    }

    public function bulkDelete(Request $request)
    {
        $ids = $request->input('ids');
        if ($ids) {
            Boat::whereIn('id', $ids)->delete();
        }
        return redirect()->route('chatboat')->with('success', 'Selected boats deleted successfully.');
    }
    
  
}
