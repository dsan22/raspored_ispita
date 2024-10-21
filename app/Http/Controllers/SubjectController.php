<?php

namespace App\Http\Controllers;

use App\Http\Requests\Subject\StoreSubjectRequest;
use App\Http\Requests\Subject\UpdateSubjectRequest;
use App\Models\Department;
use App\Models\Subject;
use App\Models\User;
use Illuminate\Database\QueryException;
class SubjectController extends Controller
{
    public function index()
    {
        $subjectsByDepartment = Subject::with('department', 'user')->get()->groupBy('department.name');
        return view("subjects.index", compact('subjectsByDepartment'));
    }

    public function create()
    {
        $this->authorize('create', Subject::class);
        return view('subjects.create', [
            'users' => User::where('is_admin', false)->get(),
            'departments' => Department::all()
        ]);
    }

    public function store(StoreSubjectRequest $request)
    {
        $this->authorize('create', Subject::class);
        Subject::create($request->validated());
        return redirect()->route("subjects.index");
    }

    public function edit(Subject $subject)
    {
        $this->authorize('update', $subject);
        return view("subjects.edit", [
            'subject' => $subject,
            'users' => User::where('is_admin', false)->get(),
            'departments' => Department::all()
        ]);
    }

    public function update(UpdateSubjectRequest $request, Subject $subject)
    {
        $this->authorize('update', $subject);
        $subject->update($request->validated());
        return redirect()->route("subjects.index");
    }

    public function destroy(Subject $subject)
    {
        $this->authorize('delete', $subject);
        $subject->delete();
        return redirect()->route('subjects.index');
    }

    public function deleted()
    {
        $this->authorize('seeDeleted', Subject::class);
        $subjectsByDepartment = Subject::onlyTrashed()->with('department', 'user')->get()->groupBy('department.name');
        return view("subjects.deleted", compact('subjectsByDepartment'));
    }

    public function deletePermanently(Subject $subject)
    {
        $this->authorize('forceDelete', $subject);
        if (!$subject->trashed()) {
            return redirect()->route('subjects.deleted')->with('error', 'Soft delete the subject first.');
        }
        try {
            $subject->forceDelete();
            return redirect()->route('subjects.deleted');
        } catch (QueryException $e) {
            return redirect()->route('subjects.deleted')->with('error', 'Subject cannot be deleted due to related records.');
        }
    }

    public function restore(Subject $subject)
    {
        $this->authorize('restore', $subject);
        $subject->restore();
        return redirect()->route('subjects.deleted');
    }
}