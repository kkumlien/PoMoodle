<?php

namespace App\Http\Controllers;

use App\Constants\SessionConstant;
use App\Services\HttpJsonResponseService;
use App\Services\MoodleAuthentication;
use App\Services\MoodleDataRetrieval;
use App\Services\MoodleDataStorage;
use App\Services\MoodleSiteValidator;
use App\Utils\UrlBuilder;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use JsonMapper;
use Validator;
use Illuminate\Support\Facades\Log;

class LoginController extends Controller
{

    /**
     * @var MoodleDataRetrieval
     */
    private $moodleDataRetrieval;

    /**
     * @var MoodleSiteValidator
     */
    private $moodleSiteValidator;

    /**
     * @var MoodleAuthentication
     */
    private $authenticationService;

    /**
     * @var MoodleDataStorage
     */
    private $moodleDataStorage;

    /**
     * LoginController constructor.
     */
    public function __construct()
    {
        $httpJsonResponseService = new HttpJsonResponseService(new Client(), new JsonMapper());
        $this->moodleDataRetrieval = new MoodleDataRetrieval(new UrlBuilder(), $httpJsonResponseService);
        $this->moodleSiteValidator = new MoodleSiteValidator();
        $this->authenticationService = new MoodleAuthentication(new UrlBuilder(), $httpJsonResponseService);
        $this->moodleDataStorage = new MoodleDataStorage();
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

        $moodleSiteData = $this->moodleSiteValidator->validateMoodleSite($moodleSite);

        $moodleUrl = empty($moodleSiteData->site_url) ? null : $moodleSiteData->site_url;

        if ($moodleUrl == null) {
            return view('pages.login')->with('errorMessage', 'Moodle site not registered.');
        }

        $wsToken = $this->authenticationService->authenticateUser($moodleUrl, $username, $password);

        if ($wsToken == null) {
            return view('pages.login')->with('errorMessage', 'Invalid user credentials.');
        }

        $user = $this->moodleDataRetrieval->getUserData($moodleUrl, $wsToken);

        // Create or update data in our local database
        $userID = $this->moodleDataStorage->storeUserData($user, $moodleSiteData->site_id);

        //Log::debug(print_r($user, true));

        // We're authenticated, happy days
        session([SessionConstant::AUTH => true]);
        session([SessionConstant::USER => $user]);
        session([SessionConstant::USER_ID => $userID]);

        return redirect('student');

    }

}
