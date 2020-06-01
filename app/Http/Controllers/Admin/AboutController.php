<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Language;
use App\About;
use App\AboutTranslation;
use Carbon;
use DB;

class AboutController extends Controller {

    public function index() {
        $i = 1;
        $data = DB::table( 'abouts' )
        ->join( 'about_translations', 'abouts.id', '=', 'about_translations.about_id' )
        ->select( 'abouts.*', 'about_translations.*' )
        ->orderBy( 'about_translations.lang_code', 'asc' )
        ->get();
        $mainTitle = About::first();
        $lang = Language::orderBy( 'code', 'asc' )->get();
        return view( 'admin.about.index', compact( 'mainTitle', 'i', 'data',  'lang' ) );
    }

    public function create() {
        $lang = Language::orderBy( 'id', 'DESC' )->get();
        return view( 'admin.about.create', compact( 'lang' ) );
    }

    public function store( Request $request ) {

        // Start Rules & Messages
        $rules = [
            'title' => 'required|unique:about_translations|min:3',
            'description' => 'required',
            'lang_code' => 'required',
        ];
        $messages = [
            'title.required' => 'The title failed is required',
            'description.required' => 'The slider description failed is required',
            'lang_code.required' => 'The Language failed is required',
        ];

        // Start Validate Data
        $validate = Validator::make( $request->all(), $rules, $messages );
        // Check The Validate
        if ( $validate->fails() ) {
            return redirect()->back()->withErrors( $validate )->withInput();
        } else {
            // Start Try & Catch
            try {
                $AboutTranslation = new AboutTranslation();
                $AboutTranslation->lang_code = $request->lang_code;
                $AboutTranslation->title = $request->title;
                $AboutTranslation->description = $request->description;
                $AboutTranslation->meta_title = $request->meta_title;
                $AboutTranslation->meta_desc = $request->meta_desc;
                $AboutTranslation->meta_keywords = $request->meta_keywords;
                $AboutTranslation->about_id = $request->about_id;
                $AboutTranslation->save();
                // Will Check If Create is successfully
                // if ( $about ) {

                //  for ( $i = 0; $i < count( $request->title );
                // $i++ ) {
                //     $translateData[] = [
                //         '' => $request->lang_code[$i],
                //         '' => $request->title[$i],
                //         '' => $request->description[$i],
                //         '' => $request->meta_title[$i],
                //         '' => $request->meta_desc[$i],
                //         '' => $request->meta_keywords[$i],
                //         '' => $about->id,
                //         'created_at' => now()->toDateTimeString(),
                //         'updated_at' => now()->toDateTimeString(),
                //     ];

                // }
                // dd( $translateData );
                // AboutTranslation::insert( $translateData );

                // }
                session()->flash( 'success', 'Record has been successfully added.' );
                return redirect()->back();

            } catch( \Exception $ex ) {
                // dd( $ex );
                // Redirect Back If has any error
                session()->flash( 'error', 'Ops:(, something is wrong. ' );
                return redirect()->back();
            }
            // End Try & Catch
        }

    }

    public function storetitle( Request $request ) {
        // Start Rules & Messages
        $rules = [
            // 'main_title' => 'required|min:3|unique:abouts',
            'main_title' => 'required|min:3',
        ];
        $messages = [
            'main_title.required' => 'The title failed is required',
        ];

        // Start Validate Data
        $validate = Validator::make( $request->all(), $rules, $messages );
        // Check The Validate
        if ( $validate->fails() ) {
            return redirect()->back()->withErrors( $validate )->withInput();
        } else {
            // Start Try & Catch
            try {

                $about = About::create( [
                    'main_title'=>$request->main_title
                ] );

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

    public function updatetitle( Request $request, $id ) {
        // Start Rules & Messages
        $rules = [
            // 'main_title' => 'required|min:3|unique:abouts',
            'main_title' => 'required|min:3',
        ];
        $messages = [
            'main_title.required' => 'The title failed is required',
        ];

        // Start Validate Data
        $validate = Validator::make( $request->all(), $rules, $messages );
        // Check The Validate
        if ( $validate->fails() ) {
            return redirect()->back()->withErrors( $validate )->withInput();
        } else {
            // Start Try & Catch
            try {

                $about = About::find( $id );
                $about->main_title = $request->main_title;
                $about->save();
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

    public function update( Request $request, $id ) {
        //  dd( $id );
        $rules = [
            'title' => 'required|min:3|unique:about_translations,id,' . $id,
            'description' => 'required',
            'lang_code' => 'required',
        ];
        $messages = [
            'title.required' => 'The title failed is required',
            'description.required' => 'The slider description failed is required',
            'lang_code.required' => 'The Language failed is required',
        ];

        // Start Validate Data
        $validate = Validator::make( $request->all(), $rules, $messages );
        // Check The Validate
        if ( $validate->fails() ) {
            return redirect()->back()->withErrors( $validate )->withInput();
        } else {
            // Start Try & Catch
            try {
                $AboutTranslation =  AboutTranslation::find( $id );
                $AboutTranslation->lang_code = $request->lang_code;
                $AboutTranslation->title = $request->title;
                $AboutTranslation->description = $request->description;
                $AboutTranslation->meta_title = $request->meta_title;
                $AboutTranslation->meta_desc = $request->meta_desc;
                $AboutTranslation->meta_keywords = $request->meta_keywords;
                $AboutTranslation->about_id = $request->about_id;
                $AboutTranslation->save();

                session()->flash( 'success', 'Record has been successfully updated.' );
                return redirect()->back();

            } catch( \Exception $ex ) {
                // dd( $ex );
                // Redirect Back If has any error
                session()->flash( 'error', 'Ops:(, something is wrong. ' );
                return redirect()->back();
            }
            // End Try & Catch
        }
    }

    public function destroy( $id ) {
        //
    }
}
