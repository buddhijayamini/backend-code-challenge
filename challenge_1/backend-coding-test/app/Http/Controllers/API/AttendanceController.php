<?php

namespace App\Http\Controllers\API;

use App\Classes\ApiCatchErrors;
use App\Http\Controllers\Controller;
use App\Http\Requests\AttendanceRequest;
use App\Http\Resources\AttendanceResource;
use App\Http\Resources\Common\ErrorResponse;
use App\Http\Resources\Common\PaginationResource;
use App\Http\Resources\Common\SuccessResponse;
use App\Http\Resources\TotAttendanceResource;
use App\Imports\AttendanceImport;
use App\Models\Attendance;
use App\Repositories\Attendance\AttendanceInterface;
use Exception;
use DB;
//use Excel;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;


class AttendanceController extends Controller
{
    protected $attendanceInterface;

    public function __construct(AttendanceInterface $attendanceInterface)
    {
        $this->attendanceInterface = $attendanceInterface;
    }

    /**
     * Display a listing of the resource.
     *
     */
    public function index()
    {
        $data = $this->attendanceInterface->getAll();
        return new SuccessResponse([
            'data' => AttendanceResource::collection($data),
            'pagination' => new PaginationResource($data)
        ]);
    }

    public function viewExcel()
    {
        $data = $this->attendanceInterface->getAll();
        return view('import_excel', compact('data'));
    }

    function importView(Request $request)
    {
        $this->validate($request, [
            'select_file'  => 'required|mimes:csv'
           ]);

        Excel::import(new AttendanceImport,request()->file('select_file'));
        return redirect()->back();
    }

    function import(Request $request)
    {
        $this->validate($request, [
            'select_file'  => 'required|mimes:csv'
           ]);

        Excel::import(new AttendanceImport,request()->file('select_file'));
        return new SuccessResponse([
            'success' => 'Excel Data Imported successfully.'
        ]);
    }

    public function showTotHours()
    {
        try {
            $diff = Attendance::select(\DB::raw('id,employee_id,time(sum(TIMEDIFF( check_out, check_in ))) as total'))
                    ->groupBy("employee_id")
                    ->get();

            return new SuccessResponse(
                [
                    'data' => TotAttendanceResource::collection($diff),
                ],
            );
        } catch (Exception $e) {
            return ApiCatchErrors::rollback($e);
        }
    }

    public function viewTotHours()
    {
        try {
            $diffs = Attendance::select(DB::raw('id,employee_id,check_in,check_out,time(sum(TIMEDIFF( check_out, check_in ))) as totHours'))
                    ->groupBy("employee_id")
                    ->get();

            return  view('attendance_info',compact('diffs'));

        } catch (Exception $e) {
            return ApiCatchErrors::rollback($e);
        }
    }



    /**
     * Store a newly created resource in storage.
     *
     */
    public function store(AttendanceRequest $request)
    {
        DB::beginTransaction();
        try {
            $validatedData = $request->validated();
            $data = $this->attendanceInterface->store($validatedData);
            DB::commit();

            return new SuccessResponse(
                [
                    'data' => new AttendanceResource($data),
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
            $data = $this->attendanceInterface->getById($id);

            return new SuccessResponse(
                [
                    'data' => new AttendanceResource($data),
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
    public function update(AttendanceRequest $request, int $id)
    {
        DB::beginTransaction();
        try{
            $details = $request->validated();
            $data = $this->attendanceInterface->update($id, $details);
            DB::commit();

            if($data){
                $record = $this->attendanceInterface->getById($id);
                return new SuccessResponse(
                    [
                        'data' => new AttendanceResource($record),
                        'message' => 'Attendance updated Successfully.'
                    ],
                );
            }else{
                return new ErrorResponse(
                    [
                        'message' => 'Attendance can not be Updated.'
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
                $data = $this->attendanceInterface->destroy($id);
                DB::commit();

                if($data){
                    return new SuccessResponse(
                        [
                            'message' => 'Attendance deleted Successfully.'
                        ],
                    );
                }else{
                    return new ErrorResponse(
                        [
                            'message' => 'Attendance can not be Deleted.'
                        ],
                    );
                }
        }catch(Exception $e){
            return ApiCatchErrors::rollback($e);
        }
    }
}
