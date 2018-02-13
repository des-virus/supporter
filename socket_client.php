<!DOCTYPE html>
<html>
    <head>
        <meta charset='UTF-8' />
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.5/angular.min.js"></script>
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">

        <script>
            var wsocket;
            function connectWS() {
                //tao doi tuong websocket
                var wsUri = "ws://supporter.oo:8080/socket_server.php";
                wsocket = new WebSocket(wsUri);

                //khi ket noi duoc mo
                wsocket.onopen = function (ev) {
                    $("#WS_status").text("[WS] Connected to websocket");
                    console.log("[WS] Connected to websocket");
                };

                wsocket.onmessage = function (ev) {
                    var msg = JSON.parse(ev.data); //chuyen chuoi JSON thanh doi tuong JSON
                    console.log("[WS][on message]: Receive data");
                    console.log(msg);
                };

                wsocket.onerror = function (ev) {
                    console.log("[WS][on error]: Error");
                    $("#WS_status").text("[WS][on error]: Error");

                    $('#msgbox').append("<div class='errorsys'>Co loi xay ra - " + ev.data + "</div>");
                };
                wsocket.onclose = function (ev) {
                    console.log("[WS][on close]: Close connection");
                    $("#WS_status").text("[WS][on close]: Close connection");

                    $('#msgbox').append("<div class='msgsys'>Ngat ket noi</div>");
                };
            }

            function joinQueue() {
                var username = $("#username").val();
                var event = "join_queue";

                var obj = {};
                obj['username'] = username;
                obj['event'] = event;

                wsocket.send(JSON.stringify(obj));
            }

            function sendMessage() {
                var msg =
                        wsocket.send(JSON.stringify(msg));
                $('#message').val(''); //reset text
            }
        </script>
    </head>
    <body>

        <div class="container" style="margin-top: 30px">
            <div class="col-md-7 form-horizontal">
                <h3 id="WS_status" class="text-danger text-center">
                    Connection information
                </h3>
                <div class="form-group">
                    <label for="ws_uri" class="col-sm-2 control-label">WS URI</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="ws_uri" placeholder="ws_uri">
                        <select class="form-control" ng-model="selected_parent">
                            <option ng-repeat="item in parent_categories" value="{{item.id}}">{{item.name}}</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="username" class="col-sm-2 control-label">Agent</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="username" placeholder="username">
                    </div>
                </div>
                <div class="form-group">
                    <label for="message" class="col-sm-2 control-label">Message</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="message" placeholder="message">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-2">
                        <button onclick="connectWS()" class="btn btn-default">Connect WS</button>
                    </div>
                    <div class="col-sm-2">
                        <button onclick="joinQueue()" class="btn btn-primary">Join queue</button>
                    </div>
                    <div class="col-sm-2">
                        <button onclick="sendMessage()"  class="btn btn-success">Send message</button>
                    </div>
                </div>
            </div>

            <div class="col-md-5">
                <div class="panel panel-primary" style="max-width: 700px">
                    <div class="panel-heading">
                        Websocket monitor
                    </div>
                    <div class="panel-body" style="padding: 0px">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th width="30%">Even</th>
                                    <th>Data</th>
                                </tr>
                            </thead>

                            <tbody>
                                <tr>
                                    <td></td>
                                    <td></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>

        <script language="javascript" type="text/javascript">
            $(document).ready(function () {




                $('#message').keypress(function (e) {
                    if (e.keyCode == 13) {
                        $('#sendbtn').click();
                    }
                });

                $('#sendbtn').click(function () {
                    var msg = $('#message').val();

                    if (msg == "") { //chua nhap message
                        alert("Vui lòng nhập thông điệp");
                        return;
                    }

                    //tao doi tuong JSON
                    var msg = {
                        message: msg,
                        name: name,
                    };

                });


            });
        </script>
    </body>
</html>