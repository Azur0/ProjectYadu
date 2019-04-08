<?php

if (!function_exists('isAuthorized')) {
    function isAuthorized($id)
    {
        if (Auth::id() == $id && $id != null) {
            //Return true if the specified id matches that of the currently authorized user
            //Null check prevents error when users that are not logged in try to access routes that require authentication
            return true;
        } else {
            //Return Status code - 401: Unauthorized
            abort(401);
        }
    }
}



