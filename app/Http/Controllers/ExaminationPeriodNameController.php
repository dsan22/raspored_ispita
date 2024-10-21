<?php

namespace App\Http\Controllers;

use App\Http\Requests\ExaminationPeriodName\StoreExaminationPeriodNameRequest;
use App\Http\Requests\ExaminationPeriodName\UpdateExaminationPeriodNameRequest;
use App\Models\ExaminationPeriodName;
use Illuminate\Database\QueryException;
class ExaminationPeriodNameController extends Controller
{
    public function index()
    {
        return view("examination-period-names.index", ['examinationPeriodNames' => ExaminationPeriodName::all()]);
    }

    public function create()
    {
        $this->authorize('create', ExaminationPeriodName::class);
        return view("examination-period-names.create");
    }

    public function store(StoreExaminationPeriodNameRequest $request)
    {
        $this->authorize('create', ExaminationPeriodName::class);
        ExaminationPeriodName::create($request->validated());
        return redirect()->route("examination_period_names.index");
    }

    public function edit(ExaminationPeriodName $examinationPeriodName)
    {
        $this->authorize('update', $examinationPeriodName);
        return view("examination-period-names.edit", compact("examinationPeriodName"));
    }

    public function update(UpdateExaminationPeriodNameRequest $request, ExaminationPeriodName $examinationPeriodName)
    {
        $this->authorize('update', $examinationPeriodName);
        $examinationPeriodName->update($request->validated());
        return redirect()->route("examination_period_names.index");
    }

    public function destroy(ExaminationPeriodName $examinationPeriodName)
    {
        $this->authorize('delete', $examinationPeriodName);
        $examinationPeriodName->delete();
        return redirect()->route('examination_period_names.index');
    }

    public function deleted()
    {
        $this->authorize('seeDeleted', ExaminationPeriodName::class);
        return view("examination-period-names.deleted", ['examinationPeriodNames' => ExaminationPeriodName::onlyTrashed()->get()]);
    }

    public function deletePermanently(ExaminationPeriodName $examinationPeriodName)
    {
        $this->authorize('forceDelete', $examinationPeriodName);
        if (!$examinationPeriodName->trashed()) {
            return redirect()->route('examination_period_names.deleted')->with('error', 'Soft delete the examination period name first.');
        }
        try {
            $examinationPeriodName->forceDelete();
            return redirect()->route('examination_period_names.deleted');
        } catch (QueryException $e) {
            return redirect()->route('examination_period_names.deleted')->with('error', 'Cannot delete due to related records.');
        }
    }

    public function restore(ExaminationPeriodName $examinationPeriodName)
    {
        $this->authorize('restore', $examinationPeriodName);
        $examinationPeriodName->restore();
        return redirect()->route('examination_period_names.deleted');
    }
}