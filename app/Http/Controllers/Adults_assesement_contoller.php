<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\assement_guide_childern;
use App\Models\assement_guide_answer;
use Illuminate\Support\Facades\Validator;
class Adults_assesement_contoller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $listofquestions=assement_guide_childern::where('for_whome',1)->get();
        $listofanswers=assement_guide_answer::where('for_whome',1)->get();

        //dd($listofanswers);
        


        return view('assement_guide_adults',compact('listofquestions','listofanswers'));

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
           
        $validators=Validator::make($request->all(),[
            'questionType'=>'required',
            'Questions'=>'required|string',
        ]);

        if ($validators->fails()) {
            return redirect()->back()
                ->withErrors($validators)
                ->withInput();
        }

       $addQuestions=assement_guide_childern::create([
        'section_name'=>$request->questionType,
        'Q1'=>$request->Questions,
        'for_whome'=>1 // for kids
       ]);

       if ($addQuestions) {
                return back()->with('success', 'Question added successfully!');
            }




    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


    public function viewAdultsAssesement(){
        $listofanswers=assement_guide_answer::with('users')->where('for_whome',1)->get();
        
        // dd($listofanswers);

        return view('assement_result_adults',compact('listofanswers'));
    }

    public function display($id)
    {
        $listofanswers=assement_guide_answer::with('users')->where('id',$id)->get();
        
        // dd($listofanswers);

        return view('assement_guide_adults_response',compact('listofanswers'));
        
    }
}
