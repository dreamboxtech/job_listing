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
            "listings" => Listing::latest()->filter(request(['tag', 'search']))->get()
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
        $formFields = $request->validate([
            'title' => 'required',
            'company' => ['required', Rule::unique('listings', 'company')],
            'location' => ['required'],
            'website' => 'required',
            'email' => ['required', 'email'],
            'tags' => 'required',
            'description' => 'required',
        ]);
        Listing::create($formFields);
        return redirect('/');
    }
}