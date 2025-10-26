<?php
 if (!function_exists('editButton')) {
    function editButton($id, $route)
    {
        return '<a href="' . route($route, $id) . '" class="btn btn-sm btn-primary">Edit</a>';
    }
}



