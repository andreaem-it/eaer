var default_content="";

$(document).ready(function(){
	
	checkURL();
	$('.quick-post a').click(function (e){

			checkURL(this.hash);

	});
	
	//filling in the default content
	default_content = $('#pageContent').html();
	
	
	setInterval("checkURL()",50);
	
});

var lasturl="";

function checkURL(hash)
{
	if(!hash) hash=window.location.hash;
	
	if(hash != lasturl)
	{
		lasturl=hash;
		
		// FIX - if we've used the history buttons to return to the homepage,
		// fill the pageContent with the default_content
		
		if(hash=="")
		$('#pageContent').html(default_content);
		
		else
		loadPage(hash);
	}
}


function loadPage(url)
{
	url=url.replace('#page','');
	
	$('.spinner').css('visibility','visible');
	
	$.ajax({
		type: "POST",
		url: "modules/load_page.php",
		data: 'page='+url,
		dataType: "html",
		success: function(msg){
			
			if(parseInt(msg)!=0)
			{
				$('#pageContent').html(msg);
				$('.spinner').css('visibility','hidden');

				/*
				------------------------------------------------
				SINGLE POST - SHARE BUTTON
				https://github.com/Julienh/Sharrre
				------------------------------------------------
				*/

				$('#share-button').sharrre({

					share: {
					twitter: true,
					facebook: true,
					googlePlus: true
					},
					template: '<div class="box"><div class="left">Share</div><div class="middle"><a href="#" class="facebook">f</a><a href="#" class="twitter">t</a><a href="#" class="googleplus">+1</a></div><div class="right">{total}</div></div>',
					enableHover: false,
					enableTracking: true,
					urlCurl: 'modules/sharrre.php',
					render: function(api, options){

						$(api.element).on('click', '.twitter', function() {
							api.openPopup('twitter');
						});
						$(api.element).on('click', '.facebook', function() {
							api.openPopup('facebook');
						});
						$(api.element).on('click', '.googleplus', function() {
							api.openPopup('googlePlus');
						});
					}

				});
			}




		}
		
	});

}