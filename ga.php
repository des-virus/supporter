<?php session_start(); 
    require './include/php_lib/google-api-php-client-1-master/google-api-php-client-1-master/autoload.php';
    
    $developerKey = "";
    
    $client = new Google_Client();
    $client->setApplicationName("Supporter");
    $client->setDeveloperKey($developerKey)
?>

<html ng-app="app">
    <head>
        <meta charset="utf8"/>
        <title>Chatbot monitor</title>
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.5/angular.min.js"></script>
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
        <script src="js/app_chatbot.js" type="text/javascript"></script>
        <link href="include/html_lib/bootstrap-tagsinput-latest/dist/bootstrap-tagsinput.css" rel="stylesheet" type="text/css"/>
        <script src="include/html_lib/bootstrap-tagsinput-latest/dist/bootstrap-tagsinput-angular.js" type="text/javascript"></script>
        <script src="include/html_lib/bootstrap-tagsinput-latest/dist/bootstrap-tagsinput.js" type="text/javascript"></script>

        
    </head>
    <body ng-controller="chatbotCtrl">
        <div class="container" style="margin-top:50px">
            
        </div>
    </body>
</html>