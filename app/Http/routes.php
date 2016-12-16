<?php

Route::get('/', function () {
    return redirect('home');
});

Route::any('/hook', 'Hook@fb');

Route::post('/slack/hook', 'Hook@slack');


Route::group(['middleware' => 'web'], function () {
    Route::auth();

    Route::group(['middleware' => 'auth'], function () {
        Route::resource('/contact','ContactController');

        Route::get('/prappo', 'Prappo@test');
        Route::get('/home', 'HomeController@index');
        Route::get('/write', 'Write@index');
        Route::get('/posttest', 'Write@postTest');

        // OAuth 2 callback urls
        Route::get('/fbconnect', 'Settings@fbconnect');
        Route::get('/linkedin/callback', 'LinkedinController@callback');

        // settings pages
        Route::get('/settings', 'Settings@index');
        Route::get('/settings/notifications', 'Settings@notifyIndex');
        Route::get('/settings/config', 'Settings@configIndex');
        Route::get('/reports', 'Reports@index');

        Route::get('/followers', 'FollowersController@index');
        Route::get('/gettwfoll', 'FollowersController@showTwFollowers');
        Route::get('/showalltwfollowers', 'FollowersController@showAllTwFollowers');

        // dashboard activities
        Route::get('/fblikes', 'HomeController@fbLikes');
        Route::get('/twfollowers', 'HomeController@twFollowers');
        Route::get('/tufollowers', 'HomeController@tuFollowers');
        Route::get('/liTotalCompanies', 'HomeController@liTotalCompanies');
        Route::get('/companyFollowers', 'HomeController@companyFollowers');
        Route::get('/liCompanyUpdates', 'HomeController@liCompanyUpdates');
        Route::get('/liPostedJobs', 'HomeController@liPostedJobs');

        Route::get('/allpost', 'AllpostController@index');

        Route::get('/facebook', 'FacebookController@index');
        Route::get('/twitter', 'TwitterController@index');
        Route::post('/twitter/retweet', 'TwitterController@retweet');
        Route::post('/twitter/message', 'TwitterController@twSendMsg');
        Route::get('/twitter/masssend', 'TwitterController@massSend');
        Route::post('/twitter/masssend/action', 'TwitterController@massMessageSend');
        Route::get('/twitter/message/send', 'TwitterController@sendMessage');
        Route::post('/twitter/reply', 'TwitterController@twReply');
        Route::post('/twitter/autoretweet', 'TwitterController@autoRetweet');
        Route::get('/twitter/autoretweet', 'TwitterController@autoRetweetIndex');
        Route::get('/twitter/autoreply', 'TwitterController@autoReplyIndex');
        Route::post('/twitter/autoreply', 'TwitterController@autoReply');
        Route::post('/twitter/autoreplyall', 'TwitterController@autoReplyAll');
        Route::get('/tumblr', 'TumblrController@index');
        Route::get('/wordpress', 'WordpressController@index');

        Route::post('/wpwrite', 'Write@wpWrite');
        Route::post('/twwrite', 'Write@twWrite');
        Route::post('/fbwrite', 'Write@fbWrite');
        Route::post('/fbgwrite', 'Write@fbgwrite');
        Route::post('/tuwrite', 'Write@tuWrite');
        Route::post('/linkedin/share', 'write@liWrite');
        Route::post('/post/save', 'Write@postSave');

        Route::post('/delpost', 'Write@delPost');
        Route::post('/delallpost', 'AllpostController@delAll');
        Route::post('/delfromall', 'AllpostController@delFromAll');

        //update settings
        Route::post('/wpsave', 'Settings@wpSave');
        Route::post('/fbsave', 'Settings@fbSave');
        Route::post('/twsave', 'Settings@twSave');
        Route::post('/tusave', 'Settings@tuSave');
        Route::post('/skypesave', 'Settings@skypeSave');
        Route::post('/lisave', 'Settings@liSave');
        Route::post('/settings/notifications', 'Settings@notifySave');
        Route::post('/save/fb/bot/config', 'Settings@fbBotConfigSave');

        // deleting
        Route::post('/fbdel', 'FacebookController@fbDelete');
        Route::post('/wpdel', 'WordpressController@wpDelete');

        // commenting
        Route::post('/fbcom', 'FacebookController@fbComment');

        // editing
        Route::post('/fbedit', 'FacebookController@fbEdit');
        // delete twitter post
        Route::post('/twdel', 'Write@twDelete');
        // delete tumblr post
        Route::post('/tudel', 'Write@tuDelete');
        Route::post('/tureblog', 'Write@tuReblog');

        Route::post('/iup', 'ImageUpload@iup');

        Route::post('/addschedule', 'ScheduleController@addSchedule');
        Route::get('/schedules', 'ScheduleController@index');
        Route::get('/scheduleslog', 'OptLogs@index');
        Route::post('/logdel', 'OptLogs@logDel');
        Route::post('/alllogdel', 'OptLogs@delAll');
        Route::post('/sdel', 'ScheduleController@sdel');
        Route::post('/sedit', 'ScheduleController@sedit');

        // Report specific routes
        Route::get('/fbreport', 'FacebookController@fbReport');

        Route::get('/fbgroups', 'FacebookController@fbGroupIndex');
        Route::get('/tusync', 'Settings@tuSync');
        Route::get('/fbmassgrouppost', 'MassFbGroup@index');
        Route::post('/savepublicgroup', 'MassFbGroup@saveGroup');
        Route::post('/fbmassgroupdel', 'MassFbGroup@deleteGroup');
        Route::post('/posttomassgroup', 'MassFbGroup@massPost');

        Route::get('/conversations', 'Conversation@index');
        Route::get('/conversations/{pageId}', 'Conversation@getConversations');
        Route::get('/conversations/{pageId}/{cId}', 'Conversation@inbox');
        Route::get('/conversations/message/{pageId}/{mId}', 'Conversation@message');
        Route::get('/ajaxchat/{pageId}/{cId}', 'Conversation@ajaxGetConversations');
        Route::post('/chat', 'Conversation@chat');

        Route::get('/masssend/{pageId}', 'FacebookController@massSend');
        Route::get('/masssend', 'FacebookController@massSendIndex');
        Route::post('/massreplay', 'FacebookController@massReplay');
        Route::get('/facebook/masscomment', 'FacebookController@massComment');
        Route::post('/facebook/masscomment', 'FacebookController@massCommentAction');
        Route::post('/facebook/page/masscomment', 'FacebookController@massCommentPageAction');

        Route::post('/facebook/addpublicpage', 'FacebookController@publicPageAdd');
        Route::post('/delete/fbpublicpage', 'FacebookController@deletePage');


        Route::get('/fb/bot', 'ChatBotController@fb');
        Route::get('/slack/bot', 'ChatBotController@slack');
        Route::post('/fb/addquestion', 'ChatBotController@addQuestion'); // fb bot
        Route::post('/fb/delquestion', 'ChatBotController@delQuestion'); // fb bot
        Route::post('/add-slack-question', 'ChatBotController@addSlackQuestion');
        Route::post('/delete-slack-question', 'ChatBotController@deleteSlackQuestion');
        Route::post('/update-slack-bot-config', 'ChatBotController@updateBotConfig');

        Route::post('/langsave', 'Settings@lang');

        Route::get('/scraper', 'Scraper@index');
        Route::post('/scraper', 'FacebookController@scraper');

        // Notifications specific routes
        Route::post('/notify', 'Notify@insert');
        Route::get('/notify', 'Notify@show');
        Route::post('/allnotifydel', 'Notify@delAll');
        Route::get('/tw/scraper', 'Scraper@twScraper');
        Route::post('/tw/scraper', 'Scraper@twitterScrapper');

        // Skype specific routes
        Route::get('/skype', 'SkypeController@index');
        Route::get('/skype/user/{username}', 'SkypeController@skypeUser');
        Route::get('/skype/chatwith/{user}', 'SkypeController@getMessage');
        Route::post('/skypechat', 'SkypeController@sendMessage');
        Route::post('/skype/request', 'SkypeController@sendRequest');
        Route::post('/skype/masssend', 'SkypeController@massSend');
        Route::post('/skype/save/phones', 'SkypeController@collectPhone');
        Route::get('/skype/phone/list', 'SkypeController@showPhones');
        Route::post('/skype/phone/del', 'SkypeController@del');
        Route::post('/skype/phone/del/all', 'SkypeController@delAll');

        //linkedin specific routes
        Route::get('/linkedin/mass_comment', 'LinkedinController@massComment');
        Route::post('/linkedin/mass_comment', 'LinkedinController@fireMassComment');
        Route::get('/linkedin/updates', 'LinkedinController@updates');

        Route::get('/profile', 'ProfileController@index');
        Route::post('/profile', 'ProfileController@update');
        Route::post('/user/delete', 'UserController@userDel');
        Route::get('/user/add', 'UserController@addUserIndex');
        Route::post('/user/add', 'UserController@userAdd');
        Route::get('/user/list', 'UserController@userList');
        Route::get('/user/{id}', 'UserController@userEdit');
        Route::post('/user/update', 'UserController@userUpdate');
        Route::get('/admin','UserController@adminIndex');
    });


});
