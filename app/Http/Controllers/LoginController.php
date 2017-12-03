<?php

namespace App\Http\Controllers;

use App\Services\MoodleAuthenticationService;
use App\Services\MoodleDataRetrievalService;
use App\Services\MoodleSiteService;
use App\Utils\UrlBuilder;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use JsonMapper;
use Validator;

// use Illuminate\Foundation\Auth\AuthenticatesUsers;
// use Illuminate\Support\Facades\Log;

class LoginController extends Controller
{

    /**
     * @var MoodleDataRetrievalService
     */
    private $moodleDataRetrievalService;


    /**
     * @var MoodleSiteService
     */
    private $moodleSiteService;

    /**
     * @var MoodleAuthenticationService
     */
    private $authenticationService;


    /**
     * LoginController constructor.
     */
    public function __construct()
    {
        $this->moodleDataRetrievalService = new MoodleDataRetrievalService(new UrlBuilder(), new Client(), new JsonMapper());
        $this->moodleSiteService = new MoodleSiteService();
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
        $moodleSite = $request->input('moodleSite');
        $username = $request->input('username');
        $password = $request->input('password');

        $moodleUrl = $this->moodleSiteService->validateMoodleSite($moodleSite);

        if ($moodleUrl == null) {
            return view('pages.login')->with('errorMessage', 'Moodle site not registered.');
        }

        $wsToken = $this->authenticationService->authenticateUser($username, $password);

        if ($wsToken == null) {
            return view('pages.login')->with('errorMessage', 'User credentials are invalid');
        }

        session(['auth' => true]);

        $user = $this->moodleDataRetrievalService->getUserData($moodleUrl, $wsToken);

        session(['user' => $user]);

        return redirect('student');

    }
}
