@props(['type'=>'text','id'=>null,'placeholder'=>'','value'=>'','oninput'=>'','onchange'=>'','disabled'=>false])
<input
  type="{{ $type }}"
  @if($id) id="{{ $id }}" @endif
  class="form-control fb-input {{ $attributes->get('class','') }}"
  placeholder="{{ $placeholder }}"
  value="{{ $value }}"
  @if($oninput)  oninput="{{ $oninput }}"   @endif
  @if($onchange) onchange="{{ $onchange }}"  @endif
  @if($disabled) disabled @endif
  {{ $attributes->except(['type','id','placeholder','value','oninput','onchange','disabled','class']) }}
/>
