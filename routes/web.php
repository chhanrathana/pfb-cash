<?php

use App\Http\Controllers\DashboardController;

use App\Http\Controllers\UserController;
use App\Http\Controllers\AddressController;
use App\Http\Controllers\MasterData\BranchController;
use App\Http\Controllers\MasterData\DepositController;

use App\Http\Controllers\Expenses\ExpenseItemController;
use App\Http\Controllers\MasterData\ExpenseTypeController;
use App\Http\Controllers\MasterData\StaffController;
use App\Http\Controllers\Loans\LoanController;
use App\Http\Controllers\Loans\LoanHalfMonthlyController;
use App\Http\Controllers\Loans\LoanTwiceWeeklyController;
use App\Http\Controllers\Loans\LoanWeeklyController;
use App\Http\Controllers\Loans\LoanDailyController;
use App\Http\Controllers\Payments\PaymentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\FinancialReports\AdminFeeRevenueController;
use App\Http\Controllers\FinancialReports\DividendRevenueController;
use App\Http\Controllers\FinancialReports\ExpenseController as FinancialReportsExpenseController;
use App\Http\Controllers\FinancialReports\InterestRevenueController;
use App\Http\Controllers\MasterData\CalendarController;
use App\Http\Controllers\OperationReports\LoanReportController;
use App\Http\Controllers\PaymentLogs\DeductionController as PaymentLogsDeductionController;
use App\Http\Controllers\Payments\InterestController;
use App\Http\Controllers\Payments\DeductionController;
use App\Http\Controllers\StaffReports\AdminFeeRevenueController as StaffReportsAdminFeeRevenueController;
use App\Http\Controllers\StaffReports\ClosingController;
use App\Http\Controllers\StaffReports\InterestRevenueController as StaffReportsInterestRevenueController;
use App\Http\Controllers\StaffReports\StatisticController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Auth::routes(['register' => false, 'reset' => false]);

