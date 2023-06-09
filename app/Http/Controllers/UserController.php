<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\User;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image as Images;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::id()){
            $products = Product::all();
            $categories = Category::withCount('product')->get();
            $user = auth()->user();
            $cartItem = Cart::where('user_id', $user->id)->sum('quantity');
            return view('store.profile.index', compact('products', 'categories', 'cartItem'));
        }else{
            $products = Product::all();
            $categories = Category::withCount('product')->get();
            $user = auth()->user();
            return view('store.contact', compact('products', 'categories'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        if(Auth::id()){
            $products = Product::all();
            $categories = Category::withCount('product')->get();
            $user = auth()->user();
            $cartItem = Cart::where('user_id', $user->id)->sum('quantity');
            return view('store.profile.edit', compact('products', 'categories', 'cartItem','user'));
        }else{
            $products = Product::all();
            $categories = Category::withCount('product')->get();
            $user = auth()->user();
            return view('store.contact', compact('products', 'categories'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $rules = [
            'name' => 'required|max:255',
            'username' => 'required',
            'image' =>'image|file|max:1024',
            'email' => 'required',
        ];

        $validateData = $request->validate($rules);

        if ($request->file('image')) {
            if ($request->oldImage) {
                Storage::delete($request->oldImage);
            }
            $validateData['image'] = $request->file('image')->store('photo-profile');         
        }

        User::where('id', auth()->user()->id)
            ->update($validateData);
        return redirect('/profile')->with('success', 'Profile Succesful Update');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        if (auth()->user()->image) {
            Storage::delete(auth()->user()->image);
        }
        User::destroy(auth()->user()->id);
        Auth::logout();
        return redirect('/')->with('success','Account Successfull Delete');
    }
}
