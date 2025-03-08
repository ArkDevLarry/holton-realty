<?php

namespace App\Http\Controllers;

use App\Models\Shortlet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ShortletController extends Controller
{

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'title' => ['required', 'string', 'max:255', 'unique:properties'],
            'size' => ['required', 'string', 'max:255'],
            'price' => ['required', 'array'],
            'price.*.amount' => ['integer'],
            'price.*.description' => ['string', "max:255"],
            'location' => ['required','regex:/^[-+]?\d+(\.\d+)?,\s*[-+]?\d+(\.\d+)?$/'],
            'document' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'type' => ['required', 'in:Sale,Rent'],
            'link' => ['required', 'string'],
            'features' => ['required', 'array'],
            'images' => ['required', 'array'],
            'images.*' => ['image', 'mimes:jpeg,png,jpg,gif', 'max:1024']
        ]);
    }

    protected function validatorUpdate(array $data, $uniqId)
    {
        return Validator::make($data, [
            'title' => ['required', 'string', 'max:255', 'unique:properties,title,'.$uniqId.',uniqId'],
            'size' => ['required', 'string', 'max:255'],
            'status' => ['required', 'in:0,1'],
            'price' => ['required', 'array'],
            'price.*.amount' => ['integer'],
            'price.*.description' => ['string', "max:255"],
            'location' => ['required','regex:/^[-+]?\d+(\.\d+)?,\s*[-+]?\d+(\.\d+)?$/'],
            'document' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'type' => ['required', 'in:Sale,Rent'],
            'link' => ['required', 'string'],
            'features' => ['required', 'array']
        ]);
    }
    
    protected function validatorImages(array $data, $uniqId)
    {
        return Validator::make($data, [
            'images' => ['required', 'array'],
            'images.*' => ['image', 'mimes:jpeg,png,jpg,gif', 'max:1024']
        ]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $pg = "Shortlet Listings";
        $list = Shortlet::get();

        if ($request->expectsJson()) {
            return response()->json([$list], 200);
        }
        return view('admin.manage-shortlet', ['pg'=>$pg, 'list'=>$list]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $pg = "List Shortlet";
        return view('admin.create-shortlet', ['pg'=>$pg]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Shortlet $shortlet)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Shortlet $shortlet)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Shortlet $shortlet)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Shortlet $shortlet)
    {
        //
    }
}
