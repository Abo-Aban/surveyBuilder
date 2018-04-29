@if(session('success'))
    <div class="alerty alerty-primary alerty-fade">
        <ul>
            <li>{{ session('success') }}</li>
        </ul>
    </div>
@endif

@if(session('error'))
    <div class="alerty alerty-danger alerty-fade">
        <ul>
            <li>{{ session('error') }}</li>
        </ul>
    </div>
@endif


@if($errors->any())
    <div class="alerty alerty-danger alerty-fade">
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif