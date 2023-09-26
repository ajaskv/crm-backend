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
Route::post('login', 'ApiController@login');
Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::post('logout', 'ApiController@logout');
    Route::get('get-projects', 'ApiController@getProjects');
    Route::post('add-tracker', 'ApiController@addTracker');
    Route::post('stop-tracker', 'ApiController@stopTracker');
    Route::post('upload-photos', 'ApiController@uploadImage');
    Route::get('users', 'Api\ApiUserController@index');
});
// CRM Lead 
Route::post('store-lead', 'Api\LeadController@store');
Route::get('lead-by-id', 'Api\LeadController@getleadById');
Route::get('lead', 'Api\LeadController@index');
Route::post('edit-lead', 'Api\LeadController@edit');
Route::post('del-lead', 'Api\LeadController@delete');

// CRM Deal 
Route::post('store-deal', 'Api\DealController@store');
Route::get('deal-by-id', 'Api\DealController@getdealById');
Route::get('deal', 'Api\DealController@index');
Route::post('edit-deal', 'Api\DealController@edit');
Route::post('del-deal', 'Api\DealController@delete');

// CRM Form Builder
Route::post('FormBuilder-store', 'Api\FormBuilderController@store');
Route::get('FormBuilder-by-id', 'Api\FormBuilderController@getFormBuilderById');
Route::get('FormBuilder', 'Api\FormBuilderController@index');
Route::post('FormBuilder-edit', 'Api\FormBuilderController@edit');
Route::post('del-FormBuilder', 'Api\FormBuilderController@delete');

// CRM / Form builder / Form Field
Route::post('FormField-store', 'Api\FormFieldController@store');
Route::get('FormField-by-id', 'Api\FormFieldController@getFormFieldById');
Route::get('FormField', 'Api\FormFieldController@index');
Route::post('FormField-edit', 'Api\FormFieldController@edit');
Route::post('del-FormField', 'Api\FormFieldController@delete');
// CRM Contract
Route::post('store-contract', 'Api\ContractController@store');
Route::get('contract-by-id', 'Api\ContractController@getcontractById');
Route::get('contract', 'Api\ContractController@index');
Route::post('edit-contract', 'Api\ContractController@edit');
Route::post('del-contract', 'Api\ContractController@delete');

// CRM System seturp

// pipline
Route::post('store-pipeline', 'Api\CrmSystemSetupController@store_pipeline');
Route::get('pipeline-by-id', 'Api\CrmSystemSetupController@getpipelineById');
Route::get('pipeline', 'Api\CrmSystemSetupController@pipeline');
Route::post('edit-pipeline', 'Api\CrmSystemSetupController@edit_pipeline');
Route::post('del-pipeline', 'Api\CrmSystemSetupController@delete');


// Lead Stage
Route::post('store-lead-stage', 'Api\CrmSystemSetupController@store_lead_stage');
Route::get('lead-stage-by-id', 'Api\CrmSystemSetupController@getlead_stageById');
Route::get('lead-stage', 'Api\CrmSystemSetupController@lead_stage');
Route::post('edit-lead-stage', 'Api\CrmSystemSetupController@edit_lead_stage');
Route::post('del-lead-stage', 'Api\CrmSystemSetupController@lead_stage_delete');

// Deal Stage  
Route::post('store-deal-stage', 'Api\CrmSystemSetupController@store_deal_stage');
Route::get('deal-stage-by-id', 'Api\CrmSystemSetupController@getdeal_stageById');
Route::get('deal-stage', 'Api\CrmSystemSetupController@deal_stage');
Route::post('edit-deal-stage', 'Api\CrmSystemSetupController@edit_deal_stage');
Route::post('del-deal-stage', 'Api\CrmSystemSetupController@deal_stage_delete');

// Sources 
Route::post('store-sources', 'Api\CrmSystemSetupController@store_sources');
Route::get('sources-by-id', 'Api\CrmSystemSetupController@getsourcesById');
Route::get('sources', 'Api\CrmSystemSetupController@sources');
Route::post('edit-sources', 'Api\CrmSystemSetupController@edit_sources');
Route::post('del-sources', 'Api\CrmSystemSetupController@sources_delete');

// Labels
Route::post('store-labels', 'Api\CrmSystemSetupController@store_labels');
Route::get('labels-by-id', 'Api\CrmSystemSetupController@getlabelsById');
Route::get('labels', 'Api\CrmSystemSetupController@labels');
Route::post('edit-labels', 'Api\CrmSystemSetupController@edit_labels');
Route::post('del-labels', 'Api\CrmSystemSetupController@labels_delete');

// Contract Type
Route::post('store-contract-type', 'Api\CrmSystemSetupController@store_contract_type');
Route::get('contract-type-by-id', 'Api\CrmSystemSetupController@getcontract_typeById');
Route::get('contract-type', 'Api\CrmSystemSetupController@contract_type');
Route::post('edit-contract-type', 'Api\CrmSystemSetupController@edit_contract_type');
Route::post('del-contract-type', 'Api\CrmSystemSetupController@contract_type_delete');


// Project system
Route::post('store-project', 'Api\project_system\ProjectController@store_project');
Route::get('project-by-id', 'Api\project_system\ProjectController@getprojectById');
Route::get('project', 'Api\project_system\ProjectController@project');
Route::post('edit-project', 'Api\project_system\ProjectController@edit_project');
Route::post('del-project', 'Api\project_system\ProjectController@project_delete');


// Project task stage

