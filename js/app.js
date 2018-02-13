var app = angular.module('app', []);

app.factory('mainService', function ($http) {
//    var MPFacebookURI = "https://localhost:8080/MPFacebook";
    var factory = {};
    factory.doPost = function (uri, data) {
        return $http.post(uri, data).then(function (response) {
            return response.data;
        });
    };

    factory.doGet = function (data, uri) {
        return $http.get(uri, data).then(function (response) {
            return response.data;
        });
    };
    return factory;
});

function getRequestObject(mode) {
    var data = {};
    data['mode'] = mode;

    return data;
}

function getMonitorObject(type, sendData, receiveData) {
    var requestObj = {};
    requestObj['time'] = Date.now();
    requestObj['type'] = type;
    requestObj['sendData'] = sendData;
    requestObj['receiveData'] = receiveData;

    return requestObj;

}

app.controller('clientCtrl', function ($scope, mainService) {
    $scope.requestData = [];
    $scope.ws;

    $scope.restURI = 'https://srv.mpcc.vn/MPFacebook';
    $scope.company_id = 'company01';
    $scope.page_id = '1863210517250420';
    $scope.page_name = 'Trang web bán hàng';
    $scope.page_token = 'EAADXELz9ZAcIBAICdR11aVcJfVZCisAu7T6AHpZBasVxCRpjzuZBZAAbbGJRiksiWakZCPiLpFOoma1leCL9HtC57dlCHCRfPhHkIs7brJXd2a0IuHhKM5au2FK4bTdnd0yI1WqcZB6RrwNGCRTHFpe2dZAialLhjS2uoMOyncOOm1JN9gCgdfR1';

    // Comment reply
    $scope.parent_id = '';
    $scope.message = '';

    //Websocket
    $scope.socketURI = 'wss://srv.mpcc.vn:2301/websocket';
    $scope.agent_id = 'phongdm';
    $scope.page_idWS = '1863210517250420';
    $scope.company_idWS = 'company01';

    // Comment & message test
    $scope.thread = [];
    $scope.message = [];
    $scope.current_thread = {};


    $scope.addPage = function () {
        var uri = "/pageAction/";
        var data = getRequestObject('add');
        data['company_id'] = $scope.company_id;
        data['page_id'] = $scope.page_id;
        data['page_name'] = $scope.page_name;
        data['page_token'] = $scope.page_token;
        mainService.doPost($scope.restURI + uri, data).then(function (response) {

            var requestObj = getMonitorObject("REST", data, response);
            $scope.requestData.push(requestObj);
        });
    };

    $scope.connectWebsocket = function () {
        $scope.ws = new WebSocket($scope.socketURI);
        $scope.ws.onopen = function (data) {
            var requestObj = getMonitorObject("WS_OPEN", "", data);
            $scope.requestData.push(requestObj);
            console.info('[WS EVENT][ON OPEN] Connect success', data);

        };
        $scope.ws.onclose = function (data) {
            console.log('[WS EVENT][ON CLOSE]: Close connection');
            var requestObj = getMonitorObject("WS_CLOSE", "", data);
            $scope.requestData.push(requestObj);
        };

        $scope.ws.onerror = function (data) {
            console.info('[WS EVENT][ON ERROR]: Connection error', data);
            var requestObj = getMonitorObject("WS_ERROR", "", data);
            $scope.requestData.push(requestObj);

        };

        $scope.ws.onmessage = function (data) {
//            console.info('[WS EVENT][ON MESSAGE]: Message receive', data.data);
            var requestObj = getMonitorObject("WS_MESSAGE", "", data.data);
            $scope.requestData.push(requestObj);
            $scope.process(data);
        };

        $scope.ws.ondisconnect = function (data) {
//            console.info('[WS EVENT][ON MESSAGE]: Message receive', data.data);
            debugger;
            var requestObj = getMonitorObject("WS_MESSAGE", "", data.data);
            $scope.requestData.push(requestObj);
            $scope.process(data);
        };
    };

    $scope.process = function (data) {
        debugger;
        console.log('[WS EVENT][ON MESSAGE]');
        var json = JSON.parse(data.data);
        console.log(json);
        var event = json.event;
        var agent_id;
        switch (event) {
            case 'join_queue':
                break;
            case 'leave_queue':
                break;
            case 'add_thread':
                $scope.thread.push(json.thread_data);
                console.log(json.thread_data);
                break;
            case 'edit_thread':
                var thread = json.thread_data;
                break;
            case 'remove_thread':
                break;
            case 'add_message':
                var message = json.message_data;
                var conversation_id = message.thread_id;
                if ($scope.currentConversation.id == conversation_id) {
                    $scope.messages.push(message);
                }
                var is_found = false;
                for (var i = 0; i < $scope.conversations.length; i++) {
                    if ($scope.conversations[i].id == conversation_id) {
                        $scope.conversations[i].is_processed = false;
                        $scope.conversations[i].is_read = false;
                        $scope.conversations[i].snippet = json.thread_data.snippet;

                        is_found = true;
                        break;
                    }
                }
                if (!is_found) {
                    $scope.conversations.push(json.thread_data);
                }
                break;
            case 'edit_message':
                break;
            case 'remove_message':
                break;
            case 'add_post':
                break;
            case 'remove_post':
                break;
            case 'edit_post':
                break;
            case 'add_reaction_thread':
                break;
            case 'add_reaction_message':
                break;
            case 'add_reaction_post':
                break;
            case 'remove_reaction_thread':
                break;
            case 'remove_reaction_message':
                break;
            case 'remove_reaction_posts':
                break;

        }
    }

    $scope.joinQueue = function () {
        var dataSend = getRequestObject('join_queue');
        dataSend['event'] = 'join_queue';
        dataSend['agent_id'] = $scope.agent_id;
        dataSend['page_id'] = $scope.page_idWS;
        dataSend['company_id'] = $scope.company_idWS;

        $scope.ws.send(JSON.stringify(dataSend));
        var requestObj = getMonitorObject("WS_SEND", dataSend, "");
        $scope.requestData.push(requestObj);
    };
    
    $scope.addPageWS = function () {
        var dataSend = getRequestObject('add_page_ws');
        dataSend['event'] = 'add_page_ws';
        dataSend['agent_id'] = $scope.agent_id;
        dataSend['page_id'] = $scope.page_idWS;
        dataSend['company_id'] = $scope.company_idWS;

        $scope.ws.send(JSON.stringify(dataSend));
        var requestObj = getMonitorObject("WS_SEND", dataSend, "");
        $scope.requestData.push(requestObj);
    };

    $scope.leaveQueue = function () {
        var dataSend = getRequestObject('leave_queue');
        dataSend['event'] = 'leave_queue';
        dataSend['agent_id'] = $scope.agent_id;
        dataSend['page_id'] = $scope.page_idWS;
        dataSend['company_id'] = $scope.company_idWS;

        $scope.ws.send(JSON.stringify(dataSend));
        var requestObj = getMonitorObject("WS_SEND", dataSend, "");
        $scope.requestData.push(requestObj);
    };

    $scope.sendMessage = function () {
        var uri = "/addReply/";
        var data = getRequestObject('add');
        data['company_id'] = $scope.company_id;
        data['page_id'] = $scope.page_id;
        data['page_name'] = $scope.page_name;
        data['page_token'] = $scope.page_token;

        var messageBO = {};
        messageBO['thread_id'] = $scope.parent_id;
        messageBO['message'] = $scope.message;

        data['message_data'] = messageBO;
        mainService.doPost(uri, data).then(function (response) {

            var requestObj = getMonitorObject("REST", data, response);
            $scope.requestData.push(requestObj);
        });
    };

    $scope.getThread = function () {

    };

    $scope.getMessage = function (thread) {
        var uri = "/getThread/";
        var data = getRequestObject('add');
        data['company_id'] = $scope.company_id;
        data['page_id'] = $scope.page_id;
        data['agent_id'] = $scope.agent_id;
        data['page_name'] = $scope.page_name;
        data['page_token'] = $scope.page_token;
        mainService.doPost(uri, data).then(function (response) {

            var requestObj = getMonitorObject("REST", data, response);
            $scope.requestData.push(requestObj);
        });
    };
});

