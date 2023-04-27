<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
//Public routes 
Route::get('register', [
  'uses' => 'api\AuthController@getRegister',
  'as' => 'user.getRegister'
]);
Route::post('register', [
  'uses' => 'api\AuthController@register',
  'as' => 'user.register'
]);
Route::post('post-register', [
'uses' => 'ResidentController@register',
'as' => 'user.register'
]);
Route::post('login', [
    'uses' => 'api\AuthController@login',
    'as' => 'user.postLogin'
]);
//api route login for website
// Route::post('login', [
//   'uses' => 'LoginController@postLogin',
//   'as' => 'user.postLogin'
// ]);
Route::post('save-user', 'Api\AuthController@residentInfo');

//Protected Routes for admin
Route::group(['middleware' => 'role:admin'], function () {
  Route::get('announcement/all', [
    'uses' => 'LandingpageController@getAllAnnouncements',
    'as' => 'landingpage.getAllAnnouncements'
  ]);
  Route::get('/dashboard', [
    'uses' => 'DashboardController@dashboard', 
    'as' => 'admin.dashboard'
  ]);
  //Announcement
    Route::post('announcement/create', [
        'uses' => 'DashboardController@storeAnnouncement', 
        'as' => 'admin.storeAnnouncement'
    ]);
  //Employer
    Route::get('employer/all', [
        'uses' => 'EmployerController@getAllEmployers',
        'as' => 'admin.getAllEmployers'
    ]);
    Route::get('employee/all', [
        'uses' => 'EmployeeController@getAllEmployees',
        'as' => 'admin.getAllEmployees'
    ]);
  //Job offer
    Route::get('joboffer/all', [
        'uses' => 'JobofferController@getAllJoboffers',
        'as' => 'job.getAllJoboffers'
    ]);
    Route::get('apply-job/{id}', [
        'uses' => 'ApplicantController@view',
        'as' => 'applicant.view'
    ]);
  //Applicants
    Route::get('applicants/all', [
        'uses' => 'ApplicantController@getAllApplicants', 
        'as' => 'applicant.getAllApplicants'
    ]);
    Route::get('applicants/edit/{id}', [
        'uses' => 'ApplicantController@edit',
        'as' => 'applicant.editApplicant'
    ]);
    Route::post('applicants/download/{resume_file}', [
        'uses' => 'ApplicantController@downloadFile',
        'as' => 'applicant.downloadFile'
    ]);
    Route::delete('/applicants/{id}', [
        'uses' => 'ApplicantController@delete',
        'as' => 'applicant.delete'
    ]);
  //Donation 
    Route::get('report-donation/all', [
      'uses' => 'ReportController@getDonationReport', 
      'as' => 'report.getDonationReport'
    ]);
  //Complaints
    Route::get('complaints/all', [
        'uses' => 'ComplaintController@getAllComplaints', 
        'as' => 'complaint.getAllComplaints'
    ]);
    Route::get('report-complaint/all', [
        'uses' => 'ReportController@getComplaintReport', 
        'as' => 'report.getComplaintReport'
    ]);
    Route::get('complaint-edit/{id}', [
      'uses' => 'ComplaintController@editComplaint', 
      'as' => 'complaint.editComplaint'
    ]);
    Route::get('complaint-update/{id}', [
      'uses' => 'ComplaintController@updateComplaint', 
      'as' => 'complaint.updateComplaint'
    ]);
    Route::post('add-schedule/{id}', [
      'uses' => 'ComplaintController@createSchedule', 
      'as' => 'complaint.createSchedule'
    ]);
    Route::get('pending-complaints/all', [
      'uses' => 'ComplaintController@getPendingComplaints', 
      'as' => 'complaint.getPendingComplaints'
    ]);
    Route::get('on-process-complaints/all', [
      'uses' => 'ComplaintController@getOnProcessComplaints', 
      'as' => 'complaint.getOnProcessComplaints'
    ]);
    Route::delete('complaint/{id}', [
      'uses' => 'ComplaintController@deleteComplaint', 
      'as' => 'complaint.deleteComplaint'
    ]);
  //Clearances
    Route::get('clearances/all', [
        'uses' => 'ClearanceController@getAllClearances', 
        'as' => 'clearance.getAllClearances'
    ]);
    Route::get('report-clearance/all', [
        'uses' => 'ReportController@getClearanceReport', 
        'as' => 'report.getClearanceReport'
    ]);
    Route::get('clearance-preview/{id}', [
      'uses' => 'GenerateController@previewClearance',
      'as' => 'clearance.previewClearance'
    ]);
    Route::get('pending-clearances/all', [
      'uses' => 'ClearanceController@getPendingClearances', 
      'as' => 'clearance.getPendingClearances'
    ]);
    Route::post('pending-clearance/update/{id}', [
      'uses' => 'ClearanceController@updateClearance',
      'as' => 'barangayid.updateClearance'
    ]);
  //Certificates
    Route::get('certificates/all', [
        'uses' => 'CertificateController@getAllCertificates', 
        'as' => 'certificate.getAllCertificates'
    ]);
    Route::get('certificate-preview/{id}', [
      'uses' => 'GenerateController@previewCertificate',
      'as' => 'certificate.previewCertificate'
    ]);
    Route::post('certificate/update/{id}', [
      'uses' => 'CertificateController@updateThisCertificate',
      'as' => 'certificate.updateThisCertificate'
    ]);
    Route::get('report-certificate/all', [
        'uses' => 'ReportController@getCertificateReport', 
        'as' => 'report.getCertificateReport'
    ]);
    Route::get('pending-certificates/all', [
      'uses' => 'CertificateController@getPendingCertificates', 
      'as' => 'certificate.getPendingCertificates'
    ]);
    Route::post('pending-certificate/update/{id}', [
      'uses' => 'CertificateController@updateThisCertificate',
      'as' => 'certificate.updateThisCertificate'
    ]);
  //Barangay ID
    Route::get('barangayids/all', [
        'uses' => 'BarangayidController@getAllBarangayids', 
        'as' => 'barangayid.getAllBarangayids'
    ]);
    Route::get('report-barangay-id/all', [
        'uses' => 'ReportController@getBarangayidReport', 
        'as' => 'report.getBarangayidReport'
    ]);
    Route::get('pending-barangayids/all', [
      'uses' => 'BarangayidController@getPendingBarangayids', 
      'as' => 'certificate.getPendingBarangayids'
    ]);
    Route::post('barangayid-request/update/{id}', [
      'uses' => 'BarangayidController@updateRequest',
      'as' => 'barangayid.updateRequest'
    ]);
  //Donation API
    Route::post('/donation/create', [
      'uses' => 'DonationController@create',
      'as' => 'donation.store'
    ]);
    Route::get('cash-donation/all', [
      'uses' => 'DonationController@getAllCashdonations',
      'as' => 'donation.getAllCashdonations'
    ]);
    Route::get('cash-donation/show/{id}', [
      'uses' => 'DonationController@showCashdonation',
      'as' => 'donation.showCashdonation'
    ]);
    Route::delete('cash-donation/{id}', [
      'uses' => 'DonationController@delete',
      'as' => 'donation.delete'
    ]);
    Route::get('cash-donation/all', [
      'uses' => 'DonationController@getAllCashdonations',
      'as' => 'donation.getAllCashdonations'
    ]);
    Route::get('report-other-donation/all', [
      'uses' => 'ReportController@getOtherdonationReport',
      'as' => 'donation.getOtherdonationReport'
    ]);
    Route::get('other-donation/all', [
      'uses' => 'DonationController@getAllOtherdonations',
      'as' => 'donation.getAllOtherdonations'
    ]);
    Route::post('other-donation/store', [
      'uses' => 'DonationController@storeOtherdonation',
      'as' => 'donation.storeOtherdonation'
    ]);
    Route::get('other-donation/edit/{id}', [
      'uses' => 'DonationController@editOtherdonation',
      'as' => 'donation.editOtherdonation'
    ]);
    Route::post('other-donation/{id}', [
      'uses' => 'DonationController@updateOtherdonation',
      'as' => 'donation.updateOtherdonation'
    ]);
    Route::delete('other-donation/{id}', [
      'uses' => 'DonationController@deleteOtherdonation',
      'as' => 'donation.deleteOtherdonation'
    ]);
  //Scholarship
    Route::get('scholarships/all', [
        'uses' => 'ScholarshipController@getAllScholarships', 
        'as' => 'scholarship.getAllScholarships'
    ]);
    Route::get('granted-applicants/all', [
        'uses' => 'ScholarshipController@getGrantedScholarships', 
        'as' => 'scholarship.getGrantedScholarships'
    ]);
    Route::get('not-granted-applicants/all', [
        'uses' => 'ScholarshipController@getNotGrantedScholarships', 
        'as' => 'scholarship.getNotGrantedScholarships'
    ]);
    Route::get('scholarship-applicantion-edit/{id}', [
        'uses' => 'ScholarshipController@edit', 
        'as' => 'scholarship.edit'
    ]);
    Route::get('scholarship-applicant/not-granted/edit/{id}', [
        'uses' => 'ScholarshipController@edit', 
        'as' => 'scholarship.edit'
    ]);
    Route::post('scholarship-applicant/not-granted/{id}', [
        'uses' => 'ScholarshipController@addComment', 
        'as' => 'scholarship.addComment'
    ]);
    Route::post('scholarship-applicant/{id}', [
        'uses' => 'ScholarshipController@updateScholarshipApplication', 
        'as' => 'scholarship.updateScholarshipApplication'
    ]);
    Route::delete('scholarship-applicant/{id}', [
        'uses' => 'ScholarshipController@deleteScholarshipApplication', 
        'as' => 'scholarship.deleteScholarshipApplication'
    ]);
  //Vaccinations 
    Route::post('vaccine/store', [
        'uses' => 'VaccineController@store', 
        'as' => 'vaccine.store'
    ]);
    Route::get('report-schedule-vaccination/all', [
        'uses' => 'ReportController@getVaccinationScheduleReport', 
        'as' => 'report.getVaccinationScheduleReport'
    ]);
    Route::post('vaccination-schedule/{id}', [
      'uses' => 'SchedulevaccineController@update', 
      'as' => 'schedulevaccine.update'
    ]);
    Route::get('vaccination-schedule/all', [
        'uses' => 'SchedulevaccineController@getAllSchedulevaccine', 
        'as' => 'schedulevaccine.getAllSchedulevaccine'
    ]);
    Route::get('vaccination-schedule/waiting-list/all', [
        'uses' => 'SchedulevaccineController@getWaitinglistSchedulevaccine', 
        'as' => 'schedulevaccine.getWaitinglistSchedulevaccine'
    ]);
    Route::get('vaccination-schedule/waiting-list/edit/{id}', [
      'uses' => 'SchedulevaccineController@edit', 
      'as' => 'schedulevaccine.edit'
    ]);  
    Route::post('vaccination-schedule/waiting-list/update/{id}', [
      'uses' => 'SchedulevaccineController@updateVaccinationSchedule', 
      'as' => 'schedulevaccine.updateVaccinationSchedule'
    ]);   
  //Vaccines
    Route::get('vaccines/all', [
        'uses' => 'VaccineController@getAllVaccine', 
        'as' => 'vaccine.getAllVaccine'
    ]);
    Route::get('vaccines/edit/{id}', [
        'uses' => 'VaccineController@edit',
        'as' => 'vaccine.editVaccine'
    ]);
    Route::post('/vaccines/{id}', [
        'uses' => 'VaccineController@update',
        'as' => 'vaccine.updateVaccine'
    ]);
    Route::delete('/vaccines/{id}', [
        'uses' => 'VaccineController@delete',
        'as' => 'vaccine.deleteVaccine'
    ]);
  //Residents
    Route::get('residents/all', [
        'uses' => 'ResidentController@getAllResidents', 
        'as' => 'resident.getAllResidents'
    ]);
    Route::get('resident/edit/{id}', [
      'uses' => 'ResidentController@edit', 
      'as' => 'resident.edit'
    ]);
    Route::post('resident/{id}', [
      'uses' => 'ResidentController@update', 
      'as' => 'resident.update'
    ]);
    Route::get('residents/not-verified/all', [
      'uses' => 'ResidentController@getNotverifiedResidents', 
      'as' => 'resident.getNotverifiedResidents'
    ]);
    Route::get('resident/not-verified/edit/{id}', [
      'uses' => 'ResidentController@edit', 
      'as' => 'resident.edit'
    ]);
    Route::get('residents/verified/all', [
      'uses' => 'ResidentController@getVerifiedResidents', 
      'as' => 'resident.getVerifiedResidents'
    ]);
    Route::get('resident/verified/edit/{id}', [
      'uses' => 'ResidentController@edit', 
      'as' => 'resident.edit'
    ]);
    Route::delete('delete-resident/{id}', [
      'uses' => 'ResidentController@deleteResident', 
      'as' => 'resident.deleteResident'
    ]);
  //Admins
    Route::get('admins/all', [
        'uses' => 'AdminController@getAllAdmins', 
        'as' => 'admin.getAllAdmins'
    ]);
    Route::get('admins/edit/{id}', [
        'uses' => 'AdminController@edit',
        'as' => 'admin.editAdmin'
    ]);
    Route::post('admin/{id}', [
        'uses' => 'AdminController@update',
        'as' => 'admin.update'
    ]);
    Route::post('add-admin', [
      'uses' => 'AdminController@store',
      'as' => 'admin.store'
    ]);
    Route::delete('admin/{id}', [
      'uses' => 'AdminController@delete',
      'as' => 'admin.delete'
    ]);
  //Requested Documents
    Route::get('requests/all', [
        'uses' => 'RequestController@getAllRequests', 
        'as' => 'admin.getAllRequests'
    ]);
});

