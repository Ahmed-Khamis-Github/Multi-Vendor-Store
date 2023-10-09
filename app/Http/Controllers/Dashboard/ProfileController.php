<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\Intl\Countries;
use Symfony\Component\Intl\Locales;



class ProfileController extends Controller
{
    public function edit() {
        $user= Auth::user() ;
        $countries = Countries::getNames() ;
        $locales = Locales::getNames();



        return view('dashboard.profiles.edit',compact('user','countries','locales')) ;

    }


    public function update(ProfileUpdateRequest $request){

        $user= Auth::user() ;
        $profile =$user->profile ;
        $profile->fill($request->all())->save() ;
        return redirect()->route('dashboard.profile.edit')->with('success','Profile Updated') ;
    }
}
