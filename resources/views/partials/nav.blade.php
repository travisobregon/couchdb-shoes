<nav class="nav has-shadow">
    <div class="container">
        <div class="nav-left">
            <a class="nav-item is-brand" href="/">
                <img src="/images/running.svg" alt="Shoe logo">
            </a>
        </div>

        <div class="nav-center">
            <a class="nav-item is-tab {{ Request::is('/') ? 'is-active' : '' }}" href="{{ url('/') }}"><i class="fa fa-home"></i> &nbsp; Home</a>
            <a class="nav-item is-tab {{ Request::is('shoes/create') ? 'is-active' : '' }}" href="{{ url('shoes/create') }}"><i class="fa fa-plus"></i> &nbsp; Add</a>
            <a class="nav-item is-tab {{ Request::is('shoes') ? 'is-active' : '' }}" href="{{ url('shoes') }}"><i class="fa fa-eye"></i> &nbsp; View</a>
            <!-- <a class="nav-item is-tab"><i class="fa fa-pencil"></i> &nbsp; Edit</a> -->
            <!-- <a class="nav-item is-tab"><i class="fa fa-trash"></i> &nbsp; Remove</a> -->
        </div>

        <div class="nav-right">
            <a class="nav-item is-brand" href="/">
                <img class="flip" src="/images/running.svg" alt="Shoe logo">
            </a>
        </div>
    </div>
  </nav>