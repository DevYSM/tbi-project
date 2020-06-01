@include('admin.includes.header')
@include('admin.includes.sidebar')
<div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            @yield('content')
        </div>
    </section>
</div>
@include('admin.includes.footer')
