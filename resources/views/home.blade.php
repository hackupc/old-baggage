@extends('layouts.app')

@section('content')
<div id="main-wrap">
  <div id="user-wrap">
    <div class="user-tab">
      <button class="user-tabs<?php if(!((isset($_GET['rem_row'])&&isset($_GET['rem_col']))||isset($_GET['rem_id']))){ echo ' active'; } ?>" onclick="openTab(event, 'user-checkin')">Check-in</button>
      <button class="user-tabs" onclick="openTab(event, 'user-list')">List</button>
      <button class="user-tabs" onclick="openTab(event, 'user-history')">History</button>
      <button class="tabs-last user-tabs" onclick="openTab(event, 'user-search')">Search</button>
    </div>
  </div>
  <div id="pos-wrap">
    <table>
      @foreach($baggages as $baggage_row)
        <tr>
          @foreach($baggage_row as $baggage)
            @if($baggage[2])
              <td id="hupc-pos_{{ $baggage[0] }}{{ $baggage[1] }}" style="background-color: #E71754;">
                <a class="occupied" href="/current/{{ $baggage[0] }}{{ $baggage[1] }}">{{ $baggage[0] }}{{ $baggage[1] }}</a>
              </td>
            @else
              <td id="hupc-pos_{{ $baggage[0] }}{{ $baggage[1] }}">
                <a class="free" href="/create/{{ $baggage[0] }}{{ $baggage[1] }}">{{ $baggage[0] }}{{ $baggage[1] }}</a>
              </td>
            @endif
          @endforeach
        </tr>
      @endforeach
    </table>
  </div>
</div>
@endsection
