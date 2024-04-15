
<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
        {{-- <a class="navbar-brand logo" href="#"><strong> HELLOAI </strong>
            <span class="position-relative  px-2 text-light bg-warning border border-warning rounded-pill box" >
                BOX<svg width="1em" height="1em" viewBox="0 0 16 16" class="position-absolute top-100 start-50 translate-middle mt-1" fill="var(--bs-warning)" xmlns="http://www.w3.org/2000/svg"><path d="M7.247 11.14L2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z"/></svg>
            </span> </a> --}}
            <div style="display:flex;">
                <img style="width: 150px;height:110px;margin:-30px" src="{{asset('storage/générale/chatbox.png')}}" alt="logo">
                <p style="margin-left:-18px;font-size:25px;font-weight:600;margin-top:5px;" >ChatAI</p>
            </div>
        <a href="{{route('show')}}"><button  class="btn btn-outline-secondary logout" type="submit">Logout</button></a>
    </div>
</nav>
{{--  class="btn btn-outline-warning logout"--}}