<?php

namespace Config;

$routes = Services::routes();

// AUTH ROUTES (no auth filter)
$routes->get('/', 'AuthController::login');
$routes->get('auth/login', 'AuthController::login');
$routes->post('auth/login', 'AuthController::processLogin');
$routes->get('auth/register', 'AuthController::register');
$routes->post('auth/register', 'AuthController::processRegister');
$routes->get('auth/google-login', 'AuthController::googleLogin');
$routes->get('auth/google-callback', 'AuthController::googleCallback');
$routes->post('auth/logout', 'AuthController::logout');

// SPA Shell Routes - each URL renders the same shell, JS loads the right partial
$routes->get('dashboard', 'MainController::index');
$routes->get('meetings', 'MainController::index');
$routes->get('participants', 'MainController::index');
$routes->get('discussions', 'MainController::index');
$routes->get('export', 'MainController::index');
$routes->get('settings', 'MainController::index');

// PARTIAL VIEWS (SPA AJAX loads) - Protected by AuthFilter
$routes->get('partials/dashboard-content', 'MainController::dashboard');
$routes->get('partials/meeting-content', 'MeetingController::index'); 
$routes->get('partials/participant-content', 'ParticipantController::index');
$routes->get('partials/discussion-content', 'DiscussionController::index');
$routes->get('partials/export-content', 'ExportController::index');

// API & CRUD Meeting
$routes->get('v1/meetings', 'MeetingController::getMeetings');
$routes->post('meeting/save', 'MeetingController::save');
$routes->post('meeting/update', 'MeetingController::update');
$routes->post('meeting/delete', 'MeetingController::delete');
$routes->get('v1/reminder', 'MeetingController::getUpcoming');

// API Participant
$routes->get('v1/participants/(:num)', 'ParticipantController::getParticipants/$1');
$routes->post('v1/participants', 'ParticipantController::addParticipant');
$routes->post('v1/scan', 'ParticipantController::scanBarcode');
$routes->post('participant/absen', 'ParticipantController::absen');

// API Discussion
$routes->get('discussion', 'DiscussionController::index');
$routes->post('discussion/save', 'DiscussionController::save');
$routes->get('discussion/search', 'DiscussionController::search');
$routes->post('discussion/delete', 'DiscussionController::delete');

// EXPORT TO PDF
$routes->post('export/pdf', 'ExportController::generatePDF');
$routes->get('export/pdf/(:num)', 'ExportController::generatePDF/$1');
$routes->get('export/preview/(:num)', 'ExportController::previewHTML/$1');

// PROFILE
$routes->get('partials/profile-content', 'ProfileController::index');
$routes->post('profile/update', 'ProfileController::update');
$routes->post('profile/change-password', 'ProfileController::changePassword');
