<div class="sidebar" id="sidebar">
    <div class="sidebar-inner slimscroll">
        <div id="sidebar-menu" class="sidebar-menu">
            <ul>
                <li class="menu-title">
                    <span>MAIN MENU</span>
                </li>

                <li class="{{ set_active(['home']) }}">
                    <a href="{{ url('/') }}/home"><i class="feather-grid"></i>
                        <span> Dashboard</span>
                    </a>
                </li>

                <li class="{{ set_active(['profile']) }}">
                    <a href="{{ url('/') }}/profile"><i class="fa fa-user"></i>
                        <span> Profile</span>
                    </a>
                </li>

                <li>
                    <a href="#"><i class="fa-solid fa-magnifying-glass"></i>
                        <span> Searching</span>
                        <span class="menu-arrow"></span>
                    </a>
                    <ul>
                        <li><a href="{{ url('/') }}/searchteacher">Searching Teacher</a></li>
                        <li><a href="{{ url('/') }}/searchstudent">Searching Student</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#"><i class="fas fa-table"></i>
                        <span>Schedule</span>
                    </a>
                </li>


                <li class="menu-title">
                    <span>MANAGEMENT</span>
                </li>

                <li class="{{ set_active(['courses']) }}">
                    <a href="{{ url('/') }}/courses"><i class="fa-solid fa-chalkboard-user"></i>
                        <span>Classroom</span></a>
                </li>

                <li class="{{ set_active(['course-task/exams']) }}">
                    <a href="{{ url('/') }}/course-task/exams"><i class="fas fa-clipboard-list"></i>
                        <span>Examination</span></a>
                </li>
                <li class="{{ set_active(['course-task/resources']) }}">
                    <a href="{{ url('/') }}/course-task/resources"><i class="fas fa-calendar-day"></i>
                        <span>Resources</span></a>
                </li>
                @if (Session::get('idtype') == 'Student')
                    <li class="{{ set_active(['course-task/emergency']) }}">
                        <a href="{{ url('/') }}/course-task/emergency"><i
                                class="fa-solid fa-bell"></i><span>Emergency Message</span></a>
                    </li>
                @endif
                @if (session('idtype') == 'Teacher')
                    <li class="{{ set_active(['course-task/archive']) }}">
                        <a href="{{ url('/') }}/course-task/archive"><i class="fab fa-slideshare"></i><span>Class
                                Archive</span></a>
                    </li>
                @endif
                <li>
                    <a href="{{ url('/') }}/logout"><i class="fa-solid fa-right-from-bracket"></i>
                        <span>Logout</span></a>
                </li>
            </ul>
        </div>
    </div>
</div>
