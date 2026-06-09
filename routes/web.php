<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\HebergementController;
use App\Http\Controllers\BainsController;
use App\Http\Controllers\RestaurantController;
use App\Http\Controllers\ExcursionController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\SportController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\EspaceController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ReservationController;

Route::get("/",                   [HomeController::class,        "index"])->name("home");
Route::get("/hebergements",       [HebergementController::class, "index"])->name("hebergements.index");
Route::get("/hebergement/{slug}",[HebergementController::class, "show"])->name("hebergements.show");
Route::get("/bains",              [BainsController::class,       "index"])->name("bains.index");
Route::get("/restaurant",         [RestaurantController::class,  "index"])->name("restaurant.index");
Route::get("/excursions",         [ExcursionController::class,   "index"])->name("excursions.index");
Route::get("/excursions/{slug}",  [ExcursionController::class,   "show"])->name("excursions.show");
Route::get("/locations",          [LocationController::class,    "index"])->name("locations.index");
Route::get("/salle-de-sport",     [SportController::class,       "index"])->name("sport.index");
Route::get("/a-propos",           [AboutController::class,       "index"])->name("about.index");
Route::get("/notre-espace",       [EspaceController::class,      "index"])->name("espace.index");
Route::get("/contact",            [ContactController::class,     "index"])->name("contact.index");
Route::post("/contact",           [ContactController::class,     "send"])->name("contact.send");

Route::get("/reservation",              [ReservationController::class, "index"])->name("reservation.index");
Route::post("/reservation",             [ReservationController::class, "store"])->name("reservation.store");
Route::get("/reservation/callback",     [ReservationController::class, "callback"])->name("reservation.callback");
Route::get("/reservation/confirmation/{id}", [ReservationController::class, "confirmation"])->name("reservation.confirmation");
Route::get("/reservation/disponibilite",[ReservationController::class, "disponibilite"])->name("reservation.disponibilite");
