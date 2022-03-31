<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PermissionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'label_permission' => $this->faker->unique()->randomElement($array = array(

                // user_management
                'user_management_access',

                //permission
                'permission_access',
                'permission_create',
                'permission_edit',
                'permission_show',
                'permission_delete',

                //role
                'role_access',
                'role_create',
                'role_edit',
                'role_show',
                'role_delete',

                //user
                'user_access',
                'user_create',
                'user_edit',
                'user_show',
                'user_delete',

                //password_edit
                'profile_password_edit',

                //category
                'category_access',
                'category_create',
                'category_edit',
                'category_show',
                'category_delete',

                //client
                'client_access',
                'client_create',
                'client_edit',
                'client_show',
                'client_delete',

                //service
                'service_access',
                'service_create',
                'service_edit',
                'service_show',
                'service_delete',

                //ticket
                'ticket_access',
                'ticket_create',
                'ticket_edit',
                'ticket_show',
                'ticket_delete',
            )),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
