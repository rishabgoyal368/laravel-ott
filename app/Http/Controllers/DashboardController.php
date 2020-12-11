<?php

namespace App\Http\Controllers;

use App\Charts\UserChart;
use App\Charts\VideoDistributionChart;
use App\Charts\VisitorsChart;
use App\Charts\UserDistributionChart;
use App\CouponCode;
use App\Genre;
use App\Movie;
use App\Package;
use App\PaypalSubscription;
use App\TvSeries;
use App\User;
use DB;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function dashboard()
    {
        $users_count = User::count();
        $movies_count = Movie::count();
        $tvseries_count = TvSeries::count();
        $livetv_count = Movie::where('live', 1)->count();
        $genres_count = Genre::count();
        $package_count = Package::where('status', 1)->where('delete_status', 1)->count();
        $coupon_count = CouponCode::count();
        // $faq_count = Faq::count();
        $activeusers = PaypalSubscription::join('users', 'users.id', '=', 'paypal_subscriptions.user_id')->where('paypal_subscriptions.status', '=', '1')->where('users.is_blocked', '=', 0)->where('users.status', '=', 1)->count();
        $totalrevnue = PaypalSubscription::sum('price');
        $users = User::where(DB::raw("(DATE_FORMAT(created_at,'%Y'))"), date('Y'))->get();
        $activesubsriber = PaypalSubscription::where(DB::raw("(DATE_FORMAT(created_at,'%Y'))"), date('Y'))->where('status', '1')->get();
        $inactivesubsriber = PaypalSubscription::where(DB::raw("(DATE_FORMAT(created_at,'%Y'))"), date('Y'))->where('status', '0')->count();
        $subsribeuseruser =PaypalSubscription::where(DB::raw("(DATE_FORMAT(created_at,'%Y'))"), date('Y'))->count();
        $fillColors = [
            '#f44336',
            '#4CAF50',
            '#2196F3',
            '#03A9F4',
            '#00BCD4',
            '#009688',
            '#8BC34A',
            '#CDDC39',
            '#FFC107',
            '#FF9800',
            '#FF5722',
        ];

        /*Creating Userbarchart*/
        $users = array(
            User::whereMonth('created_at', '01')
                ->whereYear('created_at', date('Y'))
                ->count(), //January
            User::whereMonth('created_at', '02')
                ->whereYear('created_at', date('Y'))
                ->count(), //Feb
            User::whereMonth('created_at', '03')
                ->whereYear('created_at', date('Y'))
                ->count(), //March
            User::whereMonth('created_at', '04')
                ->whereYear('created_at', date('Y'))
                ->count(), //April
            User::whereMonth('created_at', '05')
                ->whereYear('created_at', date('Y'))
                ->count(), //May
            User::whereMonth('created_at', '06')
                ->whereYear('created_at', date('Y'))
                ->count(), //June
            User::whereMonth('created_at', '07')
                ->whereYear('created_at', date('Y'))
                ->count(), //July
            User::whereMonth('created_at', '08')
                ->whereYear('created_at', date('Y'))
                ->count(), //August
            User::whereMonth('created_at', '09')
                ->whereYear('created_at', date('Y'))
                ->count(), //September
            User::whereMonth('created_at', '10')
                ->whereYear('created_at', date('Y'))
                ->count(), //October
            User::whereMonth('created_at', '11')
                ->whereYear('created_at', date('Y'))
                ->count(), //November
            User::whereMonth('created_at', '12')
                ->whereYear('created_at', date('Y'))
                ->count(), //December
        );

        $userchart = new UserChart;
        $userchart->labels(['January', 'Febuary', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December']);

        $userchart->title('Monthly Registered Users in ' . date('Y'))->dataset('Monthly Registered Users', 'line', $users)->options([
            'fill' => 'true',
            'shadow' => 'true',
            'borderWidth' => '1',
        ])->backgroundcolor("#f24236e3")->color('#f24236e3');
        /*END*/


        /*Creating Active subscriber chart*/

        $activesub = array(
            PaypalSubscription::whereMonth('created_at', '01')->where('status', '1')
                ->whereYear('created_at', date('Y'))
                ->count(), //January
            PaypalSubscription::whereMonth('created_at', '02')->where('status', '1')
                ->whereYear('created_at', date('Y'))
                ->count(), //Feb
            PaypalSubscription::whereMonth('created_at', '03')->where('status', '1')
                ->whereYear('created_at', date('Y'))
                ->count(), //March
            PaypalSubscription::whereMonth('created_at', '04')->where('status', '1')
                ->whereYear('created_at', date('Y'))
                ->count(), //April
            PaypalSubscription::whereMonth('created_at', '05')->where('status', '1')
                ->whereYear('created_at', date('Y'))
                ->count(), //May
            PaypalSubscription::whereMonth('created_at', '06')->where('status', '1')
                ->whereYear('created_at', date('Y'))
                ->count(), //June
            PaypalSubscription::whereMonth('created_at', '07')->where('status', '1')
                ->whereYear('created_at', date('Y'))
                ->count(), //July
            PaypalSubscription::whereMonth('created_at', '08')->where('status', '1')
                ->whereYear('created_at', date('Y'))
                ->count(), //August
            PaypalSubscription::whereMonth('created_at', '09')->where('status', '1')
                ->whereYear('created_at', date('Y'))
                ->count(), //September
            PaypalSubscription::whereMonth('created_at', '10')->where('status', '1')
                ->whereYear('created_at', date('Y'))
                ->count(), //October
            PaypalSubscription::whereMonth('created_at', '11')->where('status', '1')
                ->whereYear('created_at', date('Y'))
                ->count(), //November
            PaypalSubscription::whereMonth('created_at', '12')->where('status', '1')
                ->whereYear('created_at', date('Y'))
                ->count(), //December
        );

        $activesubsriber = new VisitorsChart;
        $activesubsriber->labels(['January', 'Febuary', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December']);
        $activesubsriber->label('Active Plan Users')->title('Active Subscribed Users in ' . date('Y'))->dataset('Monthly Subscribed Users', 'area', $activesub)->options([
            'fill' => 'true',
            'shadow' => true,
            'borderWidth' => '1',
        ]);
        /*END*/

        $doughnutchart = new VideoDistributionChart;
        $doughnutchart->minimalist(true);
        $doughnutchart->labels(['Movies','Tv Seires','LiveTv']);
        $data = [$movies_count,$tvseries_count,$livetv_count];
        $doughnutchart->title('Video Distribution')->dataset('Video Distribution', 'doughnut', $data)
            ->color($fillColors)
            ->backgroundcolor($fillColors);

        $piechart = new UserDistributionChart;
        $piechart->minimalist(true);
        $piechart->labels(['Active User','Subscribed User','Inactive user' ]);
        $value=[$activeusers,$subsribeuseruser,$inactivesubsriber];
        $piechart->title('User Distribution')->dataset('User Distribution', 'pie', $value)->options([
                'fill' => 'true',
                'shadow' => true,
            ])->color($fillColors);
        

        return view('admin.index', compact('genres_count', 'users_count', 'movies_count', 'tvseries_count', 'package_count', 'coupon_count', 'faq_count', 'activeusers', 'totalrevnue', 'userchart', 'activesubsriber', 'livetv_count','piechart','doughnutchart'));
    }

    public function device_history(Request $request)
    {
        $device_history = \DB::table('sessions')->where('user_id', '!=', null)->get();
        if ($request->ajax()) {
            return \Datatables::of($device_history)

                ->addIndexColumn()

                ->addColumn('username', function ($row) {
                    $username = \DB::table('users')->where('id', $row->user_id)->first()->name;

                    return $username;

                })

                ->addColumn('user_agent', function ($row) {

                    return str_limit($row->user_agent, 50);

                })
                ->addColumn('last_activity', function ($row) {

                    return date('Y-m-d h:i:sa', $row->last_activity);

                })

                ->rawColumns(['username', 'user_agent', 'last_activity'])
                ->make(true);
        }

        return view('admin.device-history', compact('device_history'));
    }
}
