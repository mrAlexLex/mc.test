<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\EmployeeRequest;
use App\Http\Resources\EmployeeResource;
use App\Models\Department;
use App\Models\Employee;
use Illuminate\Http\Response;
use function PHPUnit\Framework\exactly;
use function response;

/**
 *
 */
class EmployeeController extends Controller
{
    /**
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        return EmployeeResource::collection(Employee::all());
    }

    /**
     * @param EmployeeRequest $request
     * @return EmployeeResource
     */
    public function store(EmployeeRequest $request)
    {
        $departments = Department::whereIn('id', $request->validated()['departments'])->get();
        $employee = Employee::create($request->validated());
        $employee->departments()->attach($departments);

        return new EmployeeResource($employee);
    }

    /**
     * @param Employee $employee
     * @return EmployeeResource
     */
    public function show(Employee $employee)
    {
        return new EmployeeResource($employee);
    }

    /**
     * @param EmployeeRequest $request
     * @param Employee $employee
     * @return EmployeeResource
     */
    public function update(EmployeeRequest $request, Employee $employee)
    {
        $departments = Department::whereIn('id', $request->validated()['departments'])->get();
        $employee->update($request->validated());
        $employee->departments()->detach();
        $employee->departments()->attach($departments);

        return new EmployeeResource($employee);
    }

    /**
     * @param Employee $employee
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|Response
     */
    public function destroy(Employee $employee)
    {
        $employee->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
