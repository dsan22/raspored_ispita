<?php

namespace App\Http\Controllers;

use App\Http\Requests\Exam\StoreExamRequest;
use App\Http\Requests\Exam\UpdateExamRequest;
use App\Models\Classroom;
use App\Models\Exam;
use App\Models\ExaminationPeriod;
use App\Models\Subject;
use App\Models\User;
use Illuminate\Database\QueryException;

class ExamController extends Controller
{
    public function store(StoreExamRequest $request)
    {
        $this->authorize('create', Exam::class);
        $exam = Exam::create($request->validated());
        return redirect()->route("exams.schedule_exams", $exam->examinationPeriod);
    }


    public function edit(Exam $exam)
    {
        $this->authorize('update', Exam::class);
        $examinationPeriod = $exam->examinationPeriod;
        $classrooms = Classroom::all();
        return view("exams.edit", [
            'exam' => $exam,
            'startDate' => $examinationPeriod->start_date->format('Y-m-d'),
            'endDate' => $examinationPeriod->end_date->format('Y-m-d'),
            'classrooms' => $classrooms
        ]);
    }

    public function update(UpdateExamRequest $request, Exam $exam)
    {
        $this->authorize('update', Exam::class);
        $exam->update($request->validated());
        return redirect()->route('examination_periods.show', $exam->examinationPeriod->id);
    }

    public function destroy(Exam $exam)
    {
        $this->authorize('delete', Exam::class);
        $examinationPeriod = $exam->examinationPeriod;
        $exam->delete();
        return redirect()->route('examination_periods.show', $examinationPeriod->id);
    }

    public function usersExams(User $user)
    {
        $this->authorize('seeUsersExams', [Exam::class, $user]);
        $examsByExaminationPeriod = $user->subjects()
            ->with(['exams' => fn($query) => $query->where('date', '>', now())])
            ->get()
            ->pluck('exams')
            ->flatten()
            ->groupBy(fn($exam) => $exam->examinationPeriod->examinationPeriodName->name);

        return view("exams.users-exams", ['examsByExaminationPeriod' => $examsByExaminationPeriod]);
    }

    public function scheduleExams(ExaminationPeriod $examinationPeriod)
    {
        $this->authorize('create', Exam::class);

        $subjectsByDepartment = Subject::whereDoesntHave('exams', fn($query) => $query->where('examination_period_id', $examinationPeriod->id))
            ->with('department')
            ->get()
            ->groupBy('department.name');

        $classrooms = Classroom::all();
        return view('exams.schedule-exams', compact('examinationPeriod', 'subjectsByDepartment', 'classrooms'));
    }

    public function deleted(ExaminationPeriod $examinationPeriod)
    {
        $this->authorize('seeDeleted', Exam::class);
        $examsByDepartment = $examinationPeriod->exams()
            ->onlyTrashed()
            ->get()
            ->groupBy(fn($exam) => $exam->subject->department->name);

        return view("exams.deleted", compact('examsByDepartment', 'examinationPeriod'));
    }

    public function deletePermanently(Exam $exam)
    {
        $this->authorize('forceDelete', Exam::class);

        if (!$exam->trashed()) {
            return redirect()->route('exams.deleted', $exam->examinationPeriod->id)->with('error', 'You need to soft delete the exam first.');
        }

        try {
            $exam->forceDelete();
            return redirect()->route('exams.deleted', $exam->examinationPeriod->id);
        } catch (QueryException $e) {
            return redirect()->route('exams.deleted', $exam->examinationPeriod->id)->with('error', 'Exam cannot be deleted because it is associated with other records.');
        }
    }

    public function restore(Exam $exam)
    {
        $this->authorize('restore', Exam::class);
        $exam->restore();
        return redirect()->route('exams.deleted', $exam->examinationPeriod->id);
    }
}
