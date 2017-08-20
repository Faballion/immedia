<div class="view intro hm-purple-light" style="">
	<div class="full-bg-img flex-center">

		<div class="container text-center white-text animated fadeIn">
			<ul>
                <li>
                    <h1><strong>Search Locations</strong></h1>
				</li>
				<li>
					<p>Enter either a search term or GPS coordinates</p>
				</li>
                <li>
                    <form id="search-form">
                        <input type="hidden" name="postType" value="searchLocations">
                        <div class="row">
                            <div class="col-md-5">
                                <div class="md-form">
                                    <input type="text" name="search-term" class="form-control">
                                    <label for="form1" class="active">Location Name</label>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="md-form">
                                    <input type="text" name="latitude" class="form-control validate">
                                    <label for="form2" class="">Latitude</label>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="md-form">
                                    <input type="text" name="longitude" class="form-control validate">
                                    <label for="form3" class="">Longitude</label>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="md-form">
                                    <button id="search-locations-button" class="btn btn-lg purple darken-3 waves-effect waves-light">Search</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </li>
            </ul>
		</div>
		
	</div>
</div>
