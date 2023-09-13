
var logCounter = 0;

function startConnectL() {
    clientID = "webUser-" + parseInt(Math.random() * 100);
    host = document.getElementById("hostL").value;
    port = document.getElementById("portL").value;
    userId = document.getElementById("usernameL").value;
    passwordId = document.getElementById("passwordL").value;
    document.getElementById("messagesL").innerHTML += "<span> Connecting to " + host + "on port " + port + "</span><br>";
    document.getElementById("messagesL").innerHTML += "<span> Using the client Id " + clientID + " </span><br>";
    clientL = new Paho.MQTT.Client(host, Number(port), clientID);
    clientL.onConnectionLost = onConnectionLostL;
    clientL.onMessageArrived = onMessageArrivedL;
    clientL.connect({
        userName: userId,
        password: passwordId,
        onSuccess: onConnectL
    });
}

function onConnectL() {
    topic = document.getElementById("topic_sL").value;
    document.getElementById("messagesL").innerHTML += "<span> Subscribing to topic " + topic + "</span><br>";
    clientL.subscribe(topic);
}

function onConnectionLostL(responseObject) {
    document.getElementById("messagesL").innerHTML += "<span> ERROR: Connection is lost.</span><br>";
    if (responseObject != 0) {
        document.getElementById("messagesL").innerHTML += "<span> ERROR:" + responseObject.errorMessage + "</span><br>";
    }
}

function clearDatabase() {
    $.ajax({
        type: 'post',
        url: 'dataL.php',
        data: {
            payLoad: "clear"
        },
        success: function (data) {
            console.log(data);
        }
    });
}

function onMessageArrivedL(message) {
    payloadL = message.payloadString;
    console.log("OnMessageArrived: " + payloadL);
    document.getElementById("messagesL").innerHTML = "<span> Topic:" + message.destinationName + "| Message : " + payloadL + "</span><br>";

    //{"_time":"2023-04-06T22:25:15.040904Z", "low_pass_z":1.1, "steps":2, "threshold":2.2, "x":0.1, "y":0.1, "z":0.1}

    $.ajax({
        type: 'post',
        url: 'dataL.php',
        data: {
            payLoad: payloadL
        },
        success: function (data) {
        }
    });
}

function startDisconnectL() {
    clientL.disconnect();
    document.getElementById("messagesL").innerHTML += "<span> Disconnected. </span><br>";
}

function publishMessageL() {
    msg = document.getElementById("MessageL").value;
    topic = document.getElementById("topic_pL").value;
    Message = new Paho.MQTT.Message(msg);
    Message.destinationName = topic;
    clientL.send(Message);
    document.getElementById("messagesL").innerHTML = '<p style="border: 1px solid black; border-right:none; margin: 0px; display:inline; padding-bottom: 20px;"> Message to topic ' + topic + ' is sent </p><br>';
}








//right functions
function startConnectR() {
    clientID = "webUser-" + parseInt(Math.random() * 100);
    host = document.getElementById("host").value;
    port = document.getElementById("port").value;
    userId = document.getElementById("username").value;
    passwordId = document.getElementById("password").value;
    document.getElementById("messages").innerHTML += "<span> Connecting to " + host + "on port " + port + "</span><br>";
    document.getElementById("messages").innerHTML += "<span> Using the client Id " + clientID + " </span><br>";
    client = new Paho.MQTT.Client(host, Number(port), clientID);
    client.onConnectionLost = onConnectionLostR;
    client.onMessageArrived = onMessageArrivedR;
    client.connect({
        userName: userId,
        password: passwordId,
        onSuccess: onConnectR
    });
}

function onConnectR() {
    topic = document.getElementById("topic_s").value;
    document.getElementById("messages").innerHTML += "<span> Subscribing to topic " + topic + "</span><br>";
    client.subscribe(topic);
}

function onConnectionLostR(responseObject) {
    document.getElementById("messages").innerHTML += "<span> ERROR: Connection is lost.</span><br>";
    if (responseObject != 0) {
        document.getElementById("messages").innerHTML += "<span> ERROR:" + responseObject.errorMessage + "</span><br>";
    }
}

function onMessageArrivedR(message) {
    payloadR = message.payloadString;
    console.log("OnMessageArrived: " + payloadR);
    document.getElementById("messages").innerHTML += "<span> Topic:" + message.destinationName + "| Message : " + payloadR + "</span><br>";

    //{"_time":"2023-04-06T22:25:15.040904Z", "low_pass_z":1.1, "steps":2, "threshold":2.2, "x":0.1, "y":0.1, "z":0.1}

    $.ajax({
        type: 'post',
        url: 'dataR.php',
        data: {
            payLoad: payloadR
        },
        success: function (data) {
            // console.log(data);
        }
    });
}

function startDisconnectR() {
    client.disconnect();
    document.getElementById("messages").innerHTML += "<span> Disconnected. </span><br>";
}

function publishMessageR() {
    msg = document.getElementById("Message").value;
    topic = document.getElementById("topic_p").value;
    Message = new Paho.MQTT.Message(msg);
    Message.destinationName = topic;
    client.send(Message);
    document.getElementById("messages").innerHTML = '<p style="border: 1px solid black; border-right:none; margin: 0px; display:inline; padding-bottom: 20px;"> Message to topic ' + topic + ' is sent </p><br>';
}