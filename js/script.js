//Search for locations and display in card format
$('#search-locations-button').click(function() {
	$('#search-results').html("");
	
	$.post('posts.php', $('#search-form').serialize(), function(data) {
		var obj = JSON.parse(data);
		var results = obj.response.venues;

		for (var key in results) {
			var cardOutput = "";
			cardOutput += '<div class="card location-card col-md-3">';
			cardOutput += '<img class="img-fluid" src="https://mdbootstrap.com/img/Photos/Horizontal/Nature/4-col/img%20%282%29.jpg" alt="Card image cap">';
			cardOutput += '<div class="card-body">';
			cardOutput += '<h4 class="card-title">' + results[key].name; + '</h4>';
			cardOutput += '<p class="card-text">';
			cardOutput += results[key].location.address + ' ' + results[key].contact.phone + '<br>' + results[key].location.state + ', ' + results[key].location.country; 
			cardOutput += '</p>';
			cardOutput += '<input type="hidden" name="location-id" value="'+ results[key].id +'">';
			cardOutput += '<button class="btn purple darken-3 waves-effect waves-light view-images">View Images</button>';
			cardOutput += '</div></div>';

			$('#search-results').append(cardOutput);
		}
	});
	return false;
})


//Show images for a location in a lightbox
$('#search-results, #saved-locations-container').on('click', '.view-images', function(event) {
	var locationId = $(this).siblings('[name=location-id]').val();

	$.post('posts.php', {postType: 'fetchImages', locationId: locationId}, function(data) {
		var obj = JSON.parse(data);
		var results = obj.response.photos.items;
		var lightboxData = [];

		for (var key in results) {
			var imageLink = { 
				src:  results[key].prefix + 'original'  + results[key].suffix
			};
			lightboxData.push(imageLink);
		}

		$.fancybox.open(lightboxData, {
			loop : true,
			hash : 'test'
		});

	});
})

//Register user
$('#register-button').click(function() {
	$.post('posts.php', $('#register-form').serialize(), function(data) {
		if(data == 1) { 
			$.bootstrapGrowl('You have successfully registered. Please login.', {type: 'success', align: 'center', width: 'auto'});
			$('#register-form')[0].reset();
			$('[name=register-email').focus();
		}
		else {
			$.bootstrapGrowl('This email has already been registered.', {type: 'danger', align: 'center', width: 'auto'});
			$('#register-form')[0].reset();
			$('[name=register-email').focus();
		}	
	});
	return false;
})

//Login user
$("#login-button").click(function() {
	$.post('posts.php', $('#login-form').serialize(), function(data) {
	});
	return false;
})