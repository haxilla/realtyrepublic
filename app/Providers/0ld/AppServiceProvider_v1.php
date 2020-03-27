<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider_v1 extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //great working example of how to
        //include multiple models in one view
        view()->composer(['layouts.partials.emailCountsAZ',
        'mdbxMember.includes.pricing.emailCountsAZ',],
        function($view){
            $view
            ->with('cAzphxmetro',\App\models\distro\azphxmetro::count())
            ->with('cAzphxne',\App\models\distro\azphxne::count())
            ->with('cAzphxse',\App\models\distro\azphxse::count())
            ->with('cAzphxwv',\App\models\distro\azphxwv::count())
            ->with('cAznaz',\App\models\distro\aznaz::count())
            ->with('cAzsaz',\App\models\distro\azsaz::count());
        });

        // **  panels  **
        //scheduleCounts
        view()->composer(['mdbxAdmin.panels.scheduleCounts'],
        function($view){
            $view
            ->with('recentCompleteCount',\App\models\core\propdeliv::recentCompleteCount())
            ->with('currentCampCount',\App\models\core\propdelivnow::currentCampCount())
            ->with('authorizedCount',\App\models\core\propdelivnow::authorizedCount())
            ->with('unauthorizedCount',\App\models\core\propdelivnow::unauthorizedCount());
        });
        //versionInfo
        view()->composer(['mdbxDev.panels.versionInfo',],
        function($view){
        $view
            ->with('versionInfo',\App\models\dev\masterVersion::versionInfo());
        });
        //memberMessages
        view()->composer(['mdbxAdmin.panels.memberMessages'],
        function($view){
        $view
            ->with('memberMessages',\App\models\admin\remailmsg::memberMessages())
            ->with('newTrialRequest',\App\models\admin\newaccessrequest::newTrialRequest())
            ->with('autoPurchase',\App\models\core\propagent::autoPurchase())
            ->with('autoTrials',\App\models\core\propagent::autoTrials());
        });
        //journalCounts
        view()->composer(['mdbxDev.panels.journalCounts'],
        function($view){
        $view
            ->with('activeTaskCount',\App\models\dev\devtask::activeTaskCount())
            ->with('priorityTaskCount',\App\models\dev\devtask::priorityTaskCount());
        });
        //adminSynch
        view()->composer([
        'mdbxAdmin.panels.adminSynch'],
        function($view){
            $view
            ->with('synchSk1Count',\App\models\core\propmeta::synchSk1Count())
            ->with('synchPassHashCount',\App\models\core\propagent::synchPassHashCount())
            ->with('synchFlyerOfficeIDCount',\App\models\core\propflyer::synchFlyerOfficeIDCount())
            ->with('archivePhotoCount',\App\models\mdbxArchive\archiveFlyerPhotoModel::count())
            ->with('currentPhotoCount',\App\models\core\propphoto::count())
            ->with('resizePhoto_w1000',\App\models\core\propflyer::resizePhoto_w1000())
            ->with('getNewPhotoCount',\App\models\core\propflyer::getNewPhotoCount())
            ->with('existCheckRemailPhotoCount',\App\models\maindata\maindataRemailPhoto::existCheckCount())
            ->with('existCheckPropPhotoCount',\App\models\core\propphoto::existCheckCount());
        });
        //indexHomes
        view()->composer([
        'mdbxAdmin.panels.indexHomes'],
        function($view){
            $view
            ->with('frontPageIDdesc',\App\models\core\propflyer::frontPageIDdesc());
        });

        //  **  includes  **
        //devActiveTasks
        view()->composer([
            'mdbxDev.includes.devActiveTasks',
            'mdbxDev.includes.fullTaskList'],
            function($view){
            $view
            ->with('allActiveTasks',\App\models\dev\devtask::allActiveTasks())
            ->with('adminInfo',\App\models\admin\adminTable::adminInfo());
        });
        //memberMessageList
        view()->composer(['mdbxAdmin.includes.memberMessageList'],
        function($view){
            $view
            ->with('adminMode',\App\models\admin\adminOption::adminModes())
            ->with('memberMessages',\App\models\admin\remailmsg::memberMessages());
        });
        //devActiveTasks
        view()->composer(['mdbxAdmin.includes.showTrialList'],
        function($view){
            $view
            ->with('newTrialRequest',\App\models\admin\newaccessrequest::newTrialRequest())
            ->with('autoTrials',\App\models\core\propagent::autoTrials())
            ->with('autoPurchase',\App\models\core\propagent::autoPurchase())
            ->with('testPurchases',\App\models\core\allorder::testPurchases())
            ->with('trialApproved',\App\models\admin\newaccessrequest::trialApproved());
        });
        //devActiveTasks
        view()->composer(['mdbxDev.includes.singleTaskView'],
        function($view){
            $view
            ->with('adminInfo',\App\models\admin\adminTable::adminInfo());
        });
        //versionForm
        view()->composer(['mdbxAdmin.includes.versionForm'],
            function($view){
            $view
                ->with('versionInfo',\App\models\dev\masterVersion::versionInfo())
                ->with('gitPushInfo',\App\models\dev\adminGitLog::gitPushInfo())
                ->with('gitPullInfo',\App\models\dev\adminGitLog::gitPullInfo())
                ->with('currentVersionList',\App\models\dev\devtask::currentVersionList())
                ->with('versionHistory',\App\models\dev\masterVersion::versionHistory());
        });
        // ** navigation
        //adminTopNav
        view()->composer(['mdbxAdmin.navigation.adminTopNav'],
            function($view){
            $view
                ->with('priorityTaskCount',\App\models\dev\devtask::priorityTaskCount())
                ->with('adminInfo',\App\models\admin\adminTable::adminInfo());

        });

        view()->composer(['mdbxAdmin.includes.synchCounts',],
            function($view){
            $view
                ->with('adminMode',\App\models\admin\adminOption::adminModes())
                ->with('thisDelivNowCount',\App\models\core\propdelivnow::thisDelivNowCount())
                ->with('thisDelivCount',\App\models\core\propdeliv::thisDelivCount())
                ->with('thisStyleCount',\App\models\core\propstyle::thisStyleCount())
                ->with('thisFlyerCount',\App\models\core\propflyer::thisFlyerCount())
                ->with('thisAgentCount',\App\models\core\propagent::thisAgentCount())
                ->with('thisPhotoCount',\App\models\core\propphoto::thisPhotoCount())
                ->with('oldStyleCount',\App\models\oldsite\oldStyle::oldStyleCount())
                ->with('oldPhotoCount',\App\models\oldsite\oldPhoto::oldPhotoCount())
                ->with('oldDelivCount',\App\models\oldsite\oldDeliv::oldDelivCount())
                ->with('oldAgentCount',\App\models\oldsite\oldAgent::oldAgentCount())
                ->with('oldFlyerCount',\App\models\oldsite\oldFlyer::oldFlyerCount())
                ->with('oldDelivNowCount',\App\models\oldsite\oldDelivNow::oldDelivNowCount());
        });
        /*
        view()->composer([
        'mdbxDev.panels.journalCounts',
        'mdbxDev.fullPages.mdbxJournal',],
        function($view){
            $view
            ->with('allActiveTasks',\App\models\dev\devtask::allActiveTasks())
            ->with('allCompleteTasks',\App\models\dev\devtask::allCompleteTasks());
        });
        */
        /*
        view()->composer(['mdbxAdmin.navigation.adminTopNav',],
        function($view){
            $view
            ->with('adminInfo',\App\models\admin\adminTable::adminInfo())
            ->with('priorityTaskCount',\App\models\dev\devtask::allActiveTasks()
            ->where('taskPriority','=','1')->count());
        });
        */

    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