Route::post('store-project-task-stage', 'Api\project_system\ProjectSystemController@store_project_stage');
Route::get('project-task-stage-by-id', 'Api\project_system\ProjectSystemController@getproject_stageById');
Route::get('project-task-stage', 'Api\project_system\ProjectSystemController@project_stage');
Route::post('edit-project-task-stage', 'Api\project_system\ProjectSystemController@edit_project_stage');
Route::post('del-project-task-stage', 'Api\project_system\ProjectSystemController@project_stage_delete');


// Task 

Route::post('Task-store','Api\project_system\TaskController@ProjectTask_store');
Route::get('Task-by-id','Api\project_system\TaskController@getProjectTaskById');
Route::get('Task', 'Api\project_system\TaskController@index');
Route::post('Task-edit','Api\project_system\TaskController@edit_ProjectTask');
Route::post('Task-del','Api\project_system\TaskController@ProjectTask_delete');


// TimeSheet 

Route::post('Timesheet-store','Api\project_system\TimesheetController@Timesheet_store');
Route::get('Timesheet-by-id','Api\project_system\TimesheetController@getTimesheetById');
Route::get('Timesheet', 'Api\project_system\TimesheetController@index');
Route::post('Timesheet-edit','Api\project_system\TimesheetController@edit_Timesheet');
Route::post('Timesheet-del','Api\project_system\TimesheetController@Timesheet_delete');

// Bug 

Route::post('Bug-store','Api\project_system\BugController@Bug_store');
Route::get('Bug-by-id','Api\project_system\BugController@getBugById');
Route::get('Bug', 'Api\project_system\BugController@index');
Route::post('Bug-edit','Api\project_system\BugController@edit_Bug');
Route::post('Bug-del','Api\project_system\BugController@Bug_delete');


// Bug 

Route::post('TimeTracker-store','Api\project_system\TimeTrackersController@TimeTracker_store');
Route::get('TimeTracker-by-id','Api\project_system\TimeTrackersController@getTimeTrackerById');
Route::get('TimeTracker', 'Api\project_system\TimeTrackersController@index');
Route::post('TimeTracker-edit','Api\project_system\TimeTrackersController@edit_TimeTracker');
Route::post('TimeTracker-del','Api\project_system\TimeTrackersController@TimeTracker_delete');
// Project bug

Route::post('store-bugStatus', 'Api\project_system\ProjectSystemController@store_bugStatus');
Route::get('bugStatus-by-id', 'Api\project_system\ProjectSystemController@getbugStatusById');
Route::get('bugStatus', 'Api\project_system\ProjectSystemController@bugStatus');
Route::post('edit-bugStatus', 'Api\project_system\ProjectSystemController@edit_bugStatus');
Route::post('del-bugStatus', 'Api\project_system\ProjectSystemController@bugStatus_delete');


// HRM - Employee Setup
Route::post('store-EmpSetup', 'Api\Hrm\EmpSetupController@store_EmpSetup');
Route::get('EmpSetup-by-id', 'Api\Hrm\EmpSetupController@getEmpSetupById');
Route::get('EmpSetup', 'Api\Hrm\EmpSetupController@EmpSetup');
Route::post('edit-EmpSetup', 'Api\Hrm\EmpSetupController@edit_EmpSetup');
Route::post('del-EmpSetup', 'Api\Hrm\EmpSetupController@EmpSetup_delete');
// HRM - ManageLeave

Route::post('store-MangeLeave', 'Api\Hrm\ManageLeave@store_MangeLeave');
Route::get('MangeLeave-by-id', 'Api\Hrm\ManageLeave@getMangeLeaveById');
Route::get('MangeLeave', 'Api\Hrm\ManageLeave@index');
Route::post('edit-MangeLeave', 'Api\Hrm\ManageLeave@edit_MangeLeave');
Route::post('del-MangeLeave', 'Api\Hrm\ManageLeave@MangeLeave_delete');
Route::post('LeaveAction', 'Api\Hrm\ManageLeave@LeaveAction');

// HRM - Performance seturp
// indicator

Route::post('store-indicator', 'Api\Hrm\IndicatorController@store_indicator');
Route::get('indicator-by-id', 'Api\Hrm\IndicatorController@getindicatorById');
Route::get('indicator', 'Api\Hrm\IndicatorController@index');
Route::post('edit-indicator', 'Api\Hrm\IndicatorController@edit_indicator');
Route::post('del-indicator','Api\Hrm\IndicatorController@indicator_delete');

// Appraisal
Route::post('store-appraisal', 'Api\Hrm\AppraisalController@store_appraisal');
Route::get('appraisal-by-id', 'Api\Hrm\AppraisalController@getappraisalById');
Route::get('appraisal', 'Api\Hrm\AppraisalController@index');
Route::post('edit-appraisal', 'Api\Hrm\AppraisalController@edit_appraisal');
Route::post('del-appraisal','Api\Hrm\AppraisalController@appraisal_delete');

// Goal Tracking
Route::post('GoalTracking-store', 'Api\Hrm\GoalTrackingController@store_GoalTracking');
Route::get('GoalTracking-by-id', 'Api\Hrm\GoalTrackingController@getGoalTrackingById');
Route::get('GoalTracking', 'Api\Hrm\GoalTrackingController@index');
Route::post('edit-GoalTracking', 'Api\Hrm\GoalTrackingController@edit_GoalTracking');
Route::post('del-GoalTracking','Api\Hrm\GoalTrackingController@GoalTracking_delete');

