<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Support\Carbon;

class StackPostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Note
        //Next target to get accepted answer or top voted answer for all these posts,
        // may be questions most recent and top voted will be better
        try {
            $fp = fopen('questions-15.csv', 'wb');
            $i = 0;
            $client = new Client();

            $response = $client->get('https://api.stackexchange.com/2.2/questions?site=fitness&key=Gja2ijG6qGFPpdRJe0fK8A((&pagesize=50&page=15&q=[stretching]OR[warm-up]OR[martial-arts]OR[flexibility]&sort=activity&order=desc&min=2&is_answered=True&accepted=True');
        
            //For questions also put condition to get good questions based on upvotes
            if ($response->getStatusCode() == 200) {
                foreach (json_decode($response->getBody())->items as $question) {
                    if ($question->answer_count > 0) {
                    $questions = [];
                    $questions['question_id'] = $question->question_id;
                    $questions['title'] = $question->title;

                   $answerResponse = $client->get('https://api.stackexchange.com/2.2/questions/' . $question->question_id . '/answers/?site=fitness&key=Gja2ijG6qGFPpdRJe0fK8A((&is_accepted=True');

                   foreach (json_decode($answerResponse->getBody())->items as $answerId ) {
                       if ($answerId->is_accepted == true || $answerId->score > 0) {
                           $answerBodyResponse = $client->get('https://api.stackexchange.com/2.2/answers/' . $answerId->answer_id . '?&site=fitness&key=Gja2ijG6qGFPpdRJe0fK8A((&is_accepted=True&filter=withbody');

                        foreach (json_decode($answerBodyResponse->getBody())->items as $item) {
                                $questions['answer'] = strip_tags($item->body);
                            }
        
                       }
                   }

                    if( $i === 0 ) {
                        fputcsv($fp, array_keys($questions) ); // First write the headers
                    }
                
                    fputcsv($fp, $questions); // Then write the fields
                
                    $i++;
                }
                }
                fclose($fp);
                
            }
        } catch(RequestException $e) {
            dd($e);
        }
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
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
}
