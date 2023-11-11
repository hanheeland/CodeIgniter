<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/board', 'Board::list');
$routes->get('/boardWrite', 'Board::write');
$routes->match(['get', 'post'], 'writeSave', 'Board::save');
$routes->get('/boardView/(:num)', 'Board::view/$1');
$routes->get('/modify/(:num)', 'Board::modify/$1');
$routes->match(['get', 'post'], 'updateSave', 'Board::update');
$routes->get('/delete/(:num)', 'Board::delete/$1');
$routes->get('naverSearchAPI', 'NaverSearchAPI::SearchTrand');