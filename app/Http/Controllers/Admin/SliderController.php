<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Slider;
use App\Language;
use DB;
class SliderController extends Controller {
  
    public function index() {
        $i = 1;
        $sliders = Slider::orderBy( 'id', 'DESC' )->get();
        $countAll = Slider::count();
        $countActive = Slider::where( 'status', 0 )->count();
        $countUnactive = Slider::where( 'status', 1 )->count();
        return view( 'admin.slider.index', compact( 'i','sliders','countAll','countActive','countUnactive' ) );
    }

    public function create() {
        $lang = Language::orderBy( 'id', 'DESC' )->get();
        return view( 'admin.slider.create', compact('lang') );
    }

    public function store( Request $request ) {
        // Start Rules & Messages
        $rules = [
            'title' => 'required|unique:sliders',
            'description' => 'required',
            'lang_code' => 'required',
            'photo' => 'required|mimes:jpeg,png,jpg|dimensions:min_width=1000,max_width=2000',
        ];
        $messages = [
            'title.required' => 'The slider title failed is required',
            'description.required' => 'The slider description failed is required',
            'lang_code.required' => 'The Language failed is required',
            'photo.required' => 'The slider photo is required',
            'photo.dimensions' => 'The slider photo dimensions must between (1000px ~ 2000px)',
            'photo.mimes' => 'The slider photo mimes must between (jpeg,png,jpg)',
        ];

        // Start Validate Data
        $validate = Validator::make( $request->all(), $rules, $messages );

        // Check The Validate 
        if ( $validate->fails() ) {
            return redirect()->back()->withErrors( $validate )->withInput();
        } else {
            // Start Try & Catch
            try {
                // Start Insert Items
                $slider = new Slider();
                $slider->title = $request->title;
                $slider->description = $request->description;
                $slider->lang_code = $request->lang_code;
                // Set New File Name & Check if This Exist Or No
                if ( $file = $request->file( 'photo' ) ) {
                    $file_name = $file->GetClientOriginalName();
                    $file_ext = $file->GetClientOriginalExtension();
                    $file_to_store = time() . '.' . $file_ext;
                    $path = 'uploads/slider/';
                    $file->move( $path, $file_to_store );
                    $slider->photo = $path . $file_to_store;
                }
                $slider->save();
                session()->flash( 'success', 'Record has been successfully added.' );
                return redirect()->back();

            } catch( \Exception $ex ) {
                 // Redirect Back If has any error
                session()->flash( 'error', 'Ops:(, something is wrong. ' );
                return redirect()->back();
            }
            // End Try & Catch
        }
    }

   
    public function show( $id ) {
        $slider = Slider::where('id','=',$id)->with('language')->first();
        return view( 'admin.slider.show', compact( 'slider') );
    }


    public function edit( $id ) {
        $lang = Language::orderBy( 'id', 'DESC' )->get();
        $slider = Slider::findOrFail($id);
        return view( 'admin.slider.edit', compact('lang', 'slider') );
    }

   

    public function update( Request $request, $id ) {
        // Start Rules & Messages
        $rules = [
            'title' => 'required',
            'description' => 'required',
            'lang_code' => 'required',
            'photo' => 'mimes:jpeg,png,jpg|dimensions:min_width=1000,max_width=2000',
        ];
        $messages = [
            'title.required' => 'The slider title failed is required',
            'description.required' => 'The slider description failed is required',
            'lang_code.required' => 'The Language failed is required',
            // 'photo.required' => 'The slider photo is required',
            'photo.dimensions' => 'The slider photo dimensions must between (1000px ~ 2000px)',
            'photo.mimes' => 'The slider photo mimes must between (jpeg,png,jpg)',
        ];

        // Start Validate Data
        $validate = Validator::make( $request->all(), $rules, $messages );

        // Check The Validate 
        if ( $validate->fails() ) {
            return redirect()->back()->withErrors( $validate )->withInput();
        } else {
            // Start Try & Catch
            try {
                // Start Insert Items
                $slider =  Slider::find($id);
                $slider->title = $request->title;
                $slider->description = $request->description;
                $slider->lang_code = $request->lang_code;
                // Set New File Name & Check if This Exist Or No
                if ( $file = $request->file( 'photo' ) ) {
                    // Delete The Old Image
                    $deleteFile = \File::delete($slider->photo);
                    if ($deleteFile) {
                        $file_name = $file->GetClientOriginalName();
                        $file_ext = $file->GetClientOriginalExtension();
                        $file_to_store = time() . '.' . $file_ext;
                        $path = 'uploads/slider/';
                        $file->move( $path, $file_to_store );
                        $slider->photo = $path . $file_to_store;
                    }
                }
                $slider->save();
                
                session()->flash( 'success', 'Record has been successfully updated.' );
                return redirect()->back();

            } catch( \Exception $ex ) {
                 // Redirect Back If has any error
                session()->flash( 'error', 'Ops:(, something is wrong. ' );
                return redirect()->back();
            }
            // End Try & Catch
        }
    }

  
    public function destroy(  $id ) {
        
         try {
            DB::table( 'sliders' )
            ->where( 'id', '=', $id )
            ->delete();
            session()->flash( 'success', 'Deleted successfully' );
            return redirect()->back();
        } catch ( \Exception $ex ) {
            session()->flash( 'error', 'Ops:(, Delete failed please try again.' );
            return redirect()->back();
        }
    }
    public function active( $id ) {
        try {
            DB::table( 'sliders' )
            ->where( 'id', '=', $id )
            ->update( ['status' => 0] );
            session()->flash( 'success', 'Active successfully' );
            return redirect()->back();
        } catch ( \Exception $ex ) {
            session()->flash( 'error', 'Ops:(, Delete failed please try again.' );
            return redirect()->back();
        }
    }

    public function unactive( $id ) {
        try {
            DB::table( 'sliders' )
            ->where( 'id', '=', $id )
            ->update( ['status' => 1] );
            session()->flash( 'success', 'Unactive successfully' );
            return redirect()->back();
        } catch ( \Exception $ex ) {
            session()->flash( 'error', 'Ops:(, Unactive failed please try again.' );
            return redirect()->back();
        }
    }
}
