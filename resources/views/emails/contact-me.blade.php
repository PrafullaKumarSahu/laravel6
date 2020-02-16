@component('mail::message')
## Hi {{ $name }}

Some lorem ipsum texts.

Some List

 - First Item
 - Second Item
 - Third Item

 @component('mail::button', ['url' => 'https://example.com'])
    Visit example.com
 @endcomponent
@endcomponent