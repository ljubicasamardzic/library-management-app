<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BookLending;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $bookLendings = BookLending::with(['book_copy', 'book_copy.book', 'user'])->paginate(BookLending::PER_PAGE);

        // dd($bookLendings);

        // $currentPage = $bookLendings::resolveCurrentPage() - 1;
        $recordsOnPage = ($bookLendings::resolveCurrentPage() - 1) * BookLending::PER_PAGE;
        return view('home', compact(['bookLendings', 'recordsOnPage']));
    }
}
