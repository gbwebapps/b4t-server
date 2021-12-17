<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.

/*
 * --------------------------------------------------------------------
 * Frontend
 * --------------------------------------------------------------------
 */
$routes->get('/', 'frontend\HomeController::index'); // This is going to the site home page

$routes->group('circuits', function($routes)
{
    $routes->get('/', 'frontend\CircuitsController::index'); // Lista dei CIRCUITI - PUBBLICA
    $routes->post('indexAction', 'frontend\CircuitsController::indexAction'); // Chiamata AJAX per visualizzare la lista in AJAX - PUBBLICA
    $routes->get('(:any)', 'frontend\CircuitsController::show/$1'); // Dettaglio del circuito - PUBBLICA
    $routes->post('getSubAction', 'frontend\CircuitsController::getSubAction'); // Chiamata AJAX per visualizzare la lista degli eventi di questo circuito - PUBBLICA
});

$routes->group('organizers', function($routes) // GLI ORGANIZZATORI
{
    $routes->get('account', function(){
        return redirect('organizers/account/dashboard');
    });

    $routes->group('account', function($routes)
    {
        $routes->get('dashboard', 'frontend\OrganizersController::dashboard', ['filter' => 'organizersAuthorization']);

        $routes->get('profile', 'frontend\OrganizersController::profile', ['filter' => 'organizersAuthorization']);
        $routes->post('profileAction', 'frontend\OrganizersController::profileAction', ['filter' => 'organizersAuthorization']);

        $routes->get('events', 'frontend\OrganizersController::events', ['filter' => 'organizersAuthorization']);
        $routes->post('eventsAction', 'frontend\OrganizersController::eventsAction', ['filter' => 'organizersAuthorization']);

        $routes->get('eventsAdd', 'frontend\OrganizersController::eventsAdd', ['filter' => 'organizersAuthorization']);
        $routes->get('eventsAddOutput', 'frontend\OrganizersController::eventsAddOutput', ['filter' => 'organizersAuthorization']);
        $routes->post('eventsAddAction', 'frontend\OrganizersController::eventsAddAction', ['filter' => 'organizersAuthorization']);

        $routes->get('eventsEdit/(:num)', 'frontend\OrganizersController::eventsEdit/$1', ['filter' => 'organizersAuthorization']);
        $routes->get('eventsEditOutput', 'frontend\OrganizersController::eventsEditOutput', ['filter' => 'organizersAuthorization']);
        $routes->post('eventsEditAction', 'frontend\OrganizersController::eventsEditAction', ['filter' => 'organizersAuthorization']);

        $routes->post('eventsDeleteAction', 'frontend\OrganizersController::eventsDeleteAction', ['filter' => 'organizersAuthorization']);

        $routes->get('news', 'frontend\OrganizersController::news', ['filter' => 'organizersAuthorization']);
        $routes->post('newsAction', 'frontend\OrganizersController::newsAction', ['filter' => 'organizersAuthorization']);

        $routes->get('newsAdd', 'frontend\OrganizersController::newsAdd', ['filter' => 'organizersAuthorization']);
        $routes->get('newsAddOutput', 'frontend\OrganizersController::newsAddOutput', ['filter' => 'organizersAuthorization']);
        $routes->post('newsAddAction', 'frontend\OrganizersController::newsAddAction', ['filter' => 'organizersAuthorization']);

        $routes->get('newsEdit/(:num)', 'frontend\OrganizersController::newsEdit/$1', ['filter' => 'organizersAuthorization']);
        $routes->get('newsEditOutput', 'frontend\OrganizersController::newsEditOutput', ['filter' => 'organizersAuthorization']);
        $routes->post('newsEditAction', 'frontend\OrganizersController::newsEditAction', ['filter' => 'organizersAuthorization']);

        $routes->post('newsDeleteAction', 'frontend\OrganizersController::newsDeleteAction', ['filter' => 'organizersAuthorization']);

        $routes->get('orders', 'frontend\OrganizersController::orders', ['filter' => 'organizersAuthorization']);
        $routes->post('ordersAction', 'frontend\OrganizersController::ordersAction', ['filter' => 'organizersAuthorization']);
    });

    $routes->get('login', 'frontend\OrganizersController::login', ['filter' => 'noOrganizersAuthorization']);
    $routes->post('loginAction', 'frontend\OrganizersController::loginAction');

    $routes->get('recovery', 'frontend\OrganizersController::recovery', ['filter' => 'noOrganizersAuthorization']);
    $routes->post('recoveryAction', 'frontend\OrganizersController::recoveryAction');

    $routes->get('setPassword/(:any)', 'frontend\OrganizersController::setPassword/$1', ['filter' => 'noOrganizersAuthorization']);
    $routes->post('setPasswordAction', 'frontend\OrganizersController::setPasswordAction');

    $routes->get('logout', 'frontend\OrganizersController::logout');

    $routes->get('/', 'frontend\OrganizersController::index');
    $routes->post('indexAction', 'frontend\OrganizersController::indexAction');

    $routes->get('(:any)', 'frontend\OrganizersController::show/$1');

    $routes->post('getSubAction', 'frontend\OrganizersController::getSubAction');

    $routes->post('getNewsAction', 'frontend\OrganizersController::getNewsAction');
});

