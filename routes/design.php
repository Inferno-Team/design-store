<?php

use App\Http\Controllers\DesignController;

use Illuminate\Support\Facades\Route;

Route::group(["middleware" => ["auth:sanctum"]], function ($route) {
    $route->post('/add_design', [DesignController::class, "addDesign"]);
    $route->get('/get_designes', [DesignController::class, "getDesign"]);
    $route->get('/get_materials', [DesignController::class, "getMaterials"]);
    $route->get('/get_dimensions', [DesignController::class, "getDimensions"]);
    $route->get('/get_mat_dim', [DesignController::class, "getMatDim"]);
    $route->get('/get_requests', [DesignController::class, "getRequests"]);
});
