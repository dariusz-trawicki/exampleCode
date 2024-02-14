@if ('textarea' != $type)
    <input type="{{ $type }}"
           placeholder="{{ $placeholder }}"
           name="{{ $name }}" value="{{ old($name) }}" id="{{ $name }}"
           @if($required) required @endif
           @class([
                'bg-neutral-50 border border-gray-300 text-gray-900 sm:text-base
                rounded-lg focus:border-gray-500 focus:ring-0 block w-full p-2.5',
                'ring-1 ring-red-300' => $errors->has($name),
            ]) />
@else
    <textarea id="{{ $name }}" name="{{ $name }}"  rows="7" @if($required) required @endif
              @class([
                'w-full bg-neutral-50 border border-gray-300 text-gray-900
                sm:text-base rounded-lg focus:border-gray-500 focus:ring-0 block w-full p-2.5',
                'ring-1 ring-red-300' => $errors->has('message'),
                ])>{{ old($name) }}</textarea>
@endif
