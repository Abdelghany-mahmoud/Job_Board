<?php

namespace App\Http\Controllers;

use App\Models\Technology;
use Illuminate\Http\Request;
use App\Models\YourModel; // Replace with your model name

class SearchController extends Controller
{
    public function autocomplete(Request $request)
    {
        $query = $request->get('query');

        if ($query) {
            // Adjust the column name and model according to your needs
            $results = Technology::where('name', 'LIKE', '%' . $query . '%')->get();
            $output = '<ul>';

            foreach ($results as $result) {
                $output .= '<li>' . $result->name . '</li>';
            }

            $output .= '</ul>';
        } else {
            $output = '';
        }

        return response($output);
    }
}
