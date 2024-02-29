<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>KiraMerch | {{ $subtitle }} </title>

    <!-- Bootstrap -->
    <link href="{{ url('vendors/bootstrap/dist/css/bootstrap.min.css')}}" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="{{ url('vendors/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet">
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous" /> -->
    <!-- NProgress -->
    <link href="{{ url('vendors/nprogress/nprogress.css')}}" rel="stylesheet">
    <!-- bootstrap-daterangepicker -->
    <link href="{{ url('vendors/bootstrap-daterangepicker/daterangepicker.css')}}" rel="stylesheet">
    <!-- iCheck -->
    <link href="{{ url('vendors/iCheck/skins/flat/green.css')}}" rel="stylesheet">
    <!-- Datatables -->
    <link href="{{ url('vendors/datatables.net-bs/css/dataTables.bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{ url('vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{ url('vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{ url('vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{ url('vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css')}}" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="{{ url('build/css/custom.min.css')}}" rel="stylesheet">
    
    
  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col ">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="{{('dashboard')}}" class="site_title"><i class="fa fa-spinner"></i> <span>KiraMerch</span></a>
            </div>

            <div class="clearfix"></div>

            <!-- menu profile quick info -->
            <div class="profile clearfix">

              <div class="profile_info mx-3 mb-3">
                <span>Welcome,</span>
                <h2>{{ Auth::User()->username }}</h2>
                <span>[{{ Auth::User()->role }}]</span>
              </div>
            </div>
            <!-- /menu profile quick info -->

            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <h3>General</h3>
                <ul class="nav side-menu">
                  <li class="nav-item"><a href="{{('dashboard')}}"><i class="fa fa-desktop"></i> Dashboard <span class="nav-link"></span></a>
                  </li>
                  <li><a><i class="fa fa-edit"></i> Forms <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      @if (Auth::user()->role != 'kasir')
                      <li><a href="{{('produk')}}">Products</a></li>
                      @endif
                      @if (Auth::user()->role == 'kasir')
                      <li><a href="{{ route('transaksi.create')}}">Add Transactions</a></li>
                      @endif
                      @if (Auth::user()->role == 'kasir')
                      <li><a href="{{('transaksi')}}">Transactions</a></li>
                      @endif
                      @if (Auth::user()->role == 'owner')
                      <li><a href="{{('laporan')}}">Transactions</a></li>
                      @endif
                      @if (Auth::user()->role == 'admin')
                      <li><a href="{{('users')}}">Users</a></li>
                      @endif
                      @if (Auth::user()->role == 'owner')
                      <li><a href="{{('log')}}">Log</a></li>
                      @endif
                    </ul>
                  </li>
                </ul>
              </div>
            </div>
            <!-- /sidebar menu -->


          </div>
        </div>

        <!-- top navigation -->
        <div class="top_nav">
            <div class="nav_menu">
                <div class="nav toggle">
                  <a id="menu_toggle"><i class="fa fa-bars"></i></a>
                </div>
                <nav class="nav navbar-nav">
                <ul class=" navbar-right">
                  <li class="nav-item dropdown open" style="padding-left: 15px;">
                    <a href="javascript:;" class="user-profile dropdown-toggle" aria-haspopup="true" id="navbarDropdown" data-toggle="dropdown" aria-expanded="false">
                      {{ Auth::User()->nama }}
                    </a>
                    <div class="dropdown-menu dropdown-usermenu pull-right" aria-labelledby="navbarDropdown">
                      <a class="dropdown-item"  href="{{url('userguide')}}"><i class="fa fa-question pull-right"></i>Help</a>
                      <a class="dropdown-item"  href="{{url('logout')}}"><i class="fa fa-sign-out pull-right"></i> Log Out</a>
                    </div>
                  </li>
                </ul>
              </nav>
            </div>
          </div>
        <!-- /top navigation -->

        <!-- page content -->
        @yield('content')
        <!-- /page content -->

        <!-- footer content -->
        <footer>
          <div class="pull-right">
            KiraMerch - Designed by <a href="https://github.com/galihakbarmaulana8">Galih Akbar Maulana</a>
          </div>
          <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
      </div>
    </div>

    <!-- jQuery -->
    <script src="{{ url('vendors/jquery/dist/jquery.min.js')}}"></script>
    <!-- Bootstrap -->
    <script src="{{ url('vendors/bootstrap/dist/js/bootstrap.bundle.min.js')}}"></script>
    <!-- FastClick -->
    <script src="{{ url('vendors/fastclick/lib/fastclick.js')}}"></script>
    <!-- NProgress -->
    <script src="{{ url('vendors/nprogress/nprogress.js')}}"></script>
    <!-- Chart.js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script type="text/javascript">
      // var _ydata=<php echo json_encode($months); ?>;
      // var _xdata=<php echo json_encode($monthCount); ?>;
      // var _ydata='{! json_encode($months) !!}';
      // var _xdata='{! json_encode($monthCount) !!}';
    </script>
    <!-- <script src="{{ url('vendors/Chart.js/dist/Chart.min.js')}}"></script> -->

    <!-- jQuery Sparklines -->
    <script src="{{ url('vendors/jquery-sparkline/dist/jquery.sparkline.min.js')}}"></script>
    <!-- Flot -->
    <script src="{{ url('vendors/Flot/jquery.flot.js')}}"></script>
    <script src="{{ url('vendors/Flot/jquery.flot.pie.js')}}"></script>
    <script src="{{ url('vendors/Flot/jquery.flot.time.js')}}"></script>
    <script src="{{ url('vendors/Flot/jquery.flot.stack.js')}}"></script>
    <script src="{{ url('vendors/Flot/jquery.flot.resize.js')}}"></script>
    <!-- Flot plugins -->
    <script src="{{ url('vendors/flot.orderbars/js/jquery.flot.orderBars.js')}}"></script>
    <script src="{{ url('vendors/flot-spline/js/jquery.flot.spline.min.js')}}"></script>
    <script src="{{ url('vendors/flot.curvedlines/curvedLines.js')}}"></script>
    <!-- DateJS -->
    <script src="{{ url('vendors/DateJS/build/date.js')}}"></script>
    <!-- bootstrap-daterangepicker -->
    <script src="{{ url('vendors/moment/min/moment.min.js')}}"></script>
    <script src="{{ url('vendors/bootstrap-daterangepicker/daterangepicker.js')}}"></script>
    <!-- iCheck -->
    <script src="{{ url('vendors/iCheck/icheck.min.js')}}"></script>
    <!-- Datatables -->
    <script src="{{ url('vendors/datatables.net/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{ url('vendors/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>
    <script src="{{ url('vendors/datatables.net-buttons/js/dataTables.buttons.min.js')}}"></script>
    <script src="{{ url('vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js')}}"></script>
    <script src="{{ url('vendors/datatables.net-buttons/js/buttons.flash.min.js')}}"></script>
    <script src="{{ url('vendors/datatables.net-buttons/js/buttons.html5.min.js')}}"></script>
    <script src="{{ url('vendors/datatables.net-buttons/js/buttons.print.min.js')}}"></script>
    <script src="{{ url('vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js')}}"></script>
    <script src="{{ url('vendors/datatables.net-keytable/js/dataTables.keyTable.min.js')}}"></script>
    <script src="{{ url('vendors/datatables.net-responsive/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{ url('vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js')}}"></script>
    <script src="{{ url('vendors/datatables.net-scroller/js/dataTables.scroller.min.js')}}"></script>
    <script src="{{ url('vendors/jszip/dist/jszip.min.js')}}"></script>
    <script src="{{ url('vendors/pdfmake/build/pdfmake.min.js')}}"></script>
    <script src="{{ url('vendors/pdfmake/build/vfs_fonts.js')}}"></script>
    <script src="{{ url('//cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js')}}"></script>
    <script type="text/javascript">
        let table = new DataTable('#datatable');
    </script>
    <!-- Custom Theme Scripts -->
    <script src="{{ url('build/js/custom.min.js')}}"></script>
    @yield('js')
    <!-- FormatRupiah -->
    <script>
    //   function formatRupiah(angka, prefix){
    // var number_string = angka.replace(/[^,\d]/g, '').toString(),
    // split = number_string.split(','),
    // sisa  = split[0].length % 3,
    // rupiah = split[0].substr(0, sisa),
    // ribuan = split[0].substr(sisa).match(/\d{3}/gi);

    // // tambahkan titik jika yang di input sudah menjadi angka ribuan
    // if(ribuan){
    //   separator = sisa ? '.' : '';
    //   rupiah += separator + ribuan.join('.');
    // }

    // rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
    // return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
    // }
    // Script untuk memformat angka menjadi format Rupiah
function formatRupiah(angka) {
    var number_string = angka.toString().replace(/\D/g, '');
    var split = number_string.split(',');
    var sisa = split[0].length % 3;
    var rupiah = split[0].substr(0, sisa);
    var ribuan = split[0].substr(sisa).match(/\d{3}/gi);
    
    if (ribuan) {
        var separator = sisa ? '.' : '';
        rupiah += separator + ribuan.join('.');
    }
    
    rupiah = split[1] !== undefined ? rupiah + ',' + split[1] : rupiah;
    return rupiah;
}
    </script>

  </body>
</html>
