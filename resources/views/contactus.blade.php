<div>
    {{-- this is comment
        this is second comment
    
    --}}

    
    <!-- If you do not have a consistent goal in life, you can not live it in a consistent way. - Marcus Aurelius -->
    <h2>This is Contact</h2>
     <h2>Name :{{ request()->name }}</h2>
    <h2>ID : {{request()->id}}</h2>

    {{-- subview and view catching --}}
    @include('Subview.input',[
        'myname'=> request()->name,
    ])

    {{-- //for loop  --}}
    @for($i=0 ; $i<10;$i++)
        <p>{{ $i }}</p>
        @if ($i==5)
            <h2>Hi this is {{$i}}</h2>
        @endif
            
    
    @endfor
</div>
