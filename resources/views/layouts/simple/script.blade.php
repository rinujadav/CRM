<script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
crossorigin="anonymous"></script>
<!-- DataTables  & Plugins -->
@yield('script')
<!-- AdminLTE App -->

<script>
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl)
    })
    $(".sidebar-toggle").click(function () {
      $("body").addClass("sidebar-open");
    })

    $(".page-wrapper").mouseup(function (e) {
      var container = $(".sidebar-inner");
      if (!container.is(e.target) && container.has(e.target).length === 0) {
        $("body").removeClass("sidebar-open");
      }
    });
   
</script>

