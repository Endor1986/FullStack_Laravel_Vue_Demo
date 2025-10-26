<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;
use App\Http\Requests\StoreCourseRequest;

class CourseController extends Controller
{
    public function index(Request $r)
    {
        $perPage = (int) $r->input('per_page', 20);
        $perPage = max(1, min(100, $perPage));

        $allowedSorts = ['starts_at', 'title', 'price_cents', 'created_at'];
        $sort = $r->input('sort', 'starts_at');
        if (!in_array($sort, $allowedSorts, true)) $sort = 'starts_at';
        $dir = strtolower($r->input('dir', 'desc')) === 'asc' ? 'asc' : 'desc';

        $activeInput = $r->input('active', null);
        $activeBool = null;
        if ($activeInput !== null) {
            $activeBool = filter_var($activeInput, FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE);
        }

        $q = Course::query()
            ->when($r->filled('q'), fn ($x) => $x->where('title','like','%'.$r->input('q').'%'))
            ->when($activeBool !== null, fn ($x) => $x->where('is_active', $activeBool))
            ->orderBy($sort, $dir)
            ->paginate($perPage)
            ->appends($r->query());

        return response()->json($q);
    }

    public function store(StoreCourseRequest $req)
    {
        $course = Course::create($req->validated());
        return response()->json($course, 201);
    }

    public function show(Course $course)
    {
        return response()->json($course);
    }

    public function update(StoreCourseRequest $req, Course $course)
    {
        $course->fill($req->validated())->save();
        return response()->json($course);
    }

    public function destroy(Course $course)
    {
        $course->delete();
        return response()->noContent();
    }
}
