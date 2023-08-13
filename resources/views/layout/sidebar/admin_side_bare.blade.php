<aside id="sidebar" class="sidebar"   style="z-index: 1">

    <ul class="sidebar-nav" id="sidebar-nav">

        <li class="nav-item">
            <a class="nav-link " href="{{url("/index")}}">
                <i class="bi bi-grid"></i>
                <span>الصفحة الرئيسية</span>
            </a>
        </li><!-- End Dashboard Nav -->











        <li class="nav-heading">Pages</li>



        <li class="nav-item">
            <a class="nav-link collapsed" href="{{url("/index/get/category")}}">
                <i class="bi bi-layout-text-window-reverse"></i>
                <span>الاصناف</span>
            </a>
        </li><!-- End Login Page Nav -->



        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#tables-navv" data-bs-toggle="collapse" href="#">
                <i class="bi bi-layout-text-window-reverse"></i><span>اضافة مشروع تجاري </span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="tables-navv" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                <li>
                    <a href="{{route('add_seller_view')}}">
                        <i class="bi bi-circle"></i><span>محل تجاري</span>
                    </a>
                </li>
                <li>
                    <a href="{{route('add_pool_view')}}">
                        <i class="bi bi-circle"></i><span>شالية</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <i class="bi bi-circle"></i><span>صالة افراح</span>
                    </a>
                </li>
            </ul>
        </li><!-- End Tables Nav -->


        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#tables-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-layout-text-window-reverse"></i><span>طلبات انضمام المشاريع </span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="tables-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                <li>
                    <a href="{{route("seller_place_order")}}">
                        <i class="bi bi-circle"></i><span> طلبات انضمام  المحلات التجارية</span>
                    </a>
                </li>
                <li>
                    <a href="{{route('pool_place_order')}}">
                        <i class="bi bi-circle"></i><span>طلبات  انضمام الشاليهات</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <i class="bi bi-circle"></i><span> طلبات انضمام صالات الافراح</span>
                    </a>
                </li>
            </ul>
        </li><!-- End Tables Nav -->


        <li class="nav-item">
            <a class="nav-link collapsed" href="{{route("lest_seller_view")}}">
                <i class="bi bi-journal-text text-danger"></i>
                <span> اضافة منتج </span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link collapsed" href="{{route("pending_product_seller")}}">
                <i class="bi bi-journal-text"></i>
                <span>طلبات اضافة المنتجات </span>
            </a>
        </li><!-- End Login Page Nav -->



        <a class="nav-link collapsed" data-bs-target="#tables-naav" data-bs-toggle="collapse" href="#">
            <i class="bx bx-message-alt-error text-warning"></i><span>عروض تجارية </span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="tables-naav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
            <li>
                <a href="{{route("the_pools_offers")}}">
                    <i class="bi bi-circle"></i><span> عروض شاليهات</span>
                </a>
            </li>
            <li>
                <a href="{{route("the_sellers_offers")}}">
                    <i class="bi bi-circle"></i><span> عروض محلات تجارية</span>
                </a>
            </li>
        </ul>
        <a class="nav-link collapsed" data-bs-target="#tables-naavv" data-bs-toggle="collapse" href="#">
            <i class="bx bx-bi bi-cart "></i><span>الطلبات</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="tables-naavv" class="nav-content collapse " data-bs-parent="#sidebar-nav">
            <li>
                <a href="{{route("admin.get.sellers.orders")}}">
                    <i class="bi bi-circle"></i><span>طلبات توصيل المحلات التجارية </span>
                </a>
            </li>
            <li>
                <a href="{{route("admin.get.pool.reservation")}}">
                    <i class="bi bi-circle"></i><span> حجوازت الشاليهات</span>
                </a>
            </li>
        </ul>
        <a class="nav-link collapsed" data-bs-target="#tables-naavv1" data-bs-toggle="collapse" href="#">
            <i class="ri-notification-2-fill "></i><span> الاشعارات</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>

        <ul id="tables-naavv1" class="nav-content collapse " data-bs-parent="#sidebar-nav">
            <li>
                <a href="{{route("admin.view_app_notification")}}">
                    <i class="bi bi-circle"></i><span>الاشعارات على التطبيق </span>
                </a>
            </li>

            <li>
                <a href="{{route("admin.send_sms_notification")}}">
                    <i class="bi bi-circle"></i><span> SMS رسائل  </span>
                </a>
            </li>
            <li>
                <a href="{{route("admin.setting_sms")}}">
                    <i class="bi bi-circle"></i><span> SMS اعدادات  </span>
                </a>
            </li>

        </ul>


        <li class="nav-item">
            <a class="nav-link collapsed" href="{{route("sms_ads_orders")}}">
                <i class="bi bi-send"></i>
                <span>طلبات التسويق</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link collapsed" href="{{route("code_offers_view")}}">
                <i class="bi bi-question-circle"></i>
                <span>كواد الخصم</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link collapsed" href="{{url("/index/fqa")}}">
                <i class="bi bi-question-circle"></i>
                <span>F.Q.A</span>
            </a>
        </li>


        <li class="nav-item">
            <a class="nav-link collapsed"  href="{{route('logout')}}">
                <i class="bi bi-box-arrow-in-right"></i>
                <span>Logout</span>
            </a>
        </li><!-- End Login Page Nav -->



    </ul>

</aside><!-- End Sidebar-->
