<div class="sidebar" id="sidebar">
    <div class="sidebar-inner slimscroll">
        <div id="sidebar-menu" class="sidebar-menu">
            <ul>
                <li class="menu-title">
                    <span>MENU</span>
                </li>

                <li class="{{ set_active(['iitadmin']) }}">
                    <a href="{{ url('/') }}/iitadmin"><i class="feather-grid"></i>
                        <span> Batch</span>
                    </a>
                </li>

                <li class="{{ set_active(['ittadmin/course']) }}">
                    <a href="{{ url('/') }}/iitadmin/course"><i class="fa fa-user"></i>
                        <span> Course</span>
                    </a>
                </li>
                <li>
                    <a href="{{ url('/') }}/logout"><i class="fa-solid fa-right-from-bracket"></i>
                        <span>Logout</span></a>
                </li>
            </ul>
        </div>
    </div>
</div>
