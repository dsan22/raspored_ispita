<?php

namespace App\Http\Controllers;

use App\Http\Requests\Classroom\StoreClassroomRequest;
use App\Http\Requests\Classroom\UpdateClassroomRequest;
use App\Models\Classroom;
use Illuminate\Database\QueryException;
class ClassroomController extends Controller
{
    public function index()
    {
        return view("classrooms.index", ['classrooms' => Classroom::all()]);
    }

    public function create()
    {
        $this->authorize('create', Classroom::class);
        return view("classrooms.create");
    }

    public function store(StoreClassroomRequest $request)
    {
        $this->authorize('create', Classroom::class);
        Classroom::create($request->validated());
        return redirect()->route("classrooms.index");
    }

    public function edit(Classroom $classroom)
    {
        $this->authorize('update', $classroom);
        return view("classrooms.edit", compact('classroom'));
    }

    public function update(UpdateClassroomRequest $request, Classroom $classroom)
    {
        $this->authorize('update', $classroom);
        $classroom->update($request->validated());
        return redirect()->route('classrooms.index');
    }

    public function destroy(Classroom $classroom)
    {
        $this->authorize('delete', $classroom);
        $classroom->delete();
        return redirect()->route('classrooms.index');
    }

    public function deleted()
    {
        $this->authorize('seeDeleted', Classroom::class);
        return view("classrooms.deleted", ['classrooms' => Classroom::onlyTrashed()->get()]);
    }

    public function deletePermanently(Classroom $classroom)
    {
        $this->authorize('forceDelete', $classroom);
        if (!$classroom->trashed()) {
            return redirect()->route('classrooms.deleted')->with('error', 'Soft delete required first.');
        }
        try {
            $classroom->forceDelete();
            return redirect()->route('classrooms.deleted');
        } catch (QueryException $e) {
            return redirect()->route('classrooms.deleted')->with('error', 'Classroom cannot be deleted due to associations.');
        }
    }

    public function restore(Classroom $classroom)
    {
        $this->authorize('restore', $classroom);
        if (!$classroom->trashed()) {
            return redirect()->route('classrooms.deleted')->with('error', 'Soft delete required first.');
        }
        $classroom->restore();
        return redirect()->route('classrooms.deleted');
    }
}
