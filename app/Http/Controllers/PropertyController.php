<?php

namespace App\Http\Controllers;

use App\Models\Property;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class PropertyController extends Controller
{

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'title' => ['required', 'string', 'max:255', 'unique:properties'],
            'size' => ['required', 'string', 'max:255'],
            'price' => ['required', 'array'],
            'price.*.amount' => ['integer'],
            'price.*.descprice' => ['string', "max:255"],
            'plan' => ['required', 'array'],
            'plan.*.icon' => ['string'],
            'plan.*.descplan' => ['string', "max:255"],
            'location' => ['required', "max:255", 'regex:/^[-+]?\d+(\.\d+)?,\s*[-+]?\d+(\.\d+)?$/'],
            'loctext' => ['required','string'],
            'document' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'type' => ['required', 'in:Sale,Rent'],
            'link' => ['required', 'string', "max:255"],
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
            'price.*.descprice' => ['string', "max:255"],
            'plan' => ['required', 'array'],
            'plan.*.icon' => ['string'],
            'plan.*.descplan' => ['string', "max:255"],
            'location' => ['required', "max:255", 'regex:/^[-+]?\d+(\.\d+)?,\s*[-+]?\d+(\.\d+)?$/'],
            'loctext' => ['required','string'],
            'document' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'type' => ['required', 'in:Sale,Rent'],
            'link' => ['required', 'string', "max:255"],
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
        $pg = "Property Listings";
        $list = Property::get();

        if ($request->expectsJson()) {
            return response()->json([$list], 200);
        }
        return view('admin.manage-property', ['pg'=>$pg, 'list'=>$list]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $pg = "List Property";
        return view('admin.create-property', ['pg'=>$pg]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = $this->validator($request->all());

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $cr = new Property();
        $cr->title          = $request->title;
        $cr->size           = $request->size;
        $cr->slug           = Str::slug($request->title);
        $cr->price          = $request->price;
        $cr->sold           = 0;
        $cr->status         = 1;
        $cr->type           = $request->type;
        $cr->link           = $request->link;
        $cr->document       = $request->document;
        $cr->description    = $request->description;
        $cr->loctext        = $request->loctext;
        $cr->uniqId         = Str::random(5);

        $newLoc = explode(",", $request->location);
        $cr->location = json_encode(['lat' => trim($newLoc[0]), 'long' => trim($newLoc[1])]);

        if ($request->hasFile('images')) {
            $imagesName = [];
            
            foreach ($request->images as $image) {
                $imageName = Str::slug(substr($image->getClientOriginalName(), 0, -3)).$cr->uniqId.'.'.$image->getClientOriginalExtension();
                Storage::disk('public')->putFileAs("/images", $image, $imageName);
                $imagesName[] = $imageName;
            }
            $cr->images = json_encode($imagesName);
        }
        
        $featsName = [];
        $expPar = explode(",", $request->features[0]);
        foreach ($expPar as $feature) {
            if (!empty($feature)) {
                $exp = explode("remitttta", $feature);
                $featsName[] = ['name' => $exp[0], 'icon' => $exp[1]];
            }
        }
        $cr->features = json_encode($featsName);

        $priceList = [];
        foreach ($request->price as $p) {
            if (!empty($p)) {
                $priceList[] = ['amount' => $p['amount'], 'description' => $p['descprice']];
            }
        }
        $cr->price = json_encode($priceList);

        $planList = [];
        foreach ($request->plan as $p) {
            if (!empty($p)) {
                $planList[] = ['icon' => $p['icon'], 'description' => $p['descplan']];
            }
        }
        $cr->plan = json_encode($planList);

        // Return success response
        if ($cr->save()) {
            return response()->json(['message' => 'Property listing successful'], 201);
        }
        return response()->json(['error' => 1,'message' => ''], 422);
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Property $property, $slug)
    {
        $property = $property->where("slug", $slug);
        if ($property->exists()) {
            $qr = $property->first();
            if ($request->expectsJson()) {
                return response()->json([$qr], 200);
            }
            return view("property-single", ["prop" => $qr]);
        } else {
            if ($request->expectsJson()) {
                return response()->json(["Error: resource not found"], 404);
            }
            return redirect()->back();
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Property $property, $uniqId)
    {
        $property = $property->where("uniqId", $uniqId);
        if ($property->exists()) {
            $property = $property->first();
        }
        $pg = "Update {$property->title}";
        return view('admin.update-property', ['pg' => $pg, 'prop'=>$property]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Property $property, $uniqId)
    {
        $validator = $this->validatorUpdate($request->all(), $uniqId);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $cr = $property->where("uniqId", $uniqId)->first();
        $cr->title          = $request->title;
        $cr->size           = $request->size;
        $cr->slug           = Str::slug($request->title);
        $cr->price          = $request->price;
        $cr->status         = $request->status;
        $cr->type           = $request->type;
        $cr->link           = $request->link;
        $cr->document       = $request->document;
        $cr->loctext        = $request->loctext;
        $cr->description    = $request->description;

        $newLoc = explode(",", $request->location);
        $cr->location = json_encode(['lat' => trim($newLoc[0]), 'long' => trim($newLoc[1])]);

        $featsName = [];
        $expPar = explode(",", $request->features[0]);
        foreach ($expPar as $feature) {
            if (!empty($feature)) {
                $exp = explode("remitttta", $feature);
                $featsName[] = ['name' => $exp[0], 'icon' => $exp[1]];
            }
        }
        $cr->features = json_encode($featsName);

        $priceList = [];
        foreach ($request->price as $p) {
            if (!empty($p)) {
                $priceList[] = ['amount' => $p['amount'], 'description' => $p['descprice']];
            }
        }
        $cr->price = json_encode($priceList);

        $planList = [];
        foreach ($request->plan as $p) {
            if (!empty($p)) {
                $planList[] = ['icon' => $p['icon'], 'description' => $p['descplan']];
            }
        }
        $cr->plan = json_encode($planList);

        // Return success response
        if ($cr->save()) {
            return response()->json(['message' => 'Property update successful'], 201);
        }
        return response()->json(['error' => 1,'message' => ''], 422);
    }

    public function updateImages(Request $request, Property $property, $uniqId)
    {
        $validator = Validator::make($request->all(["images"]), [
            'images' => ['required', 'array'],
            'images.*' => ['image', 'mimes:jpeg,png,jpg,gif', 'max:1024']
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        if ($request->hasFile('images')) {
            $cr = $property->where("uniqId", $uniqId)->first();
            $imagesName = [];

            $imagesNamePrev = json_decode($cr->images, true);
            
            foreach ($request->images as $image) {
                $rawImageName = $image->getClientOriginalName();
                
                if (in_array($rawImageName, $imagesNamePrev)) {
                    $imageName = $rawImageName;
                }else {
                    $imageName = Str::slug(substr($image->getClientOriginalName(), 0, -3)).$uniqId.'.'.$image->getClientOriginalExtension();
                    if (!in_array($imageName, $imagesNamePrev)) {
                        Storage::disk('public')->putFileAs("/images", $image, $imageName);
                    }
                }
                
                $imagesName[] = $imageName;
            }
            
            $unlinks = array_diff($imagesNamePrev, $imagesName);
            foreach ($unlinks as $imgN) {
                if (Storage::disk('public')->exists("/images/{$imgN}")) {
                    Storage::disk('public')->delete("/images/{$imgN}");
                }
            }

            $cr->images = json_encode($imagesName);
            $cr->save();
            return response()->json(['message' => 'Image upload successful'], 201);
        } else {
            return response()->json(['error' => 1,'message' => 'No file(s) uploaded'], 422);
        }
    }

    public function status(Property $property, string $uniqId) {
        $query = $property->where("uniqId", $uniqId);
        if ($query->exists()) {
            $prop = $query->first();

            $prop->status = $prop->status == 1 ? 0 : 1;
            return $prop->save() ? true : false;
        }
        return false;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Property $property)
    {
        
    }
}