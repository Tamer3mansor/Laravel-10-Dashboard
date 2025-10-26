<?php
use Illuminate\Support\Facades\Route;

if (!function_exists('modalButton')) {
    /**
     * Generic button that opens remote modal
     * $route: named route
     * $title: modal title
     * $label: button text
     * $class: extra classes
     */
    function modalButton($route, $title = 'Form', $label = 'Open', $class = 'btn btn-sm btn-primary') {
        $url = route($route);
        $titleEsc = e($title);
        $labelEsc = e($label);
        return "<button type=\"button\" class=\"{$class} open-modal\" data-url=\"{$url}\" data-title=\"{$titleEsc}\">{$labelEsc}</button>";
    }
}

if (!function_exists('createModalButton')) {
    function createModalButton($route, $label = 'Create New') {
        return modalButton($route, $label, $label, 'btn btn-success');
    }
}

if (!function_exists('editModalButton')) {
    function editModalButton($route, $id, $label = 'Edit') {
        $url = route($route, $id);
        $labelEsc = e($label);
        return "<button type=\"button\" class=\"btn btn-sm btn-primary open-modal\" data-url=\"{$url}\" data-title=\"{$labelEsc}\"><i class=\"fas fa-edit\"></i> {$labelEsc}</button>";
    }
}

if (!function_exists('deleteAjaxButton')) {
    function deleteAjaxButton($route, $id, $label = 'Delete') {
        $url = route($route, $id);
        $labelEsc = e($label);
         return "<button type=\"button\" class=\"btn btn-sm btn-danger delete-record\" data-url=\"{$url}\" data-confirm=\"Are you sure you want to delete this record?\"><i class=\"fas fa-trash\"></i> {$labelEsc}</button>";
    }
}
if (!function_exists('deleteButton')) {
    function deleteButton($route, $id, $label = 'Delete') {
        $url = route($route, $id);
        $labelEsc = e($label);
        return "<form method=\"POST\" action=\"{$url}\" style=\"display:inline-block;\" onsubmit=\"return confirm('Are you sure you want to delete this record?');\">
                    " . csrf_field() . "
                    " . method_field('DELETE') . "
                    <button type=\"submit\" class=\"btn btn-sm btn-danger\"><i class=\"fas fa-trash\"></i> {$labelEsc}</button>
                </form>";
    }
}
