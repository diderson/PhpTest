<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GrahamCampbell\GitHub\Facades\GitHub;

class GithubController extends Controller
{
     /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $page_data = [];
        $latest_commits = [];
        $commits = GitHub::api('repo')->commits()->all('nodejs', 'node', array('sha' => 'master'));//connect to a specific repo to do make this dynamic

        for ($i=0; $i < count($commits); $i++) {
            $latest_commits[$i] = $commits[$i];
            $lastchar = substr($commits[$i]['commit']['message'], -1);

            $latest_commits[$i]['decorate'] = 'no';

            if (is_numeric($lastchar)) {
                $latest_commits[$i]['decorate'] = 'yes';
            }

            if ($i == 24) break;
        }

        $page_data['commits'] = $latest_commits;

        return view('view-commit', $page_data);
    }
}
