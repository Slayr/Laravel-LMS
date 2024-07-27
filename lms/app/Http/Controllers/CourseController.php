<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Page;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function index()
    {
        $courses = Course::all();
        return view('courses.index', compact('courses'));
    }

    public function create()
    {
        return view('courses.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        Course::create($request->only('title', 'description'));

        return redirect()->route('courses')->with('success', 'Course created successfully.');
    }

    public function addPages(Course $course)
    {
        $pages = $course->pages; // Retrieve all pages for the course
        return view('courses.add-pages', compact('course', 'pages'));
    }   

    public function storePage(Request $request, Course $course)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'content' => 'nullable|string',
        ]);

        $page = new Page();
        $page->title = $request->input('title');
        $page->content = $request->input('content');
        $page->course_id = $course->id;

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public');
            $page->image = $imagePath;
        }

        $page->save();

        return redirect()->route('courses.pages', $course->id)->with('success', 'Page added successfully.');
    }

    public function destroyPage(Page $page)
    {
        $page->delete();
        return back()->with('success', 'Page deleted successfully.');
    }

    public function playCourse(Course $course, Request $request)
    {
        $pages = $course->pages;
    
        // Check if there are any pages
        if ($pages->isEmpty()) {
            return redirect()->route('courses.pages', $course->id)->with('error', 'No pages available for this course.');
        }
    
        // Default to the first page if no page_id is provided
        $currentPageId = $request->query('page_id', $pages->first()->id);
        $currentPage = $pages->find($currentPageId);
    
        // Handle the case where the current page is not found
        if (!$currentPage) {
            return redirect()->route('courses.pages', $course->id)->with('error', 'Page not found.');
        }
    
        return view('courses.play-course', compact('course', 'pages', 'currentPage'));
    }
    
    public function destroy(Course $course)
    {
        $course->delete();
        return redirect()->route('courses')->with('success', 'Course deleted successfully.');
    }

    
}
