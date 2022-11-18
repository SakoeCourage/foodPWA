<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AddDish as Dish;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic as Image;
use Carbon\Carbon;
use Illuminate\Support\Str;
use App\Models\Procedures;
use App\Models\Ingredients;


class AddDishController extends Controller
{
   
    public function index( ){
        $dish = Dish::Query();
        return 
           $dish->filter(request(['search','sort','dishType','difficulty']))
            ->with(['user:id,name','dishtype'])
            ->latest()
            ->paginate(4)
            ->withQueryString();
    }

    public function getFeaturedDish(Dish $dish){
        return $dish->with('user:id,name')->first();
    }
   
    public function getdishbyslug($slug){
        
        return ([
            'post' => Dish::with(['procedure', 'ingredient'])-> where('slug',$slug)->firstOrFail(),
            'favoritesCount' => Dish::where('slug',$slug)->firstOrFail()->favoriters()->count()
        ]);
    }

    public  function storeimage($imagefile, $dishname)
    {
        $date = Carbon::now();
        $image    = $imagefile;
        $newfilename =  $dishname . time();
        $newfilename = preg_replace('/\s+/', '_', $newfilename);
        $filename = $newfilename . '.' . $image->getClientOriginalExtension();
        $mypath = 'public/images/foodthumbnails/' . $date->year . '/' . $date->monthName;
        if (!Storage::exists($mypath)) {
            Storage::makeDirectory($mypath, 0775, true, true);
        }
        $image_resize = Image::make($image->getRealPath());
        $image_resize->resize(400, 400, function ($constraint) {
		    $constraint->aspectRatio();
		});
        
        $image_resize->save(public_path('storage/images/foodthumbnails/' . $date->year . '/' . $date->monthName . '/' .$filename));
        
        return ($filename);
    }


    public function createDish(Request $request){
       
        $request->validate([
            'dishname'=>'required|string|max:255',
            'ingredients' => 'required',
            'image' => 'required|image|mimes:tiff,jpeg,jpg,png|max:4048',
            'procedures' => 'required',
            'difficultyLevel' => 'required|string|max:255',
            'dishtypeid' => 'required|integer'
        ]);  
        // Creating new dish 
        $createdish = Dish::Create([
            'user_id'=>Auth()->user()->id,
            'dishname' =>$request->dishname,
            'difficulty' =>$request->difficultyLevel,
            'dishtype_id'=>$request->dishtypeid, 
            'image' =>  $this->storeimage($request->image,$request->dishname)  
        ]);
        //Adding newly created dish procedure to procedures table
        $procedures = $request->procedures;
        $procedures = Str::of($procedures)->explode(',');
        $procedures->each(function($value,$key)use($createdish){
            if($value !=""){
                Procedures::Create([
                    'add_dish_id' => $createdish->id,
                    'index' => $key + 1,
                    'procedure' => $value
                ]);
            }
       });
       //Adding newly created dish ingredients to ingredients table
       $ingredient = $request->ingredients;
       $ingredient = json_decode($ingredient);
       $ingredient= collect($ingredient);
       $ingredient->each(function($value,$key)use($createdish){
           Ingredients::Create([
                  'add_dish_id' => $createdish->id,
                  'name' => $value->ingredient,
                  'important' => $value->majoringredient
              ]);
          
         });
        return response("done",200);   

    }
    
}
