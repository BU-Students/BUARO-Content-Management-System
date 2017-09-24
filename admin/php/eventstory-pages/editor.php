<!-- Modal -->
<div class="modal fade" id="editor" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Add Story/Event</h4>
			</div>
			<form id="editor-form" method="POST" action="backend/post_content.php" enctype="multipart/form-data">
				<div class="modal-body">
					<div id="">
						<div class="form-group">
							<label for="exampleInputEmail1">Title</label>
							<input type="text" class="form-control" id="post-title" placeholder="Title" name="post-title" required>
						</div>
						<div class="form-group">
							<label for="exampleInputFile">Image Banner</label>
							<input type="file" id="exampleInputFile" name="img-banner">
						</div>
						<div class="form-group">
							<div class="dropdown">
								<button type="button" class="btn1 btn-select1" data-toggle="dropdown">Content Type</button>
								<ul class="dropdown-menu dropdown-menu-select">
									<li>
										<label class="dropdown-radio">
											<input type="radio" value="1" name="content-type" onclick="chng1()">
											<i>Story</i>
										</label>
									</li>
									<li>
										<label class="dropdown-radio">
											<input type="radio" value="2" name="content-type" onclick="chng()">
											<i>Event</i>
										</label>
									</li>
									<li>
										<label class="dropdown-radio">
											<input type="radio" value="3" name="content-type" onclick="chng1()">
											<i>Bulletin Item</i>
										</label>
									</li>
								</ul>
							</div>
							<div id="dateEvent1" class="hidden"><label for="event-date"><input type="date" name="event-date" id="event-date">Date of Event</label></div>
						</div>
						<div class="form-group">
							<textarea class="form-control" rows="5" id="textarea1" name="content"></textarea>
						</div>
						<div class="form-group">
							<label for="exampleInputFile">Upload Images</label>
							<input type="file" name="files[]" multiple="multiple" />
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-primary">Publish</button>
				</div>
			</form>
		</div>
	</div>
</div>