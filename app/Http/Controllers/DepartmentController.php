<?php

namespace App\Http\Controllers;

use App\Http\Requests\Department\StoreDepartmentRequest;
use App\Http\Requests\Department\UpdateDepartmentRequest;
use App\Models\Department;
use Illuminate\Database\QueryException;
class DepartmentController extends Controller
{
    public function index()
    {
        return view("departments.index", ['departments' => Department::all()]);
    }

    public function create()
    {
        $this->authorize('create', Department::class);
        return view("departments.create");
    }

    public function store(StoreDepartmentRequest $request)
    {
        $this->authorize('create', Department::class);
        Department::create($request->validated());
        return redirect()->route("departments.index");
    }

    public function edit(Department $department)
    {
        $this->authorize('update', $department);
        return view("departments.edit", compact("department"));
    }

    public function update(UpdateDepartmentRequest $request, Department $department)
    {
        $this->authorize('update', $department);
        $department->update($request->validated());
        return redirect()->route("departments.index");
    }

    public function destroy(Department $department)
    {
        $this->authorize('delete', $department);
        $department->delete();
        return redirect()->route('departments.index');
    }

    public function deleted()
    {
        $this->authorize('seeDeleted', Department::class);
        return view("departments.deleted", ['departments' => Department::onlyTrashed()->get()]);
    }

    public function deletePermanently(Department $department)
    {
        $this->authorize('forceDelete', $department);
        if (!$department->trashed()) {
            return redirect()->route('departments.deleted')->with('error', 'Soft delete required first.');
        }
        try {
            $department->forceDelete();
            return redirect()->route('departments.deleted');
        } catch (QueryException $e) {
            return redirect()->route('departments.deleted')->with('error', 'Department cannot be deleted due to associations.');
        }
    }

    public function restore(Department $department)
    {
        $this->authorize('restore', $department);
        if (!$department->trashed()) {
            return redirect()->route('departments.deleted')->with('error', 'Soft delete required first.');
        }
        $department->restore();
        return redirect()->route('departments.deleted');
    }
}