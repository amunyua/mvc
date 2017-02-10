<?php

namespace App\Http\Controllers;

use App\booking_sources;
use App\BookingDetails;
use App\Bookings;
use App\NightStops;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use App\Masterfile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;


class BookingsController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    private $_booking_array= array();
    public function index(){
        $clients = Masterfile::where('user_role','Client')->get();
        return view('bookings.index', array(
            'clients'=>$clients,
            'sources'=>booking_sources::all(),
            'drivers'=>Masterfile::Where('b_role', 'driver')->get(),
            'night_stops'=>NightStops::all()

        ));
    }
    public function createBooking(Request $request){
//        var_dump($_POST);die;
        $validate = array(
            'days'=> 'required',
            'night_stops'=>'required'
        );
        $this->validate($request,$validate);
        $night_stops = array();
        $days = array();
        if(isset($request->night_stops) && !empty($request->night_stops)){
            if(isset($request->days)&& !empty($request->days)){
                if(count($request->night_stops)){
                    foreach($request->night_stops as $stop){
                        if($stop != ''){
                            $night_stops[] = $stop;
                        }
                    }
                    foreach ($request->days as $day){
                        if($days != ''){
                            $days[] = $day;
                        }
                    }
                }
            }
        }
        $this->_booking_array = array_combine($night_stops,$days);
//        print_r($bookings);die;
        DB::transaction(function (){
            $booking = new Bookings();
            $booking->booking_source = Input::get('booking_source');
            $booking->client = Input::get('client');
            $booking->driver = Input::get('driver');
            $booking->start_date = Input::get('start_date');
            $booking->end_date = Input::get('end_date');

            $booking->save();
            $booking_id = $booking->id;


            foreach($this->_booking_array as $key=>$value) {
                $booking_details = new BookingDetails();
                $booking_details->booking_id = $booking_id;
                $booking_details->night_stops = $key;
                $booking_details->day = $value;
                $booking_details->save();
            }
        });
        Session::flash('Success', 'The Booking has been Created');
        return redirect('all-bookings');
    }

    public function allBookings(){
        return view('bookings.all_bookings',array(
            'bookings'=> Bookings::all()

    ));

    }

    public function viewBookingDetails($id){
        $bookings = BookingDetails::where('booking_id',$id)->get();

        return view('reports.daily-report',array(
            'bookings'=>$bookings
        ));
    }
}