// Traning
Route::post('Training-store', 'Api\Hrm\TrainingController@store_Training');
Route::get('Training-by-id', 'Api\Hrm\TrainingController@getTrainingById');
Route::get('Training', 'Api\Hrm\TrainingController@index');
Route::post('edit-Training', 'Api\Hrm\TrainingController@edit_Training');
Route::post('del-Training','Api\Hrm\TrainingController@Training_delete');

// Trainer  
Route::post('Trainer-store', 'Api\Hrm\TrainerController@store_Trainer');
Route::get('Trainer-by-id', 'Api\Hrm\TrainerController@getTrainerById');
Route::get('Trainer', 'Api\Hrm\TrainerController@index');
Route::post('edit-Trainer', 'Api\Hrm\TrainerController@edit_Trainer');
Route::post('del-Trainer','Api\Hrm\TrainerController@Trainer_delete');


// Event Setup
Route::post('EventSetup-store', 'Api\Hrm\EventSetupController@store_EventSetup');
// Route::get('EventSetup-by-id', 'Api\Hrm\EventSetupController@getEventSetupById');
Route::get('EventSetup', 'Api\Hrm\EventSetupController@index');
// Route::post('edit-EventSetup', 'Api\Hrm\EventSetupController@edit_EventSetup');
// Route::post('del-EventSetup','Api\Hrm\EventSetupController@EventSetup_delete');

// Meeting
Route::post('Meeting-store', 'Api\Hrm\MeetingController@store_Meeting');
Route::get('Meeting-by-id', 'Api\Hrm\MeetingController@getMeetingById');
Route::get('Meeting', 'Api\Hrm\MeetingController@index');
Route::post('Meeting-edit', 'Api\Hrm\MeetingController@edit_Meeting');
Route::post('del-Meeting','Api\Hrm\MeetingController@Meeting_delete');


// Employee Assets Setup
Route::post('EmpAssetsSetup-store', 'Api\Hrm\EmpAssetsSetupController@store_EmpAssetsSetup');
Route::get('EmpAssetsSetup-by-id', 'Api\Hrm\EmpAssetsSetupController@getEmpAssetsSetupById');
Route::get('EmpAssetsSetup', 'Api\Hrm\EmpAssetsSetupController@index');
Route::post('EmpAssetsSetup-edit', 'Api\Hrm\EmpAssetsSetupController@edit_EmpAssetsSetup');
Route::post('del-EmpAssetsSetup','Api\Hrm\EmpAssetsSetupController@EmpAssetsSetup_delete');

// Document Setup
Route::post('DocumentSetup-store', 'Api\Hrm\DocSetupController@store_DocumentSetup');
Route::get('DocumentSetup-by-id', 'Api\Hrm\DocSetupController@getDocumentSetupById');
Route::get('DocumentSetup', 'Api\Hrm\DocSetupController@index');
Route::post('DocumentSetup-edit', 'Api\Hrm\DocSetupController@edit_DocumentSetup');
Route::post('del-DocumentSetup','Api\Hrm\DocSetupController@DocumentSetup_delete');

// Company Policy
Route::post('ComPolicy-store', 'Api\Hrm\ComPolicyController@store_ComPolicy');
Route::get('ComPolicy-by-id', 'Api\Hrm\ComPolicyController@getComPolicyById');
Route::get('ComPolicy', 'Api\Hrm\ComPolicyController@index');
Route::post('ComPolicy-edit', 'Api\Hrm\ComPolicyController@edit_ComPolicy');
Route::post('del-ComPolicy','Api\Hrm\ComPolicyController@ComPolicy_delete');


// HRM / HrmSystem
// Branch
Route::post('Branch-store', 'Api\Hrm\HrmSystem\BranchController@Branch_store');
Route::get('Branch-by-id', 'Api\Hrm\HrmSystem\BranchController@getBranchById');
Route::get('Branch', 'Api\Hrm\HrmSystem\BranchController@index');
Route::post('Branch-edit', 'Api\Hrm\HrmSystem\BranchController@edit_Branch');
Route::post('Branch-del','Api\Hrm\HrmSystem\BranchController@Branch_delete');

// Departmnt
Route::post('Departmnt-store', 'Api\Hrm\HrmSystem\DepartmntController@Departmnt_store');
Route::get('Departmnt-by-id', 'Api\Hrm\HrmSystem\DepartmntController@getDepartmntById');
Route::get('Departmnt', 'Api\Hrm\HrmSystem\DepartmntController@index');
Route::post('Departmnt-edit', 'Api\Hrm\HrmSystem\DepartmntController@edit_Departmnt');
Route::post('Departmnt-del','Api\Hrm\HrmSystem\DepartmntController@Departmnt_delete');

// Designation
Route::post('Designation-store', 'Api\Hrm\HrmSystem\DesignationController@Designation_store');
Route::get('Designation-by-id', 'Api\Hrm\HrmSystem\DesignationController@getDesignationById');
Route::get('Designation', 'Api\Hrm\HrmSystem\DesignationController@index');
Route::post('Designation-edit', 'Api\Hrm\HrmSystem\DesignationController@edit_Designation');
Route::post('Designation-del','Api\Hrm\HrmSystem\DesignationController@Designation_delete');

// Leave Type
Route::post('LeaveType-store', 'Api\Hrm\HrmSystem\LeaveTypeController@LeaveType_store');
Route::get('LeaveType-by-id', 'Api\Hrm\HrmSystem\LeaveTypeController@getLeaveTypeById');
Route::get('LeaveType', 'Api\Hrm\HrmSystem\LeaveTypeController@index');
Route::post('LeaveType-edit', 'Api\Hrm\HrmSystem\LeaveTypeController@edit_LeaveType');
Route::post('LeaveType-del','Api\Hrm\HrmSystem\LeaveTypeController@LeaveType_delete');

