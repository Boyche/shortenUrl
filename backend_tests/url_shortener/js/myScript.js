 
 //event handler on click the element with id getShortUrlBtn
$(document).on("click","#getShortUrlBtn",function(){
	var url = $("#urlTxt").val().trim();//we get data from input element, trimed of spaces
	if(url.length == 0){ //if its 0 length, we show message, and leave function
		alert("Please, insert url!");
		return;
	}
	//regex for checking if inserted data is url at all.
	var urlRegEx = /^(?:http(s)?:\/\/)?[\w.-]+(?:\.[\w\.-]+)+[\w\-\._~://?#[\]@!\$&'\(\)\*\+,;=.]+$/;
	if( !urlRegEx.test(url) ){ //if testing fails, we leave function.
		alert("Url is not propper!");
		return;
	}
	
	//if its all good. we make ajax request
	$.ajax({
		url: "/backend_tests/url_shortener/shorten.php",
		method: "POST", //type of request
		data: { //data sent
			"url" : url
		},
		dataType: "json", //expected type of data in respond.
		success: function(object){//if communication goes ok object is data returned.
			console.log(object);
			$("#yourUrlDiv").fadeOut(500, function(){
				var str ="Your link: "+object.original_link+"<br/><br/>Shorten link: <input readonly id='shortUrl' value='localhost/"+object.short_link+"'> </input> <br/><br/>"
				str+= "<button  onclick='clickToCopy()' >Click to Copy link </button><br/><br/>";
				str+= "<button  onclick='makeNewShortUrl()' >Make New Short Url</button><br/><br/>";
				$('#shortUrlDiv').html(str).fadeIn(500);
			
			});
		},
		error: function(){
		}
	});
});


function clickToCopy(){
  var copyText = document.getElementById("shortUrl");
    copyText.select();
    document.execCommand("Copy");
    alert("Copied the text: " + copyText.value);
}

function makeNewShortUrl(){
	$("#urlTxt").val("");
	$("#shortUrl").val("");
    $("#shortUrlDiv").fadeOut(500, function(){
	$("#yourUrlDiv").fadeIn(500);
  });
}

$(document).on("click","#testBtn", function(){
	$.ajax({
		url: "/backend_tests/url_shortener/openUrl.php",
		method: "GET",
		data: {
			"shortUrl":"ftKIvr4NWzaa"
		},
		dataType: "text",
		success: function(object){
			console.log(object);
			
		},
		error: function(){
		}
	});
});