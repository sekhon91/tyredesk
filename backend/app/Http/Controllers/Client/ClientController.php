<?php

namespace App\Http\Controllers\Client;

use App\Enums\PermissionsEnum;
use App\Exceptions\ForbiddenException;
use App\Exceptions\NotFoundException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Client\ClientRequest;
use App\Http\Resources\Client\ClientCollectionResource;
use App\Http\Resources\Client\ClientSingleResource;
use Illuminate\Http\Request;

class ClientController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index(Request $request)
  {
    /** Authorization Check */
    if (!$request->user()->can(PermissionsEnum::CLIENTS_VIEW->value)) {
      throw new ForbiddenException('You do not have permission to view clients.');
    }

    /** Get Company */
    $company = $request->user()->company;

    /** Get Clients */
    $clients = $company->clients()->orderBy('name', 'asc')->get();

    /** Return Clients */
    return ClientCollectionResource::collection($clients);
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(ClientRequest $request)
  {
    /** Authorization Check */
    if (!$request->user()->can(PermissionsEnum::CLIENTS_MANAGE->value)) {
      throw new ForbiddenException('You do not have permission to manage clients.');
    }

    /** Get Company */
    $company = $request->user()->company;

    /** Create Client */
    $client = $company->clients()->create($request->validated());

    /** Return Client */
    return new ClientCollectionResource($client);
  }

  /**
   * Display the specified resource.
   */
  public function show(Request $request, string $id)
  {
    /** Authorization Check */
    if (!$request->user()->can(PermissionsEnum::CLIENTS_VIEW->value)) {
      throw new ForbiddenException('You do not have permission to view clients.');
    }

    /** Get Company */
    $company = $request->user()->company;

    /** Get Client */
    $client = $company->clients()->find($id);
    /** Authorization Check */
    if (!$client) {
      throw new NotFoundException('Client not found.');
    }

    /** Return Client */
    return new ClientSingleResource($client);
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(ClientRequest $request, string $id)
  {
    /** Authorization Check */
    if (!$request->user()->can(PermissionsEnum::CLIENTS_MANAGE->value)) {
      throw new ForbiddenException('You do not have permission to manage clients.');
    }

    /** Get Company */
    $company = $request->user()->company;

    /** Get Client */
    $client = $company->clients()->find($id);

    /** Authorization Check */
    if (!$client) {
      throw new NotFoundException('Client not found.');
    }

    /** Update Client */
    $client->update($request->validated());

    /** Return Client */
    return new ClientCollectionResource($client);
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(string $id)
  {
    //
  }
}