Route::middleware(['auth'])->group(function () {

    Route::middleware(['has.menu'])->group(function(){


        Route::group(['prefix' => 'profile', 'as' => 'profile.'], function () {
            Route::get('',          [ProfileController::class, 'index'])->name('index');
            Route::post('',         [ProfileController::class, 'store'])->name('store');
            // Route::get('create',    [ProfileController::class, 'create'])->name('create');
            Route::delete('{id}',   [ProfileController::class, 'destroy'])->name('destroy');
            Route::patch('{id}',    [ProfileController::class, 'update'])->name('update');
            Route::get('{id}',      [ProfileController::class, 'show'])->name('show');
            Route::get('{id}/edit', [ProfileController::class, 'edit'])->name('edit');
        });

        Route::get('address/{type}/{id}', [AddressController::class, 'index'])->name('address');
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
        Route::get('/dashboard/print', [DashboardController::class, 'print'])->name('dashboard.print');



        // loans transaction
        Route::group(['prefix' => 'loan', 'as' => 'loan.'], function () {

            Route::get('export',    [LoanController::class, 'export'])->name('export');
            Route::get('download',  [LoanController::class, 'download'])->name('download');

            Route::group(['prefix' => 'list', 'as' => 'list.'], function () {
                Route::get('',          [LoanController::class, 'index'])->name('index');
                Route::delete('{id}',   [LoanController::class, 'destroy'])->name('destroy');
                Route::get('{id}',      [LoanController::class, 'show'])->name('show');
                Route::patch('{id}',    [LoanController::class, 'update'])->name('update');
                Route::get('{id}/edit', [LoanController::class, 'edit'])->name('edit');
            });

            Route::group(['prefix' => 'half-monthly', 'as' => 'half-monthly.'], function () {
                Route::post('',         [LoanHalfMonthlyController::class, 'store'])->name('store');
                Route::get('create',    [LoanHalfMonthlyController::class, 'create'])->name('create');
                Route::patch('{id}',      [LoanHalfMonthlyController::class, 'update'])->name('update');
                Route::get('{id}/edit', [LoanHalfMonthlyController::class, 'edit'])->name('edit');
            });

            Route::group(['prefix' => 'twice-weekly', 'as' => 'twice-weekly.'], function () {
                Route::post('',         [LoanTwiceWeeklyController::class, 'store'])->name('store');
                Route::get('create',    [LoanTwiceWeeklyController::class, 'create'])->name('create');
                Route::patch('{id}',      [LoanTwiceWeeklyController::class, 'update'])->name('update');
                Route::get('{id}/edit', [LoanTwiceWeeklyController::class, 'edit'])->name('edit');
            });

            Route::group(['prefix' => 'weekly', 'as' => 'weekly.'], function () {
                Route::post('',         [LoanWeeklyController::class, 'store'])->name('store');
                Route::get('create',    [LoanWeeklyController::class, 'create'])->name('create');
                Route::patch('{id}',    [LoanWeeklyController::class, 'update'])->name('update');
                Route::get('{id}/edit', [LoanWeeklyController::class, 'edit'])->name('edit');
            });

            Route::group(['prefix' => 'daily', 'as' => 'daily.'], function () {
                Route::post('',         [LoanDailyController::class, 'store'])->name('store');
                Route::get('create',    [LoanDailyController::class, 'create'])->name('create');
                Route::patch('{id}',      [LoanDailyController::class, 'update'])->name('update');
                Route::get('{id}/edit', [LoanDailyController::class, 'edit'])->name('edit');
            });

        });

        Route::group(['prefix' => 'payment', 'as' => 'payment.'], function () {

            Route::get('export',    [PaymentController::class, 'export'])->name('export');
            Route::get('download',  [PaymentController::class, 'download'])->name('download');
            // Route::resource('list', PaymentController::class);
            Route::group(['prefix' => 'list', 'as' => 'list.'], function () {
                Route::get('', [PaymentController::class, 'index'])->name('index');
                // Route::delete('{id}',   [PaymentController::class, 'destroy'])->name('destroy');
                // Route::get('{id}',      [PaymentController::class, 'show'])->name('show');
            });

            Route::group(['prefix' => 'interest', 'as' => 'interest.'], function () {
                Route::get('',          [InterestController::class, 'index'])->name('index');
                Route::post('',         [InterestController::class, 'store'])->name('store');
                Route::patch('{id}',    [InterestController::class, 'update'])->name('update');
                Route::get('{id}/edit', [InterestController::class, 'edit'])->name('edit');
            });

            Route::group(['prefix' => 'deduction', 'as' => 'deduction.'], function () {
                Route::get('',          [DeductionController::class, 'index'])->name('index');
                Route::post('',         [DeductionController::class, 'store'])->name('store');
                Route::patch('{id}',    [DeductionController::class, 'update'])->name('update');
                Route::get('{id}/edit', [DeductionController::class, 'edit'])->name('edit');
            });
        });

        Route::group(['prefix' => 'report-financial', 'as' => 'report-financial.'], function () {
            Route::get('revenue-interest',          [InterestRevenueController::class, 'index'])->name('revenue-interest');
            Route::get('revenue-interest-export',   [InterestRevenueController::class, 'export'])->name('revenue-interest-export');
            Route::get('revenue-admin-fee',         [AdminFeeRevenueController::class, 'index'])->name('revenue-admin-fee');
            Route::get('revenue-dividend',          [DividendRevenueController::class, 'index'])->name('revenue-dividend');
            Route::get('expense',                   [FinancialReportsExpenseController::class, 'index'])->name('expense');
        });

        Route::group(['prefix' => 'report-operation', 'as' => 'report-operation.'], function () {
            Route::get('loan',         [LoanReportController::class, 'index'])->name('loan');
            Route::get('loan-export',  [LoanReportController::class, 'export'])->name('loan-export');
        });

        Route::group(['prefix' => 'report-staff', 'as' => 'report-staff.'], function () {
            Route::get('statistic',         [StatisticController::class, 'index'])->name('statistic');
            Route::get('statistic-export/{id}', [StatisticController::class, 'export'])->name('revenue-interest-export');
            Route::get('revenue-interest',   [StaffReportsInterestRevenueController::class,'index'])->name('revenue-interest');
            Route::get('revenue-admin-fee', [StaffReportsAdminFeeRevenueController::class,'index'])->name('revenue-admin-fee');
//
//            Route::group(['prefix' => 'closing', 'as' => 'closing.'], function () {
//                Route::get('',          [ClosingController::class, 'index'])->name('index');
//                Route::post('',         [ClosingController::class, 'store'])->name('store');
//                Route::get('create',    [ClosingController::class, 'create'])->name('create');
//                // Route::delete('{id}',   [ClosingController::class, 'destroy'])->name('destroy');
//                Route::patch('{id}',    [ClosingController::class, 'update'])->name('update');
//                Route::get('{id}',      [ClosingController::class, 'show'])->name('show');
//                Route::get('{id}/edit', [ClosingController::class, 'edit'])->name('edit');
//            });
        });

        // payment log
        Route::group(['prefix' => 'payment-log', 'as' => 'payment-log.'], function () {
            Route::get('deduction',                 [PaymentLogsDeductionController::class,'index'])->name('deduction');
            Route::post('deduction-reverse/{id}',   [PaymentLogsDeductionController::class,'rollback'])->name('deduction-reverse');
        });

        // Route::group(['prefix' => 'shareholder', 'as' => 'shareholder.'], function () {
        //     Route::get('',          [ShareholderController::class, 'index'])->name('index');
        //     Route::post('',         [ShareholderController::class, 'store'])->name('store');
        //     Route::get('create',    [ShareholderController::class, 'create'])->name('create');
        //     Route::delete('{id}',   [ShareholderController::class, 'destroy'])->name('destroy');
        //     Route::patch('{id}',    [ShareholderController::class, 'update'])->name('update');
        //     Route::get('{id}',      [ShareholderController::class, 'show'])->name('show');
        //     Route::get('{id}/edit', [ShareholderController::class, 'edit'])->name('edit');
        // });

        Route::group(['prefix' => 'expense', 'as' => 'expense.'], function () {
            Route::group(['prefix' => 'item', 'as' => 'item.'], function () {
                Route::get('',          [ExpenseItemController::class, 'index'])->name('index');
                Route::post('',         [ExpenseItemController::class, 'store'])->name('store');
                Route::get('create',    [ExpenseItemController::class, 'create'])->name('create');
                Route::delete('{id}',   [ExpenseItemController::class, 'destroy'])->name('destroy');
                Route::patch('{id}',    [ExpenseItemController::class, 'update'])->name('update');
                Route::get('{id}',      [ExpenseItemController::class, 'show'])->name('show');
                Route::get('{id}/edit', [ExpenseItemController::class, 'edit'])->name('edit');
            });
        });

        Route::group(['prefix' => 'master-data', 'as' => 'master-data.'], function () {

            Route::group(['prefix' => 'calendar', 'as' => 'calendar.'], function () {
                Route::get('',          [CalendarController::class, 'index'])->name('index');
                Route::get('download',  [CalendarController::class, 'download'])->name('download');
                Route::post('',         [CalendarController::class, 'store'])->name('store');
                Route::get('create',    [CalendarController::class, 'create'])->name('create');
                Route::delete('{id}',   [CalendarController::class, 'destroy'])->name('destroy');
                Route::patch('{id}',    [CalendarController::class, 'update'])->name('update');
                Route::get('{id}',      [CalendarController::class, 'show'])->name('show');
                Route::get('{id}/edit', [CalendarController::class, 'edit'])->name('edit');
            });

            Route::group(['prefix' => 'deposit', 'as' => 'deposit.'], function () {
                Route::get('',          [DepositController::class, 'index'])->name('index');
                Route::post('',         [DepositController::class, 'store'])->name('store');
                Route::get('create',    [DepositController::class, 'create'])->name('create');
                Route::delete('{id}',   [DepositController::class, 'destroy'])->name('destroy');
                Route::patch('{id}',    [DepositController::class, 'update'])->name('update');
                Route::get('{id}',      [DepositController::class, 'show'])->name('show');
                Route::get('{id}/edit', [DepositController::class, 'edit'])->name('edit');
            });

            Route::group(['prefix' => 'branch', 'as' => 'branch.'], function () {
                Route::get('',          [BranchController::class, 'index'])->name('index');
                Route::post('',         [BranchController::class, 'store'])->name('store');
                Route::get('create',    [BranchController::class, 'create'])->name('create');
                Route::delete('{id}',   [BranchController::class, 'destroy'])->name('destroy');
                Route::patch('{id}',    [BranchController::class, 'update'])->name('update');
                Route::get('{id}',      [BranchController::class, 'show'])->name('show');
                Route::get('{id}/edit', [BranchController::class, 'edit'])->name('edit');
            });

            Route::group(['prefix' => 'staff', 'as' => 'staff.'], function () {
                Route::get('',          [StaffController::class, 'index'])->name('index');
                Route::post('',         [StaffController::class, 'store'])->name('store');
                Route::get('create',    [StaffController::class, 'create'])->name('create');
                Route::delete('{id}',   [StaffController::class, 'destroy'])->name('destroy');
                Route::patch('{id}',    [StaffController::class, 'update'])->name('update');
                Route::get('{id}',      [StaffController::class, 'show'])->name('show');
                Route::get('{id}/edit', [StaffController::class, 'edit'])->name('edit');
            });

            Route::group(['prefix' => 'expense-type', 'as' => 'expense-type.'], function () {
                Route::get('',          [ExpenseTypeController::class, 'index'])->name('index');
                Route::post('',         [ExpenseTypeController::class, 'store'])->name('store');
                Route::get('create',    [ExpenseTypeController::class, 'create'])->name('create');
                Route::delete('{id}',   [ExpenseTypeController::class, 'destroy'])->name('destroy');
                Route::patch('{id}',    [ExpenseTypeController::class, 'update'])->name('update');
                Route::get('{id}',      [ExpenseTypeController::class, 'show'])->name('show');
                Route::get('{id}/edit', [ExpenseTypeController::class, 'edit'])->name('edit');
            });

        });

        Route::group(['prefix' => 'user', 'as' => 'user.'], function () {
            Route::get('',          [UserController::class, 'index'])->name('index');
            Route::post('',         [UserController::class, 'store'])->name('store');
            Route::get('create',    [UserController::class, 'create'])->name('create');
            Route::delete('{id}',   [UserController::class, 'destroy'])->name('destroy');
            Route::patch('{id}',      [UserController::class, 'update'])->name('update');
            Route::get('{id}',      [UserController::class, 'show'])->name('show');
            Route::get('{id}/edit', [UserController::class, 'edit'])->name('edit');
        });
    });
});

Route::get('/test',[\App\Http\Controllers\TestController::class,'any']);
