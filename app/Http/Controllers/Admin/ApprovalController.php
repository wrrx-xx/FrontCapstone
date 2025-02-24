<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\OwnerProfile;
use Illuminate\Http\Request;
use App\Notifications\OwnerApprovalStatusChanged;
use App\Models\User;

class ApprovalController extends Controller
{
    /**
     * Display pending owner approvals
     */
    public function index()
    {
        $pendingApprovals = OwnerProfile::where('approved', false)
            ->with('user')
            ->paginate(10);

        return view('admin.approvals.index', compact('pendingApprovals'));
    }

    /**
     * Approve an owner profile
     */
    public function approve($id)
    {
        $profile = OwnerProfile::findOrFail($id);
        $profile->update(['approved' => true]);

        // Notify owner about approval
        $profile->user->notify(new OwnerApprovalStatusChanged(true));

        return redirect()->route('admin.approvals.index')
            ->with('success', 'Owner profile approved successfully');
    }

    /**
     * Reject an owner profile
     */
    public function reject($id)
    {
        $profile = OwnerProfile::findOrFail($id);
        $profile->delete();

        // Notify owner about rejection
        $profile->user->notify(new OwnerApprovalStatusChanged(false));

        return redirect()->route('admin.approvals.index')
            ->with('success', 'Owner profile rejected successfully');
    }
}
