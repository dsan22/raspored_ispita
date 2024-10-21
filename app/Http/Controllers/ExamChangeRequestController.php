<?php

namespace App\Http\Controllers;

use App\Http\Requests\ExamChangeRequest\StoreExamChangeRequestRequest;
use App\Http\Requests\ExamChangeRequest\UpdateExamChangeRequestRequest;
use App\Models\Classroom;
use App\Models\Exam;
use App\Models\ExamChangeRequest;
use App\Models\User;
use Illuminate\Support\Facades\DB;


class ExamChangeRequestController extends Controller
{
    public function index()
    {
        $this->authorize('seeRequests', ExamChangeRequest::class);
        return view("exam-change-requests.index", ['examChangeRequests' => ExamChangeRequest::all()]);
    }

    public function create(Exam $exam)
    {
        $this->authorize('create', [ExamChangeRequest::class, $exam]);
        $examinationPeriod = $exam->examinationPeriod;
        return view("exam-change-requests.create", [
            'classrooms' => Classroom::all(),
            'exam' => $exam,
            'startDate' => $examinationPeriod->start_date->format('Y-m-d'),
            'endDate' => $examinationPeriod->end_date->format('Y-m-d')
        ]);
    }

    public function store(StoreExamChangeRequestRequest $request)
    {
        $exam = Exam::find($request->exam_id);
        $this->authorize('create', [ExamChangeRequest::class, $exam]);
        ExamChangeRequest::create($request->validated());
        return redirect()->route('users.requests', ['user' => auth()->id()]);
    }

    public function edit(ExamChangeRequest $examChangeRequest)
    {
        $this->authorize('update', [ExamChangeRequest::class, $examChangeRequest]);
        $examinationPeriod = $examChangeRequest->exam->examinationPeriod;
        return view("exam-change-requests.edit", [
            'examChangeRequest' => $examChangeRequest,
            'startDate' => $examinationPeriod->start_date->format('Y-m-d'),
            'endDate' => $examinationPeriod->end_date->format('Y-m-d'),
            'classrooms' => Classroom::all()
        ]);
    }

    public function update(UpdateExamChangeRequestRequest $request, ExamChangeRequest $examChangeRequest)
    {
        $this->authorize('update', [ExamChangeRequest::class, $examChangeRequest]);
        $examChangeRequest->update($request->validated());
        return redirect()->route('users.requests', ['user' => auth()->id()]);
    }

    public function destroy(ExamChangeRequest $examChangeRequest)
    {
        $this->authorize('forceDelete', [ExamChangeRequest::class, $examChangeRequest]);
        $examChangeRequest->forceDelete();
        return redirect(url()->previous());
    }

    public function usersExamChangeRequests(User $user)
    {
        $this->authorize('seeUsersRequests', [ExamChangeRequest::class, $user]);
        $examChangeRequests = $user->subjects()
            ->with(['exams.examChangeRequests' => fn($query) => $query->whereHas('exam.examinationPeriod', fn($query) => $query->where('date', '>', now()))])
            ->get()
            ->pluck('exams.*.examChangeRequests')
            ->flatten()
            ->sortBy(fn($request) => is_null($request->change_approved) ? 0 : 1);
        return view("exam-change-requests.users-requests", compact('examChangeRequests'));
    }

    public function openRequests()
    {
        $this->authorize('seeRequests', ExamChangeRequest::class);
        return view("exam-change-requests.open-requests", ['examChangeRequests' => ExamChangeRequest::whereNull('change_approved')->get()]);
    }

    public function denieRequest(ExamChangeRequest $examChangeRequest)
    {
        $this->authorize('denie', ExamChangeRequest::class);
        $examChangeRequest->update(['change_approved' => false]);
        return redirect()->route('exam_change_requests.open_requests');
    }

    public function approveRequest(ExamChangeRequest $examChangeRequest)
    {
        $this->authorize('approve', ExamChangeRequest::class);
        DB::transaction(function () use ($examChangeRequest) {
            $examChangeRequest->update(['change_approved' => true]);
            $exam = $examChangeRequest->exam;
            if ($examChangeRequest->new_date) $exam->date = $examChangeRequest->new_date;
            if ($examChangeRequest->new_time) $exam->time = $examChangeRequest->new_time;
            if ($examChangeRequest->new_classroom) $exam->classroom()->associate($examChangeRequest->classroom);
            $exam->save();
        });
        return redirect()->route('exam_change_requests.open_requests');
    }
}