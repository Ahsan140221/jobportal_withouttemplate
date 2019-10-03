<?php

namespace App\Http\Controllers;

use App\Company;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    public function __construct()
    {
        $this->middleware(['employer', 'verified'], ['except' => array('index')]);
    }
    public function index($id, Company $name)
    {
        return view('company.index', compact('name'));
    }

    public function create()
    {
        return view('company.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'address' => 'required',
            'phone' => 'required|min:11|numeric',
            'website' => 'required',
            'slogan' => 'required|min:10',
            'description' => 'required|min:20'
        ]);
        $user_id = auth()->user()->id;
        Company::where('user_id', $user_id)->update([
            'address' => request('address'),
            'phone' => request('phone'),
            'website' => request('website'),
            'slogan' => request('slogan'),
            'description' => request('description')
        ]);
        return redirect()->back()->with('message', 'Company Information Updated Successfully');
    }

    public function coverphoto(Request $request)
    {
        $this->validate($request, [
            'cover_photo' => 'required|mimes:png,jpeg,jpg|max:20000'
        ]);
        $user_id = auth()->user()->id;
        if ($request->hasFile('cover_photo')) {
            $file = $request->file('cover_photo');
            $et = $file->getClientOriginalExtension();
            $filename = time() . '.' . $et;
            $file->move('uploads/cover/', $filename);
            Company::where('user_id', $user_id)->update([
                'cover_photo' => $filename
            ]);
            return redirect()->back()->with('message', 'CoverPhoto Updated successfully');
        }
    }

    public function logo(Request $request)
    {
        $this->validate($request, [
            'logo' => 'required|mimes:png,jpeg,jpg|max:20000'
        ]);
        $user_id = auth()->user()->id;
        if ($request->hasFile('logo')) {
            $file = $request->file('logo');
            $et = $file->getClientOriginalExtension();
            $filename = time() . '.' . $et;
            $file->move('uploads/logo/', $filename);
            Company::where('user_id', $user_id)->update([
                'logo' => $filename
            ]);
            return redirect()->back()->with('message', 'Company Logo Updated successfully');
        }
    }
}
