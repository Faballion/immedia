/*$("#search-locations-button").click(function() {
	$.post("posts.php", $("#search-form").serialize(), function(data){
		var obj = JSON.parse(data);
		var results = obj.response.venues;
		console.log(results);

		for (var key in results) {
			var name = results[key].name;
			$("#search-results").append(results[key].name);

		}
	});
	return false;
})*/

$('#search-locations-button').click(function() {
	$('#search-results').html("");
	
	$.post('posts.php', $('#search-form').serialize(), function(data) {
		var obj = JSON.parse(data);
		var results = obj.response.venues;

		for (var key in results) {
			var cardOutput = "";
			cardOutput += '<div class="card">';
			cardOutput += '<img class="img-fluid" src="https://mdbootstrap.com/img/Photos/Horizontal/Nature/4-col/img%20%282%29.jpg" alt="Card image cap">';
			cardOutput += '<div class="card-body">';
			cardOutput += '<h4 class="card-title">' + results[key].name; + '</h4>';
			cardOutput += '<p class="card-text">Something</p>';
			cardOutput += '<a href="#" class="btn purple darken-3">View Images</a>';
			cardOutput += '</div></div><br>';

			$('#search-results').append(cardOutput);
			/*for (var i = 0; i < result[key].length; i++) {
				var title = result[key][i];
				console.log(title);
			}*/
		}
	});
	return false;
})

