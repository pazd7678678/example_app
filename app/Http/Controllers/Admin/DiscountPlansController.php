<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DiscountPlan;
use Illuminate\Http\Request;

use function PHPUnit\Framework\returnSelf;

class DiscountPlansController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $discount_plans = DiscountPlan::latest()->paginate(20);

        return view('admin.discountplans.all',compact('discount_plans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.discountplans.create');
    }

    /**
     * Store a newly created resource in storage.
     */
  public function store(Request $request)
    {

    


        $validated = $request->validate([
           'name' => 'required|unique:discount_plans,name',
           'percent' => 'required|integer|between:1,99',
           'payment_type'=>'required',
           'users' => 'nullable|array|exists:users,id',
           'products' => 'nullable|array|exists:products,id',
           'start_at' => 'required',
           'expired_at' => 'required'
        ]);

        $discountplan = DiscountPlan::create($validated);
        

        $discountplan->users()->attach($validated['users']);
        $discountplan->products()->attach($validated['products']);

        return redirect(route('admin.discountplans.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
