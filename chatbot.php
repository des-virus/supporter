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
            <h3 class="text-center text-danger">Chatbot monitor</h3>
            <div class="row">
                <div class="col-md-12">
                    <form class="form-horizontal">
                        <div class="row">
                            <div class="col-md-2 col-md-offset-10">
                                <button class="btn btn-primary {{is_edit.change == add_data ? 'disabled' : ''}}">Lưu dữ liệu</button>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label for="question" class="control-label">Câu hỏi</label>
                            </div>
                            <div class="col-md-6">
                                <label for="answer" class="control-label">Câu trả lời</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <input type="text" value="" data-role="tagsinput" placeholder="Thêm mới câu hỏi" />
                            </div>
                            <div class="col-md-6">
                                <div ng-repeat="item in add_data.answer track by $index" class="row">
                                    <div class="col-md-10">
                                        <input style="margin-top: 5px" ng-model="item.value" value="" type="text" class="form-control" id="company_id" placeholder="Câu trả lời">
                                    </div>
                                    <div class="col-md-2">
                                        <button class="btn btn-danger" ng-click="removeAnwer($index)">Xóa</button>
                                    </div>
                                </div>
                                <button style="margin-top: 10px" ng-click="pushAnser()" type="submit" class="btn btn-primary">Thêm câu trả lời</button>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>