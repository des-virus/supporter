<html ng-app="app">
    <head>
        <meta charset="utf8"/>
        <title>Trang client</title>
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.5/angular.min.js"></script>
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
        <script src="js/app.js" type="text/javascript"></script>
    </head>
    <body ng-controller="clientCtrl">
        <div class="container" style="margin-top:50px">


            <div class="row">
                <h3 class="text-center text-danger">Client action</h3>
                <div class="col-md-4">
                    <h3 class="text-center">Add page</h3>
                    <form class="form-horizontal">
                        <div class="form-group">
                            <label for="restURI" class="col-sm-2 control-label">REST URI</label>
                            <div class="col-sm-10">
                                <input ng-model="restURI" value="" type="text" class="form-control" id="restURI" placeholder="CompanyID">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="company_id" class="col-sm-2 control-label">CompanyID</label>
                            <div class="col-sm-10">
                                <input ng-model="company_id" value="" type="text" class="form-control" id="company_id" placeholder="CompanyID">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="page_id" class="col-sm-2 control-label">Page ID</label>
                            <div class="col-sm-10">
                                <input ng-model="page_id" value="" type="text" class="form-control" id="page_id" placeholder="Page ID">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="page_name" class="col-sm-2 control-label">Page Name</label>
                            <div class="col-sm-10">
                                <input ng-model="page_name" value="" type="text" class="form-control" id="page_name" placeholder="Page Name">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="page_token" class="col-sm-2 control-label">Page Token</label>
                            <div class="col-sm-10">
                                <input ng-model="page_token" value="" type="text" class="form-control" id="page_token" placeholder="Page token">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <button ng-click="addPage()" type="submit" class="btn btn-default">Add page</button>
                                <button ng-click="addPageWS()" type="submit" class="btn btn-default">Add page WS</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-md-4">
                    <h3 class="text-center">join queue</h3>
                    <form class="form-horizontal">
                        <div class="form-group">
                            <label for="socketURI" class="col-sm-2 control-label">SocketURI</label>
                            <div class="col-sm-10">
                                <input ng-model="socketURI" type="text" class="form-control" id="socketURI" placeholder="socketURI">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="agent_id" class="col-sm-2 control-label">AgentID</label>
                            <div class="col-sm-10">
                                <input ng-model="agent_id" value="" type="text" class="form-control" id="agent_id" placeholder="Agent ID">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="page_idWS" class="col-sm-2 control-label">Page ID</label>
                            <div class="col-sm-10">
                                <input ng-model="page_idWS" value="" type="text" class="form-control" id="page_idWS" placeholder="Page ID">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="company_idWS" class="col-sm-2 control-label">CompanyID</label>
                            <div class="col-sm-10">
                                <input ng-model="company_idWS" value="" type="text" class="form-control" id="company_idWS" placeholder="company_idWS">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <button ng-click="connectWebsocket()" type="submit" class="btn btn-default">Connect WS</button>
                                <button ng-click="joinQueue()" type="submit" class="btn btn-primary">Join queue</button>
                                <button ng-click="leaveQueue()" type="submit" class="btn btn-primary">Leave queue</button>
                                <button ng-click="getThread()" type="submit" class="btn btn-primary">Get My thread</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-md-4">
                    <h3 class="text-center">Send reply</h3>
                    <form class="form-horizontal">
                        <div class="form-group">
                            <label for="parent_id" class="col-sm-2 control-label">ParentID</label>
                            <div class="col-sm-10">
                                <input ng-model="parent_id" type="text" class="form-control" id="parent_id" placeholder="parent_id">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="message" class="col-sm-2 control-label">Message</label>
                            <div class="col-sm-10">
                                <input ng-model="message" value="" type="text" class="form-control" id="message" placeholder="Agent ID">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <button ng-click="sendMessage()" type="submit" class="btn btn-default">Send Message</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="row">
                <h3>Client monitor</h3>
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Time</th>
                            <th>Request Type</th>
                            <th width="30%">Send Data</th>
                            <th>ReceiveData</th>
                            <th>Valuable Data</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr ng-repeat="item in requestData">
                            <td>{{item.time| date:'d/M/y H:m:s'}}</td>
                            <td>{{item.type}}</td>
                            <td>{{item.sendData}}</td>
                            <td>{{item.receiveData}}</td>
                            <td>{{item.valueData}}</td>
                            <td>{{item.action}}</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="row">
                <h3 class="text-center text-danger">Client message</h3>
                <div class="col-md-4">
                    <div class="list-group">
                        <a href="#" class="list-group-item list-group-item-success">Danh sách tin nhắn</a>
                        <a href="#" class="list-group-item active" ng-repeat="item in thread">{{item.id}}</a>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            Nội dung tin nhắn
                        </div>
                        <div class="panel-body">
                            <p class="text-success">Sender nhắn</p>
                            <p class="text-primary">Page nhắn</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>