$routes->group('events', function($routes) // GLI EVENTI
{
    $routes->get('/', 'frontend\EventsController::index');

    $routes->post('indexAction', 'frontend\EventsController::indexAction');
    $routes->get('(:any)', 'frontend\EventsController::show/$1');
});

$routes->group('news', function($routes) // LE NEWS
{
    $routes->get('/', 'frontend\NewsController::index');

    $routes->post('indexAction', 'frontend\NewsController::indexAction');
    $routes->get('(:any)', 'frontend\NewsController::show/$1');
});

$routes->group('members', function($routes)
{
    $routes->get('/', function(){
        return redirect('members/account/dashboard');
    });

    $routes->get('account', function(){
        return redirect('members/account/dashboard');
    });

    $routes->group('account', function($routes)
    {
        $routes->get('dashboard', 'frontend/MembersController::dashboard', ['filter' => 'membersAuthorization']);

        $routes->get('profile', 'frontend\MembersController::profile', ['filter' => 'membersAuthorization']);
        $routes->post('profileAction', 'frontend\MembersController::profileAction', ['filter' => 'membersAuthorization']);

        $routes->get('orders', 'frontend/MembersController::orders', ['filter' => 'membersAuthorization']);
        $routes->post('ordersAction', 'frontend\MembersController::ordersAction', ['filter' => 'membersAuthorization']);
    });

    $routes->get('login', 'frontend\MembersController::login', ['filter' => 'noMembersAuthorization']);
    $routes->post('loginAction', 'frontend\MembersController::loginAction');

    $routes->get('recovery', 'frontend\MembersController::recovery', ['filter' => 'noMembersAuthorization']);
    $routes->post('recoveryAction', 'frontend\MembersController::recoveryAction');

    $routes->get('setPassword/(:any)', 'frontend\MembersController::setPassword/$1', ['filter' => 'noMembersAuthorization']);
    $routes->post('setPasswordAction', 'frontend\MembersController::setPasswordAction');

    $routes->get('register', 'frontend\MembersController::register', ['filter' => 'noMembersAuthorization']);
    $routes->post('registerAction', 'frontend\MembersController::registerAction');

    $routes->get('logout', 'frontend\MembersController::logout');
});

$routes->group('contacts', function($routes) // LE NEWS
{
    $routes->get('/', 'frontend\ContactsController::index'); // PAGINA DEI CONTATTI
    $routes->post('indexAction', 'frontend\ContactsController::indexAction'); // Chiamata AJAX per inviare il form di contatto - PUBBLICA
});

$routes->post('/', 'frontend\AttachementsController::index'); // ATTACHEMENTS

/*
 * --------------------------------------------------------------------
 * Backend
 * --------------------------------------------------------------------
 */
$routes->get('admin', function(){
    return redirect('admin/dashboard');
});

