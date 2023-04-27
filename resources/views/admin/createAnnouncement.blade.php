@extends('layouts.master')

@section('title')
	Announcement
@endsection 
@include('layouts.sidebaradmin')
@section('content')
<div class="container">
  <div class="main-panel" id="main-panel" style="padding-bottom:100px;">
	@if(Session::get('success'))
	<div class = "alert alert-success text-center" style="font-weight: bolder;">
		{{ Session::get('success')}}
	</div>
	@endif
	<div id="banner-form">
		<h2>ANNOUNCEMENTS</h2>
	</div>
	<div class="container">
  	<div class="table-responsive">
    <table class="table table-hover" id="announcementTable">
      <thead>
        <tr>
          <th>ID</th>
          <th>Heading</th>
          <th>Caption</th>
          <th class="actionsCol">Actions</th>
        </tr>
      </thead>
      <tfoot>
        <th>ID</th>
        <th>Heading</th>
        <th>Caption</th>
      </tfoot>
    </table>
  	</div>
	</div>
</div>

<!-- Announcement Modal -->
<div class="modal fade" id="announcementModal" aria-labelledby="announcementModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" >
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" style="font-weight: bolder;">Add Announcement</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="announcementForm" method="post" action="{{route('admin.storeAnnouncement')}}">
          <input type="hidden" name="_token" value="{{ csrf_token() }}">
          <div class="form-group"> 
            <label for="article_img[]" class="control-label" style="font-weight: bolder;">Article Image</label>
            <input type="file" class="form-control" accept="image/*" id="article_img[]" name="article_img[]" multiple>
          </div> 
          <div class="form-group"> 
            <label for="heading" class="control-label" style="font-weight: bolder;">Heading: </label>
            <input type="text" class="form-control" id="heading" name="heading">
          </div>
          <div class="form-group">
            <label for="" class="control-label" style="font-weight: bolder;">Caption</label>
            <textarea class="form-control" id="caption" name="caption" rows="3"></textarea>
          <div class="modal-footer">
            <button id="announcementSubmit" type="submit" class="btn btn-success">Add</button>
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection
