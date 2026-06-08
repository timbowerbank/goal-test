    @extends('layouts.carer')

    @section('title', "This is a carer home page")

    @section('carer-content')
        <x-shared.header
            :headline="$home->home_name"
            :sub-headline="'Welcome to ' . $home->home_name"
        ></x-shared.header>

        


    @endsection