@extends('layouts.app')

@section('content')
<div id="main-wrap">
  <div id="user-wrap">
    <div class="user-tab">
      <a class="user-tabs {{ $tabs[0] }}" href="/create">Check-in</a>
      <a class="user-tabs {{ $tabs[1] }}" href="/">List</a>
      <a class="user-tabs {{ $tabs[2] }}" href="/history">History</a>
      <a class="tabs-last user-tabs {{ $tabs[3] }}" href="/search">Search</a>
    </div>
    <div id="user-checkin" class="user-content {{ $tabs2[0] }}">
      <form method="post" id="reg_form" action="" onsubmit="return verifyForm();">
        <div>
          <h2 class="user-title">Baggage check-in</h2>
          @if(!empty($newposition))
            <p class="user-title">Position selected: {{ $newposition[0] }}{{ $newposition[1] }} (<a href="./">Remove</a>)</p>
          @endif
        </div>
        <div>
          <input type="text" id="reg_id" name="reg_id" placeholder="ID/Passport">
          <input type="text" id="reg_name" name="reg_name" placeholder="Name">
          <input type="text" id="reg_surname" name="reg_surname" placeholder="Surname">
          <input type="text" id="reg_desc" name="reg_desc" placeholder="Description">
          @if(!empty($newposition))
              <input type="hidden" id="reg_row" name="reg_row" value="{{ $newposition[0] }}">
              <input type="hidden" id="reg_col" name="reg_col" value="{{ $newposition[1] }}">
          @else
              <input type="checkbox" id="reg_spe" name="reg_spe" value="Special">Special<br>
          @endif
          <input type="submit" id="reg_submit" name="reg_submit" value="Submit">
        </div>
      </form>
    </div>
  </div>
  <div id="pos-wrap">
    <table>
      @foreach($baggages as $baggage_row)
        <tr>
          @foreach($baggage_row as $baggage)
            @if($baggage[1]==$med_col)
              <td id="hupc-pos_{{ $baggage[0] }}-corridor" class="pos-med">
              </td>
            @endif
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
