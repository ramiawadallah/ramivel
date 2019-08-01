@php  $id = isset($id) ? $id : '';  @endphp

<div class="custom-control custom-checkbox">
    <input id="user_id_{{ $id }}" type="checkbox" value="{{ $id }}" class="custom-control-input checkSingle"
           id="user_id_1" required name="item[]=">
           <label class="custom-control-label" for="user_id_{{ $id }}"></label>
</div>
