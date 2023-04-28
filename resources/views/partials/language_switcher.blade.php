@if(App::currentLocale() !== 'en')
    <a href="/language/en" style="display:inline; margin-left: 1em">
        <img style="display:inline; height: 1.3em; margin-bottom: 0.5em" src="{{ URL::asset("pics/en_flag.jpg") }}"> 
    </a>
@else
    <a href="/language/en" style="display:inline; margin-left: 1em">
        <img style="display:inline; height: 1.6em; margin-bottom: 0.6em" src="{{ URL::asset("pics/en_flag_selected.jpg") }}"> 
    </a>
@endif
@if(App::currentLocale() !== 'ru')
    <a href="/language/ru" style="display:inline; margin-left: 0.5em">
        <img style="display:inline; height: 1.3em; margin-bottom: 0.5em" src="{{ URL::asset("pics/ru_flag.jpg") }}"> 
    </a>
@else
    <a href="/language/ru" style="display:inline; margin-left: 0.5em">
        <img style="display:inline; height: 1.6em; margin-bottom: 0.6em" src="{{ URL::asset("pics/ru_flag_selected.jpg") }}"> 
    </a>
@endif