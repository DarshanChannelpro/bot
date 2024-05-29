<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Modules\Wpbox\Models\Flows;

class DraggableItemController extends Controller
{
    private $provider = Flows::class;

    public function index($id,$back_id)
    {
      
        $items = Flows::where('id', $id)->first();
        return view('boatFLowLayout.dragAndDropFlow', compact('id','back_id','items')); 
    }

    // Update the position of a draggable item
//     public function update(Request $request, DraggableItem $draggableItem)
//     {
//         $draggableItem->update($request->only('dropzone'));
//         return response()->json(['success' => true]);
//     }

//     // Create new draggable item
//     public function store(Request $request)
//     {
//         $item = DraggableItem::create($request->only('name', 'dropzone'));
//         return response()->json(['success' => true, 'item' => $item]);
//     }

//     // Delete a draggable item
//     public function destroy(DraggableItem $draggableItem)
//     {
//         $draggableItem->delete();
//         return response()->json(['success' => true]);
//     }
 }
