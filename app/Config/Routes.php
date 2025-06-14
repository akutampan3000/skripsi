<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// Auth Routes
$routes->get('/', 'Auth::login');
$routes->get('/auth/login', 'Auth::login');
$routes->post('/auth/authenticate', 'Auth::authenticate');
$routes->get('/auth/register', 'Auth::register');
$routes->post('/auth/processRegistration', 'Auth::processRegistration');
$routes->get('/auth/logout', 'Auth::logout');

// User Dashboard
$routes->get('/dashboard', 'Auth::dashboard', ['filter' => 'auth']);

// Diagnosa & User-facing Routes (Riwayat, Daftar Sparepart)
// Semua rute di sini memerlukan user untuk login
$routes->group('diagnosa', ['filter' => 'auth'], function($routes) {
    $routes->get('/', 'Diagnosa::index');
    $routes->get('brand', 'Diagnosa::brand');
    $routes->post('process-brand', 'Diagnosa::processBrand');
    $routes->get('problem-type', 'Diagnosa::problemType');
    $routes->post('process-problem-type', 'Diagnosa::processProblemType');
    $routes->get('question', 'Diagnosa::question');
    $routes->post('process-answer', 'Diagnosa::processAnswer');
    $routes->get('result', 'Diagnosa::result');
    $routes->get('reset', 'Diagnosa::reset');
    
    // Rute untuk halaman baru (Riwayat & Daftar Sparepart)
    // URL akan menjadi: /diagnosa/history dan /diagnosa/daftar-sparepart
    $routes->get('history', 'Diagnosa::history');
    $routes->get('daftar-sparepart', 'Diagnosa::daftarSparepart');
});

// Admin Routes
// Semua rute di sini memerlukan user untuk login sebagai admin
$routes->group('admin', ['filter' => 'admin'], function($routes) {
    $routes->get('dashboard', 'AdminController::dashboard');
    
    $routes->group('gejala', function($routes) {
        $routes->get('/', 'AdminQuestionController::index');
        $routes->get('tambah', 'AdminQuestionController::create');
        $routes->post('simpan', 'AdminQuestionController::store');
        $routes->get('edit/(:segment)', 'AdminQuestionController::edit/$1');
        $routes->post('update/(:segment)', 'AdminQuestionController::update/$1');
        $routes->get('hapus/(:segment)', 'AdminQuestionController::delete/$1');
    });
    
    $routes->group('sparepart', function($routes) {
        $routes->get('/', 'AdminSparepartController::index');
        $routes->get('tambah', 'AdminSparepartController::create');
        $routes->post('simpan', 'AdminSparepartController::store');
        $routes->get('edit/(:segment)', 'AdminSparepartController::edit/$1');
        $routes->post('update/(:segment)', 'AdminSparepartController::update/$1');
        $routes->get('hapus/(:segment)', 'AdminSparepartController::delete/$1');
    });
});
