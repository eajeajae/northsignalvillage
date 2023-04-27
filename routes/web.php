<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('landingpage.index');
// });
Route::get('/', [
  'uses' => 'LandingpageController@index',
  'as' => 'landingpage.index'
]);
Auth::routes();

Route::group(['middleware' => 'guest'], function() {
    Route::get('register', [
        'uses' => 'api\AuthController@getRegister',
        'as' => 'user.getRegister'
    ]);
    Route::post('register', [
        'uses' => 'ResidentController@register',
        'as' => 'user.register'
    ]);
    Route::get('login', [
        'uses' => 'api\AuthController@getLogin',
        'as' => 'user.getLogin'
    ]);
    Route::post('post-login', [
        'uses' => 'LoginController@postLogin',
        'as' => 'user.postLogin'
    ]);
    
    Route::get('/latest-update', [
      'uses' => 'LandingpageController@latestUpdate',
      'as' => 'landingpage.latestUpdate'
    ]);
});

Route::get('logout', [
    'uses' => 'api\AuthController@getLogout',
    'as' => 'user.logout',
])->middleware('auth');


Route::group(['middleware' => 'role:resident'], function() {
    
    Route::get('about-us', [
        'uses' => 'LandingpageController@viewAboutus',
        'as' => 'aboutbrgy.index'
    ]);
  //Annoncement Route
    Route::get('announcement/all', [
        'uses' => 'LandingpageController@getAllAnnouncements',
        'as' => 'landingpage.getAllAnnouncements'
    ]);
  //Barangay ID Route   
    Route::get('barangayid', [
        'uses' => 'BarangayidController@index',
        'as' => 'barangayid.index'
    ]);
    Route::post('barangayid', [
        'uses' => 'BarangayidController@create',
        'as' => 'barangayid.store'
    ]);
  //Complaint route
    Route::get('complaint', [
        'uses' => 'ComplaintController@index',
        'as' => 'complaint.index'
    ]);
    Route::post('complaint', [
        'uses' => 'ComplaintController@create',
        'as' => 'complaint.store'
    ]);
  //Certificate Route   
    Route::get('certificate', [
        'uses' => 'CertificateController@index',
        'as' => 'certificate.index'
    ]);
    Route::post('certificate', [
        'uses' => 'CertificateController@create',
        'as' => 'certificate.store'
    ]);
    Route::get('certificate/edit/{id}', [
        'uses' => 'MyrequestController@editCertificate',
        'as' => 'certificate.editCertificate'
    ]);
    Route::post('certificate/update', [
        'uses' => 'MyrequestController@updateCertificate',
        'as' => 'certificate.updateCertificate'
    ]);
  //Clearance Route    
    Route::get('clearance', [
        'uses' => 'ClearanceController@index',
        'as' => 'clearance.index'
    ]);
    Route::post('clearance', [
        'uses' => 'ClearanceController@create',
        'as' => 'clearance.store'
    ]);
  //Donation Route    
    Route::get('donation', [
        'uses' => 'DonationController@index',
        'as' => 'donation.index'
    ]);
    Route::post('donation', [
        'uses' => 'DonationController@create',
        'as' => 'donation.store'
    ]);
  //Schedule Vaccination Route
    Route::get('schedule-vaccination', [
        'uses' => 'SchedulevaccineController@index', 
        'as' => 'schedulevaccine.index'
    ]);
    Route::post('schedule-vaccination/store', [
        'uses' => 'SchedulevaccineController@store', 
        'as' => 'schedulevaccine.store'
    ]);
  //Scholarship Route    
    Route::get('scholarship', [
        'uses' => 'ScholarshipController@index',
        'as' => 'scholarship.index'
    ]);
    Route::post('scholarship', [
        'uses' => 'ScholarshipController@create',
        'as' => 'scholarship.store'
    ]);
  //Job Fair Route
    Route::get('apply-job', [
        'uses' => 'ApplicantController@index',
        'as' => 'applicant.create'
    ]);
    Route::get('apply-job/{id}', [
        'uses' => 'ApplicantController@viewJobdetails',
        'as' => 'applicant.viewJobdetails'
    ]);
    // Route::get('apply-job/{id}', [
    //     'uses' => 'ApplicantController@view',
    //     'as' => 'applicant.view'
    // ]);
    Route::post('apply-job/store/{id}', [
      'uses' => 'ApplicantController@storeApplicant',
      'as' => 'applicant.storeApplicant'
    ]);
  //My profile Route
    Route::get('allmyrequests', [
        'uses' => 'ResidentController@getAllMyrequests',
        'as' => 'resident.getAllMyrequests'
    ]);
  //My request Route
    Route::get('myrequests', [
        'uses' => 'MyrequestController@view',
        'as' => 'resident.myrequest'
    ]);
    Route::post('myrequests/submit-payment', [
        'uses' => 'MyrequestController@submitPayment',
        'as' => 'resident.submitPayment'
    ]);
    Route::get('allmyrequests/all', [
        'uses' => 'ResidentController@getAllMyrequests',
        'as' => 'resident.getAllMyrequests'
    ]);
  //Contact Us Route
    Route::post('/send-email', [
        'uses' => 'ContactusController@sendMessage',
        'as' => 'emails.sendMessage'
    ]);
    // Route::get('/send-email', [App\Http\Controllers\ContactusController::class, 'index']);
});

