<?php

if (!function_exists('isAuthorized')) {
    function isAuthorized(int $id)
    {
        if (Auth::id() == $id) {
            //Return true if the specified id matches that of the currently authorized user
            return true;
        } else {
            //Return Status code - 401: Unauthorized
            abort(401);
        }
    }
}