// Document Type
Route::post('DocumentType-store','Api\Hrm\HrmSystem\DocumentTypeController@DocumentType_store');
Route::get('DocumentType-by-id','Api\Hrm\HrmSystem\DocumentTypeController@getDocumentTypeById');
Route::get('DocumentType', 'Api\Hrm\HrmSystem\DocumentTypeController@index');
Route::post('DocumentType-edit','Api\Hrm\HrmSystem\DocumentTypeController@edit_DocumentType');
Route::post('DocumentType-del','Api\Hrm\HrmSystem\DocumentTypeController@DocumentType_delete');

// Document Type
Route::post('PayslipType-store','Api\Hrm\HrmSystem\PayslipTypeController@PayslipType_store');
Route::get('PayslipType-by-id','Api\Hrm\HrmSystem\PayslipTypeController@getPayslipTypeById');
Route::get('PayslipType', 'Api\Hrm\HrmSystem\PayslipTypeController@index');
Route::post('PayslipType-edit','Api\Hrm\HrmSystem\PayslipTypeController@edit_PayslipType');
Route::post('PayslipType-del','Api\Hrm\HrmSystem\PayslipTypeController@PayslipType_delete');

// Document Type
Route::post('AllowanceOpt-store','Api\Hrm\HrmSystem\AllowanceOptController@AllowanceOpt_store');
Route::get('AllowanceOpt-by-id','Api\Hrm\HrmSystem\AllowanceOptController@getAllowanceOptById');
Route::get('AllowanceOpt', 'Api\Hrm\HrmSystem\AllowanceOptController@index');
Route::post('AllowanceOpt-edit','Api\Hrm\HrmSystem\AllowanceOptController@edit_AllowanceOpt');
Route::post('AllowanceOpt-del','Api\Hrm\HrmSystem\AllowanceOptController@AllowanceOpt_delete');


// Loan Option
Route::post('LoanOpt-store','Api\Hrm\HrmSystem\LoanOptController@LoanOpt_store');
Route::get('LoanOpt-by-id','Api\Hrm\HrmSystem\LoanOptController@getLoanOptById');
Route::get('LoanOpt', 'Api\Hrm\HrmSystem\LoanOptController@index');
Route::post('LoanOpt-edit','Api\Hrm\HrmSystem\LoanOptController@edit_LoanOpt');
Route::post('LoanOpt-del','Api\Hrm\HrmSystem\LoanOptController@LoanOpt_delete');

// Loan Option
Route::post('DeductionOpt-store','Api\Hrm\HrmSystem\DeductionOptController@DeductionOpt_store');
Route::get('DeductionOpt-by-id','Api\Hrm\HrmSystem\DeductionOptController@getDeductionOptById');
Route::get('DeductionOpt', 'Api\Hrm\HrmSystem\DeductionOptController@index');
Route::post('DeductionOpt-edit','Api\Hrm\HrmSystem\DeductionOptController@edit_DeductionOpt');
Route::post('DeductionOpt-del','Api\Hrm\HrmSystem\DeductionOptController@DeductionOpt_delete');

// Goal Type
Route::post('GoalType-store','Api\Hrm\HrmSystem\GoalTypeController@GoalType_store');
Route::get('GoalType-by-id','Api\Hrm\HrmSystem\GoalTypeController@getGoalTypeById');
Route::get('GoalType', 'Api\Hrm\HrmSystem\GoalTypeController@index');
Route::post('GoalType-edit','Api\Hrm\HrmSystem\GoalTypeController@edit_GoalType');
Route::post('GoalType-del','Api\Hrm\HrmSystem\GoalTypeController@GoalType_delete');

// Training  Type
Route::post('TrainingType-store','Api\Hrm\HrmSystem\TrainingTypeController@TrainingType_store');
Route::get('TrainingType-by-id','Api\Hrm\HrmSystem\TrainingTypeController@getTrainingTypeById');
Route::get('TrainingType', 'Api\Hrm\HrmSystem\TrainingTypeController@index');
Route::post('TrainingType-edit','Api\Hrm\HrmSystem\TrainingTypeController@edit_TrainingType');
Route::post('TrainingType-del','Api\Hrm\HrmSystem\TrainingTypeController@TrainingType_delete');


// Award  Type
Route::post('AwardType-store','Api\Hrm\HrmSystem\AwardTypeController@AwardType_store');
Route::get('AwardType-by-id','Api\Hrm\HrmSystem\AwardTypeController@getAwardTypeById');
Route::get('AwardType', 'Api\Hrm\HrmSystem\AwardTypeController@index');
Route::post('AwardType-edit','Api\Hrm\HrmSystem\AwardTypeController@edit_AwardType');
Route::post('AwardType-del','Api\Hrm\HrmSystem\AwardTypeController@AwardType_delete');

// Terminal type

Route::post('TerminationType-store','Api\Hrm\HrmSystem\TerminationTypeController@TerminationType_store');
Route::get('TerminationType-by-id','Api\Hrm\HrmSystem\TerminationTypeController@getTerminationTypeById');
Route::get('TerminationType', 'Api\Hrm\HrmSystem\TerminationTypeController@index');
Route::post('TerminationType-edit','Api\Hrm\HrmSystem\TerminationTypeController@edit_TerminationType');
Route::post('TerminationType-del','Api\Hrm\HrmSystem\TerminationTypeController@TerminationType_delete');

// Job Category

