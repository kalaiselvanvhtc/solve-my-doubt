if($("#publisherId").length>0)
{
    
// replace these values with those generated in your TokBox Account
var apiKey = $("#apiKeyhdn").val();
var sessionId = $("#sessionIdhdn").val();
var token = $("#tokenhdn").val();
var connectionCount;
var session;
var publisher;
var subscriber;
    
   


function handleError(error)
{
    alert(error);
}
$("#disconnectSession").click(function() {
     session.disconnect();
});
 

session = OT.initSession(apiKey, sessionId);
var connectionCount = 0;
// Replace with the replacement element ID:
publisher = OT.initPublisher(publisherId);
publisher.on({
  streamCreated: function (event) {
    alert("Publisher started streaming.");
  },
  streamDestroyed: function (event) {
    alert("Publisher stopped streaming. Reason: "
      + event.reason);
  }
});
session.on('streamCreated', function(event) {
  var subscriberProperties = {insertMode: 'append'};
   subscriber = session.subscribe(event.stream,
    'subscriberId',
    subscriberProperties,
    function (error) {
      if (error) {
        alert("subscribe: "+error);
      } else {
        alert('Subscriber added.');
      }
  });
  
subscriber.on({
  disconnected: function() {
        alert("subscriber disconnected");
        document.getElementById('disconnectSession').style.display = 'none';
  },
  connected: function() {
    alert("subscriber connected");
    document.getElementById('disconnectSession').style.display = 'block';
  },
  destroyed: function() {
    alert("subscriber destroyed");
    document.getElementById('disconnectSession').style.display = 'none';
  }
  });
});


function connect() {
  // Replace apiKey and sessionId with your own values:
  
  session.on({
    connectionCreated: function (event) {
      connectionCount++;
      alert(connectionCount + ' connections.');
    },
    connectionDestroyed: function (event) {
      connectionCount--;
      alert(connectionCount + ' connections.');
    },
    sessionDisconnected: function sessionDisconnectHandler(event) {
      // The event is defined by the SessionDisconnectEvent class
      alert('Disconnected from the session.');
      document.getElementById('disconnectSession').style.display = 'none';
      if (event.reason == 'networkDisconnected') {
        alert('Your network connection terminated.')
      }
    }
  });
  // Replace token with your own value:
  session.connect(token, function(error) {
    if (error) {
      alert('Unable to connect: ', error.message);
    } else if (session.capabilities.publish == 1) {
          document.getElementById('disconnectSession').style.display = 'block';
      alert('Connected to the session.');
      connectionCount = 1;console.log
    session.publish(publisher);
  } else {
    alert("You cannot publish an audio-video stream.");
  }
  
    
  });
}

connect();
}