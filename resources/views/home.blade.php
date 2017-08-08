@extends('layouts.app')

@section('content')
<div id="main-wrap">
  <div id="user-wrap">
    <div class="user-tab">
      <button class="user-tabs<?php if(!((isset($_GET['rem_row'])&&isset($_GET['rem_col']))||isset($_GET['rem_id']))){ echo ' active'; } ?>" onclick="openTab(event, 'user-checkin')">Check-in</button>
      <button class="user-tabs" onclick="openTab(event, 'user-list')">List</button>
      <button class="user-tabs" onclick="openTab(event, 'user-history')">History</button>
      <button class="tabs-last user-tabs" onclick="openTab(event, 'user-search')">Search</button>
    </div>.
  </div>
  <div id="pos-wrap">
    Test 2.
  </div>
</div>
@endsection
