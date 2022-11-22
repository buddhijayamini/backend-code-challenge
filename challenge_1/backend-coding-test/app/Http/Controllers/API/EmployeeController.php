<?php

namespace App\Http\Controllers\API;

use App\Classes\ApiCatchErrors;
use App\Http\Controllers\Controller;
use App\Http\Requests\EmployeeRequest;
use App\Http\Resources\Common\ErrorResponse;
use App\Http\Resources\Common\PaginationResource;
use App\Http\Resources\Common\SuccessResponse;
use App\Http\Resources\EmployeeResource;
use App\Repositories\Employee\EmployeeInterface;
use Exception;
use Illuminate\Support\Facades\DB;

class EmployeeController extends Controller
{
    protected $employeeInterface;

    public function __construct(EmployeeInterface $employeeInterface)
    {
        $this->employeeInterface = $employeeInterface;
    }
    /**
     * Display a listing of the resource.
     *
     */
    public function index()
    {
        $data = $this->employeeInterface->getAll();

        return new SuccessResponse([
            'data' => EmployeeResource::collection($data),
            'pagination' => new PaginationResource($data)
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     */
    public function store(EmployeeRequest $request)
    {
        DB::beginTransaction();
        try {
            $validatedData = $request->validated();
            $data = $this->employeeInterface->store($validatedData);
            DB::commit();

            return new SuccessResponse(
                [
                    'data' => new EmployeeResource($data),
                ],
            );
        } catch (Exception $e) {
            return ApiCatchErrors::rollback($e);
        }
    }

    /**
     * Display the specified resource.
     *
     */
    public function show(int $id)
    {
        try {
            $data = $this->employeeInterface->getById($id);

            return new SuccessResponse(
                [
                    'data' => new EmployeeResource($data),
                ],
            );
        } catch (Exception $e) {
            return ApiCatchErrors::rollback($e);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     */
    public function update(EmployeeRequest $request, int $id)
    {
        DB::beginTransaction();
        try{
            $details = $request->validated();
            $data = $this->employeeInterface->update($id, $details);
            DB::commit();

            if($data){
                $record = $this->employeeInterface->getById($id);
                return new SuccessResponse(
                    [
                        'data' => new EmployeeResource($record),
                        'message' => 'Employee updated Successfully.'
                    ],
                );
            }else{
                return new ErrorResponse(
                    [
                        'message' => 'Employee can not be Updated.'
                    ],
                );
            }

        }catch(Exception $e){
            return ApiCatchErrors::rollback($e);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     */
    public function destroy(int $id)
    {
        DB::beginTransaction();
        try{
                $data = $this->employeeInterface->destroy($id);
                DB::commit();

                if($data){
                    return new SuccessResponse(
                        [
                            'message' => 'Employee deleted Successfully.'
                        ],
                    );
                }else{
                    return new ErrorResponse(
                        [
                            'message' => 'Employee can not be Deleted.'
                        ],
                    );
                }
        }catch(Exception $e){
            return ApiCatchErrors::rollback($e);
        }
    }
}
