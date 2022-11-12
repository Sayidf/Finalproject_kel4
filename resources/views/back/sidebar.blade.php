<div class="dlabnav">
  <div class="dlabnav-scroll">
      <ul class="metismenu" id="menu">
          <li><a class="has-arrow" href="javascript:void()" aria-expanded="false">
                  <i class="fas fa-home"></i>
                  <span class="nav-text">Dashboard</span>
              </a>
              <ul aria-expanded="false">
                 
                  <li><a href="{{ url('/administrator')}}">Beranda</a></li>
                  <li><a href="kanban.html">Kanban</a></li>
                  <li><a href="calendar-page.html">Calendar</a></li>
                  <li><a href="message.html">Messages</a></li>	
              </ul>

          </li>
          
          <li><a class="has-arrow " href="javascript:void()" aria-expanded="false">
              <i class="fas fa-database"></i>
                  <span class="nav-text">Master Data</span>
              </a>
              <ul aria-expanded="false">
                  <li><a href="{{ url('administrator/menu') }}">Data Menu</a></li>
                  <li><a href="{{ url('administrator/meja') }}">Data Meja</a></li>
                  <li><a href="{{ url('administrator/customer') }}">Customers</a></li>
                  <li><a href="{{ url('administrator/pegawai') }}">Pegawai</a></li>
              </ul>
          </li>
          <li><a class="has-arrow " href="javascript:void()" aria-expanded="false">
                  <i class="fas fa-clone"></i>
                  <span class="nav-text">Pages</span>
              </a>
              <ul aria-expanded="false">
                  <li><a href="page-login.html">Login</a></li>
                  <li><a href="page-register.html">Register</a></li>
                  <li><a class="has-arrow" href="javascript:void()" aria-expanded="false">Error</a>
                      <ul aria-expanded="false">
                          <li><a href="page-error-400.html">Error 400</a></li>
                          <li><a href="page-error-403.html">Error 403</a></li>
                          <li><a href="page-error-404.html">Error 404</a></li>
                          <li><a href="page-error-500.html">Error 500</a></li>
                          <li><a href="page-error-503.html">Error 503</a></li>
                      </ul>
                  </li>
                  <li><a href="page-lock-screen.html">Lock Screen</a></li>
                  <li><a href="empty-page.html">Empty Page</a></li>
              </ul>
          </li>
      </ul>
      
      <div class="copyright">
          <p><strong>NF Culinary Admin</strong> © 2022 Final Project SIB 3</p>
          <p class="fs-12">Made with <span class="heart"></span> Kelompok 4</p>
      </div>
  </div>
</div>