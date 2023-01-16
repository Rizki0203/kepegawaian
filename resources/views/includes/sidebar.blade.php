           @if (Auth::user()->role == 'admin')
               <ul class="sidebar-nav">
                   <li class="sidebar-header">
                       Pages
                   </li>

                   <li class="sidebar-item {{ request()->routeIs('admin.dashboard.*') ? 'active' : null }}">
                       <a class="sidebar-link" href="{{ route('admin.dashboard.index') }}">
                           <i class="align-middle" data-feather="home"></i> <span class="align-middle">Dashboard</span>
                       </a>
                   </li>

                   <li class="sidebar-item {{ request()->routeIs('admin.kontrak.*') ? 'active' : null }}">
                       <a class="sidebar-link" href="{{ route('admin.kontrak.index') }}">
                           <i class="align-middle" data-feather="file"></i> <span class="align-middle">Kontrak Karyawan</span>
                       </a>
                   </li>

                   <li class="sidebar-item {{ request()->routeIs('admin.kinerja.*') ? 'active' : null }}">
                       <a class="sidebar-link" href="{{ route('admin.kinerja.index') }}">
                           <i class="align-middle" data-feather="user-plus"></i> <span class="align-middle">Kinerja Karyawan</span>
                       </a>
                   </li>

                   <li class="sidebar-item {{ request()->routeIs('admin.tugas.*') ? 'active' : null }}">
                       <a class="sidebar-link" href="{{ route('admin.tugas.index') }}">
                           <i class="align-middle" data-feather="clipboard"></i> <span class="align-middle">Pemberian Tugas</span>
                       </a>
                   </li>
                   <li class="sidebar-header">
                       Pengajuan
                   </li>
                   <li class="sidebar-item {{ request()->routeIs('admin.cuti.*') ? 'active' : null }}">
                       <a class="sidebar-link" href="{{ route('admin.cuti.index') }}">
                           <i class="align-middle" data-feather="layers"></i> <span class="align-middle">Pengajuan Cuti</span>
                       </a>
                   </li>
                   <li class="sidebar-item {{ request()->routeIs('admin.dinas.*') ? 'active' : null }}">
                       <a class="sidebar-link" href="{{ route('admin.dinas.index') }}">
                           <i class="align-middle" data-feather="feather"></i> <span class="align-middle">Pengajuan Dinas</span>
                       </a>
                   </li>
                   <li class="sidebar-header">
                       Data
                   </li>
                   <li class="sidebar-item {{ request()->routeIs('admin.users.*') ? 'active' : null }}">
                       <a class="sidebar-link" href="{{ route('admin.users.index') }}">
                           <i class="align-middle" data-feather="user-plus"></i> <span class="align-middle">Karyawan</span>
                       </a>
                   </li>
               </ul>
           @endif

           @if (Auth::user()->role == 'user')
               <ul class="sidebar-nav">
                   <li class="sidebar-header">
                       Pages
                   </li>

                   <li class="sidebar-item {{ request()->routeIs('user.dashboard.*') ? 'active' : null }}">
                       <a class="sidebar-link" href="{{ route('user.dashboard.index') }}">
                           <i class="align-middle" data-feather="home"></i> <span class="align-middle">Dashboard</span>
                       </a>
                   </li>

                   <li class="sidebar-item {{ request()->routeIs('user.kontrak.*') ? 'active' : null }}">
                       <a class="sidebar-link" href="{{ route('user.kontrak.index') }}">
                           <i class="align-middle" data-feather="file"></i> <span class="align-middle">Kontrak</span>
                       </a>
                   </li>

                   <li class="sidebar-item {{ request()->routeIs('user.kinerja.*') ? 'active' : null }}">
                       <a class="sidebar-link" href="{{ route('user.kinerja.index') }}">
                           <i class="align-middle" data-feather="user-plus"></i> <span class="align-middle">Aktifitas </span>
                       </a>
                   </li>

                   <li class="sidebar-item {{ request()->routeIs('user.tugas.*') ? 'active' : null }}">
                       <a class="sidebar-link" href="{{ route('user.tugas.index') }}">
                           <i class="align-middle" data-feather="clipboard"></i> <span class="align-middle">List Tugas</span>
                       </a>
                   </li>
                   <li class="sidebar-header">
                       Pengajuan
                   </li>
                   <li class="sidebar-item {{ request()->routeIs('user.cuti.*') ? 'active' : null }}">
                       <a class="sidebar-link" href="{{ route('user.cuti.index') }}">
                           <i class="align-middle" data-feather="layers"></i> <span class="align-middle">Pengajuan Cuti</span>
                       </a>
                   </li>
                   <li class="sidebar-item {{ request()->routeIs('user.dinas.*') ? 'active' : null }}">
                       <a class="sidebar-link" href="{{ route('user.dinas.index') }}">
                           <i class="align-middle" data-feather="feather"></i> <span class="align-middle">Pengajuan Dinas</span>
                       </a>
                   </li>
               </ul>
           @endif
