<footer class="footer">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                {{config('app.descricaoSite')}}
            </div>
            <div class="col-md-6">
                <div class="text-md-right footer-links d-none d-md-block">
                    <a href="javascript: void(0);">2020 © {{config('app.autorSite')}}</a>
                </div>
            </div>
        </div>
    </div>
</footer>

<script src="{{ URL::asset('js/vendor.min.js') }}"></script>
<script src="{{ URL::asset('js/app.min.js') }}"></script>

<!-- third party js -->
<script src="{{ URL::asset('js/vendor/jquery.dataTables.min.js') }}"></script>
<script src="{{ URL::asset('js/vendor/dataTables.bootstrap4.js') }}"></script>
<script src="{{ URL::asset('js/vendor/dataTables.responsive.min.js') }}"></script>
<script src="{{ URL::asset('js/vendor/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ URL::asset('js/vendor/apexcharts.min.js') }}"></script>
<script src="{{ URL::asset('js/vendor/dataTables.checkboxes.min.js') }}"></script>
<!-- third party js ends -->

<script src="{{ URL::asset('js/page.js') }}"></script>

<script>
    $(".alert").fadeTo(2000, 1000).slideUp(1000, function(){
        $(".alert").slideUp(1000);
    });
</script>
