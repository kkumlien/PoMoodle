<?php

namespace App\Http\Controllers;

use App\Services\MoodleRestService;
use App\Utils\UrlBuilder;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use JsonMapper;
use Validator;

// use Illuminate\Foundation\Auth\AuthenticatesUsers;
// use Illuminate\Support\Facades\Log;

class LoginController extends Controller
{

    /**
     * @var MoodleRestService
     */
    private $moodleRestService;


    /**
     * LoginController constructor.
     */
    public function __construct()
    {
        $this->moodleRestService = new MoodleRestService(new UrlBuilder(), new Client(), new JsonMapper());
    }


    /**
     * Handles requests for displaying the login page
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function loginPage()
    {
        return view('pages.login');
    }


    /**
     * Handles authenticating users for the application and redirecting them to your home screen
     *
     * @param Request $request
     * @return $this
     */
    public function login(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'moodleSite' => [Rule::in(['https://pomodoro-moodle.c9users.io/moodle'])]
        ], [
            'moodleSite.in' => 'Moodle site not registered.'
        ]);

        if ($validator->fails()) {

            return redirect('/')
                ->withErrors($validator)
                ->withInput();

        }

        $validator = Validator::make($request->all(), [
            'username' => [Rule::in(['finn'])]
            , 'password' => [Rule::in(['finn'])]
        ], [
            'username.in' => 'Invalid user name.'
            , 'password.in' => 'Invalid password.'
        ]);

        if ($validator->fails()) {

            return redirect('/')
                ->withErrors($validator)
                ->withInput();

        }

        session(['auth' => true]);


        $moodleUrl = "https://pomodoro-moodle.c9users.io/moodle";
        $wsToken = "3a8164713cd1a379bbade400c1a2ad7c";

        $user = $this->moodleRestService->getUserData($moodleUrl, $wsToken);

        session(['user' => $user]);

        return redirect('student');

    }
}
