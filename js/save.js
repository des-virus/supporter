 var ws, data;
            function connect() {
                var ip = $("#ws_add").val();
                if (ws) {
                    alert('Already connect');
                    return;
                }
               
            }

            function disconnect() {
                ws.onclose = function () {}; // disable onclose handler first
                $("#WS_status").text("CLOSE");
                ws.close();
                ws = null;
            }

            function sendData(sendData) {
                data = {};
                data['event'] = 'test';
                data['agent'] = 'phongdm';
                if (!sendData) {
                    data['sendData'] = $("#sendData").val();
                } else {
                    data['sendData'] = sendData;
                }
                ws.send(JSON.stringify(data));
                console.log('SEND data : ' + JSON.stringify(data));


            }