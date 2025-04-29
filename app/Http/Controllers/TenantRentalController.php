<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Listing;
use Illuminate\Support\Facades\Auth;

class TenantRentalController extends Controller
{// TenantRentalController.php

public function index()
{
    $myRentals = Listing::where('tenant_id', Auth::id())->with('photos')->get();

    return view('Tenant.myrental.index', compact('myRentals'));
}

}
