<?php


namespace App\Http\Controllers\Backend\Information;


use App\Http\Controllers\Controller;
use App\Models\Information;
use Illuminate\Http\Request;

class InformationController extends Controller
{
    public function getInformation()
    {
        $blogs = Information::orderBy('id','DESC')->get();
        return view('backend.information.index')->with('blogs', $blogs);
    }

    public function getInformationAdd()
    {
        $categories = Information::all();
        return view('backend.information.add')->with('categories', $categories);
    }

    public function getInformationEdit($blogId)
    {
        $blog = Information::where('id',$blogId)->first();
        return view('backend.information.edit')->with('blog',$blog);
    }

    public function postInformation(Request $request){

        if(isset($request->delete)){
            try {
                Information::where('id', $request->id)->delete();
                return response(['status' => 'success', 'title' => 'Thành công', 'content' => 'Thành công']);
            } catch (\Exception $e) {
                return response(['status' => 'success', 'title' => 'Thất bại', 'content' => 'Thất bại']);
            }
        }
    }

    public function postInformationAdd(Request $request){
        try {
            Information::create($request->all());
            return response(['status' => 'success', 'title' => 'Thành công', 'content' => 'Thành công']);
        } catch (\Exception $e) {
            return response(['status' => 'error', 'title' => 'Thất bại', 'content' => 'Thất bại']);
        }
    }

    public function postInformationEdit(Request $request, $pageId){
        try {
            $pages =  Information::where('id',$pageId)->first();
            Information::where('id',$pageId)->update([
                'title' => $request->title,
                'value'=> $request->value,
            ]);

            return response(['status' => 'success', 'title' => 'Thành công', 'content' => 'Thành công ']);
        } catch (\Exception $e) {
            return response(['status' => 'error', 'title' => 'Thất bại', 'content' => 'SThất bại']);
        }
    }
}
