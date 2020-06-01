<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Services;
use App\ServicesTranslation;
use App\Language;
use DB;

class ServicesController extends Controller {

    public function index() {
        $i = 1;
        $services = Services::orderBy( 'id', 'DESC' )->with( ['translations'] )->get();
        // $services = DB::table( 'services' )
        // ->join( 'services_translations', 'services.id', '=', 'services_translations.services_id' )
        // ->join( 'languages', 'services_translations.lang_code', '=', 'languages.code' )
        // ->select( 'services.*', 'services_translations.*', 'languages.title as "language_title"' )
        // ->selectRaw( "services_translations.services_id, COUNT('services_translations.*') as user_activitiesCount" )
        // ->groupBy( 'services.main_title' )
        // ->orderBy( 'services_translations.lang_code', 'asc' )
        // ->get();
        // dd( $services );
        $countAll = Services::count();
        $countActive = Services::where( 'status', 0 )->count();
        $countUnactive = Services::where( 'status', 1 )->count();
        return view( 'admin.services.index', compact( 'i', 'services', 'countAll', 'countActive', 'countUnactive' ) );
    }

    public function create() {
        $lang = Language::orderBy( 'id', 'DESC' )->get();
        return view( 'admin.services.create', compact( 'lang' ) );
    }

    public function store( Request $request ) {
        // dd($request->all());
        // Start Rules & Messages
        $rules = [
            'title' => 'required|unique:services_translations',
            'description' => 'required',
            'lang_code' => 'required',
        ];
        $messages = [
            'title.required' => 'The title failed is required',
            'description.required' => 'The description failed is required',
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
                // Start Insert Items
                $services = new ServicesTranslation();
                $services->lang_code = $request->lang_code;
                $services->title = $request->title;
                $services->description = $request->description;
                $services->meta_title = $request->meta_title;
                $services->meta_desc = $request->meta_desc;
                $services->meta_keywords = $request->meta_keywords;
                $services->services_id = $request->services_id;
            
                $services->save();
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
        $services = Services::where( 'id', '=', $id )->with( 'translations' )->first();
        if (!$services) {
            return abort( 404 );
        }
        return view( 'admin.services.show', compact( 'services' ) );
    }

    public function edit( $id ) {
        $lang = Language::orderBy( 'id', 'DESC' )->get();
        $services = Services::where( 'id', '=', $id )->with( ['translations'] )->first();
        $data = $services->translations;
        if ( !$services ) {
            return abort( 404 );
        }
        // dd( $services );
        return view( 'admin.services.edit', compact( 'lang', 'services','data' ) );
    }

    public function update( Request $request, $id ) {
        // Start Rules & Messages
        $rules = [
            'title' => 'required|unique:services_translations,id,' . $id,
            'description' => 'required',
            'lang_code' => 'required',
        ];
        $messages = [
            'title.required' => 'The title failed is required',
            'description.required' => 'The description failed is required',
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
                $services =  ServicesTranslation::find($id);
                $services->lang_code = $request->lang_code;
                $services->title = $request->title;
                $services->description = $request->description;
                $services->meta_title = $request->meta_title;
                $services->meta_desc = $request->meta_desc;
                $services->meta_keywords = $request->meta_keywords;
                $services->services_id = $request->services_id;
                $services->save();

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

    public function storeServices( Request $request ) {
        // Start Rules & Messages
        $rules = [
            // 'main_title' => 'required|min:3|unique:abouts',
            'main_title' => 'required|min:3',
            'icon' => 'required|image',
            'photo' => 'required|image',
        ];
        $messages = [
            'main_title.required' => 'The title failed is required',
            'icon.required' => 'The Icon failed is required',
            'photo.required' => 'The photo failed is required',
        ];

        // Start Validate Data
        $validate = Validator::make( $request->all(), $rules, $messages );
        // Check The Validate
        if ( $validate->fails() ) {
            return redirect()->back()->withErrors( $validate )->withInput();
        } else {
            // Start Try & Catch
            try {

                $services = new Services();
                $services->main_title = $request->main_title;
                // Set New File Name & Check if This Exist Or No
                if ( $file = $request->file( 'photo' ) ) {
                    $file_name = $file->GetClientOriginalName();
                    $file_ext = $file->GetClientOriginalExtension();
                    $file_to_store = time() . '.' . $file_ext;
                    $path = 'uploads/services/';
                    $file->move( $path, $file_to_store );
                    $services->photo = $path . $file_to_store;
                }
                // Set New File Name & Check if This Exist Or No
                if ( $file = $request->file( 'icon' ) ) {
                    $file_name = $file->GetClientOriginalName();
                    $file_ext = $file->GetClientOriginalExtension();
                    $file_to_store = time() . '.' . $file_ext;
                    $path = 'uploads/services/icons/';
                    $file->move( $path, $file_to_store );
                    $services->icon = $path . $file_to_store;
                }

                $services->save();

                session()->flash( 'success', 'Record has been successfully added.' );
                return redirect( '/admin/services/edit/' . $services->id );

            } catch( \Exception $ex ) {
                // Redirect Back If has any error
                session()->flash( 'error', 'Ops:(, something is wrong. ' );
                return redirect()->back();
            }
            // End Try & Catch
        }
    }

    public function updateServices( Request $request, $id ) {
        // Start Rules & Messages
        $rules = [
            // 'main_title' => 'required|min:3|unique:abouts',
            'main_title' => 'required|min:3',
            'icon' => 'image',
            'photo' => 'image',
        ];
        $messages = [
            'main_title.required' => 'The title failed is required',
            'icon.required' => 'The Icon failed is required',
            'photo.required' => 'The photo failed is required',
        ];
        // Start Validate Data
        $validate = Validator::make( $request->all(), $rules, $messages );
        // Check The Validate
        if ( $validate->fails() ) {
            return redirect()->back()->withErrors( $validate )->withInput();
        } else {
            // Start Try & Catch
            try {
                $services =  Services::find( $id );
                $services->main_title = $request->main_title;
                // Set New File Name & Check if This Exist Or No
                if ( $file = $request->file( 'photo' ) ) {
                    // File::delete( 'images/post/'.$post->image );
                    $deleteOldPhoto = unlink($services->photo );
                    if ( $deleteOldPhoto ) {

                        $file_name = $file->GetClientOriginalName();
                        $file_ext = $file->GetClientOriginalExtension();
                        $file_to_store = time() . '.' . $file_ext;
                        $path = 'uploads/services/';
                        $file->move( $path, $file_to_store );
                        $services->photo = $path . $file_to_store;
                    }

                }
                // Set New File Name & Check if This Exist Or No
                if ( $file = $request->file( 'icon' ) ) {
                    $deleteOldPhoto = unlink($services->icon );
                    if ( $deleteOldPhoto ) {
                        $file_name = $file->GetClientOriginalName();
                        $file_ext = $file->GetClientOriginalExtension();
                        $file_to_store = time() . '.' . $file_ext;
                        $path = 'uploads/services/icons/';
                        $file->move( $path, $file_to_store );
                        $services->icon = $path . $file_to_store;
                    }

                }

                $services->save();

                session()->flash( 'success', 'Record has been successfully updated.' );
                return redirect()->back();

            } catch( \Exception $ex ) {
                dd($ex);
                // Redirect Back If has any error
                session()->flash( 'error', 'Ops:(, something is wrong. ' );
                return redirect()->back();
            }
            // End Try & Catch
        }
    }

    public function destroy( $id ) {

        try {
            DB::table( 'services' )
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
            DB::table( 'services' )
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
            DB::table( 'services' )
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
