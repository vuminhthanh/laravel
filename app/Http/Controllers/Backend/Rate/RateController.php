<?php


namespace App\Http\Controllers\Backend\Rate;


use App\Http\Controllers\Controller;
use App\Models\Information;
use App\Models\Rate;
use App\Models\Sliders;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class RateController extends Controller
{
    public function getRate()
    {
        $Rate = Rate::all();
        return view('backend.rate.index')->with('blogs', $Rate);
    }

    public function getRateAdd()
    {
        return view('backend.rate.add');
    }

    public function getRateEdit($sliderId)
    {
        $Rate = Rate::where('id',$sliderId)->first();
        if (!$Rate){
            return 'k ton tai';
        }
        return view('backend.rate.edit')->with('blog',$Rate);
    }


    public function postRate(Request $request)
    {
        if (isset($request->delete)) {
            try {
                $Rate =  Rate::where('id',$request->id)->first();
                File::delete(public_path($Rate->image_link));
                Rate::where('id', $request->id)->delete();
                return response(['status' => 'success', 'title' => 'Thành công', 'content' => 'Slider Thành công']);
            } catch (\Exception $e) {
                return response(['status' => 'error', 'title' => 'Thất bại', 'content' => 'Thất bại']);
            }
        }
    }

    public function postRateAdd(Request $request)
    {
            $date = Str::slug(Carbon::now());
            $imageName = Str::slug($request->title) . '-' . $date;
            Image::make($request->file('image'))->save(public_path('/uploads/rate/') . $imageName . '.jpg')->encode('jpg', '50');
            $request->merge(['image_link' => '/uploads/rate/' . $imageName . '.jpg']);
            Rate::create($request->all());
            return response(['status' => 'success', 'title' => 'Thành công', 'content' => 'Thành công']);
    }

    public function postRateEdit(Request $request,$rateId)
    {
        try {
            $Rate =  Rate::where('id',$rateId)->first();
            if ($request->hasFile('image_link')){
                File::delete(public_path($Rate->image_link));
                $date = Str::slug(Carbon::now());
                $imageName = Str::slug($request->title) . '-' . $date;
                Image::make($request->file('image_link'))->save(public_path('/uploads/rate/') . $imageName . '.jpg')->encode('jpg','50');
            }

            Rate::where('id',$rateId)->update([
                'title' => $request->title,
                'image_link'=> $request->hasFile('image_link') ? '/uploads/rate/' . $imageName . '.jpg' : $Rate->image_link,
                'comment' => $request->comment,
            ]);

            return response(['status' => 'success', 'title' => 'Thành công', 'content' => 'Thành công ']);
        } catch (\Exception $e) {
            return response(['status' => 'error', 'title' => 'Thất bại', 'content' => 'Thất bại']);
        }
    }
}
