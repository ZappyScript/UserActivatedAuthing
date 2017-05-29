 chrome.storage.sync.get('trialData', function (obj) {
		
		var updateAuths =[];
		if(obj.trialData != null){
			for (var i=0; i<obj.trialData.length; i++){
				var data = obj.trialData[i];
				sendMVCAuth(data['userID'],data['script'],data['time']);
				//TODO: flag check, dont want to delete failed!
				updateAuths.push(data);
			}
		chrome.storage.sync.set({'updateAuths': updateAuths});
		chrome.storage.sync.remove('trialData');
			
		}
    });
	
	
	function sendMVCAuth(userID,scriptID,scriptDuration){
	
       $.ajax({
        type: 'POST',
        url: 'https://osbot.org/mvc/scripters/auth',
        data: {
          task: 'addauth',
          memberID: userID,
          scriptID: scriptID,
          authDuration: scriptDuration
        },
        success: function() {
		  console.log("Success!");
          console.log("Just sent : userID: %i script:"+scriptID+" dur:"+scriptDuration+"h");
        },
        error: function() {
        //TODO: Flag error
          console.log("Auth Failed :(");
		  console.log("Just sent : userID: %i script:"+scriptID+" dur:"+scriptDuration+"h");
        },
	});
}

var sleep = getParamFromUrl("sleep");
if(sleep != ""){
	setTimeout(function() { window.location=window.location;},sleep);
}
function getParamFromUrl(param) {
    var re = new RegExp(".*[?&]" + param + "=([^&]+)(&|$)");
	var url = window.location.href;
    var match = url.match(re);
    return(match ? match[1] : "");

}

