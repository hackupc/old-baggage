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
    <?php
      $rows = 10;
      $cols = 14;
      $med_col = $cols/2;
    ?>
    <table>
      @for($ini_row=0; $ini_row<$rows; $ini_row++)
        <tr>
          <?php $corridor = false; ?>
          @for($ini_col=0; $ini_col<$cols; $ini_col++)
            @if((!$corridor)AND($ini_col==$med_col))
              <td class="pos-med" id="hupc-pos_{{ chr($ini_row+65) }}-corridor">
              </td>
              <?php
                $ini_col--;
                $corridor = true;
              ?>
            @else
              <td id="hupc-pos_{{ chr($ini_row+65) }}-{{ $ini_col }}">
                <a class="occupied">{{ chr($ini_row+65) }}{{ $ini_col }}</a>
              </td>
            @endif
          @endfor
        </tr>
      @endfor
    </table>

    @foreach($baggages as $baggage)
      <p>Test: {{ $baggage->row }}{{ $baggage->col }}</p>
    @endforeach
  </div>
</div>
@endsection
