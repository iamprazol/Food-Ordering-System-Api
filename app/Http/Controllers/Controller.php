<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Restaurant;
use Illuminate\Support\Facades\Auth;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function responser($item,$data,$name)
    {
        try {
            $exists = !empty($item); // or you can use ($item !== null)

            return response()->json([
                'data' => $data,
                'status' => $exists ? 200 : 404,
                'message' => $exists ? "$name found" : "$name not found",
            ], $exists ? 200 : 404);

        } catch (\Throwable $e) {
            \Log::error('Responser error: '.$e->getMessage(), [
                'trace' => $e->getTraceAsString()
            ]);

            return response()->json([
                'data' => null,
                'status' => 500,
                'message' => 'Server error: '.$e->getMessage()
            ], 500);
        }
    }

    public static function closest($lat, $lng, $max_distance = 50, $max_locations = 50, $units = 'miles')
    {
        /*
         *  Allow for changing of units of measurement
         */
        switch ( $units ) {
            default:
            case 'miles':
                $gr_circle_radius = 3959;
                break;
            case 'kilometers':
                $gr_circle_radius = 6371;
                break;
        }
        $distance_select = sprintf(
            "*, ( %d * acos( cos( radians(%s) ) " .
            " * cos( radians( latitude ) ) " .
            " * cos( radians( longitude ) - radians(%s) ) " .
            " + sin( radians(%s) ) * sin( radians( latitude ) ) " .
            ") " .
            ") " .
            "AS distance",
            $gr_circle_radius,
            $lat,
            $lng,
            $lat
        );


        return  Restaurant::selectraw($distance_select)
            ->having( 'distance', '<', $max_distance )
            ->take( $max_locations )
            ->orderBy( 'distance', 'ASC' )
            ->get();
    }

}
