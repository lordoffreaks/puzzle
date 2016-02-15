@extends('_layouts.master')

@section('body')
<h1>Contact us!</h1>
<p>A very common place.</p>

<form action="/info" method="post">
    <label for="name">
        <input type="text" placeholder="Your name" name="name" />
    </label>

    <label for="mail">
        <input type="text" placeholder="Your mail" name="mail" />
    </label>

    <textarea name="message"></textarea>

    <input type="submit" value="Send" />
</form>
@endsection
