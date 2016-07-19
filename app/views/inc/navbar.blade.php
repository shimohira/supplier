 <!-- Navigation -->
 <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation" style="background-color:#fff;border-color:#000">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse" >
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>

        <a href="{{ URL::route('index') }}"><img style="height:83px;" src="img/logo1.png" ></a>

    </div>
    <!-- Top Menu Items -->
    <ul class="nav navbar-right top-nav">
        @if(Auth::check())
        <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> {{Auth::user()->username}} <b class="caret"></b></a>
            <ul class="dropdown-menu">
                <li>
                    <a href="{{ URL::route('profile') }}"><i class="fa fa-fw fa-user"></i> Profile</a>
                </li>
                <li class="divider"></li>
                <li>
                    <a href="{{URL::route('logout')}}"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
                </li>
            </ul>
        </li>
        @endif
    </ul>
    <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
    <div class="collapse navbar-collapse navbar-ex1-collapse">
        <ul class="nav navbar-nav side-nav">
            <li>
                <a href="{{ URL::route('index') }}"><i class="fa fa-fw fa-dashboard"></i> Dashboard</a>
            </li>
            <li>
                <a href="javascript:;" data-toggle="collapse" data-target="#master"><i class="glyphicon glyphicon-list-alt"></i> Master <i class="fa fa-fw fa-caret-down"></i></a>
                <ul id="master" class="collapse">
                    <li>
                        <a href="{{ URL::route('department.index') }}">Departemen</a>
                    </li>
                    <li>
                        <a href="{{ URL::route('barang.index') }}">Barang</a>
                    </li>
                    <li>
                        <a href="{{ URL::route('supplier.index') }}">Supplier</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="javascript:;" data-toggle="collapse" data-target="#transaksi"><i class="fa fa-fw fa-folder"></i>Transaksi <i class="fa fa-fw fa-caret-down"></i></a>
                <ul id="transaksi" class="collapse">
                    <li>
                        <a href="{{ URL::route('STTB.index') }}">STTB</a>
                        <a href="{{ URL::route('SPPB.index') }}">SPPB</a>
                        <a href="{{ URL::route('PO.index') }}">PO</a>
                        <a href="{{ URL::route('invoice.index') }}">Invoice</a>
                        <a href="{{ URL::route('DO.index') }}">DO</a>
                    </li>
                </ul>
            </li>

            <li>
                <a href="javascript:;" data-toggle="collapse" data-target="#laporan"><i class="fa fa-fw fa-book"></i>Laporan <i class="fa fa-fw fa-caret-down"></i></a>
                <ul id="laporan" class="collapse">
                    <li>
                        <a href="{{ URL::route('lapRekap') }}">Rekapitulasi<br>Barang</a>
                        <a href="{{ URL::route('lapInvo') }}">Laporan Invoice</a>
                        <a href="{{ URL::route('lapSTTB') }}">Laporan Pengadaan<br>Barang</a>
                        <a href="{{ URL::route('lapSPPB') }}">Laporan Pemesanan<br>Barang</a>
                        <a href="{{ URL::route('lapStock') }}">Laporan Stock<br>Barang</a>
                    </li>
                </ul>
            </li>
            @if (Auth::user()->level == 'admin')
            <li>
                <a href="{{ URL::route('daftar') }}"><i class="fa fa-fw fa-users"></i> User Management</a>
            </li>
            @endif
        </ul>
    </div>
    <!-- /.navbar-collapse -->
</nav>