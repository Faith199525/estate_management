<?php

use App\Role;
use Illuminate\Database\Seeder;

class RoleTablePermissionUpdater extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = Role::all();

        foreach ($roles as $key => $role) {
            if ($role->name == 'AdHoc') {
                $role->permissions =
                json_encode([
                    "view_admin",
                    "view_visitor",
                    "edit_visitor",
                    "view_incident",
                    "edit_incident",
                    "view_user_partial",
                    "view_landlord",
                    "view_resident",
                    "view_resident_staff"
                ]);
                $role->save();
            }
            if ($role->name == 'Moderator') {
                $role->permissions =
                json_encode([
                    "view_admin",
                    "view_visitor",
                    "edit_visitor",
                    "view_incident",
                    "edit_incident",
                    "view_user_partial",
                    "view_user",
                    "view_landlord",
                    "view_resident",
                    "view_resident_staff",
                    "view_street",
                    "view_due",
                    "view_message",
                    "edit_message",
                    "view_payments",
                    "view_personnel"
                ]);
                $role->save();
            }
            if ($role->name == 'Manager') {
                $role->permissions =
                json_encode([
                    "view_admin",
                    "view_visitor",
                    "edit_visitor",
                    "view_incident",
                    "edit_incident",
                    "view_user_partial",
                    "view_user",
                    "view_user_full",
                    "view_landlord",
                    "edit_landlord",
                    "view_resident",
                    "edit_resident",
                    "view_resident_staff",
                    "view_street",
                    "edit_street",
                    "view_due",
                    "edit_due",
                    "view_message",
                    "edit_message",
                    "view_payments",
                    "edit_payments",
                    "view_settings",
                    "view_personnel",
                    "edit_personnel",
                    "view_role",
                    "edit_role"
                ]);
                $role->save();
            }
            if ($role->name == 'Admin') {
                $role->permissions =
                json_encode([
                    "view_admin",
                    "view_visitor",
                    "edit_visitor",
                    "view_incident",
                    "edit_incident",
                    "view_user_partial",
                    "view_user",
                    "view_user_full",
                    "view_landlord",
                    "edit_landlord",
                    "view_resident",
                    "edit_resident",
                    "view_resident_staff",
                    "view_street",
                    "edit_street",
                    "view_due",
                    "edit_due",
                    "view_message",
                    "edit_message",
                    "view_payment",
                    "edit_payment",
                    "view_settings",
                    "edit_settings",
                    "view_personnel",
                    "edit_personnel",
                    "view_role",
                    "edit_role",
                    "grant_admin_role"
                ]);
                $role->save();
            }

            if ($role->name == 'SuperAdmin') {
                $role->permissions =
                json_encode([
                    "view_admin",
                    "view_visitor",
                    "edit_visitor",
                    "view_incident",
                    "edit_incident",
                    "view_user_partial",
                    "view_user",
                    "view_user_full",
                    "view_landlord",
                    "edit_landlord",
                    "view_resident",
                    "edit_resident",
                    "view_resident_staff",
                    "view_street",
                    "edit_street",
                    "view_due",
                    "edit_due",
                    "view_message",
                    "edit_message",
                    "view_payment",
                    "edit_payment",
                    "view_settings",
                    "edit_settings",
                    "view_personnel",
                    "edit_personnel",
                    "view_role",
                    "edit_role",
                    "grant_admin_role"
                ]);
                $role->save();
            }
        }
    }
}
