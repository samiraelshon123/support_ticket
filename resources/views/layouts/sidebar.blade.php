<div class="d-flex flex-column flex-shrink-0 p-3 text-bg-light" style="width: 280px;">
    <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">


      <span class="fs-4 text-black">  Dashboard</span>
    </a>
    <hr>
    <ul class="nav nav-pills flex-column mb-auto">
      <li class="pt-6 nav-item">
        <a href="{{route('dashboard')}}" class="nav-link {{ (request()->is('dashboard')) ? 'active' : '' }}" aria-current="page">



          <span class="pt-10 text-black"> <i class="fa-solid fa-house"></i> Dashboard</span>
        </a>
      </li>
       @can("Show_Ticket")
      <li>
        <a href="{{route('ticket.index')}}" class="nav-link text-black {{ (request()->is('ticket')) ? 'active' : '' }}">

            <i class="fa-solid fa-ticket"></i>
           Tickets
        </a>
      </li>
      @endcan

      @can("Show_User")
      <li>
        <a href="{{route('user.index')}}" class="nav-link text-black {{ (request()->is('user')) ? 'active' : '' }}">
            <i class="fa-solid fa-user-group"></i>
          Users
        </a>
      </li>
      @endcan
      @can("Show_Ticket_Logs")
      <li>
        <a href="{{ route('activities') }}" class="nav-link text-black {{ (request()->is('activities')) ? 'active' : '' }}">
            <i class="fa-solid fa-clipboard-list"></i>
          Ticket Logs
        </a>
      </li>
      @endcan
      @can("Show_Category")
      <li>
        <a href="{{route('category.index')}}" class="nav-link text-black {{ (request()->is('category')) ? 'active' : '' }}">
            <i class="fa-solid fa-clipboard"></i>
          Categories
        </a>
      </li>
      @endcan
      @can("Show_Label")
      <li>
        <a href="{{route('label.index')}}" class="nav-link text-black {{ (request()->is('label')) ? 'active' : '' }}">

            <i class="fa-solid fa-tag"></i>
          Lables
        </a>
      </li>
      @endcan
    </ul>
    <hr>

  </div>
  <div class="b-example-divider b-example-vr"></div>