//Protected Routes for residents 
// Route::group(['middleware' => 'role:resident'], function () {
  Route::get('/home', [
    'uses' => 'LandingpageController@index',
    'as' => 'landingpage.index'
  ]);
  Route::get('announcement/all', [
      'uses' => 'LandingpageController@getAllAnnouncements',
      'as' => 'landingpage.getAllAnnouncements'
  ]);
  Route::get('about-us', [
      'uses' => 'LandingpageController@viewAboutus',
      'as' => 'landingpage.viewAboutus'
  ]);
  //Applicants API 
    Route::post('apply-job/{id}/store', [
      'uses' => 'ApplicantController@storeApplicant',
      'as' => 'applicant.storeApplicant'
    ]);
  //Complaint API
    Route::post('complaint/create', [
      'uses' => 'ComplaintController@create',
      'as' => 'complaint.store'
    ]);
    Route::get('complaint/edit/{id}', [
      'uses' => 'ComplaintController@edit',
      'as' => 'complaint.edit'
    ]);
    Route::post('complaint/{id}', [
      'uses' => 'ComplaintController@update',
      'as' => 'complaint.update'
    ]);
    Route::get('complaint/show/{id}', [
      'uses' => 'ComplaintController@show',
      'as' => 'complaint.show'
    ]);
    Route::delete('complaint/{id}', [
      'uses' => 'ComplaintController@delete',
      'as' => 'complaint.delete'
    ]);
  //Donation API
    Route::post('donation/create', [
        'uses' => 'DonationController@create',
        'as' => 'donation.store'
    ]);
  //Scholarship API
    Route::post('scholarship/create', [
        'uses' => 'ScholarshipController@create',
        'as' => 'scholarship.store'
    ]);
    Route::get('scholarship-application/show/{id}', [
      'uses' => 'ScholarshipController@show',
      'as' => 'scholarship.show'
    ]);
    Route::get('scholarship-application/edit/{id}', [
      'uses' => 'ScholarshipController@edit',
      'as' => 'scholarship.edit'
    ]);
    Route::post('scholarship-application/{id}', [
      'uses' => 'ScholarshipController@update',
      'as' => 'scholarship.update'
    ]);
    Route::delete('scholarship-application/{id}', [
      'uses' => 'ScholarshipController@delete',
      'as' => 'scholarship.delete'
    ]);
  //Barangay ID API
    Route::post('barangayid/create', [
        'uses' => 'BarangayidController@create',
        'as' => 'barangayid.store'
    ]);
    Route::get('barangayid/edit/{id}', [
        'uses' => 'BarangayidController@edit',
        'as' => 'barangayid.edit'
    ]);
    Route::post('barangayid/{id}', [
        'uses' => 'BarangayidController@update',
        'as' => 'barangayid.update'
    ]);
    Route::get('barangayid/show/{id}', [
      'uses' => 'BarangayidController@show',
      'as' => 'barangayid.show'
    ]);
    Route::delete('barangayid/{id}', [
        'uses' => 'BarangayidController@delete',
        'as' => 'barangayid.delete'
    ]);
  //Certificate API
    Route::post('certificate/create', [
        'uses' => 'CertificateController@create',
        'as' => 'certificate.store'
    ]);
    Route::get('certificate/edit/{id}', [
        'uses' => 'CertificateController@editCertificate',
        'as' => 'certificate.editCertificate'
    ]);
    Route::post('certificate/update/{id}', [
      'uses' => 'CertificateController@updateCertificate',
      'as' => 'certificate.updateCertificate'
    ]);
    Route::get('certificate/show/{id}', [
      'uses' => 'CertificateController@show',
      'as' => 'certificate.show'
    ]);
    Route::delete('certificate/delete/{id}', [
        'uses' => 'CertificateController@deleteCertificate',
        'as' => 'certificate.deleteCertificate'
    ]);
  //Clearance API
    Route::post('clearance/create', [
        'uses' => 'ClearanceController@create',
        'as' => 'clearance.store'
    ]);
    Route::get('clearance/edit/{id}', [
        'uses' => 'ClearanceController@edit',
        'as' => 'clearance.edit'
    ]);
    Route::post('clearance/{id}', [
        'uses' => 'ClearanceController@update',
        'as' => 'clearance.update'
    ]);
    Route::get('clearance/show/{id}', [
      'uses' => 'ClearanceController@show',
      'as' => 'clearance.show'
    ]);
    Route::delete('clearance/delete/{id}', [
        'uses' => 'ClearanceController@delete',
        'as' => 'clearance.delete'
    ]);
  //Schedule Vaccination API 
    Route::post('schedule-vaccination/store', [
        'uses' => 'SchedulevaccineController@store', 
        'as' => 'schedulevaccine.store'
    ]);
    Route::get('vaccination-schedule/edit/{id}', [
        'uses' => 'SchedulevaccineController@edit', 
        'as' => 'schedulevaccine.edit'
    ]);
  //My request 
    Route::post('myrequests/submit-payment', [
      'uses' => 'MyrequestController@submitPayment',
      'as' => 'resident.submitPayment'
    ]);
    Route::post('myrequests/submit-gcash-payment', [
      'uses' => 'MyrequestController@submitgcashPayment',
      'as' => 'resident.submitgcashPayment'
    ]);
  //My profile
    Route::get('profile/edit', [
        'uses' => 'ResidentController@editmyProfile',
        'as' => 'resident.editmyProfile'
    ]);
    Route::post('profile/update', [
        'uses' => 'ResidentController@updatemyProfile',
        'as' => 'resident.updatemyProfile'
    ]);
    Route::get('allmyrequests/all', [
        'uses' => 'ResidentController@getAllMyrequests',
        'as' => 'resident.getAllMyrequests'
    ]);
    Route::get('myrequests/all', [
        'uses' => 'MyrequestController@viewMyrequest',
        'as' => 'resident.myrequest'
    ]);
    Route::get('allmyrequests', [
        'uses' => 'ResidentController@getMyProfile',
        'as' => 'resident.getMyProfile'
    ]);
  //Contact Us Route
    Route::post('send-email', [
      'uses' => 'ContactusController@sendMessage',
      'as' => 'emails.sendMessage'
    ]);
// });

