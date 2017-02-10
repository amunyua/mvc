<?php

use Illuminate\Database\Seeder;
use App\Menu;
use App\Route;
use Illuminate\Support\Facades\DB;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::transaction(function () {
            DB::table('menus')->delete();
            #### Dashboard
            $dashboard_route = Route::where('route_name', 'Dashboard')->first();
            $dashboard = new Menu();
            $dashboard->route_id = $dashboard_route->id;
            $dashboard->sequence = 1;
            $dashboard->save();
            $dashboard_id = $dashboard->id;

            $analytics_route = Route::where('route_name', 'Analytics Dashboard')->first();
            $analytics = new Menu();
            $analytics->route_id = $analytics_route->id;
            $analytics->parent_menu = $dashboard->id;
            $analytics->sequence = 1;
            $analytics->save();

            #### Masterfiles
            $registration_route = Route::where('route_name', 'MasterFiles')->first();
            $registration = new Menu();
            $registration->route_id = $registration_route->id;
            $registration->sequence = 2;
            $registration->save();
            $masterfile_id = $registration->id;

            //new masterfile
            $mf_route = Route::where('route_name', 'Create MasterFile')->first();
            $mf = new Menu();
            $mf->route_id = $mf_route->id;
            $mf->parent_menu = $masterfile_id;
            $mf->sequence = 1;
            $mf->save();

            //all masterfiles
            $mf_route = Route::where('route_name', 'All MasterFiles')->first();
            $mf = new Menu();
            $mf->route_id = $mf_route->id;
            $mf->parent_menu = $masterfile_id;
            $mf->sequence = 2;
            $mf->save();

            #### Masterfiles
//            $booking_route = Route::where('route_name', 'Bookings')->first();
//            $booking = new Menu();
//            $booking->route_id = $booking_route->id;
//            $booking->sequence = 3;
//            $booking->save();
//            $booking_id = $booking->id;
//
//
//            $booking_route = Route::where('route_name', 'Create Booking')->first();
//            $booking = new Menu();
//            $booking->route_id = $booking_route->id;
//            $booking->parent_menu = $booking_id;
//            $booking->sequence = 1;
//            $booking->save();
//
//
//            $booking_route = Route::where('route_name', 'All Bookings')->first();
//            $booking = new Menu();
//            $booking->route_id = $booking_route->id;
//            $booking->parent_menu = $booking_id;
//            $booking->sequence = 2;
//            $booking->save();

//            #### Suppliers
//            $supplier_route = Route::where('route_name','Suppliers')->first();
//            $supplier = new Menu();
//            $supplier->route_id = $supplier_route->id;
//            $supplier->sequence = 4;
//            $supplier->save();
//            $supplier_r = $supplier->id;
//
//            //manage suppliers
//            $s_id = Route::where('route_name','Manage Suppliers')->first();
//            $m_supp = new Menu();
//            $m_supp->route_id = $s_id->id;
//            $m_supp->parent_menu = $supplier_r;
//            $m_supp->sequence = 1;
//            $m_supp->save();
//
//            // manage supplier items
//            $s_id = Route::where('route_name','Manage Supplier Items')->first();
//            $m_supp = new Menu();
//            $m_supp->route_id = $s_id->id;
//            $m_supp->parent_menu = $supplier_r;
//            $m_supp->sequence = 2;
//            $m_supp->save();
//
//            // Manage Invoices
//            $s_id = Route::where('route_name','Manage Invoices')->first();
//            $m_supp = new Menu();
//            $m_supp->route_id = $s_id->id;
//            $m_supp->parent_menu = $supplier_r;
//            $m_supp->sequence = 3;
//            $m_supp->save();
//
//
//            #### configurations
//            $configurations_route = Route::where('route_name', 'System Configurations')->first();
//            $conf = new Menu();
//            $conf->route_id = $configurations_route->id;
//            $conf->sequence = 3;
//            $conf->save();
//            $configurations_id = $conf->id;
//
//            //manage vehicles
//            $configurations_route = Route::where('route_name', 'Manage Vehicles')->first();
//            $conf = new Menu();
//            $conf->route_id = $configurations_route->id;
//            $conf->parent_menu = $configurations_id;
//            $conf->sequence = 1;
//            $conf->save();
//
//            //manage expenses
//            $configurations_route = Route::where('route_name', 'Manage Expenses')->first();
//            $conf = new Menu();
//            $conf->route_id = $configurations_route->id;
//            $conf->parent_menu = $configurations_id;
//            $conf->sequence = 2;
//            $conf->save();
//
//            //create transaction
//            $configurations_route = Route::where('route_name', 'Create Transaction')->first();
//            $conf = new Menu();
//            $conf->route_id = $configurations_route->id;
//            $conf->parent_menu = $configurations_id;
//            $conf->sequence = 4;
//            $conf->save();
//
//            #### Reports
//            //parent
//            $report_route = Route::where('route_name', 'Reports')->first();
//            $report = new Menu();
//            $report->route_id = $report_route->id;
//            $report->sequence = 5;
//            $report->save();
//            $report_id = $report->id;
//
//            //daily report
//            $report_route = Route::where('route_name', 'Daily Report')->first();
//            $report = new Menu();
//            $report->route_id = $report_route->id;
//            $report->parent_menu = $report_id;
//            $report->sequence = 1;
//            $report->save();
//
//            //on demand report
//            $report_route = Route::where('route_name', 'On-Demand Report')->first();
//            $report = new Menu();
//            $report->route_id = $report_route->id;
//            $report->parent_menu = $report_id;
//            $report->sequence = 3;
//            $report->save();
//            //account status
//            $report_route = Route::where('route_name', 'Account Status')->first();
//            $report = new Menu();
//            $report->route_id = $report_route->id;
//            $report->parent_menu = $report_id;
//            $report->sequence = 4;
//            $report->save();


            #### user management
            $user_mngt_route = Route::where('route_name', 'User Management')->first();
            $user_mngt = new Menu();
            $user_mngt->fa_icon = 'fa-group';
            $user_mngt->route_id = $user_mngt_route->id;
            $user_mngt->sequence = 8;
            $user_mngt->save();
            $user_mngt_id = $user_mngt->id;

            $all_user_route = Route::where('route_name', 'All Users')->first();
            $all_user = new Menu();
            $all_user->route_id = $all_user_route->id;
            $all_user->parent_menu = $user_mngt->id;
            $all_user->sequence = 1;
            $all_user->save();

            $role_route = Route::where('route_name', 'User Roles')->first();
            $role = new Menu();
            $role->route_id = $role_route->id;
            $role->parent_menu = $user_mngt->id;
            $role->sequence = 2;
            $role->save();
            $all_user->save();

            $audit_trail_route = Route::where('route_name', 'Audit Trail')->first();
            $audit_trail = new Menu();
            $audit_trail->route_id = $audit_trail_route->id;
            $audit_trail->parent_menu = $user_mngt->id;
            $audit_trail->sequence = 3;
            $audit_trail->save();

            #### system
            $system_route = Route::where('route_name', 'System')->first();
            $system = new Menu();
            $system->fa_icon = 'fa-cogs';
            $system->route_id = $system_route->id;
            $system->sequence = 9;
            $system->save();
            $system_id = $system->id;

            $routes_route = Route::where('route_name', 'System Routes')->first();
            $routes = new Menu();
            $routes->route_id = $routes_route->id;
            $routes->parent_menu = $system->id;
            $routes->sequence = 1;
            $routes->save();

            $menu_route = Route::where('route_name', 'System Menu')->first();
            $menu = new Menu();
            $menu->route_id = $menu_route->id;
            $menu->parent_menu = $system->id;
            $menu->sequence = 2;
            $menu->save();

//            $config_route = Route::where('route_name', 'Load System Configuration')->first();
//            $sys_config = new Menu();
//            $sys_config->route_id = $config_route->id;
//            $sys_config->parent_menu = $system->id;
//            $sys_config->sequence = 3;
//            $sys_config->save();
//
//            $theme_route = Route::where('route_name', 'Theme Configuration')->first();
//            $theme_config = new Menu();
//            $theme_config->route_id = $theme_route->id;
//            $theme_config->parent_menu = $system->id;
//            $theme_config->sequence = 4;
//            $theme_config->save();

            $backup_route = Route::where('route_name', 'Backup')->first();
            $backup = new Menu();
            $backup->route_id = $backup_route->id;
            $backup->parent_menu = $system->id;
            $backup->sequence = 5;
            $backup->save();
        });
    }
}