Route::post('JobCategory-store','Api\Hrm\HrmSystem\JobCategoryController@JobCategory_store');
Route::get('JobCategory-by-id','Api\Hrm\HrmSystem\JobCategoryController@getJobCategoryById');
Route::get('JobCategory', 'Api\Hrm\HrmSystem\JobCategoryController@index');
Route::post('JobCategory-edit','Api\Hrm\HrmSystem\JobCategoryController@edit_JobCategory');
Route::post('JobCategory-del','Api\Hrm\HrmSystem\JobCategoryController@JobCategory_delete');

// Job Stage

Route::post('JobStage-store','Api\Hrm\HrmSystem\JobStageController@JobStage_store');
Route::get('JobStage-by-id','Api\Hrm\HrmSystem\JobStageController@getJobStageById');
Route::get('JobStage', 'Api\Hrm\HrmSystem\JobStageController@index');
Route::post('JobStage-edit','Api\Hrm\HrmSystem\JobStageController@edit_JobStage');
Route::post('JobStage-del','Api\Hrm\HrmSystem\JobStageController@JobStage_delete');

// Perfomance Type

Route::post('PerformanceType-store','Api\Hrm\HrmSystem\PerformanceTypeController@PerformanceType_store');
Route::get('PerformanceType-by-id','Api\Hrm\HrmSystem\PerformanceTypeController@getPerformanceTypeById');
Route::get('PerformanceType', 'Api\Hrm\HrmSystem\PerformanceTypeController@index');
Route::post('PerformanceType-edit','Api\Hrm\HrmSystem\PerformanceTypeController@edit_PerformanceType');
Route::post('PerformanceType-del','Api\Hrm\HrmSystem\PerformanceTypeController@PerformanceType_delete');

// Competencies

Route::post('Competencies-store','Api\Hrm\HrmSystem\CompetenciesController@Competencies_store');
Route::get('Competencies-by-id','Api\Hrm\HrmSystem\CompetenciesController@getCompetenciesById');
Route::get('Competencies', 'Api\Hrm\HrmSystem\CompetenciesController@index');
Route::post('Competencies-edit','Api\Hrm\HrmSystem\CompetenciesController@edit_Competencies');
Route::post('Competencies-del','Api\Hrm\HrmSystem\CompetenciesController@Competencies_delete');

// HRM RecruitmentSetup
// Job & Job Create
Route::post('Job-store','Api\Hrm\RecruitmentSetup\JobController@Job_store');
Route::get('Job-by-id','Api\Hrm\RecruitmentSetup\JobController@getJobById');
Route::get('Job', 'Api\Hrm\RecruitmentSetup\JobController@index');
Route::post('Job-edit','Api\Hrm\RecruitmentSetup\JobController@edit_Job');
Route::post('Job-del','Api\Hrm\RecruitmentSetup\JobController@Job_delete');

// Job Applicaton
Route::post('Job-applica-store','Api\Hrm\RecruitmentSetup\JobAppliController@Applicaton_store');
Route::get('Job-applica-by-id','Api\Hrm\RecruitmentSetup\JobAppliController@getApplicatonById');
Route::get('Job-applica', 'Api\Hrm\RecruitmentSetup\JobAppliController@index');
Route::post('Job-applica-edit','Api\Hrm\RecruitmentSetup\JobAppliController@edit_Applicaton');
Route::post('Job-applica-del','Api\Hrm\RecruitmentSetup\JobAppliController@Applicaton_delete');

// job candidate
 
Route::get('Job-all-candidate','Api\Hrm\RecruitmentSetup\JobAppliController@getcandidate');
Route::get('Job-candidate','Api\Hrm\RecruitmentSetup\JobAppliController@getApplicatonById');

// job on-boarding
Route::post('Job-boarding-store','Api\Hrm\RecruitmentSetup\JobBoardingController@boarding_store');
Route::get('Job-boarding-by-id','Api\Hrm\RecruitmentSetup\JobBoardingController@getboardingById');
Route::get('Job-boarding', 'Api\Hrm\RecruitmentSetup\JobBoardingController@index');
Route::post('Job-boarding-edit','Api\Hrm\RecruitmentSetup\JobBoardingController@edit_boarding');
Route::post('Job-boarding-del','Api\Hrm\RecruitmentSetup\JobBoardingController@boarding_delete');

// custom question
Route::post('customQus-store','Api\Hrm\RecruitmentSetup\JobcustomQusController@customQus_store');
Route::get('customQus-by-id','Api\Hrm\RecruitmentSetup\JobcustomQusController@getcustomQusById');
Route::get('customQus', 'Api\Hrm\RecruitmentSetup\JobcustomQusController@index');
Route::post('customQus-edit','Api\Hrm\RecruitmentSetup\JobcustomQusController@edit_customQus');
Route::post('customQus-del','Api\Hrm\RecruitmentSetup\JobcustomQusController@customQus_delete');

// custom question
Route::post('Interview-store','Api\Hrm\RecruitmentSetup\InterviewController@Interview_store');
Route::get('Interview-by-id','Api\Hrm\RecruitmentSetup\InterviewController@getInterviewById');
Route::get('Interview', 'Api\Hrm\RecruitmentSetup\InterviewController@index');
Route::post('Interview-edit','Api\Hrm\RecruitmentSetup\InterviewController@edit_Interview');
Route::post('Interview-del','Api\Hrm\RecruitmentSetup\InterviewController@Interview_delete');


// HR Admin system

// Award 

