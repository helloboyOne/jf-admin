<?php

namespace Imzhi\JFAdmin;

/**
 * Class JFAdmin.
 */
class JFAdmin
{
    const VERSION = '1.0.0';

    public function routes()
    {
        $attributes = [
            'prefix' => config('jfadmin.route.prefix'),
            'as' => config('jfadmin.route.as'),
            'domain' => config('jfadmin.route.domain'),
            'middleware' => 'web',
            'namespace' => '\Imzhi\JFAdmin\Controllers',
        ];
        app('router')->group($attributes, function ($router) {
            $router->get('login', 'Auth\LoginController@showLoginForm')->name('show.login');
            $router->post('login', 'Auth\LoginController@login')->name('login');
            $router->get('logout', 'Auth\LoginController@logout')->name('logout');

            $router->middleware('jfadmin')->group(function ($router) {
                // 修改密码
                $router->get('profile/pwd', 'ProfileController@showPwd')->name('show.profile.pwd');
                $router->post('profile/pwd', 'ProfileController@pwd')->name('profile.pwd');

                // 管理员管理-成员管理
                $router->get('manageuser/list', 'ManageUserController@showList')->name('show.manageuser.list');
                $router->get('manageuser/create/{id?}', 'ManageUserController@showCreate')->name('show.manageuser.create');
                $router->post('manageuser/create', 'ManageUserController@create')->name('manageuser.create');
                $router->post('manageuser/status', 'ManageUserController@status')->name('manageuser.status');
                $router->get('manageuser/distribute/{id}', 'ManageUserController@showDistribute')->name('show.manageuser.distribute');
                $router->post('manageuser/distribute', 'ManageUserController@distribute')->name('manageuser.distribute');

                // 管理员管理-角色管理
                $router->get('manageuser/roles', 'ManageUserController@showRoles')->name('show.manageuser.roles');
                $router->get('manageuser/roles/create/{id?}', 'ManageUserController@showRolesCreate')->name('show.manageuser.roles.create');
                $router->post('manageuser/roles/create', 'ManageUserController@rolesCreate')->name('manageuser.roles.create');
                $router->get('manageuser/roles/distribute/{id}', 'ManageUserController@showRolesDistribute')->name('show.manageuser.roles.distribute');
                $router->post('manageuser/roles/distribute', 'ManageUserController@rolesDistribute')->name('manageuser.roles.distribute');

                // 管理员管理-权限管理
                $router->get('manageuser/permissions', 'ManageUserController@showPermissions')->name('show.manageuser.permissions');
                $router->post('manageuser/permissions/detect', 'ManageUserController@permissionsDetect')->name('manageuser.permissions.detect');
                $router->post('manageuser/permissions/group', 'ManageUserController@permissionsGroup')->name('manageuser.permissions.group');

                // 系统设置
                $router->get('setting/log', 'SettingController@showLog')->name('show.setting.log');
            });
        });
    }
}