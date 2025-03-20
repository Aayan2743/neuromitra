<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\assement_guide_childern;
use App\Models\assement_guide_answer;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Response;

class KidsAssementController extends Controller
{
    //

    public function list(){

        // $listofQuestion=assement_guide_childern::get();

        $listofQuestion = assement_guide_childern::where('for_whome',0)->orderBy('section_name')
                  ->orderBy('id')
                  ->get()
                  ->groupBy('section_name');

            

        return response()->json([
            'status'=>true,
            'data'=>$listofQuestion
        ]);

    }

    public function list_for_adults(){

        // $listofQuestion=assement_guide_childern::get();

        $listofQuestion = assement_guide_childern::where('for_whome',1)->orderBy('section_name')
                  ->orderBy('id')
                  ->get()
                  ->groupBy('section_name');

            

        return response()->json([
            'status'=>true,
            'data'=>$listofQuestion
        ]);

    }


    public function store(Request $request){

        $validator = Validator::make($request->all(), [
            // 'Question_id' => 'required',
            // 'Question' => 'required|string',
            // 'Question_section' => 'required|string',
            // 'answer' => 'required|string',
            'data' => 'required',
            'role' => 'required|in:0,1',


        ],[
           
            'role.in'=>'Role shoule be 0 for Kids and 1 for Adults ',
        ]);
    
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                
                'message' => $validator->errors()->first(),
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $user_id=Auth('api')->user()->id;

        //dd($request->role);

        if($request->role==0) //  for kids calucation
        {
            $data = json_decode($request->data, true);
            $scoreMap = [
                "No" => 0,
                "Sometimes" => 1,
                "Yes" => 2
            ];
            $categoryScores = [];
                $totalScore = 0;
    
                // Iterate over answers and calculate score per category
                foreach ($data['answers'] as $category => $questions) {
                    $categoryScores[$category] = 0;
                    foreach ($questions as $question) {
                        $answer = $question['answer'];
                        if (isset($scoreMap[$answer])) {
                            $categoryScores[$category] += $scoreMap[$answer];
                            $totalScore += $scoreMap[$answer]; // Add to total score
                        }
                    }
                }
                // Include total score in the output
                $categoryScores["Total Score"] = $totalScore;
    
                // Convert to JSON
                $score_for_kids = json_encode($categoryScores, JSON_PRETTY_PRINT);

                $saveanswers=assement_guide_answer::create([
                    'user_id'=>$user_id,
                    // 'Question_id'=>$request->Question_id,
                    // 'Question'=>$request->Question,
                    // 'Question_section'=>$request->Question_section,
                    // 'answer'=>$request->answer,
                    'data' => $request->data,
                    'for_whome' => $request->role,
                    'score' => $score_for_kids
                ]);
        
                if($saveanswers){
                    return response()->json([
                        'status'=>true,
                        'message'=>'added',
                        'result'=>$score_for_kids,
                        'role'=> $request->role,
                    ]);
                }


        }else{
            // for adults

            $data = json_decode($request->data, true);
            $scoreMap = [
                "Strongly Disagree" => 1,
                "Disagree" => 2,
                "Neutral" => 3,
                "Agree" => 4,
                "Strongly Agree" => 5
            ];
            $categoryScores = [];
                $totalScore = 0;
    
                // Iterate over answers and calculate score per category
                foreach ($data['answers'] as $category => $questions) {
                    $categoryScores[$category] = 0;
                    foreach ($questions as $question) {
                        $answer = $question['answer'];
                        if (isset($scoreMap[$answer])) {
                            $categoryScores[$category] += $scoreMap[$answer];
                            $totalScore += $scoreMap[$answer]; // Add to total score
                        }
                    }
                }
                // Include total score in the output
                $categoryScores["Total Score"] = $totalScore;
    
                // Convert to JSON
                $score_for_adults = json_encode($categoryScores, JSON_PRETTY_PRINT);

               // dd($score_for_adults);

                $saveanswers=assement_guide_answer::create([
                    'user_id'=>$user_id,
                    // 'Question_id'=>$request->Question_id,
                    // 'Question'=>$request->Question,
                    // 'Question_section'=>$request->Question_section,
                    // 'answer'=>$request->answer,
                    'data' => $request->data,
                    'for_whome' => $request->role,
                    'score' => $score_for_adults
                ]);
        
                if($saveanswers){
                    return response()->json([
                        'status'=>true,
                        'message'=>'added',
                        'result'=>$score_for_adults,
                        'role'=> $request->role,
                    ]);
                }



        }
      

            // Print JSON output
            // echo $jsonOutput;





       
       


    }

}
