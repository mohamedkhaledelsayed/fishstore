<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Page;

class SettingsController extends Controller
{
    public function index()
    {
        $setting = Page::get()->first();
        return view('dashboard.settings.index',compact('setting'));

    }
    public function update(Request $request,Page $page)
    {
        $data  = [];    
        foreach (config('translatable.locales') as $one_lang) {
            $data += [$one_lang . '.text' => 'required'];
        }
        $data += [
            'phone_number' =>'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'link'=>'required|url',
            'linkyoutube'=>'required|url',
            'linkmap'=>'required|url',

        ];
         $validatedData = $request->validate($data);
        $page->update($validatedData);
        return redirect()->route('settings.index')->with('success',__('admin.updated'));
    }
}
