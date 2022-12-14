<?php

namespace App\Http\Controllers;

use PhpOption\None;
use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ListingController extends Controller
{
    //Show all listings
    public function index() {
        return view('listings.index', [
            "listings" => Listing::latest()->filter(request(['tag', 'search']))->paginate(4)
        ]);

    }

    //Show individual listing
    public function show(Listing $listing) {
        return view('listings.show', [
            'listing' => $listing
        ]);
    }

    //create a show/job listing
    public function create() {
        return view('listings.create');
    }

    //Store form data
    public function store(Request $request) {
        // dd($request->file('logo'));
        $formFields = $request->validate([
            'title' => 'required',
            'company' => ['required', Rule::unique('listings', 'company')],
            'location' => ['required'],
            'website' => 'required',
            'email' => ['required', 'email'],
            'tags' => 'required',
            'description' => 'required'
        ]);
        if($request->hasFile('logo')) {
            $formFields['logo'] = $request->file('logo')->store('logos', 'public');
        }

        // Add user_id field to form
        $formFields['user_id'] = auth()->id();
        
        Listing::create($formFields);
        return redirect('/')->with('message', 'The listing has been successfully created.');
    }

    // Show Edit Form
    public function edit(Listing $listing) {
        return view('listings.edit', ['listing' => $listing]);
    }

    //Update form data
    public function update(Request $request, Listing $listing) {
        // dd($request->file('logo'));
        $formFields = $request->validate([
            'title' => 'required',
            'company' => 'required',
            'location' => ['required'],
            'website' => 'required',
            'email' => ['required', 'email'],
            'tags' => 'required',
            'description' => 'required'
        ]);
        if($request->hasFile('logo')) {
            $formFields['logo'] = $request->file('logo')->store('logos', 'public');
        }
        
        $listing->update($formFields);
        return back()->with('message', 'Update successful!');
        // return redirect('/')->with('message', 'The listing has been successfully created.');
    }

    public function destroy(Listing $listing) {
        $listing->delete();

        return redirect('/')->with('message', 'The listing has been successfully deleted.');
    }
}