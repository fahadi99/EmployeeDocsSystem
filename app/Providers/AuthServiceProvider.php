<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();

        //Special Account for google
        Gate::define('google_default',function($user){
          $email = 'hrlsmartoffice@gmail.com';
          return $user->CanUseGoogleCalenderWithDefaultHost($email);
      });

      //Special Account for google
      Gate::define('google',function($user){
          return $user->CanUseGoogleCalender();
      });

      Gate::define('manage-meetings',function($user){
          return $user->hasRoleAdminOrSuperAdmin();
      });

      Gate::define('meetings-all',function($user){
          return $user->hasRoleAdminOrSuperAdmin();
      });

      Gate::define('meeting-delete',function($user){
          return $user->hasRoleAdminOrSuperAdmin();
      });


      Gate::define('is_super_admin',function($user){
          return $user->hasRoleSuperAdmin(3);
      });

      Gate::define('is_admin',function($user){
          return $user->hasRoleAdmin(2);
      });

      Gate::define('manage-settings',function($user){
          return $user->hasRoleAdminOrSuperAdmin();
      });

      Gate::define('manage-users',function($user){
          return $user->hasRoleAdminOrSuperAdmin();
      });

      Gate::define('is_guest',function($user){
          return $user->UserIsGuest();
      });

      Gate::define('is_member',function($user){
          return $user->IsGeneralMember();
      });

      Gate::define('member',function($user){
          return $user->hasRoleMember(1);
      });



      Gate::define('create-meeting',function($user){
          return !$user->UserIsGuest();
      });
    }
}
