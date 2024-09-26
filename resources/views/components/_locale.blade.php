<form action="{{route('setLocale', $lang)}}" method="POST">
    @csrf
    <button type="submit" class="btn">
        <img src="{{asset('vendor/blade-flags/language-' . $lang . '.svg')}}" alt="" width="20" height="10">
    </button>
</form>