Route::group(['middleware' => 'role:admin'], function() {
    Route::get('/dashboard', [
        'uses' => 'DashboardController@index', 
        'as' => 'admin.dashboard'
    ]);
    Route::get('/requests', [
        'uses' => 'DashboardController@getAllRequests', 
        'as' => 'admin.requests'
    ]);
  //Announcement Route
    Route::get('announcement', [
        'uses' => 'AnnouncementController@index', 
        'as' => 'admin.announcement'
    ]);
    Route::post('announcement/store', [
        'uses' => 'AnnouncementController@storeAnnouncement', 
        'as' => 'admin.storeAnnouncement'
    ]);
  //Employee Route
    Route::get('employee', [
        'uses' => 'EmployerController@index', 
        'as' => 'admin.employer'
    ]);
    Route::post('employee/store', [
        'uses' => 'EmployeeController@storeEmployee', 
        'as' => 'admin.storeEmployee'
    ]);
  //Employer Route
    Route::get('employer', [
        'uses' => 'EmployerController@index', 
        'as' => 'admin.employer'
    ]);
    Route::post('employee/store', [
        'uses' => 'EmployeeController@storeEmployee', 
        'as' => 'admin.storeEmployer'
    ]);
  //Job offer Route
    Route::get('job-offer', [
        'uses' => 'JobofferController@index', 
        'as' => 'job.index'
    ]);
    Route::post('job-offer/store', [
        'uses' => 'JobofferController@storeJoboffer', 
        'as' => 'job.storeJoboffer'
    ]);
  //Applicants
    Route::get('applicants/all', [
        'uses' => 'ApplicantController@getAllApplicants', 
        'as' => 'applicant.getAllApplicants'
    ]);
    Route::get('applicants', [
        'uses' => 'ApplicantController@viewall', 
        'as' => 'applicant.viewall'
    ]);
    Route::post('applicants/download-file', [
        'uses' => 'ApplicantController@downloadFile', 
        'as' => 'applicant.downloadFile'
    ]);
  //Complaints Route
    Route::get('complaints/all', [
        'uses' => 'ComplaintController@getAllComplaints', 
        'as' => 'complaint.getAllComplaints'
    ]);
    Route::get('complaints', [
        'uses' => 'ComplaintController@viewall', 
        'as' => 'complaint.viewall'
    ]);
    Route::get('pending-complaints', [
      'uses' => 'ComplaintController@pending', 
      'as' => 'complaint.pending'
    ]);
    Route::get('on-process-complaints', [
      'uses' => 'ComplaintController@onprocess', 
      'as' => 'complaint.onProcess'
    ]);
    Route::post('generate-summoning-letter', [
      'uses' => 'GenerateController@processSummon',
      'as' => 'complaint.processSummon'
    ]);
  //Clearances Route
    Route::get('clearances/all', [
        'uses' => 'ClearanceController@getAllClearances', 
        'as' => 'clearance.getAllClearances'
    ]);
    Route::get('clearance-requests', [
        'uses' => 'ClearanceController@viewall', 
        'as' => 'clearance.viewall'
    ]);
    Route::get('pending-clearances', [
      'uses' => 'ClearanceController@pending', 
      'as' => 'clearance.pending'
    ]);
    Route::post('generate-clearance', [
      'uses' => 'GenerateController@processClearance',
      'as' => 'clearance.processClearance'
    ]);
  //Certificates Route
    Route::get('certificates/all', [
        'uses' => 'CertificateController@getAllCertificates', 
        'as' => 'certificate.getAllCertificates'
    ]);
    Route::get('certificate-requests', [
        'uses' => 'CertificateController@viewall', 
        'as' => 'certificate.viewall'
    ]);
    Route::get('pending-certificates', [
      'uses' => 'CertificateController@pending', 
      'as' => 'certificate.pending'
    ]);
    Route::post('generate-certificate', [
      'uses' => 'GenerateController@processCertificate',
      'as' => 'certificate.processCertificate'
    ]);
  //Barangay ID Route
    Route::get('barangayid-requests/all', [
        'uses' => 'BarangayidController@getAllBarangayids', 
        'as' => 'barangayid.getAllBarangayids'
    ]);
    Route::get('barangayid-requests', [
        'uses' => 'BarangayidController@viewall', 
        'as' => 'barangayid.viewall'
    ]);
    Route::get('pending-barangayid-requests', [
      'uses' => 'BarangayidController@pending', 
      'as' => 'barangayid.pending'
  ]);
  //Donation
  Route::get('donations/all', [
    'uses' => 'DonationController@getAllBarangayids', 
    'as' => 'barangayid.getAllBarangayids'
  ]);
  Route::get('donations', [
    'uses' => 'DonationController@viewall', 
    'as' => 'donation.viewall'
  ]);
  //Scholarships Route
    Route::get('scholarships/all', [
        'uses' => 'ScholarshipController@getAllScholarships', 
        'as' => 'scholarship.getAllScholarships'
    ]);
    Route::get('scholarships', [
        'uses' => 'ScholarshipController@viewall', 
        'as' => 'scholarship.viewall'
    ]);
    Route::get('granted-applicants', [
        'uses' => 'ScholarshipController@viewGrantedApplicants', 
        'as' => 'scholarship.viewGrantedApplicants'
    ]);
    Route::get('not-granted-applicants', [
        'uses' => 'ScholarshipController@viewNotGrantedApplicants', 
        'as' => 'scholarship.viewNotGrantedApplicants'
    ]);
  //Vaccination Schedule Route
    Route::get('vaccination-schedule/all', [
        'uses' => 'SchedulevaccineController@getAllSchedulevaccine', 
        'as' => 'scholarship.getAllSchedulevaccine'
    ]);
    Route::get('vaccination-schedules', [
        'uses' => 'SchedulevaccineController@viewall', 
        'as' => 'schedulevaccine.viewall'
    ]);
    Route::get('vaccination-schedule/waiting-list', [
        'uses' => 'SchedulevaccineController@waitinglist', 
        'as' => 'schedulevaccine.waitinglist'
    ]);
    Route::get('vaccination-schedule/waiting-list/all', [
        'uses' => 'SchedulevaccineController@getWaitinglistSchedulevaccine', 
        'as' => 'schedulevaccine.getWaitinglistSchedulevaccine'
    ]);
  //Vaccines Route
    Route::get('vaccines/all', [
        'uses' => 'VaccineController@getAllVaccine', 
        'as' => 'vaccine.getAllVaccine'
    ]);
    Route::get('vaccines', [
        'uses' => 'VaccineController@viewall', 
        'as' => 'vaccine.viewall'
    ]);
    Route::post('vaccines/store', [
        'uses' => 'VaccineController@store', 
        'as' => 'vaccine.store'
    ]);
  //List of residents Route
    Route::get('residents', [
        'uses' => 'ResidentController@viewall', 
        'as' => 'resident.viewall'
    ]);
    Route::get('residents/not-verified', [
      'uses' => 'ResidentController@notverifiedResidents', 
      'as' => 'resident.notverified'
    ]);
    Route::get('residents/verified', [
      'uses' => 'ResidentController@verifiedResidents', 
      'as' => 'resident.verified'
    ]);
  //List of Admins Route
    Route::get('admins', [
        'uses' => 'AdminController@viewall', 
        'as' => 'admin.viewall'
    ]);
    Route::post('admin/store', [
        'uses' => 'AdminController@store', 
        'as' => 'admin.store'
    ]);
    Route::post('admins/{id}', [
        'uses' => 'AdminController@update',
        'as' => 'admin.updateAdmin'
    ]);
  //Requests
    Route::get('requests', [
        'uses' => 'RequestController@index',
        'as' => 'admin.requests'
    ]);
  //Reports
    Route::get('reports-barangay-id', [
        'uses' => 'ReportController@viewBrgyidReport', 
        'as' => 'report.viewBrgyidReport'
    ]);
    Route::get('reports-certificate', [
        'uses' => 'ReportController@viewCertificateReport', 
        'as' => 'report.viewCertificateReport'
    ]);
    Route::get('reports-clearance', [
        'uses' => 'ReportController@viewClearanceReport', 
        'as' => 'report.viewClearanceReport'
    ]);
    Route::get('reports-complaint', [
        'uses' => 'ReportController@viewComplaintReport', 
        'as' => 'report.viewComplaintReport'
    ]);
    Route::get('reports-vaccination-schedule', [
        'uses' => 'ReportController@viewVaccinationScheduleReport', 
        'as' => 'report.viewVaccinationScheduleReport'
    ]);
    Route::get('reports-donation', [
      'uses' => 'ReportController@viewDonationReport', 
      'as' => 'report.viewDonationReport'
  ]);
});

Route::group(['middleware' => 'role:resident, role:admin'], function() {
    //My profile Route
    Route::get('profile', [
        'uses' => 'ResidentController@getMyProfile',
        'as' => 'resident.profile'
    ]);
    Route::get('profile/edit', [
        'uses' => 'ResidentController@editmyProfile',
        'as' => 'resident.editmyProfile'
    ]);
        Route::post('profile/update', [
        'uses' => 'ResidentController@updatemyProfile',
        'as' => 'resident.updatemyProfile'
    ]);
    //Setting Route
    Route::get('settings', [
        'uses' => 'ResidentController@setting',
        'as' => 'resident.setting'
    ]);
});
//My profile Route
Route::get('profile', [
    'uses' => 'ResidentController@getMyProfile',
    'as' => 'resident.profile'
]);
Route::get('profile/edit', [
    'uses' => 'ResidentController@editmyProfile',
    'as' => 'resident.editmyProfile'
]);
    Route::post('profile/update', [
    'uses' => 'ResidentController@updatemyProfile',
    'as' => 'resident.updatemyProfile'
]);
//Setting Route
Route::get('settings', [
    'uses' => 'ResidentController@setting',
    'as' => 'resident.setting'
]);
