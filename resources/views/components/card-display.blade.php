<div>
    @foreach ($calls as $call)
        <x-ui.call-card :call="$call" />
    @endforeach
</div>
