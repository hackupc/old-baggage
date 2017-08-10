@extends('layouts.app')

@section('content')
<div id="main-wrap">
  <div id="user-wrap">
    <div class="user-tab">
      <a class="user-tabs {{ $tabs[0] }}" href="/create">Check-in</a>
      <a class="user-tabs {{ $tabs[1] }}" href="/list">List</a>
      <a class="user-tabs {{ $tabs[2] }}" href="/history">History</a>
      <a class="tabs-last user-tabs {{ $tabs[3] }}" href="/search">Search</a>
    </div>
    @if($tabs2[0]==true)
      <div id="user-checkin" class="user-content">
        <form method="post" id="reg_form" action="" onsubmit="return verifyForm();">
          <div>
            <h2 class="user-title">Baggage check-in</h2>
            @if(!empty($newposition))
              <p class="user-title">Position selected: {{ $newposition[0] }}{{ $newposition[1] }} (<a href="./">Remove</a>)</p>
            @endif
          </div>
          <div>
            {{ csrf_field() }}
            @if(empty($moredetails))
              <input type="text" id="reg_id" name="reg_id" placeholder="ID/Passport">
              <input type="text" id="reg_name" name="reg_name" placeholder="Name">
              <input type="text" id="reg_surname" name="reg_surname" placeholder="Surname">
            @else
              <input type="text" id="reg_id" name="reg_id" placeholder="ID/Passport" value="{{ $moredetails[0] }}">
              <input type="text" id="reg_name" name="reg_name" placeholder="Name" value="{{ $moredetails[1] }}">
              <input type="text" id="reg_surname" name="reg_surname" placeholder="Surname" value="{{ $moredetails[2] }}">
            @endif
            <input type="text" id="reg_desc" name="reg_desc" placeholder="Description">
            @if(!empty($newposition))
                <input type="hidden" id="determined" name="determined" value="true">
                <input type="hidden" id="reg_row" name="reg_row" value="{{ $newposition[0] }}">
                <input type="hidden" id="reg_col" name="reg_col" value="{{ $newposition[1] }}">
            @else
                <input type="hidden" id="determined" name="determined" value="false">
                <input type="checkbox" id="reg_spe" name="reg_spe" value="Special">Special<br>
            @endif
            <input type="submit" id="reg_submit" name="reg_submit" value="Submit">
          </div>
        </form>
      </div>
    @endif
    @if($tabs2[1]==true)
      <div id="user-list" class="user-content">
        <div>
          <h2 class="user-title">Baggage list</h2>
        </div>
        @foreach($lists as $list)
        <div class="list">
          <div class="list-left">
            <a href="/baggage/{{ strtotime($list['created']) }}/{{ $list['row'] }}{{ $list['col'] }}">{{ $list['row'] }}{{ $list['col'] }}</a>
            <p>{{ date("j/Y H:i\h", strtotime($list['created'])) }}</p>
          </div>
          <div class="list-right">
            <a href="/user/{{ $list['id'] }}">{{ $list['id'] }}</a>
            <p>{{ $list['name'] }} {{ $list['surname'] }}</p>
          </div>
        </div>
        @endforeach
      </div>
    @endif
    @if($tabs2[2]==true)
      <div id="user-list" class="user-content">
        <div>
          <h2 class="user-title">Baggage history</h2>
        </div>
        @foreach($lists as $list)
        <div class="list">
          <div class="list-left">
            <a href="/baggage/{{ strtotime($list['created']) }}/{{ $list['row'] }}{{ $list['col'] }}">{{ $list['row'] }}{{ $list['col'] }}</a>
            <p>{{ date("j/y H:i\h", strtotime($list['created'])) }} - {{ date("j/y H:i\h", strtotime($list['deleted'])) }}</p>
          </div>
          <div class="list-right">
            <a href="/user/{{ $list['id'] }}">{{ $list['id'] }}</a>
            <p>{{ $list['name'] }} {{ $list['surname'] }}</p>
          </div>
        </div>
        @endforeach
      </div>
    @endif
    @if($tabs2[3]==true)
      <div id="user-search" class="user-content">
        <form method="post" id="sea_form" action="" onsubmit="return verifySearch();">
          <div>
            <h2 class="user-title">User search</h2>
          </div>
          <div>
            {{ csrf_field() }}
            <input type="text" id="sea_id" name="sea_id" placeholder="DNI/Passport">
            <input type="submit" id="sea_submit" name="sea_submit" value="Submit">
          </div>
        </form>
      </div>
    @endif
    @if($tabs2[4]==true)
      <div id="user-user" class="user-content" style="opacity: 1; height: inherit;">
        <div>
          <h2 class="user-title">Baggage details</h2>
        </div>
        @if(empty($list[0]))
          <p>There's no baggage with the details provided.</p>
        @else
          <h3>{{ $list[0]['row'] }}{{ $list[0]['col'] }}</h3>
          <p><a href="/user/{{ $list[0]['id'] }}">{{ $list[0]['id'] }}</a>: {{ $list[0]['name'] }} {{ $list[0]['surname'] }}</p>
          <p>{{ $list[0]['description'] }}</p>
          <p>{{ date("j/Y H:i\h", strtotime($list[0]['created'])) }}
            @if(!empty($list[0]['deleted']))
              - {{ date("j/Y H:i\h", strtotime($list[0]['deleted'])) }}</p>
            @else
              </p>
              @if(!empty($new))
                <a id="remove-button" href="/create/more/{{ $list[0]['id'] }}/{{ $list[0]['name'] }}/{{ $list[0]['surname'] }}" style="width: 42.5%; float: left; margin-right: 5%;">Add more</a>
                <a id="remove-button" href="/remove/{{ $list[0]['row'] }}{{ $list[0]['col'] }}" style="width: 42.5%; float: right;">Remove baggage</a>
              @else
                <a id="remove-button" href="/remove/{{ $list[0]['row'] }}{{ $list[0]['col'] }}">Remove baggage</a>
              @endif
            @endif
        @endif
      </div>
    @endif
    @if($tabs2[5]==true)
      <div id="user-details" class="user-content" style="opacity: 1; height: inherit;">
        <div>
          <h2 class="user-title">User history</h2>
        </div>
        @if(empty($user[0]))
          <p>There's no user with the details provided.</p>
        @else
          <h3>{{ $user[0]['id'] }}</h3>
          <p>{{ $user[0]['name'] }} {{ $user[0]['surname'] }}</p>
          <a id="remove-button" href="/create/more/{{ $user[0]['id'] }}/{{ $user[0]['name'] }}/{{ $user[0]['surname'] }}" style="margin-bottom: 25px;">Add more baggages</a>
          @foreach($lists as $list)
          <div class="list">
            <div class="list-left">
              <a href="/baggage/{{ strtotime($list['created']) }}/{{ $list['row'] }}{{ $list['col'] }}">{{ $list['row'] }}{{ $list['col'] }}</a>
            </div>
            <div class="list-right">
              <p>{{ date("j/Y H:i\h", strtotime($list['created'])) }}
                @if(!empty($list['deleted']))
                  - {{ date("j/Y H:i\h", strtotime($list['deleted'])) }}
                @endif
              </p>
            </div>
            <p>{{ $list['description'] }}</p>
          </div>
          @endforeach
        @endif
      </div>
    @endif
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
                <a class="occupied" href="/baggage/{{ strtotime($baggage[2][0]['created']) }}/{{ $baggage[0] }}{{ $baggage[1] }}">{{ $baggage[0] }}{{ $baggage[1] }}</a>
              </td>
            @elseif(!empty($newposition)AND($newposition[0]==$baggage[0])AND($newposition[1]==$baggage[1]))
              <td id="hupc-pos_{{ $baggage[0] }}{{ $baggage[1] }}" style="background-color: #FF78A5;">
                <a class="occupied" href="/create/{{ $baggage[0] }}{{ $baggage[1] }}">{{ $baggage[0] }}{{ $baggage[1] }}</a>
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
    <div>
      <h3 class="special-title">Special baggages</h3>
      @foreach($specials as $special)
        <p><a href="/baggage/{{ strtotime($special['created']) }}/{{ $special['row'] }}{{ $special['col'] }}">{{ $special['row'] }}{{ $special['col'] }}</a>: {{ $special['id'] }}</p>
      @endforeach
    </div>
  </div>
</div>
@endsection
