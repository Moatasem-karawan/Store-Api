<aside id="sidebar" class="sidebar"   style="z-index: 1">

    <ul class="sidebar-nav" id="sidebar-nav">

        <li class="nav-item">
            <a class="nav-link " href="{{url("/owner")}}">
                <i class="bi bi-grid"></i>
                <span>الصفحة الرئيسية</span>
            </a>
        </li><!-- End Dashboard Nav -->











        <li class="nav-heading">Pages</li>



        <li class="nav-item">

            <a class="nav-link collapsed" href="{{route("owner_add_product")}}">
                <i class="bi bi-layout-text-window-reverse"></i>
                <span>تقديم طلب </span>
            </a>
        </li><!-- End Login Page Nav -->
        <li class="nav-item">
            <button type="button" class="btn btn" style="text-underline: red" data-bs-toggle="modal" data-bs-target="#basicModal">
                <i class="bi bi-layout-text-window-reverse"></i>
                <span class="text-danger">حجز خارجي </span>
            </button>
        </li><!-- End Login Page Nav -->


        <li class="nav-item">
            <a class="nav-link collapsed"  href="{{route('logout')}}">
                <i class="bi bi-box-arrow-in-right"></i>
                <span>Logout</span>
            </a>
        </li><!-- End Login Page Nav -->



    </ul>

</aside><!-- End Sidebar-->
