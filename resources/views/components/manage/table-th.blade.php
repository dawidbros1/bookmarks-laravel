@switch($attributes['type'])
@case('order')
<th>
    <img class="block m-auto" src="{{ URL::asset('/images/order.png') }}" alt="profile Pic" height="25" width="25" title="Kolejność wyświetlania" )>
</th>
@break

@case('hidden')
<th>
    <img class="block m-auto" src="{{ URL::asset('/images/hidden.png') }}" alt="profile Pic" height="25" width="25" title="Czy element ma być ukryty" )>
</th>
@break

@case('public')
<th>
    <img class="block m-auto" src="{{ URL::asset('/images/lock.png') }}" alt="profile Pic" height="25" width="25" title="Czy element ma być prywatny" )>
</th>
@break
@endswitch
