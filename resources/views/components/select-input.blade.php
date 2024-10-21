
@props([
    'disabled' => false,
    'values'=>[],
    'selected'=>""
])


<select {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm']) !!} >
   @foreach ($values as $value)
       <option @if ($selected == $value['value']) selected @endif value={{$value['value']}}>{{$value['name']}}</option>
   @endforeach
    
</select>