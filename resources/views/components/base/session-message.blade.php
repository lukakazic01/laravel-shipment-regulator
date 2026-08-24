@php use App\View\Components\Base\SessionMessage; @endphp

@if(session()->has($sessionKey ?? 'message'))
    <div {{ $attributes->class([
        "flex text-sm justify-center mb-6 border p-2 rounded w-full",
        SessionMessage::applyClassBasedOnSeverity($alertSeverity),
    ]) }}>
        {{ session()->get($sessionKey ?? 'message') }}
    </div>
@endif
