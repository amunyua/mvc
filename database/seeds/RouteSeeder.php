<?php

use Illuminate\Database\Seeder;
use App\Route;
use App\Role;
use Illuminate\Support\Facades\DB;

class RouteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::transaction(function (){
            DB::table('routes')->delete();
            $admin = Role::where('role_code', 'SYS_ADMIN')->first();
            #### Dashboard
            $dashboard = new Route();
            $dashboard->route_name = 'Dashboard';
            $dashboard->save();
            $dashboard_id = $dashboard->id;

            #### Dashboard child
            $analytics_dash = new Route();
            $analytics_dash->route_name = 'Analytics Dashboard';
            $analytics_dash->url = 'dashboard';
            $analytics_dash->parent_route = $dashboard_id;
            $analytics_dash->save();
            $analytics_dash->roles()->attach($admin);

            #### MasterFiles
            $masterfile= new Route();
            $masterfile->route_name = 'MasterFiles';
            $masterfile->save();
            $masterfile_id = $masterfile->id;

            //add new masterfile
            $mf = new Route();
            $mf->route_name = 'Create MasterFile';
            $mf->url = 'new-mf';
            $mf->parent_route = $masterfile_id;
            $mf->save();
            $mf->roles()->attach($admin);

            //all masterfile
            $mf = new Route();
            $mf->route_name = 'All MasterFiles';
            $mf->url = 'all-masterfiles';
            $mf->parent_route = $masterfile_id;
            $mf->save();
            $mf->roles()->attach($admin);

            #### Suppliers
            $supplier = new Route();
            $supplier->route_name = 'Suppliers';
            $supplier->save();
            $supp_id = $supplier->id;

            // manage suppliers
            $supplier = new Route();
            $supplier->route_name = 'Manage Suppliers';
            $supplier->url = 'suppliers';
            $supplier->parent_route = $supp_id;
            $supplier->save();
            $supplier->roles()->attach($admin);

            // manage supplier items
            $supplier = new Route();
            $supplier->route_name = 'Manage Supplier Items';
            $supplier->url = 'supplier-items';
            $supplier->parent_route = $supp_id;
            $supplier->save();
            $supplier->roles()->attach($admin);

            // manage Invoices
            $supplier = new Route();
            $supplier->route_name = 'Manage Invoices';
            $supplier->url = 'invoices';
            $supplier->parent_route = $supp_id;
            $supplier->save();
            $supplier->roles()->attach($admin);



            #### Configurations
            $system_configurations = new Route();
            $system_configurations->route_name = 'System Configurations';
            $system_configurations->save();
            $system_configurations_id = $system_configurations->id;

            #### configurations children
            $manage_buses = new Route();
            $manage_buses->route_name = 'Manage Vehicles';
            $manage_buses->url = 'all-buses';
            $manage_buses->parent_route = $system_configurations_id;
            $manage_buses->save();
            $manage_buses->roles()->attach($admin);

            //manage expenses
            $manage_expenses = new Route();
            $manage_expenses->route_name = 'Manage Expenses';
            $manage_expenses->url = 'expenses';
            $manage_expenses->parent_route = $system_configurations_id;
            $manage_expenses->save();
            $manage_expenses->roles()->attach($admin);

            //Record transaction
            $manage_expenses = new Route();
            $manage_expenses->route_name = 'Create Transaction';
            $manage_expenses->url = 'accounts';
            $manage_expenses->parent_route = $system_configurations_id;
            $manage_expenses->save();
            $manage_expenses->roles()->attach($admin);


            #### Reports
            $report_menu =new Route();
            $report_menu->route_name = 'Reports';
            $report_menu->save();
            $report_menu_id = $report_menu->id;

            // daily report
            $report = new Route();
            $report->route_name = 'Daily Report';
            $report->url = 'daily-report';
            $report->parent_route = $report_menu_id;
            $report->save();

            // on demand report
            $report = new Route();
            $report->route_name = 'On-Demand Report';
            $report->url = 'all-transactions';
            $report->parent_route = $report_menu_id;
            $report->save();

            //account status report
            $report = new Route();
            $report->route_name = 'Account Status';
            $report->url = 'account-status';
            $report->parent_route = $report_menu_id;
            $report->save();


            #### system
            $system = new Route();
            $system->route_name = 'System';
            $system->save();
            $system_id = $system->id;

            #### system children
            $routes = new Route();
            $routes->route_name = 'System Routes';
            $routes->url = 'routes';
            $routes->parent_route = $system_id;
            $routes->save();
            $routes->roles()->attach($admin);

            $routes = new Route();
            $routes->route_name = 'Load System Routes';
            $routes->url = 'load-routes';
            $routes->parent_route = $system_id;
            $routes->save();
            $routes->roles()->attach($admin);

            $menu = new Route();
            $menu->route_name = 'System Menu';
            $menu->url = 'menu';
            $menu->parent_route = $system_id;
            $menu->save();
            $menu->roles()->attach($admin);

            $system_config = new Route();
            $system_config->route_name = 'System Configuration';
            $system_config->url = 'sys-config';
            $system_config->parent_route = $system_id;
            $system_config->save();
            $system_config->roles()->attach($admin);

            $system_config = new Route();
            $system_config->route_name = 'System Settings';
            $system_config->url = 'load-config';
            $system_config->parent_route = $system_id;
            $system_config->save();
            $system_config->roles()->attach($admin);

            $system_config = new Route();
            $system_config->route_name = 'Get Route Data';
            $system_config->url = 'get-route/{route_id}';
            $system_config->parent_route = $system_id;
            $system_config->save();
            $system_config->roles()->attach($admin);

            $system_config = new Route();
            $system_config->route_name = 'Update Route';
            $system_config->url = 'edit-route';
            $system_config->parent_route = $system_id;
            $system_config->save();
            $system_config->roles()->attach($admin);

            $system_config = new Route();
            $system_config->route_name = 'Load System Configuration';
            $system_config->url = 'load-config';
            $system_config->parent_route = $system_id;
            $system_config->save();
            $system_config->roles()->attach($admin);

            $theme_config = new Route();
            $theme_config->route_name = 'Theme Configuration';
            $theme_config->url = 'theme_config';
            $theme_config->parent_route = $system_id;
            $theme_config->save();
            $theme_config->roles()->attach($admin);

            $theme_config = new Route();
            $theme_config->route_name = 'Theme Select';
            $theme_config->url = 'theme-select/{theme}';
            $theme_config->parent_route = $system_id;
            $theme_config->save();
            $theme_config->roles()->attach($admin);

            $get_theme = new Route();
            $get_theme->route_name = 'Get Theme';
            $get_theme->url = 'get-theme';
            $get_theme->parent_route = $system_id;
            $get_theme->save();
            $get_theme->roles()->attach($admin);

            $backup = new Route();
            $backup->route_name = 'Backup';
            $backup->url = 'backup';
            $backup->parent_route = $system_id;
            $backup->save();
            $backup->roles()->attach($admin);



            #### user management
            $user_mngt = new Route();
            $user_mngt->route_name = 'User Management';
            $user_mngt->save();
            $user_mngt_id = $user_mngt->id;

            #### user management children
            $all_user = new Route();
            $all_user->route_name = 'All Users';
            $all_user->url = 'all_users';
            $all_user->parent_route = $user_mngt_id;
            $all_user->save();
            $all_user->roles()->attach($admin);

            $roles = new Route();
            $roles->route_name = 'User Roles';
            $roles->url = 'user_roles';
            $roles->parent_route = $user_mngt_id;
            $roles->save();
            $roles->roles()->attach($admin);

            $role = new Route();
            $role->route_name = 'Delete User';
            $role->url = 'delete-user/{id}';
            $role->parent_route = $user_mngt_id;
            $role->save();
            $role->roles()->attach($admin);

            $role = new Route();
            $role->route_name = 'Block User';
            $role->url = 'all_users/block-user';
            $role->parent_route = $user_mngt_id;
            $role->save();
            $role->roles()->attach($admin);

            $role = new Route();
            $role->route_name = 'Unblock User';
            $role->url = 'all_users/unblock-user';
            $role->parent_route = $user_mngt_id;
            $role->save();
            $role->roles()->attach($admin);


            $audit_trail = new Route();
            $audit_trail->route_name = 'Audit Trail';
            $audit_trail->url = 'audit_trails';
            $audit_trail->parent_route = $user_mngt_id;
            $audit_trail->save();
            $audit_trail->roles()->attach($admin);

            $route = new Route();
            $route->route_name = 'Load Routes Allocation';
            $route->url = 'load-routes-allocation';
            $route->parent_route = $system_id;
            $route->save();
            $route->roles()->attach($admin);

            $route = new Route();
            $route->route_name = 'is Route Allocated';
            $route->url = 'check-allocated-route/{id}';
            $route->parent_route = $system_id;
            $route->save();
            $route->roles()->attach($admin);

            $route = new Route();
            $route->route_name= 'Attach Route';
            $route->url = 'attach-route';
            $route->parent_route = $system_id;
            $route->save();
            $route->roles()->attach($admin);

            $route = new Route();
            $route->route_name= 'Detach Route';
            $route->url = 'detach-route';
            $route->parent_route = $system_id;
            $route->save();
            $route->roles()->attach($admin);

        });
    }
}