Route::post('Award-store','Api\Hrm\HradminSetup\AwardController@Award_store');
Route::get('Award-by-id','Api\Hrm\HradminSetup\AwardController@getAwardById');
Route::get('Award', 'Api\Hrm\HradminSetup\AwardController@index');
Route::post('Award-edit','Api\Hrm\HradminSetup\AwardController@edit_Award');
Route::post('Award-del','Api\Hrm\HradminSetup\AwardController@Award_delete');

// Transfer 

Route::post('Transfer-store','Api\Hrm\HradminSetup\TransferController@Transfer_store');
Route::get('Transfer-by-id','Api\Hrm\HradminSetup\TransferController@getTransferById');
Route::get('Transfer', 'Api\Hrm\HradminSetup\TransferController@index');
Route::post('Transfer-edit','Api\Hrm\HradminSetup\TransferController@edit_Transfer');
Route::post('Transfer-del','Api\Hrm\HradminSetup\TransferController@Transfer_delete');


// Resignation 

Route::post('Resignation-store','Api\Hrm\HradminSetup\ResignationController@Resignation_store');
Route::get('Resignation-by-id','Api\Hrm\HradminSetup\ResignationController@getResignationById');
Route::get('Resignation', 'Api\Hrm\HradminSetup\ResignationController@index');
Route::post('Resignation-edit','Api\Hrm\HradminSetup\ResignationController@edit_Resignation');
Route::post('Resignation-del','Api\Hrm\HradminSetup\ResignationController@Resignation_delete');


// Trvel 

Route::post('Travel-store','Api\Hrm\HradminSetup\TripController@Travel_store');
Route::get('Travel-by-id','Api\Hrm\HradminSetup\TripController@getTravelById');
Route::get('Travel', 'Api\Hrm\HradminSetup\TripController@index');
Route::post('Travel-edit','Api\Hrm\HradminSetup\TripController@edit_Travel');
Route::post('Travel-del','Api\Hrm\HradminSetup\TripController@Travel_delete');

// Promotion 

Route::post('Promotion-store','Api\Hrm\HradminSetup\PromotionController@Promotion_store');
Route::get('Promotion-by-id','Api\Hrm\HradminSetup\PromotionController@getPromotionById');
Route::get('Promotion', 'Api\Hrm\HradminSetup\PromotionController@index');
Route::post('Promotion-edit','Api\Hrm\HradminSetup\PromotionController@edit_Promotion');
Route::post('Promotion-del','Api\Hrm\HradminSetup\PromotionController@Promotion_delete');

// Compliain 

Route::post('Complaint-store','Api\Hrm\HradminSetup\ComplainController@Complaint_store');
Route::get('Complaint-by-id','Api\Hrm\HradminSetup\ComplainController@getComplaintById');
Route::get('Complaint', 'Api\Hrm\HradminSetup\ComplainController@index');
Route::post('Complaint-edit','Api\Hrm\HradminSetup\ComplainController@edit_Complaint');
Route::post('Complaint-del','Api\Hrm\HradminSetup\ComplainController@Complaint_delete');

// Warning 

Route::post('Warning-store','Api\Hrm\HradminSetup\WarningController@Warning_store');
Route::get('Warning-by-id','Api\Hrm\HradminSetup\WarningController@getWarningById');
Route::get('Warning', 'Api\Hrm\HradminSetup\WarningController@index');
Route::post('Warning-edit','Api\Hrm\HradminSetup\WarningController@edit_Warning');
Route::post('Warning-del','Api\Hrm\HradminSetup\WarningController@Warning_delete');

// Termination 

Route::post('Termination-store','Api\Hrm\HradminSetup\TerminationController@Termination_store');
Route::get('Termination-by-id','Api\Hrm\HradminSetup\TerminationController@getTerminationById');
Route::get('Termination', 'Api\Hrm\HradminSetup\TerminationController@index');
Route::post('Termination-edit','Api\Hrm\HradminSetup\TerminationController@edit_Termination');
Route::post('Termination-del','Api\Hrm\HradminSetup\TerminationController@Termination_delete');

// Announcement 

Route::post('Announcement-store','Api\Hrm\HradminSetup\AnnouncementController@Announcement_store');
Route::get('Announcement-by-id','Api\Hrm\HradminSetup\AnnouncementController@getAnnouncementById');
Route::get('Announcement', 'Api\Hrm\HradminSetup\AnnouncementController@index');
Route::post('Announcement-edit','Api\Hrm\HradminSetup\AnnouncementController@edit_Announcement');
Route::post('Announcement-del','Api\Hrm\HradminSetup\AnnouncementController@Announcement_delete');

// Holidays 

Route::post('Holiday-store','Api\Hrm\HradminSetup\HolidayController@Holiday_store');
Route::get('Holiday-by-id','Api\Hrm\HradminSetup\HolidayController@getHolidayById');
Route::get('Holiday', 'Api\Hrm\HradminSetup\HolidayController@index');
Route::post('Holiday-edit','Api\Hrm\HradminSetup\HolidayController@edit_Holiday');
Route::post('Holiday-del','Api\Hrm\HradminSetup\HolidayController@Holiday_delete');

// zoom Meeting
Route::post('ZoomMeeting-store','Api\ZoomMeetingController@ZoomMeeting_store');
// Route::get('Holiday-by-id','Api\ZoomMeetingController@getHolidayById');
Route::get('ZoomMeeting', 'Api\ZoomMeetingController@index');
//Route::post('Holiday-edit','Api\ZoomMeetingController@edit_Holiday');
Route::post('ZoomMeeting-del','Api\ZoomMeetingController@ZoomMeeting_delete');


