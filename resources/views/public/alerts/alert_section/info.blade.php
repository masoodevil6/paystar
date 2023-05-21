@if(session("alert-section-info"))
    <div class="alert alert-info alert-dismissible fade show" role="alert">
        <h4 aria-hidden="true">&times; </h4>
        <hr>
        <p class="mb-0">
            {!! session("alert-section-info")!!}
        </p>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close" style="right: auto!important; left: 0;">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif

