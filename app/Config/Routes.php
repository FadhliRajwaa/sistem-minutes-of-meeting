<?php

namespace Config;

$routes = Services::routes();

// ✅ AUTH ROUTES
$routes->get('/', 'AuthController::login');
$routes->get('auth/login', 'AuthController::login');
$routes->post('auth/login', 'AuthController::processLogin');
$routes->get('auth/register', 'AuthController::register');
$routes->post('auth/register', 'AuthController::processRegister');
$routes->get('auth/google-login', 'AuthController::googleLogin');
$routes->get('auth/google-callback', 'AuthController::googleCallback');
$routes->get('auth/logout', 'AuthController::logout');
$routes->get('partials/settings-info', 'SettingsController::info');

// ✅ MAIN ROUTE (SPA Dashboard)
$routes->get('dashboard', 'MainController::index');
$routes->get('dashboard/(:any)', 'MainController::index');
$routes->get('dashboard/load/(:segment)', 'MainController::load/$1');

// ✅ PARTIAL VIEWS (SPA Loads)
$routes->get('partials/dashboard-content', 'PartialController::dashboard');
$routes->get('partials/meeting-content', 'MeetingController::index'); 
$routes->get('partials/participant-content', 'PartialController::participant');
$routes->get('partials/discussion-content', 'DiscussionController::index');
$routes->get('partials/export-content', 'ExportController::index');
$routes->get('partials/settings-content', 'PartialController::settings');

// ✅ API & CRUD Meeting
$routes->get('v1/meetings', 'MeetingController::getMeetings');
$routes->post('meeting/save', 'MeetingController::save');
$routes->post('meeting/update', 'MeetingController::update');
$routes->post('meeting/delete', 'MeetingController::delete');
$routes->get('meetings/json', 'MeetingController::getMeetings');
$routes->get('v1/reminder', 'MeetingController::getUpcoming');

// ✅ API Participant
$routes->get('v1/participants/(:num)', 'ParticipantController::getParticipants/$1');
$routes->post('v1/participants', 'ParticipantController::addParticipant');
$routes->post('v1/scan', 'ParticipantController::scanBarcode');
$routes->post('participant/absen', 'ParticipantController::absen');

// ✅ API Discussion
$routes->get('discussion', 'DiscussionController::index');
$routes->post('discussion/save', 'DiscussionController::save');
$routes->post('discussion/store', 'DiscussionController::store');

// ✅ EXPORT TO PDF
$routes->post('export/pdf', 'ExportController::generatePDF');
$routes->get('export/pdf/(:num)', 'ExportController::generatePDF/$1');
$routes->get('export/preview/(:num)', 'ExportController::previewHTML/$1');
$routes->get('/discussion/search', 'DiscussionController::search');
$routes->post('discussion/delete', 'DiscussionController::delete');






