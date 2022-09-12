<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Skill;
use Illuminate\Http\Request;

class SkillController extends Controller
{
    public function skill(){
        $skills = Skill::get();
        return view('admin.skill.index',compact('skills'));
    }

    public function skillAddForm(){
        return view('admin.skill.add');
    }

    public function skillStore(Request $request){
        $validatedData = $request->validate([
            'skill' => 'required',
        ]);

        $skillStore = new Skill();
        $skillStore->skill = $request->skill;
        $skillStore->save();
        return redirect()->route('admin.skill')->with('success','Skill Created Successfully.!');
        
    }

    public function skillEditForm($id){
        $skillEditForm = Skill::find($id);
        return view('admin.skill.edit',compact('skillEditForm'));
    }

    public function skillUpdate(Request $request){
        $skillStore =  Skill::find($request->id);
        $skillStore->skill = $request->skill;
        $skillStore->save();
        return redirect()->route('admin.skill')->with('success','Skill Updated Successfully.!');
    }

    public function skillDelete($id){
        $skillDelete = Skill::find($id)->delete();
        return redirect()->route('admin.skill')->with('delete','Skill Deleted Successfully.!');

    }
}
