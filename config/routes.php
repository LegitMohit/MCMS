<?php
/**
 * Routes configuration.
 *
 * In this file, you set up routes to your controllers and their actions.
 * Routes are very important mechanism that allows you to freely connect
 * different URLs to chosen controllers and their actions (functions).
 *
 * It's loaded within the context of `Application::routes()` method which
 * receives a `RouteBuilder` instance `$routes` as method argument.
 *
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */

use Cake\Routing\Route\DashedRoute;
use Cake\Routing\RouteBuilder;

/*
 * This file is loaded in the context of the `Application` class.
  * So you can use  `$this` to reference the application class instance
  * if required.
 */
return function (RouteBuilder $routes): void {
    /*
     * The default class to use for all routes
     *
     * The following route classes are supplied with CakePHP and are appropriate
     * to set as the default:
     *
     * - Route
     * - InflectedRoute
     * - DashedRoute
     *
     * If no call is made to `Router::defaultRouteClass()`, the class used is
     * `Route` (`Cake\Routing\Route\Route`)
     *
     * Note that `Route` does not do any inflections on URLs which will result in
     * inconsistently cased URLs when used with `{plugin}`, `{controller}` and
     * `{action}` markers.
     */
    $routes->setRouteClass(DashedRoute::class);

    $routes->scope('/', function (RouteBuilder $builder): void {
        /*
         * Here, we are connecting '/' (base path) to a controller called 'Pages',
         * its action called 'display', and we pass a param to select the view file
         * to use (in this case, templates/Pages/home.php)...
         */
        $builder->connect('/', ['controller' => 'home', 'action' => 'index']);

        $builder->scope('/users', function (RouteBuilder $builder): void {
            $builder->connect('/', ['controller' => 'users', 'action' => 'index']);

            $builder->connect('/signup', ['controller' => 'users', 'action' => 'signup']);

            $builder->connect('/login', ['controller' => 'users', 'action' => 'login']);

            $builder->connect('/logout', ['controller' => 'users', 'action' => 'logout']);
        });

        $builder->scope('/patients', function (RouteBuilder $builder): void {
            $builder->connect('/', ['controller' => 'patients', 'action' => 'index']);

            $builder->connect('/add', ['controller' => 'patients', 'action' => 'add_patients']);

            $builder->connect('/delete/{id}', ['controller' => 'patients', 'action' => 'delete'], ['pass' => ['id']]);
        
            $builder->connect('/edit/{id}', ['controller' => 'patients', 'action' => 'edit'], ['pass' => ['id']]);

            
        }); 

        $builder->scope('/doctors', function (RouteBuilder $builder): void {
            $builder->connect('/', ['controller' => 'doctors', 'action' => 'index']);

            $builder->connect('/add', ['controller' => 'doctors', 'action' => 'add_doctors']);

            $builder->connect('/delete/{id}', ['controller' => 'doctors', 'action' => 'delete'], ['pass' => ['id']]);

            $builder->connect('/edit/{id}', ['controller' => 'doctors', 'action' => 'edit'], ['pass' => ['id']]);
        });

        $builder->scope('/appointments', function (RouteBuilder $builder): void {
            $builder->connect('/', ['controller' => 'appointments', 'action' => 'index']);

            $builder->connect('/add', ['controller' => 'appointments', 'action' => 'add_appointments']);

            $builder->connect('/delete/{id}', ['controller' => 'appointments', 'action' => 'delete'], ['pass' => ['id']]);

            $builder->connect('/edit/{id}', ['controller' => 'appointments', 'action' => 'edit'], ['pass' => ['id']]);
        });

        
        /*
         * ...and connect the rest of 'Pages' controller's URLs.
         */
        $builder->connect('/pages/*', 'Pages::display');

        /*
         * Connect catchall routes for all controllers.
         *
         * The `fallbacks` method is a shortcut for
         *
         * ```
         * $builder->connect('/{controller}', ['action' => 'index']);
         * $builder->connect('/{controller}/{action}/*', []);
         * ```
         *
         * You can remove these routes once you've connected the
         * routes you want in your application.
         */
        $builder->fallbacks();
    });

    $routes->scope('/api', function (RouteBuilder $builder): void {
        // Parse specified extensions from URLs
        $builder->setExtensions(['json']);
        // Connect /api/users to UsersController::userApi
        $builder->connect('/users', ['controller' => 'Users', 'action' => 'userApi']);

        $builder->connect('/users/{id}', ['controller' => 'Users', 'action' => 'view'], ['pass' => ['id']]);

        $builder->connect('/patients', ['controller' => 'Patients', 'action' => 'patientApi']);

        $builder->connect('/patients/{id}', ['controller' => 'Patients', 'action' => 'view'], ['pass' => ['id']]);

        $builder->connect('/doctors', ['controller' => 'Doctors', 'action' => 'doctorApi']);

        $builder->connect('/doctors/{id}', ['controller' => 'Doctors', 'action' => 'view'], ['pass' => ['id']]);

        $builder->connect('/appointments', ['controller' => 'Appointments', 'action' => 'appointmentApi']);

        $builder->connect('/appointments/{id}', ['controller' => 'Appointments', 'action' => 'view'], ['pass' => ['id']]);

        // Connect /api/user (POST) to UsersController::addUser
        // $builder->connect('/user', ['controller' => 'Users', 'action' => 'addUser'], ['_method' => 'POST']);
    });

    /*
     * If you need a different set of middleware or none at all,
     * open new scope and define routes there.
     *
     * ```
     * $routes->scope('/api', function (RouteBuilder $builder): void {
     *     // No $builder->applyMiddleware() here.
     *
     *     // Parse specified extensions from URLs
     *     // $builder->setExtensions(['json', 'xml']);
     *
     *     // Connect API actions here.
     * });
     * ```
     */
};
