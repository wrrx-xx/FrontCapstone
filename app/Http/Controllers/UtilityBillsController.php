<?php

namespace App\Http\Controllers;

use App\Models\UtilityBill;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UtilityBillsController extends Controller
{
    /**
     * Store a newly created utility bill in storage.
     */
    public function store(Request $request)
    {
    
        $request->validate([
            'billing_id' => 'required|exists:billings,id',
            'type' => 'required|string|max:255',
            'custom_type' => 'nullable|string|max:255',
            'amount' => 'required|numeric|min:0',
            'reading' => 'nullable|string|max:255',
            'status' => 'required|string|in:pending,paid,failed',
        ]);
    
        $utilityType = $request->type === 'other' ? $request->custom_type : $request->type;
    
        if ($utilityType === null || trim($utilityType) === '') {
            return redirect()->back()->withErrors(['custom_type' => 'Please specify the utility type.'])->withInput();
        }
    
        $utilityBill = new UtilityBill();
        $utilityBill->billing_id = $request->billing_id;
        $utilityBill->type = $utilityType;
        $utilityBill->amount = $request->amount;
        $utilityBill->reading = $request->reading ?? '';
        $utilityBill->status = $request->status;
        $utilityBill->save();
    
        return redirect()->back()->with('success', 'Utility bill added successfully.');
    }
    
}
