<?php

namespace App\Http\Controllers;

use App\Models\Config;
use Illuminate\Http\Request;

class ConfigsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $configs = Config::get();
        return view("configs.index",compact("configs"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("configs.edit");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $this->validate($request, [
            'title' => 'bail|required|string|max:1000',
            'answer' => 'bail|required|string',
        ]);
     
        $possibility = json_encode([
            'a'=>$request->possibilityA,
            'b'=>$request->possibilityB,
            'c'=>$request->possibilityC,
            'd'=>$request->possibilityD]);

        Config::create([
            "title" => $request->title,
            "possibility" => $possibility,
            "answer" => $request->answer,
        ]);
    
        $configs = Config::get();
        return view("configs.index",compact("configs"));
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        // 
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Config $config)
    {
        return view('configs.edit', compact("config"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Config $config)
    {   
        $this->validate($request, [
            'title' => 'bail|required|string|max:1000',
            'answer' => 'bail|required|string',
        ]);
     
        $possibility = json_encode([
            'a'=>$request->possibilityA,
            'b'=>$request->possibilityB,
            'c'=>$request->possibilityC,
            'd'=>$request->possibilityD]);

        $config->update([
            "title" => $request->title,
            "possibility" => $possibility,
            "answer" => $request->answer,
        ]);
        $configs = Config::get();
        return view("configs.index",compact("configs"));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Config $config)
    {
        $config->delete();

        return redirect(route('configs.index'));
    }
}
