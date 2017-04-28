<?php
/**
 * ownCloud - seeker
 *
 * This file is licensed under the Affero General Public License version 3 or
 * later. See the COPYING file.
 *
 * @author Daugieras <adau828@aucklanduni.ac.nz>
 * @copyright Daugieras 2017
 */

/**
 * Create your routes in here. The name is the lowercase name of the controller
 * without the controller part, the stuff after the hash is the method.
 * e.g. page#index -> OCA\Seeker\Controller\PageController->index()
 *
 * The controller class has to be registered in the application.php file since
 * it's instantiated in there
 */
return [
    'routes' => [
	   ['name' => 'page#index', 'url' => '/', 'verb' => 'GET'],
	   ['name' => 'page#getUser', 'url' => '/user', 'verb' => 'POST'],
	   ['name' => 'page#getOwner', 'url' => '/owner', 'verb' => 'POST'],
	   ['name' => 'page#download', 'url' => '/download', 'verb' => 'POST'],
    ]
];
