<?php

// Start helper Function To Validate Inputs
if ( ! function_exists( 'SanitizeString' ) ) {
    function SanitizeString( $input ) {
        return filter_var( $input, FILTER_SANITIZE_STRING );
    }
}
if ( ! function_exists( 'SanitizeNumber' ) ) {
    function SanitizeNumber( $input ) {
        return filter_var( $input, FILTER_SANITIZE_NUMBER_INT );
    }
}
if ( ! function_exists( 'SanitizeEmail' ) ) {
    function SanitizeEmail( $input ) {
        return filter_var( $input, FILTER_SANITIZE_EMAIL );
    }
}

// End helper Function To Validate Inputs

// Start Helper Function Active And Unactive
if (!function_exists('active')) {
    function active($tbl, $id) {
        try {
            DB::table( $tbl )
            ->where( 'id', '=', $id )
            ->update( ['active' => 1] );
            Session::flash( 'success', 'Status activated successfully.' );
            return redirect()->back();
        } catch ( \Exception $ex ) {
            Session::flash( 'error', 'Ops:(, Status not activated please try again.' );
            return redirect()->back()->withInput( Input::all() );
        }
    }
}
// End Helper Function Active And Unactive
 
// Start Helper Function Delete
if (!function_exists('delete')) {
    function delete($tbl, $id) {
        try {
            DB::table( $tbl )
            ->where( 'id', '=', $id )
            ->delete();
            Session::flash( 'success', 'Deleted successfully' );
            return redirect()->back();
        } catch ( \Exception $ex ) {
            Session::flash( 'error', 'Ops:(, Delete fail please try again.' );
            return redirect()->back();
        }
    }
}
// End Helper Function Delete
