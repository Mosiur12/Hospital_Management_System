<?php

namespace App\Http\Controllers;

use App\Category;
use App\Chapter;
use App\Contact;
use App\ContactInformation;
use App\Course;
use App\Enroll;
use App\Event;
use App\EventRegistration;
use App\Payment;
use App\Review;
use App\Setting;
use App\Subscription;
use App\Team;
use App\User;
use App\Wallet;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $categories = Category::where('status','1')->orderBy('name')->get();
        $populars = Course::where('status','1')->where('is_approve', '1')->orderBy('total_student','desc')->limit(4)->get();
        $featuredCourses = Course::where('status','1')->where('is_featured', '1')->orderBy('total_student','desc')->limit(4)->get();
        $newCourses = Course::where('status','1')->where('is_featured', '0')->limit(4)->get();

        return view('frontend.home', compact('categories', 'populars', 'featuredCourses', 'newCourses'));
    }

    public function popularCourse()
    {
        $populars = Course::where('status','1')->where('is_approve', '1')->orderBy('total_student','desc')->paginate(12);
        $randoms = Course::where('status', '1')->where('is_approve', '1')->inRandomOrder()->limit(4)->get();
        return view('frontend.popular_course', compact('populars', 'randoms'));
    }

    public function featuredCourse()
    {
        $featuredCourses = Course::where('status','1')->where('is_featured', '1')->orderBy('total_student','desc')->paginate(12);
        $randoms = Course::where('status', '1')->where('is_approve', '1')->inRandomOrder()->limit(4)->get();
        return view('frontend.featured_course', compact('featuredCourses', 'randoms'));
    }

    public function newCourse()
    {
        $newCourses = Course::where('status','1')->where('is_featured', '0')->orderBy('id','desc')->paginate(12);
        $randoms = Course::where('status', '1')->where('is_approve', '1')->inRandomOrder()->limit(4)->get();
        return view('frontend.new_course', compact('newCourses', 'randoms'));
    }



    public function courseDetails($id)
    {

        Course::find($id)->increment('reviews');
        $chapters = Chapter::where('course_id', $id)->get();
        $courseDetails = Course::where('id', $id)->first();
        $randoms = Course::where('status', '1')->where('is_approve', '1')->inRandomOrder()->limit(3)->get();
        $reviews = Review::where('course_id', $id)->where('status', '1')->orderByDesc('id')->paginate(8);

        return view('frontend.course_details', compact('courseDetails','randoms', 'reviews', 'chapters'));
    }

    public function categoryCourse($id)
    {
        $category = Category::where('id', $id)->first();;
        $data['category_name'] = $category->name;
        $courses = Course::where('category_id', $id)->where('status', '1')->where('is_approve', '1')->paginate(5);
        $randoms = Course::where('status', '1')->where('is_approve', '1')->inRandomOrder()->limit(4)->get();
        return view('frontend.course_category', compact('courses', 'randoms', 'data'));
    }

    public function searchCourse(Request $request)
    {
        $search = $request->search;
        $data['keyword'] = $request->search;
        $courses = Course::where('title', $search)->orWhere('title', 'LIKE', '%'.$search.'%')->where('status','1')->where('is_approve', '1')->orderBy('title')->paginate(8);
        $randoms = Course::where('status', '1')->where('is_approve', '1')->inRandomOrder()->limit(4)->get();
        return view('frontend.course_search', compact('courses', 'randoms', 'data'));
    }

    public function allCourse()
    {
        $courses = Course::where('status', '1')->where('is_approve', '1')->paginate(12);
        $categories = Category::where('status','1')->orderBy('name')->get();
        return view('frontend.course_all', compact('courses', 'categories'));
    }

    public function instructor()
    {
        $instructors = User::where('user_type', 'instructor')->where('status', '1')->paginate(12);
        return view('frontend.instructor', compact('instructors'));
    }

    public function instructorDetails($id)
    {
        $data['course']= Course::where('instructor_id', $id)->count();
        $courses = Course::where('instructor_id', $id)->get();
        $data['students'] = 0;
        $data['reviews'] = 0;

        foreach ($courses as $course)
        {
            $data['students'] += $course->total_student;
            $data['reviews'] += $course->reviews;
        }

        $instructorDetails = User::where('id', $id)->first();
        $courses = Course::where('instructor_id', $id)->where('status','1')->where('is_approve', '1')->orderBy('total_student','desc')->limit(4)->get();
        $about = ContactInformation::where('user_id', $id)->first();
        return view('frontend.instructor_details', compact('instructorDetails', 'courses', 'about', 'data'));
    }

    public function login()
    {
        return view('frontend.login');
    }


    public function registration()
    {
        return view('frontend.registration');
    }

    public function about()
    {
        $aboutSettings = Setting::select('our_history', 'our_mission', 'our_vision', 'featured_image')->first();
        $ourTeamMembers = Team::where('status', '1')->get();
        return view('frontend.about', compact('aboutSettings', 'ourTeamMembers'));
    }

    public function terms()
    {
        $term = Setting::select('terms')->first();
        return view('frontend.terms', compact('term'));
    }
    public function privacy()
    {
        $privacy = Setting::select('privacy')->first();
        return view('frontend.privacy', compact('privacy'));
    }


    public function checkout($id)
    {
        $authId = Auth::user()->id;
        $user = User::where('id', $authId)->first();
        $course = Course::where('id', $id)->first();
        return view('frontend.checkout', compact('user', 'course'));
    }

    public function checkoutStore(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'address' => 'required',
        ]);

        $std = User::where('id', $request->student_id)->first();
        $std->phone = $request->phone;
        $std->address = $request->address;
        $std->update();

        $enroll = Enroll::where('student_id', $request->student_id)->where('course_id', $request->course_id)->first();
        if ($enroll)
        {
            Toastr::error("sorry you already take this course", 'Error');
            return redirect()->back();
        }

        try {
            $enroll =  new Enroll();
            $enroll->student_id = $request->student_id;
            $enroll->course_id = $request->course_id;
            $enroll->status = "1";
            $enroll->save();

            $payment = new Payment();
            $payment->user_id = $request->student_id;
            $payment->course_id = $request->course_id;
            $payment->amount = $request->course_fee;
            $payment->transaction_id = $request->student_id.Str::random(9);
            $payment->status = "1";
            $payment->save();

            $ava = Wallet::where('user_id', $request->instructor_id)->first();
            if ($ava)
            {
                $ava->available = $ava->available+$request->course_fee;
                $ava->update();
            }else{
                $walet = new Wallet();
                $walet->user_id = $request->instructor_id;
                $walet->available = $request->course_fee;
                $walet->save();
            }

            User::find($request->student_id)->increment('total_course');
            Course::find($request->course_id)->increment('total_student');
            return view('frontend.successCheckoutResult');

        }catch (\Exception $e) {
            Toastr::error($e->getMessage(), 'Error');
            return redirect()->back();
        }

    }

    public function contact()
    {
        $setting = Setting::first();
        return view('frontend.contact', compact('setting'));
    }

    public function contactSubmit(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'subject' => 'required',
            'message' => 'required',
        ]);
        //return $request;

        $contact = new Contact();
        $contact->name = $request->name;
        $contact->email = $request->email;
        $contact->subject = $request->subject;
        $contact->message = $request->message;
        $contact->save();

        Toastr::success('Thank you!!! Admin will contact with your as soon as possible', 'Success');
        return redirect()->back();
    }

    public function subscription(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:subscriptions',
        ]);

        $subscription = new Subscription();
        $subscription->email = $request->email;

        $subscription->save();
        Toastr::success('Thank you For Subscription', 'Success');
        return redirect()->back();
    }

    public function eventDetails($id)
    {
        $event = Event::where('id', $id)->first();
        return view('frontend.event-details', compact('event'));
    }

    public function events()
    {
        $events = Event::where('status', '1')->get();
        return view('frontend.event-list', compact('events'));
    }

    public function eventRegistrationForm($id)
    {
        $data['event_id'] = $id;
        return view('frontend.event-registration', $data);
    }

    public function eventRegistration(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:event_registrations',
            'phone' => 'required',
        ]);

        $eventRegistration = new EventRegistration();
        $eventRegistration->name = $request->name;
        $eventRegistration->user_id = \auth()->user()->id;
        $eventRegistration->email = $request->email;
        $eventRegistration->phone = $request->phone;
        $eventRegistration->event_id = $request->event_id;
        $eventRegistration->save();

        Toastr::success('Thank you!! For registration. Authority will contact with your as soon as possible', 'Success');
        return redirect()->back();
    }


}
