  <aside class="sidebar-wrapper fixed-top">
      @php
          $slug = Request::segment(1);
          if($slug == ''){
            $slug = 'company';
          }
      @endphp
      <div class="sidebar-inner">
          <ul class="side-ul">
              <li class="side-item">
                  <a href="{{ route('company.index') }}" class="side-link {{($slug == 'company'?'active':'')}}">Manage Companies</a>
              </li>
              <li class="side-item">
                  <a href="{{ route('employee.index') }}" class="side-link {{($slug == 'employee'?'active':'')}}">Manage Employees</a>
              </li>
          </ul>
          <a href="{{ route('logout_get') }}" class="btn btn-sm btn-light rounded-pill mx-auto px-5 my-4"><i
                  class="fa fa-sign-in-alt me-2"></i>
              Logout</a>
      </div>
  </aside>
