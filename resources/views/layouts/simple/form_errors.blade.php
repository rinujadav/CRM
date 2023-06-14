@if(count($errors))
<div class="alert text-danger">
    <strong>Whoops!</strong> There were some problems with your input.
    <br/>
    <ul>
        @foreach($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif