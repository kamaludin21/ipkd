<?php

use App\Models\Document;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;

if (!function_exists('cleanFileName')) {
  function cleanFileName($string)
  {
    // Replaces all spaces with hyphens.
    $string = str_replace(' ', '_', $string);
    // Removes special chars.
    $string = preg_replace('/[^A-Za-z0-9\-\_]/', '', $string);
    // Replaces multiple hyphens with single one.
    $string = preg_replace('/-+/', '_', $string);

    $clean_file_name = strtolower($string);

    return $clean_file_name;
  }
}

if (!function_exists('currentRoutePosition')) {
  function currentRoutePosition()
  {
    $routeName = Route::currentRouteName();
    $cleanRouteName = explode(".", $routeName);
    return $cleanRouteName[0];
  }
}

if (!function_exists('duplicate_find')) {
  function duplicate_find($value, $column = 'slug'): bool
  {
    $query = Document::where($column, $value)->count();
    return ($query > 1) ? true : false;

  }
}
