<?php


namespace App\Http\Controllers\Backend\Questions;


use App\Http\Controllers\Controller;
use App\Models\Pages;
use App\Models\Question;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class QuestionController extends Controller
{
    public function getQuestion()
    {
        $blogs = Question::orderBy('id','DESC')->get();
        return view('backend.question.index')->with('blogs', $blogs);
    }

    public function getQuestionAdd()
    {
        $categories = Question::all();
        return view('backend.question.add')->with('categories', $categories);
    }

    public function getQuestionEdit($blogId)
    {
        $blog = Question::where('id',$blogId)->first();
        return view('backend.question.edit')->with('blog',$blog);
    }

    public function postQuestion(Request $request){

        if(isset($request->delete)){
            try {
                Question::where('id', $request->id)->delete();
                return response(['status' => 'success', 'title' => 'Thành công', 'content' => 'Thành công']);
            } catch (\Exception $e) {
                return response(['status' => 'success', 'title' => 'Thất bại', 'content' => 'Thất bại']);
            }
        }
    }

    public function postQuestionAdd(Request $request){
        try {
            Question::create($request->all());
            return response(['status' => 'success', 'title' => 'Thành công', 'content' => 'Thành công']);
        } catch (\Exception $e) {
            return response(['status' => 'error', 'title' => 'Thất bại', 'content' => 'Thất bại']);
        }
    }

    public function postQuestionEdit(Request $request, $pageId){
        try {
            $pages =  Question::where('id',$pageId)->first();
            Question::where('id',$pageId)->update([
                'title' => $request->title,
                'value'=> $request->value,
            ]);

            return response(['status' => 'success', 'title' => 'Thành công', 'content' => 'Thành công ']);
        } catch (\Exception $e) {
            return response(['status' => 'error', 'title' => 'Thất bại', 'content' => 'SThất bại']);
        }
    }
}