// Support System
Route::post('SupportSys-store','Api\SupportSysController@SupportSys_store');
Route::get('SupportSys-by-id','Api\SupportSysController@getSupportSysById');
Route::get('SupportSys', 'Api\SupportSysController@index');
Route::post('SupportSys-edit','Api\SupportSysController@edit_SupportSys');
Route::post('SupportSys-del','Api\SupportSysController@SupportSys_delete');

// Products System
Route::post('ProductSys-store','Api\ProductSysController@ProductSys_store');
Route::get('ProductSys-by-id','Api\ProductSysController@getProductSysById');
Route::get('ProductSys', 'Api\ProductSysController@index');
Route::post('ProductSys-edit','Api\ProductSysController@edit_ProductSys');
Route::post('ProductStock-edit','Api\ProductSysController@ProductStock_edit');
Route::post('ProductSys-del','Api\ProductSysController@ProductSys_delete');


// UserManagment
// user
Route::post('User-store','Api\UserManagment\UserController@User_store');
Route::get('User-by-id','Api\UserManagment\UserController@getUserById');
Route::get('User', 'Api\UserManagment\UserController@index');
Route::post('User-edit','Api\UserManagment\UserController@edit_User');
Route::post('User-del','Api\UserManagment\UserController@User_delete');

// RollController
Route::post('Roll-store','Api\UserManagment\RollController@roll_store');
Route::get('Roll-by-id','Api\UserManagment\RollController@getrollById');
Route::get('Roll', 'Api\UserManagment\RollController@index');
Route::post('Roll-edit','Api\UserManagment\RollController@edit_roll');
Route::post('Roll-del','Api\UserManagment\RollController@roll_delete');

// RollController
Route::post('Client-store','Api\UserManagment\ClientController@Client_store');
Route::get('Client-by-id','Api\UserManagment\ClientController@getClientById');
Route::get('Client', 'Api\UserManagment\ClientController@index');
Route::post('Client-edit','Api\UserManagment\ClientController@edit_Client');
Route::post('Client-del','Api\UserManagment\ClientController@Client_delete');
Route::post('Client-resetPassword','Api\UserManagment\ClientController@resetPassword_Client');

// Accounting System 
Route::post('Customer-store','Api\AccountingSystem\CustomerController@Customer_store');
Route::get('Customer-by-id','Api\AccountingSystem\CustomerController@getCustomerById');
Route::get('Customer', 'Api\AccountingSystem\CustomerController@index');
Route::post('Customer-edit','Api\AccountingSystem\CustomerController@edit_Customer');
Route::post('Customer-del','Api\AccountingSystem\CustomerController@Customer_delete');

// Vendor System 
Route::post('Vendor-store','Api\AccountingSystem\VendorController@Vendor_store');
Route::get('Vendor-by-id','Api\AccountingSystem\VendorController@getVendorById');
Route::get('Vendor', 'Api\AccountingSystem\VendorController@index');
Route::post('Vendor-edit','Api\AccountingSystem\VendorController@edit_Vendor');
Route::post('Vendor-del','Api\AccountingSystem\VendorController@Vendor_delete');

// Proposal System   is not done
Route::post('Proposal-store','Api\AccountingSystem\ProposalController@Proposal_store');
Route::get('Proposal-by-id','Api\AccountingSystem\ProposalController@getProposalById');
Route::get('Proposal','Api\AccountingSystem\ProposalController@index');
Route::post('Proposal-edit','Api\AccountingSystem\ProposalController@edit_Proposal');
Route::post('Proposal-del','Api\AccountingSystem\ProposalController@Proposal_delete');

// Goal 
Route::post('Goal-store','Api\AccountingSystem\GoalController@Goal_store');
Route::get('Goal-by-id','Api\AccountingSystem\GoalController@getGoalById');
Route::get('Goal','Api\AccountingSystem\GoalController@index');
Route::post('Goal-edit','Api\AccountingSystem\GoalController@edit_Goal');
Route::post('Goal-del','Api\AccountingSystem\GoalController@Goal_delete');


// Taxes 
Route::post('Taxes-store','Api\AccountingSystem\TaxesController@Taxes_store');
Route::get('Taxes-by-id','Api\AccountingSystem\TaxesController@getTaxesById');
Route::get('Taxes','Api\AccountingSystem\TaxesController@index');
Route::post('Taxes-edit','Api\AccountingSystem\TaxesController@edit_Taxes');
Route::post('Taxes-del','Api\AccountingSystem\TaxesController@Taxes_delete');


// Category
Route::post('Category-store','Api\AccountingSystem\CategoryController@Category_store');
Route::get('Category-by-id','Api\AccountingSystem\CategoryController@getCategoryById');
Route::get('Category','Api\AccountingSystem\CategoryController@index');
Route::post('Category-edit','Api\AccountingSystem\CategoryController@edit_Category');
Route::post('Category-del','Api\AccountingSystem\CategoryController@Category_delete');

// Unit
Route::post('Unit-store','Api\AccountingSystem\UnitController@Unit_store');
Route::get('Unit-by-id','Api\AccountingSystem\UnitController@getUnitById');
Route::get('Unit','Api\AccountingSystem\UnitController@index');
Route::post('Unit-edit','Api\AccountingSystem\UnitController@edit_Unit');
Route::post('Unit-del','Api\AccountingSystem\UnitController@Unit_delete');

// Custom Field
Route::post('CustomField-store','Api\AccountingSystem\CustomFieldController@CustomField_store');
Route::get('CustomField-by-id','Api\AccountingSystem\CustomFieldController@getCustomFieldById');
Route::get('CustomField','Api\AccountingSystem\CustomFieldController@index');
Route::post('CustomField-edit','Api\AccountingSystem\CustomFieldController@edit_CustomField');
Route::post('CustomField-del','Api\AccountingSystem\CustomFieldController@CustomField_delete');

