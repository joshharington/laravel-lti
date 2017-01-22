<?php
/**
 * Created by PhpStorm.
 * User: jharing10
 * Date: 2017/01/17
 * Time: 10:48 AM
 */

namespace JoshHarington\LaravelLTI\Http\Controllers;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ImportLTIToolController extends Controller {

    public function index() {
        return view('jh.lti:layouts.tools.import');
    }

    public function store(Request $request) {
        dd($request);
    }

}