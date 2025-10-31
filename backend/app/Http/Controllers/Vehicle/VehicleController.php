<?php

namespace App\Http\Controllers\Vehicle;

use App\Enums\PermissionsEnum;
use App\Exceptions\ForbiddenException;
use App\Exceptions\NotFoundException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Vehicle\VehicleRequest;
use App\Http\Resources\Vehicle\VehicleCollectionResource;
use App\Http\Resources\Vehicle\VehicleSingleResource;
use Illuminate\Http\Request;

class VehicleController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index(Request $request)
  {
    /** Authorization Check */
    if (!$request->user()->can(PermissionsEnum::VEHICLES_VIEW->value)) {
      throw new ForbiddenException('You do not have permission to view Vehicles.');
    }

    /** Get Company */
    $company = $request->user()->company;

    /** Get Clients */
    $vehicles = $company->vehicles()->orderBy('reg_number', 'asc')->get();

    /** Return Clients */
    return VehicleCollectionResource::collection($vehicles);
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(VehicleRequest $request)
  {
    /** Authorization Check */
    if (!$request->user()->can(PermissionsEnum::VEHICLES_MANAGE->value)) {
      throw new ForbiddenException('You do not have permission to manage Vehicles.');
    }

    /** Get Company */
    $company = $request->user()->company;

    /** Create Client */
    $vehicle = $company->vehicles()->create($request->validated());

    /** Return Client */
    return new VehicleSingleResource($vehicle);
  }

  /**
   * Display the specified resource.
   */
  public function show(Request $request, string $id)
  {
    /** Authorization Check */
    if (!$request->user()->can(PermissionsEnum::VEHICLES_VIEW->value)) {
      throw new ForbiddenException('You do not have permission to view Vehicle.');
    }

    /** Get Company */
    $company = $request->user()->company;

    /** Get Client */
    $vehicle = $company->vehicles()->find($id);
    /** Authorization Check */
    if (!$vehicle) {
      throw new NotFoundException('Vehicle not found.');
    }

    /** Return Client */
    return new VehicleSingleResource($vehicle);
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(VehicleRequest $request, string $id)
  {
    /** Authorization Check */
    if (!$request->user()->can(PermissionsEnum::VEHICLES_MANAGE->value)) {
      throw new ForbiddenException('You do not have permission to manage Vehicles.');
    }

    /** Get Company */
    $company = $request->user()->company;

    /** Get Client */
    $vehicle = $company->vehicles()->find($id);

    /** Authorization Check */
    if (!$vehicle) {
      throw new NotFoundException('Vehicle not found.');
    }

    /** Update Client */
    $vehicle->update($request->validated());

    /** Return Client */
    return new VehicleSingleResource($vehicle);
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(string $id)
  {
    //
  }
}
