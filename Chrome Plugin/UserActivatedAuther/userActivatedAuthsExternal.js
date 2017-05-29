//Token example:
//var token = "C4LUc9SLDEhj3SFJTBwqDGGG";
var token = "INSERT TOKEN HERE";
var authController = "http://website.com/plugin/authController.php";
var refresh = 10000;

 chrome.storage.sync.get('updateAuths', function (obj) {
	console.log("Searching auths to remove");
		if(obj.updateAuths != null){
			console.log("Auths found");
			for (var i=0; i<obj.updateAuths.length; i++){
				var data = obj.updateAuths[i];
				console.log("Removing Auth user id:"+data['userID']);
				run(data['id'],"removeAuth");
			}
		console.log("Clearing auth que");
		chrome.storage.sync.remove('updateAuths')
		}
    });
	
	
console.log("Pulling auth que");
run(0,"getAuth");

function run(id,method){
	console.log("Sending a GET too "+method);
	$.ajax({
        type: 'GET',
        url: authController,
        data:"token="+token+"&method="+method+"&id="+id,
        success: function (jsonString) {
		
			console.log("Success! The get sent! recieved: "+jsonString);
			if(method == "getAuth"){
            handleTrials(JSON.parse(jsonString));
			}
		},
		error: function(request) {
			console.log("Failed talking too : "+method+" reponse: "+request.responseText);
        }
	});

}	

function handleTrials(trialsArray){
	console.log("Auths loaded : "+trialsArray.length);
	chrome.storage.sync.set({"trialData": trialsArray});
}

if(refresh >0){
	console.log("Refresh set");
	setTimeout(function() { window.location=window.location;},refresh);
}
	
	
