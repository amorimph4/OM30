<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\CreatePatientRequest;
use App\Http\Requests\ListPatientRequest;
use App\Http\Requests\UpdatePatientRequest;
use App\Http\Resources\PatientResource;
use App\Services\DeletePatientService;
use App\Services\CreatePatientService;
use App\Services\GetPatientService;
use App\Services\ListPatientService;
use App\Services\UpdatePatientService;
use Illuminate\Http\Response;

class PatientController extends Controller
{
    public function __construct(
        private CreatePatientService $createPatienService,
        private DeletePatientService $deletePatientService,
        private GetPatientService $getPatientService,
        private ListPatientService $listPatienService,
        private UpdatePatientService $updatePatientService
    )
    {}

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ListPatientRequest $request)
    {
        return new Response(
            $this->listPatienService->listPatients($request->getSearch()), 
            Response::HTTP_OK
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\CreatePatientRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreatePatientRequest $request)
    {
        $this->createPatienService->create($request->toDomain());
        return new Response(null, Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(int $id)
    {

        return new PatientResource(
            $this->getPatientService->getPatient($id)
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  App\Http\Requests\UpdatePatientRequest $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePatientRequest $request)
    {
        $this->updatePatientService->update($request->toDomain());
        return new Response(null, Response::HTTP_NO_CONTENT);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        $this->deletePatientService->destroyPatient($id);
        return new Response(null, Response::HTTP_NO_CONTENT);
    }


    public function uploadPatients()
    {
        return new Response(null, Response::HTTP_OK);
    }
}
