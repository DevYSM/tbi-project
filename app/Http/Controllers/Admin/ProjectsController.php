<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Project;
use App\ProjectTranslations;
use App\Language;
use App\Tag;
use App\Technology;
use DB;

class ProjectsController extends Controller {

    public function index() {
        $i = 1;
        $services = Services::orderBy( 'id', 'DESC' )->with( ['translations'] )->get();
        $countAll = Services::count();
        $countActive = Services::where( 'status', 0 )->count();
        $countUnactive = Services::where( 'status', 1 )->count();
        return view( 'admin.projects.index', compact( 'i', 'services', 'countAll', 'countActive', 'countUnactive' ) );
    }

    public function create() {
        $lang = Language::orderBy( 'id', 'DESC' )->get();
        $tags = Tag::orderBy( 'id', 'DESC' )->get();
        $technologies = Technology::orderBy( 'id', 'DESC' )->get();
        return view( 'admin.projects.create', compact( 'lang', 'tags', 'technologies' ) );
    }

    public function store( Request $request ) {
        // dd( $request->all() );
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
                $project = new ProjectTranslations();
                $project->lang_code = $request->lang_code;
                $project->title = $request->title;
                $project->duration = $request->duration;
                $project->short_description = $request->short_description;
                $project->description = $request->description;
                $project->meta_title = $request->meta_title;
                $project->meta_desc = $request->meta_desc;
                $project->meta_keywords = $request->meta_keywords;
                $project->project_id = $request->project_id;
                $project->save();

                session()->flash( 'success', 'Record has been successfully added.' );
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

    public function show( $id ) {
        $services = Project::where( 'id', '=', $id )->with( 'translations' )->first();
        if ( !$services ) {
            return abort( 404 );
        }
        return view( 'admin.projects.show', compact( 'services' ) );
    }

    public function edit( $id ) {
        $lang = Language::orderBy( 'id', 'DESC' )->get();
        $projects = Project::findOrFail( $id );
        $tags = Tag::get();
        $technologies = Technology::get();
        $project_tags = $projects->tags;
        $project_technologies = $projects->technologies;

        $data = $projects->translations;
        if ( !$projects ) {
            return abort( 404 );
        }
        return view( 'admin.projects.edit', compact( 'lang', 'projects', 'data', 'tags', 'technologies', 'project_tags', 'project_technologies' ) );
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
                $services =  ServicesTranslation::find( $id );
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

    public function storeMainData( Request $request ) {
        // Start Rules & Messages
        $rules = [
            // 'main_title' => 'required|min:3|unique:abouts',
            'main_title' => 'required|min:3',
            'photo' => 'required|image',
        ];
        $messages = [
            'main_title.required' => 'The title failed is required',
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

                $store = new Project();
                $store->main_title = $request->main_title;
                // Set New File Name & Check if This Exist Or No
                if ( $file = $request->file( 'photo' ) ) {
                    $file_name = $file->GetClientOriginalName();
                    $file_ext = $file->GetClientOriginalExtension();
                    $file_to_store = time() . '.' . $file_ext;
                    $path = 'uploads/projects/';
                    $file->move( $path, $file_to_store );
                    $store->photo = $path . $file_to_store;
                }
                $store->save();

                if ( $store ) {
                    // if ( is_array( $request->tags ) ) {
                    //    foreach ( $request->tags as $tag ) {
                    //     ProjectTags::create( [
                    //         'tag_id'=>$tag,
                    //         'project_id'=>$store->id
                    //     ] );
                    //    }
                    // }
                    // if ( is_array( $request->technologies ) ) {
                    //     foreach ( $request->technologies as $tech ) {
                    //         ProjectTechnology::create( [
                    //          'technologies_id'=>$tech,
                    //          'project_id'=>$store->id
                    //      ] );
                    //     }
                    //  }
                }

                session()->flash( 'success', 'Record has been successfully added.' );
                return redirect( '/admin/projects/edit/' . $store->id );

            } catch( \Exception $ex ) {
                // Redirect Back If has any error
                session()->flash( 'error', 'Ops:(, something is wrong. ' );
                return redirect()->back();
            }
            // End Try & Catch
        }
    }

    public function updateMainData( Request $request, $id ) {
        // Start Rules & Messages

        $rules = [
            // 'main_title' => 'required|min:3|unique:abouts',
            'main_title' => 'required|min:3',
            'photo' => 'image',
        ];
        $messages = [
            'main_title.required' => 'The title failed is required',
            // 'photo.required' => 'The photo failed is required',
        ];
        // Start Validate Data
        $validate = Validator::make( $request->all(), $rules, $messages );
        // Check The Validate
        if ( $validate->fails() ) {
            return redirect()->back()->withErrors( $validate )->withInput();
        } else {
            // Start Try & Catch
            try {

                $project =  Project::where( 'id', '=', $id )->first();
                $project->main_title = $request->main_title;
                $project->tags()->sync( $request->tags );
                $project->technologies()->sync( $request->technologies );

                // Set New File Name & Check if This Exist Or No
                if ( $file = $request->file( 'photo' ) ) {
                    // File::delete( 'images/post/'.$post->image );
                    $deleteOldPhoto = unlink( $project->photo );
                    if ( $deleteOldPhoto ) {

                        $file_name = $file->GetClientOriginalName();
                        $file_ext = $file->GetClientOriginalExtension();
                        $file_to_store = time() . '.' . $file_ext;
                        $path = 'uploads/services/';
                        $file->move( $path, $file_to_store );
                        $project->photo = $path . $file_to_store;
                    }

                }
                // Set New File Name & Check if This Exist Or No

                $project->save();

                session()->flash( 'success', 'Record has been successfully updated.' );
                return redirect()->back();

            } catch( \Exception $ex ) {
                dd( $ex );
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
