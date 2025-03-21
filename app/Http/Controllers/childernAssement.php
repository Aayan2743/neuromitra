<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\assement_guide_childern;
use App\Models\assement_guide_answer;
use Illuminate\Support\Facades\Validator;

class childernAssement extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

        $listofquestions=assement_guide_childern::where('for_whome',0)->get();
        $listofanswers=assement_guide_answer::with('users')->where('for_whome',0)->get();
        
        // dd($listofanswers);

        return view('assement_guide_childern',compact('listofquestions','listofanswers'));
        
    }


    public function updatequestions($id){
        $listofquestions=assement_guide_childern::where('id',$id)->get();
    //dd($listofquestions);

        return view('assement_guide_childern_edit',compact('listofquestions'));
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
        'for_whome'=>0 // for kids
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
       
        
    }


    public function display($id)
    {
        $listofanswers=assement_guide_answer::with('users')->where('id',$id)->get();
        
        // dd($listofanswers);

        return view('assement_guide_childern_response',compact('listofanswers'));
        
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
    //    dd($id, $request->all()) ;
      

       
        try{

            $record = assement_guide_childern::find($id);
           

            if($record->for_whome==1){
                // for adultes

                if ($record) {
                    if ($record->section_name == $request->questionType && $record->Q1 == $request->Questions) {
                        // return response()->json(['message' => 'No changes detected']);

                        return redirect()->route('create_assesement_for_adults.index')->with('error', 'No changes detected');
                    }

                    $update = $record->update([
                        'section_name' => $request->questionType,
                        'Q1' => $request->Questions,
                    ]);

                    if ($update) {
                        return redirect()->route('create_assesement_for_adults.index')->with('success', 'Record updated successfully');
                    } else {
                        return redirect()->route('create_assesement_for_adults.index')->with('error', 'No changes were made');
                    }
                }
                return redirect()->route('create_assesement_for_adults.index')->with('error', 'Record not found');
                // return response()->json(['error' => 'Record not found'], 404);

            }else if($record->for_whome==0){
                if ($record) {
                    if ($record->section_name == $request->questionType && $record->Q1 == $request->Questions) {
                        // return response()->json(['message' => 'No changes detected']);

                        return redirect()->route('create_assessment.index')->with('error', 'No changes detected');
                    }

                    $update = $record->update([
                        'section_name' => $request->questionType,
                        'Q1' => $request->Questions,
                    ]);

                    if ($update) {
                        return redirect()->route('create_assessment.index')->with('success', 'Record updated successfully');
                    } else {
                        return redirect()->route('create_assessment.index')->with('error', 'No changes were made');
                    }
                }
                return redirect()->route('create_assessment.index')->with('error', 'Record not found');
                // return response()->json(['error' => 'Record not found'], 404);


            }


                


        }catch(Exception $e){
            return response()->json([
                'status'=>false,
                'message'=>$e->getMessage()
            ]);
        }

       
    
    
    
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

     

        $therapist = assement_guide_childern::find($id);
        if (!$therapist) {
            return response()->json(['success' => false, 'message' => 'Question not found.']);
        }
    
        if ($therapist->delete()) {
            return response()->json(['success' => true, 'message' => 'Question deleted successfully.']);
        } else {
            return response()->json(['success' => false, 'message' => 'Failed to delete Question.']);
        }


    }

    public function viewChildAssesement(){
        $listofanswers=assement_guide_answer::with('users')->where('for_whome',0)->get();
        
        // dd($listofanswers);

        return view('assement_result_kids',compact('listofanswers'));
       
    }

    
}