// Bank Account
Route::post('BackAccount-store','Api\AccountingSystem\BackAccountController@BackAccount_store');
Route::get('BackAccount-by-id','Api\AccountingSystem\BackAccountController@getBackAccountById');
Route::get('BackAccount','Api\AccountingSystem\BackAccountController@index');
Route::post('BackAccount-edit','Api\AccountingSystem\BackAccountController@edit_BackAccount');
Route::post('BackAccount-del','Api\AccountingSystem\BackAccountController@BackAccount_delete');

// Balance Transfer
Route::post('BalanceTransfer-store','Api\AccountingSystem\BalanceTransferController@BalanceTransfer_store');
Route::get('BalanceTransfer-by-id','Api\AccountingSystem\BalanceTransferController@getBalanceTransferById');
Route::get('BalanceTransfer','Api\AccountingSystem\BalanceTransferController@index');
Route::post('BalanceTransfer-edit','Api\AccountingSystem\BalanceTransferController@edit_BalanceTransfer');
Route::post('BalanceTransfer-del','Api\AccountingSystem\BalanceTransferController@BalanceTransfer_delete');

// Chart Accounts
Route::post('ChartAccount-store','Api\AccountingSystem\ChartAccountController@ChartAccount_store');
Route::get('ChartAccount-by-id','Api\AccountingSystem\ChartAccountController@getChartAccountById');
Route::get('ChartAccount','Api\AccountingSystem\ChartAccountController@index');
Route::post('ChartAccount-edit','Api\AccountingSystem\ChartAccountController@edit_ChartAccount');
Route::post('ChartAccount-del','Api\AccountingSystem\ChartAccountController@ChartAccount_delete');

// Jernal Entry
Route::post('JernalEntry-store','Api\AccountingSystem\JernalEntryController@JernalEntry_store');
Route::get('JernalEntry-by-id','Api\AccountingSystem\JernalEntryController@getJernalEntryById');
Route::get('JernalEntry','Api\AccountingSystem\JernalEntryController@index');
Route::post('JernalEntry-edit','Api\AccountingSystem\JernalEntryController@edit_JernalEntry');
Route::post('JernalEntry-del','Api\AccountingSystem\JernalEntryController@JernalEntry_delete');

// Expense > Bill
Route::post('Bill-store','Api\AccountingSystem\BillController@Bill_store');
Route::get('Bill-by-id','Api\AccountingSystem\BillController@getBillById');
Route::get('Bill','Api\AccountingSystem\BillController@index');
Route::post('Bill-edit','Api\AccountingSystem\BillController@edit_Bill');
Route::post('Bill-del','Api\AccountingSystem\BillController@Bill_delete');

// Expense > Payment
Route::post('Payment-store','Api\AccountingSystem\PaymentController@Payment_store');
Route::get('Payment-by-id','Api\AccountingSystem\PaymentController@getPaymentById');
Route::get('Payment','Api\AccountingSystem\PaymentController@index');
Route::post('Payment-edit','Api\AccountingSystem\PaymentController@edit_Payment');
Route::post('Payment-del','Api\AccountingSystem\PaymentController@Payment_delete');

// Expense > DebitNote
Route::post('DebitNote-store','Api\AccountingSystem\DebitNoteController@DebitNote_store');
Route::get('DebitNote-by-id','Api\AccountingSystem\DebitNoteController@getDebitNoteById');
Route::get('DebitNote','Api\AccountingSystem\DebitNoteController@index');
Route::post('DebitNote-edit','Api\AccountingSystem\DebitNoteController@edit_DebitNote');
Route::post('DebitNote-del','Api\AccountingSystem\DebitNoteController@DebitNote_delete');

// Income > Invoice 
Route::post('Invoice-store','Api\AccountingSystem\InvoiceController@Invoice_store');
Route::get('Invoice-by-id','Api\AccountingSystem\InvoiceController@getInvoiceById');
Route::get('Invoice','Api\AccountingSystem\InvoiceController@index');
Route::post('Invoice-edit','Api\AccountingSystem\InvoiceController@edit_Invoice');
Route::post('Invoice-del','Api\AccountingSystem\InvoiceController@Invoice_delete');


// Income > Revenue
Route::post('Revenue-store','Api\AccountingSystem\RevenueController@Revenue_store');
Route::get('Revenue-by-id','Api\AccountingSystem\RevenueController@getRevenueById');
Route::get('Revenue','Api\AccountingSystem\RevenueController@index');
Route::post('Revenue-edit','Api\AccountingSystem\RevenueController@edit_Revenue');
Route::post('Revenue-del','Api\AccountingSystem\RevenueController@Revenue_delete');

// Income > Credit Note
Route::post('CreditNote-store','Api\AccountingSystem\CreditNoteController@CreditNote_store');
Route::get('CreditNote-by-id','Api\AccountingSystem\CreditNoteController@getCreditNoteById');
Route::get('CreditNote','Api\AccountingSystem\CreditNoteController@index');
Route::post('CreditNote-edit','Api\AccountingSystem\CreditNoteController@edit_CreditNote');
Route::post('CreditNote-del','Api\AccountingSystem\CreditNoteController@CreditNote_delete');

// Sytem Setting
Route::get('SettingAdd','Api\AccountingSystem\SystemSetup@setting_store');
Route::post('SettingUpdate','Api\SystemSetup@SettingUpdate');

