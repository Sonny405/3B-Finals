<?php

namespace App\Http\Controllers;

use App\Http\Requests\NewSubjectRequest;
use App\Http\Requests\UpdateSubjectRequest;
use Illuminate\Http\Request;
use App\Models\Subject;

class SubjectController extends Controller
{
    ///GET Index
    public function index(Request $request, $student_id){
        $find_student = Subject::findOrFail($student_id);
        $subject_query = Subject::query();

        //SORT
        if ($request->has('sort')) {
            $sortDirection = strtolower($request->get('direction', 'asc')) === 'desc' ? 'desc' : 'asc';
            $subject_query->orderBy($request->sort, $sortDirection);
        }

        //SEARCH
        if ($request->has('search')) {
            $search = $request->search;
            $subject_query->where(function ($subQuery) use ($search) {
                $subQuery->where('subject_code', 'like', "%{$search}%")
                         ->orWhere('name', 'like', "%{$search}%")
                         ->orWhere('instructor', 'like', "%{$search}%");
            });
        }

        //FILTER USING REMARKS
        if ($request->has('remarks')) {
            $subject_query->where('remarks', strtoupper($request->get('remarks')));
        }

        //FIELDS
        $field_queries = $request->get('fields');
        if ($field_queries) {
            $field_queriesArray = explode(',', $field_queries);
            $subject_query->select($field_queriesArray);
        }

        //LIMIT & OFFSET
        $limit = $request->get('limit') ? $request->limit: 5;
        $offset = $request->get('offset', 1) ? $request->offset: 1;
        $students = $subject_query-> paginate($limit, ['*'], 'page', $offset);

        return response()->json([
            'metadata' => [
                'count' => $students->total(),
                'search' => $request->get('search', null),
                'limit' => $students->perPage(),
                'offset' => $students->currentPage(),
                'fields' => $request->get('fields', ['id', 'student_id', 'subject_code', 'name', 'description', 'instructor', 'schedule', 'grades', 'average_grade', 'remarks', 'data_taken']),
            ],
            'students' => $students->collect()->all(),
        ]);
    }

    public function add(NewSubjectRequest $request, $student_id)
    {
        $subject_validated = $request->validated();
        $average_grade = array_sum($subject_validated['grades']) / count($subject_validated['grades']);
        $remarks = $average_grade <= 3.0 ? 'PASSED' : 'FAILED';
        $new_subject = new Subject([
            'student_id' => $student_id,
            'subject_code' => $subject_validated['subject_code'],
            'name' => $subject_validated['name'],
            'description' => $subject_validated['description'],
            'instructor' => $subject_validated['instructor'],
            'schedule' => $subject_validated['schedule'],
            'grades' => json_encode($subject_validated['grades']),
            'average_grade' => $average_grade,
            'remarks' => $remarks,
            'date_taken' => date('Y_m_d')
        ]);
        $new_subject->save();
        return response()->json($new_subject, 201);
    }

    public function find($student_id, $subject_id)
    {
        $subject = Subject::where('student_id', $student_id)->where('id', $subject_id)->first();
        if (!$subject) {
            return response()->json(['error' => 'Subject not found'], 404);
        }
        return response()->json($subject);
    }

    public function update(UpdateSubjectRequest $request, $student_id, $subject_id)
    {
        $subject = Subject::find($subject_id);
        if (!$subject) {
            return response()->json(['error' => 'Subject not found'], 404);
        }
        $subject_validated = $request->validated();

        if (isset($subject_validated['grades'])) {
            $average_grade = array_sum($subject_validated['grades']) / count($subject_validated['grades']);
            $remarks = $average_grade <= 3.0 ? 'PASSED' : 'FAILED';
            $subject_validated['average_grade'] = $average_grade;
            $subject_validated['remarks'] = $remarks;
        }

        // Update the subject with new record
        $subject->update($subject_validated);

        return response()->json($subject);
}
    
}
