<footer class="main-footer page-footer {{config('app.corSite')}}">
    <div class="container">
      <div class="row">
        <div class="col l6 s12">
          <h5 class="white-text">{{config('app.logoSite')}}</h5>
          <p class="grey-text text-lighten-4">{{config('app.descricaoSite')}}</p>
        </div>
        <div class="col l4 offset-l2 s12 footer-copyright float-right d-none d-sm-block">
          <div class="container float-right">
            © 2020 Copyright {{config('app.logoSite')}}
            <a class="grey-text text-lighten-4 right" href="#!">{{config('app.autorSite')}}</a>
          </div>
        </div>
      </div>
    </div>
  </footer>
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>

<script src="{{ URL::asset('js/jquery.min.js') }}"></script>
<script src="{{ URL::asset('js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ URL::asset('js/adminlte.min.js') }}"></script>
