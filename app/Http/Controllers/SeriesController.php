<?php

namespace App\Http\Controllers;

class SeriesController extends Controller {
    public function index(){
        $seriesList = [
            'Serie One',
            'Serie Two',
            'Serie Three',
        ];

        $html = "<ul>";
        foreach($seriesList as $serie){
            $html .= "<li>$serie</li>";
        }
        $html .= "</ul>";

        return $html;
    }
}