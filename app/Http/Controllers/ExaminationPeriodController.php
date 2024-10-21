<?php

namespace App\Http\Controllers;

use App\Http\Requests\ExaminationPeriod\StoreExaminationPeriodRequest;
use App\Models\ExaminationPeriod;
use App\Models\ExaminationPeriodName;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;


class ExaminationPeriodController extends Controller
{
    public function index(Request $request)
    {
        $examinationPeriodsInFuture = $request->has('future');
        $examinationPeriods = $examinationPeriodsInFuture 
            ? ExaminationPeriod::where('end_date', '>', now())->get() 
            : ExaminationPeriod::all();

        return view('examination-periods.index', compact('examinationPeriods', 'examinationPeriodsInFuture'));
    }

    public function create()
    {
        $this->authorize('create', ExaminationPeriod::class);
        $examinationPeriodNames = ExaminationPeriodName::all();
        return view("examination-periods.create", compact('examinationPeriodNames'));
    }

    public function store(StoreExaminationPeriodRequest $request)
    {
        $this->authorize('create', ExaminationPeriod::class);
        $examinationPeriod = ExaminationPeriod::create($request->validated());
        return redirect()->route('examination_periods.show', $examinationPeriod);
    }

    public function show(ExaminationPeriod $examinationPeriod)
    {
        $examsByDepartment = $examinationPeriod->exams->groupBy(fn($exam) => $exam->subject->department->name);
        return view('examination-periods.show', compact('examinationPeriod', 'examsByDepartment'));
    }

    public function edit(ExaminationPeriod $examinationPeriod)
    {
        $this->authorize('update', ExaminationPeriod::class);
        $examinationPeriodNames = ExaminationPeriodName::all();
        return view("examination-periods.edit", compact("examinationPeriod", "examinationPeriodNames"));
    }

    public function update(StoreExaminationPeriodRequest $request, ExaminationPeriod $examinationPeriod)
    {
        $this->authorize('update', ExaminationPeriod::class);
        $examinationPeriod->update($request->validated());
        return redirect()->route('examination_periods.index');
    }

    public function destroy(ExaminationPeriod $examinationPeriod)
    {
        $this->authorize('delete', ExaminationPeriod::class);
        $examinationPeriod->delete();
        return redirect()->route('examination_periods.index');
    }

    public function deleted()
    {
        $this->authorize('seeDeleted', ExaminationPeriod::class);
        $examinationPeriods = ExaminationPeriod::onlyTrashed()->get();
        return view("examination-periods.deleted", compact('examinationPeriods'));
    }

    public function deletePermanently(ExaminationPeriod $examinationPeriod)
    {
        $this->authorize('forceDelete', ExaminationPeriod::class);

        if (!$examinationPeriod->trashed()) {
            return redirect()->route('examination_periods.deleted')->with('error', 'You need to soft delete the examination period first.');
        }

        try {
            $examinationPeriod->forceDelete();
            return redirect()->route('examination_periods.deleted');
        } catch (QueryException $e) {
            return redirect()->route('examination_periods.deleted')->with('error', 'Examination period cannot be deleted because it is associated with other records.');
        }
    }

    public function restore(ExaminationPeriod $examinationPeriod)
    {
        $this->authorize('restore', ExaminationPeriod::class);
        $examinationPeriod->restore();
        return redirect()->route('examination_periods.deleted');
    }
}