$routes->group('admin', function($routes)
{
    $routes->group('auth', function($routes) // AUTH
    {
        $routes->get('/', function(){
            return redirect('admin/dashboard');
        });

        $routes->get('login', 'backend\AuthController::login', ['filter' => 'usersnoauthorization']);
        $routes->post('loginAction', 'backend\AuthController::loginAction');

        $routes->get('recovery', 'backend\AuthController::recovery', ['filter' => 'usersnoauthorization']);
        $routes->post('recoveryAction', 'backend\AuthController::recoveryAction');

        $routes->get('setPassword/(:any)', 'backend\AuthController::setPassword/$1', ['filter' => 'usersnoauthorization']);
        $routes->post('setPasswordAction', 'backend\AuthController::setPasswordAction');

        $routes->get('logout', 'backend\AuthController::logout');
    });

    $routes->group('dashboard', function($routes) // DASHBOARD
    {
        $routes->get('/', 'backend/DashboardController::index', ['filter' => 'usersauthorization']);
        $routes->get('getGeneralStats', 'backend/DashboardController::getGeneralStats', ['filter' => 'usersauthorization']);
    });

    $routes->group('home', function($routes) // HOME
    {
        $routes->get('/', 'backend/HomeController::index', ['filter' => 'usersauthorization']);

        $routes->post('sectionAction', 'backend\HomeController::sectionAction', ['filter' => 'usersauthorization']);
    });

    $routes->group('circuits', function($routes) // CIRCUITS
    {
        $routes->get('/', 'backend\CircuitsController::index', ['filter' => 'usersauthorization']);

        $routes->get('showAll', 'backend\CircuitsController::showAll', ['filter' => 'usersauthorization']);
        $routes->post('showAllAction', 'backend\CircuitsController::showAllAction', ['filter' => 'usersauthorization']);

        $routes->get('add', 'backend\CircuitsController::add', ['filter' => 'usersauthorization']);
        $routes->get('addOutput', 'backend\CircuitsController::addOutput', ['filter' => 'usersauthorization']);
        $routes->post('addAction', 'backend\CircuitsController::addAction', ['filter' => 'usersauthorization']);

        $routes->get('edit/(:num)', 'backend\CircuitsController::edit/$1', ['filter' => 'usersauthorization']);
        $routes->post('editOutput', 'backend\CircuitsController::editOutput', ['filter' => 'usersauthorization']);
        $routes->post('editAction', 'backend\CircuitsController::editAction', ['filter' => 'usersauthorization']);

        $routes->get('show/(:num)', 'backend\CircuitsController::show/$1', ['filter' => 'usersauthorization']);

        $routes->post('deleteAction', 'backend\CircuitsController::deleteAction', ['filter' => 'usersauthorization']);

        $routes->post('getTypesServices', 'backend\CircuitsController::getTypesServices', ['filter' => 'usersauthorization']);
        $routes->get('removeTypesServices', 'backend\CircuitsController::removeTypesServices', ['filter' => 'usersauthorization']);
        $routes->post('selectServices', 'backend\CircuitsController::selectServices', ['filter' => 'usersauthorization']);

        $routes->post('sectionAction', 'backend\CircuitsController::sectionAction', ['filter' => 'usersauthorization']);
        $routes->post('removeSectionAttachement', 'backend\CircuitsController::removeSectionAttachement', ['filter' => 'usersauthorization']);
    });

    $routes->group('organizers', function($routes) // ORGANIZERS
    {
        $routes->get('/', 'backend\OrganizersController::index', ['filter' => 'usersauthorization']);

        $routes->get('showAll', 'backend\OrganizersController::showAll', ['filter' => 'usersauthorization']);
        $routes->post('showAllAction', 'backend\OrganizersController::showAllAction', ['filter' => 'usersauthorization']);

        $routes->get('add', 'backend\OrganizersController::add', ['filter' => 'usersauthorization']);
        $routes->get('addOutput', 'backend\OrganizersController::addOutput', ['filter' => 'usersauthorization']);
        $routes->post('addAction', 'backend\OrganizersController::addAction', ['filter' => 'usersauthorization']);

        $routes->get('edit/(:num)', 'backend\OrganizersController::edit/$1', ['filter' => 'usersauthorization']);
        $routes->post('editOutput', 'backend\OrganizersController::editOutput', ['filter' => 'usersauthorization']);
        $routes->post('editAction', 'backend\OrganizersController::editAction', ['filter' => 'usersauthorization']);

        $routes->get('show/(:num)', 'backend\OrganizersController::show/$1', ['filter' => 'usersauthorization']);

        $routes->post('deleteAction', 'backend\OrganizersController::deleteAction', ['filter' => 'usersauthorization']);

        $routes->post('getCircuitsTypes', 'backend\OrganizersController::getCircuitsTypes', ['filter' => 'usersauthorization']);
        $routes->get('removeCircuitsTypes', 'backend\OrganizersController::removeCircuitsTypes', ['filter' => 'usersauthorization']);
        $routes->post('selectTypes', 'backend\OrganizersController::selectTypes', ['filter' => 'usersauthorization']);

        $routes->post('sectionAction', 'backend\OrganizersController::sectionAction', ['filter' => 'usersauthorization']);
        $routes->post('removeSectionAttachement', 'backend\OrganizersController::removeSectionAttachement', ['filter' => 'usersauthorization']);
    });

    $routes->group('events', function($routes) // EVENTS
    {
        $routes->get('/', 'backend\EventsController::index', ['filter' => 'usersauthorization']);

        $routes->get('showAll', 'backend\EventsController::showAll', ['filter' => 'usersauthorization']);
        $routes->post('showAllAction', 'backend\EventsController::showAllAction', ['filter' => 'usersauthorization']);

        $routes->get('add', 'backend\EventsController::add', ['filter' => 'usersauthorization']);
        $routes->get('addOutput', 'backend\EventsController::addOutput', ['filter' => 'usersauthorization']);
        $routes->post('addAction', 'backend\EventsController::addAction', ['filter' => 'usersauthorization']);

        $routes->get('edit/(:num)', 'backend\EventsController::edit/$1', ['filter' => 'usersauthorization']);
        $routes->post('editOutput', 'backend\EventsController::editOutput', ['filter' => 'usersauthorization']);
        $routes->post('editAction', 'backend\EventsController::editAction', ['filter' => 'usersauthorization']);

        $routes->get('show/(:num)', 'backend\EventsController::show/$1', ['filter' => 'usersauthorization']);

        $routes->post('deleteAction', 'backend\EventsController::deleteAction', ['filter' => 'usersauthorization']);

        $routes->post('selectOrganizer', 'backend\EventsController::selectOrganizer', ['filter' => 'usersauthorization']);
        $routes->post('selectCircuit', 'backend\EventsController::selectCircuit', ['filter' => 'usersauthorization']);
        $routes->post('getDatesSlots', 'backend\EventsController::getDatesSlots', ['filter' => 'usersauthorization']);
        $routes->get('removeDatesSlots', 'backend\EventsController::removeDatesSlots', ['filter' => 'usersauthorization']);
        $routes->post('getServices', 'backend\EventsController::getServices', ['filter' => 'usersauthorization']);
        $routes->get('removeServices', 'backend\EventsController::removeServices', ['filter' => 'usersauthorization']);

        $routes->post('sectionAction', 'backend\EventsController::sectionAction', ['filter' => 'usersauthorization']);
        $routes->post('removeSectionAttachement', 'backend\EventsController::removeSectionAttachement', ['filter' => 'usersauthorization']);
        $routes->post('statusAction', 'backend\EventsController::statusAction', ['filter' => 'usersauthorization']);
    });

    $routes->group('transactions', function($routes) // TRANSACTIONS
    {
        $routes->get('/', function(){
            return redirect('admin/transactions/showAll');
        });

        $routes->get('showAll', 'backend\TransactionsController::showAll', ['filter' => 'usersauthorization']);
        $routes->post('showAllAction', 'backend\TransactionsController::showAllAction', ['filter' => 'usersauthorization']);

        $routes->get('add', 'backend\TransactionsController::add', ['filter' => 'usersauthorization']);
        $routes->get('addOutput', 'backend\TransactionsController::addOutput', ['filter' => 'usersauthorization']);
        $routes->post('addAction', 'backend\TransactionsController::addAction', ['filter' => 'usersauthorization']);

        $routes->get('show/(:num)', 'backend\TransactionsController::show/$1', ['filter' => 'usersauthorization']);
    });

    $routes->group('orders', function($routes) // ORDERS
    {
        $routes->get('/', function(){
            return redirect('admin/orders/showAll');
        });

        $routes->get('showAll', 'backend\OrdersController::showAll', ['filter' => 'usersauthorization']);
        $routes->post('showAllAction', 'backend\OrdersController::showAllAction', ['filter' => 'usersauthorization']);

        $routes->get('add', 'backend\OrdersController::add', ['filter' => 'usersauthorization']);
        $routes->get('addOutput', 'backend\OrdersController::addOutput', ['filter' => 'usersauthorization']);
        $routes->post('addAction', 'backend\OrdersController::addAction', ['filter' => 'usersauthorization']);

        $routes->get('edit/(:num)', 'backend\OrdersController::edit/$1', ['filter' => 'usersauthorization']);
        $routes->post('editOutput', 'backend\OrdersController::editOutput', ['filter' => 'usersauthorization']);
        $routes->post('editAction', 'backend\OrdersController::editAction', ['filter' => 'usersauthorization']);

        $routes->post('deleteAction', 'backend\OrdersController::deleteAction', ['filter' => 'usersauthorization']);
    });

    $routes->group('members', function($routes) // MEMBERS
    {
        $routes->get('/', function(){
            return redirect('admin/members/showAll');
        });

        $routes->get('showAll', 'backend\MembersController::showAll', ['filter' => 'usersauthorization']);
        $routes->post('showAllAction', 'backend\MembersController::showAllAction', ['filter' => 'usersauthorization']);

        $routes->get('show/(:num)', 'backend\MembersController::show/$1', ['filter' => 'usersauthorization']);

        $routes->post('deleteAction', 'backend\MembersController::deleteAction', ['filter' => 'usersauthorization']);
        $routes->post('statusAction', 'backend\MembersController::statusAction', ['filter' => 'usersauthorization']);
    });

    $routes->group('comments', function($routes) // COMMENTS
    {
        $routes->get('/', function(){
            return redirect('admin/comments/showAll');
        });

        $routes->get('showAll', 'backend\CommentsController::showAll', ['filter' => 'usersauthorization']);
        $routes->post('showAllAction', 'backend\CommentsController::showAllAction', ['filter' => 'usersauthorization']);

        $routes->get('add', 'backend\CommentsController::add', ['filter' => 'usersauthorization']);
        $routes->get('addOutput', 'backend\CommentsController::addOutput', ['filter' => 'usersauthorization']);
        $routes->post('addAction', 'backend\CommentsController::addAction', ['filter' => 'usersauthorization']);

        $routes->get('edit/(:num)', 'backend\CommentsController::edit/$1', ['filter' => 'usersauthorization']);
        $routes->post('editOutput', 'backend\CommentsController::editOutput', ['filter' => 'usersauthorization']);
        $routes->post('editAction', 'backend\CommentsController::editAction', ['filter' => 'usersauthorization']);

        $routes->get('show/(:num)', 'backend\CommentsController::show/$1', ['filter' => 'usersauthorization']);

        $routes->post('deleteAction', 'backend\CommentsController::deleteAction', ['filter' => 'usersauthorization']);
        $routes->post('statusAction', 'backend\CommentsController::statusAction', ['filter' => 'usersauthorization']);
    });

    $routes->group('news', function($routes) // NEWS
    {
        $routes->get('/', 'backend\NewsController::index', ['filter' => 'usersauthorization']);

        $routes->get('showAll', 'backend\NewsController::showAll', ['filter' => 'usersauthorization']);
        $routes->post('showAllAction', 'backend\NewsController::showAllAction', ['filter' => 'usersauthorization']);

        $routes->get('add', 'backend\NewsController::add', ['filter' => 'usersauthorization']);
        $routes->get('addOutput', 'backend\NewsController::addOutput', ['filter' => 'usersauthorization']);
        $routes->post('addAction', 'backend\NewsController::addAction', ['filter' => 'usersauthorization']);

        $routes->get('edit/(:num)', 'backend\NewsController::edit/$1', ['filter' => 'usersauthorization']);
        $routes->post('editOutput', 'backend\NewsController::editOutput', ['filter' => 'usersauthorization']);
        $routes->post('editAction', 'backend\NewsController::editAction', ['filter' => 'usersauthorization']);

        $routes->get('show/(:num)', 'backend\NewsController::show/$1', ['filter' => 'usersauthorization']);

        $routes->post('deleteAction', 'backend\NewsController::deleteAction', ['filter' => 'usersauthorization']);
        $routes->post('removeSectionAttachement', 'backend\NewsController::removeSectionAttachement', ['filter' => 'usersauthorization']);

        $routes->post('sectionAction', 'backend\NewsController::sectionAction', ['filter' => 'usersauthorization']);
        $routes->post('inHomeAction', 'backend\NewsController::inHomeAction', ['filter' => 'usersauthorization']);
        $routes->post('statusAction', 'backend\NewsController::statusAction', ['filter' => 'usersauthorization']);
    });

    $routes->group('contacts', function($routes) // MEMBERS
    {
        $routes->get('/', 'backend\ContactsController::index', ['filter' => 'usersauthorization']);

        $routes->get('showAll', 'backend\ContactsController::showAll', ['filter' => 'usersauthorization']);
        $routes->post('showAllAction', 'backend\ContactsController::showAllAction', ['filter' => 'usersauthorization']);

        $routes->get('show/(:num)', 'backend\ContactsController::show/$1', ['filter' => 'usersauthorization']);

        $routes->post('deleteAction', 'backend\ContactsController::deleteAction', ['filter' => 'usersauthorization']);

        $routes->post('sectionAction', 'backend\ContactsController::sectionAction', ['filter' => 'usersauthorization']);
        $routes->post('removeSectionAttachement', 'backend\ContactsController::removeSectionAttachement', ['filter' => 'usersauthorization']);
    });

    $routes->group('users', function($routes) // USERS
    {
        $routes->get('/', function(){
            return redirect('admin/users/showAll');
        });

        $routes->get('showAll', 'backend\UsersController::showAll', ['filter' => 'usersauthorizationrole']);
        $routes->post('showAllAction', 'backend\UsersController::showAllAction', ['filter' => 'usersauthorizationrole']);

        $routes->get('add', 'backend\UsersController::add', ['filter' => 'usersauthorizationrole']);
        $routes->get('addOutput', 'backend\UsersController::addOutput', ['filter' => 'usersauthorizationrole']);
        $routes->post('addAction', 'backend\UsersController::addAction', ['filter' => 'usersauthorizationrole']);

        $routes->get('edit/(:num)', 'backend\UsersController::edit/$1', ['filter' => 'usersauthorizationrole']);
        $routes->post('editOutput', 'backend\UsersController::editOutput', ['filter' => 'usersauthorizationrole']);
        $routes->post('editAction', 'backend\UsersController::editAction', ['filter' => 'usersauthorizationrole']);

        $routes->get('account/(:any)', 'backend\UsersController::account/$1', ['filter' => 'usersauthorization']);
        $routes->post('accountOutput', 'backend\UsersController::accountOutput', ['filter' => 'usersauthorization']);
        $routes->post('accountAction', 'backend\UsersController::accountAction', ['filter' => 'usersauthorization']);

        $routes->post('removeAvatar', 'backend\UsersController::removeAvatar', ['filter' => 'usersauthorizationrole']);
        $routes->post('resetPassword', 'backend\UsersController::resetPassword', ['filter' => 'usersauthorizationrole']);

        $routes->get('show/(:num)', 'backend\UsersController::show/$1', ['filter' => 'usersauthorizationrole']);

        $routes->post('deleteAction', 'backend\UsersController::deleteAction', ['filter' => 'usersauthorizationrole']);
        $routes->post('statusAction', 'backend\UsersController::statusAction', ['filter' => 'usersauthorizationrole']);
        $routes->post('roleAction', 'backend\UsersController::roleAction', ['filter' => 'usersauthorizationrole']);
    });

    $routes->group('frontendsettings', function($routes) // FRONTEND SETTINGS
    {
        $routes->get('/', 'backend\FrontendSettingsController::index', ['filter' => 'usersauthorizationrole']);

        $routes->post('sectionAction', 'backend\FrontendSettingsController::sectionAction', ['filter' => 'usersauthorizationrole']);
    });

    $routes->group('backendsettings', function($routes) // BACKEND SETTINGS
    {
        $routes->get('/', 'backend\BackendSettingsController::index', ['filter' => 'usersauthorizationrole']);
    });

    $routes->group('tools', function($routes) // TOOLS
    {
        $routes->get('/', 'backend\ToolsController::index', ['filter' => 'usersauthorizationrole']);
    });

    $routes->group('attachements', function($routes)
    {
        $routes->post('showAttachements', 'backend\AttachementsController::showAttachements', ['filter' => 'usersauthorization']);
        $routes->post('deleteAttachement', 'backend\AttachementsController::deleteAttachement', ['filter' => 'usersauthorization']);
        $routes->post('setCoverAttachement', 'backend\AttachementsController::setCoverAttachement', ['filter' => 'usersauthorization']);
        $routes->post('removeCoverAttachement', 'backend\AttachementsController::removeCoverAttachement', ['filter' => 'usersauthorization']);
    });
});

/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
