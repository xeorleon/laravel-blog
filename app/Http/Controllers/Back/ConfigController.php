<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Models\Config;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class ConfigController extends Controller
{
    public function index(){
        $config = Config::find(1);
        return view('back.config.index',compact('config'));
    }
    public function update(Request $request){
        $config = Config::find(1);
        $config->title = $request->title;
        $config->active = $request->active;
        $config->facebook = $request->facebook;
        $config->twitter = $request->twitter;
        $config->linkedin = $request->linkedin;
        $config->github = $request->github;
        $config->youtube = $request->youtube;
        $config->instagram = $request->instagram;
        if($request->hasFile('logo')){
            if(File::exists($config->logo)){
                File::delete(public_path($config->logo));
            }
            $logo = Str::slug($request->title).'-logo.'.$request->logo->getClientOriginalExtension();
            $request->logo->move(public_path('uploads/config'),$logo);
            $config->logo = 'uploads/config/'.$logo;
        }
        if($request->hasFile('favicon')){
            if(File::exists($config->favicon)){
                File::delete(public_path($config->favicon));
            }
            $favicon = Str::slug($request->title).'-favicon.'.$request->favicon->getClientOriginalExtension();
            $request->favicon->move(public_path('uploads/config'),$favicon);
            $config->favicon = 'uploads/config/'.$favicon;
        }
        $config->save();
        toastr()->success('Güncelleme Başarılı');
        return redirect()->back();
    }
}
