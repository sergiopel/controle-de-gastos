        <!--begin::Sidebar-->
        <aside class="shadow app-sidebar bg-body-secondary" data-bs-theme="dark">
            <!--begin::Sidebar Brand-->
            <div class="sidebar-brand">
                <!--begin::Brand Link-->
                <a href="{{ route('home') }}" class="brand-link">
                    <!--begin::Brand Image-->
                    <img src="{{ Vite::asset('resources/images/AdminLTELogo.png') }}" alt="AdminLTE Logo"
                        class="shadow opacity-75 brand-image" />
                    <!--end::Brand Image-->
                    <!--begin::Brand Text-->
                    <span class="brand-text fw-light">AdminLTE 4</span>
                    <!--end::Brand Text-->
                </a>
                <!--end::Brand Link-->
            </div>
            <!--end::Sidebar Brand-->
            <!--begin::Sidebar Wrapper-->
            <div class="sidebar-wrapper">
                <nav class="mt-2">
                    <!--begin::Sidebar Menu-->
                    <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="menu"
                        data-accordion="false">
                        @can('viewUsers', \App\Models\User::class)
                        <li class="nav-item">
                            <a href="{{ route('users.index') }}" class="nav-link">
                                <i class="bi bi-person"></i>
                                <p>Usuários</p>
                            </a>
                        </li>
                        @endcan
                        <li class="nav-item">
                            <a href="{{ route('incomes.index') }}" class="nav-link">
                                <i class="bi bi-arrow-up-circle-fill"></i>
                                <p>Receitas</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('expenses.index') }}" class="nav-link">
                                <i class="bi bi-arrow-down-circle-fill"></i>
                                <p>Despesas</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('categories.index') }}" class="nav-link">
                                <i class="bi bi-tags-fill"></i>
                                <p>Categorias</p>
                            </a>
                        </li>
                        
                        <li class="nav-header">LABELS</li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon bi bi-circle text-danger"></i>
                                <p class="text">Important</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon bi bi-circle text-warning"></i>
                                <p>Warning</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon bi bi-circle text-info"></i>
                                <p>Informational</p>
                            </a>
                        </li>
                    </ul>
                    <!--end::Sidebar Menu-->
                </nav>
            </div>
            <!--end::Sidebar Wrapper-->
        </aside>
        <!--end::Sidebar-->
