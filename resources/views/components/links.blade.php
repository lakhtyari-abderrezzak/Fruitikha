@props(['active' => false])

{{-- <a  class="{{ $active ? 'current-list-item' : '' }}" {{$attributes}} >{{$slot}}</a> --}}
<li class="{{ $active ? 'current-list-item' : '' }}">{{$slot}}</li>
