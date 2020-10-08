<div class="left-side-menu">
    <a href="#" class="logo text-center logo-light">
        <span class="logo-lg">
            <img src="{{ URL::asset('img/banner_all_transp.png') }}" alt="" height="75">
        </span>
        <span class="logo-sm">
            <img src="{{ URL::asset('img/banner_all_transp.png') }}" alt="" height="75">
        </span>
    </a>
    <a href="#" class="logo text-center logo-dark">
        <span class="logo-lg">
            <img src="{{ URL::asset('img/banner_transp.png') }}" alt="" height="75">
        </span>
        <span class="logo-sm">
            <img src="{{ URL::asset('img/banner_transp.png') }}" alt="" height="75">
        </span>
    </a>

    <div class="h-100" id="left-side-menu-container" data-simplebar>
        <ul class="metismenu side-nav">
            <li class="side-nav-title side-nav-item">Navigation</li>

            <li class="side-nav-item">
                <a href="javascript: void(0);" class="side-nav-link">
                    <i class="uil-building"></i>
                    <span> Controle Escolar </span>
                    <span class="menu-arrow"></span>
                </a>
                <ul class="side-nav-second-level" aria-expanded="false">
                    <li>
                        <a href="apps-tasks.html">College</a>
                    </li>
                    <li>
                        <a href="apps-tasks-details.html">Stuff</a>
                    </li>
                    <li>
                        <a href="apps-kanban.html">Students</a>
                    </li>
                </ul>
            </li>

            <li class="side-nav-item">
                <a href="javascript: void(0);" class="side-nav-link">
                    <i class="uil-building"></i>
                    <span> Sistema de Bolão </span>
                    <span class="menu-arrow"></span>
                </a>
                <ul class="side-nav-second-level" aria-expanded="false">
                    <li>
                        <a href="{{route('admin.boloes.index')}}">Bolão</a>
                    </li>
                    <li>
                        <a href="{{route('admin.rodadas.index')}}">Rodadas</a>
                    </li>
                    <li>
                        <a href="{{route('admin.partidas.index')}}">Partidas</a>
                    </li>
                </ul>
            </li>

            <li class="side-nav-item">
                <a href="javascript: void(0);" class="side-nav-link">
                    <i class="uil-building"></i>
                    <span> Lista de compras</span>
                    <span class="menu-arrow"></span>
                </a>
                <ul class="side-nav-second-level" aria-expanded="false">
                    <li>
                        <a href="{{route('listacompra.index')}}">Lista</a>
                    </li>
                    <li>
                        <a href="{{route('produtocompra.index')}}">Produtos</a>
                    </li>
                    <li>
                        <a href="{{route('categoriacompra.index')}}">Categorias</a>
                    </li>
                </ul>
            </li>

            <li class="side-nav-title side-nav-item">Custom</li>


            <li class="side-nav-item">
                <a href="javascript: void(0);" class="side-nav-link">
                    <i class="uil-users-alt"></i>
                    <span> Usuários </span>
                    <span class="menu-arrow"></span>
                </a>
                <ul class="side-nav-second-level" aria-expanded="false">
                    <li>
                        <a href="{{route('usuarios.index')}}">Usuários</a>
                    </li>
                    <li>
                        <a href="{{route('papeis.index')}}">Papeis</a>
                    </li>
                    <li>
                        <a href="{{route('permissoes.index')}}">Permissão</a>
                    </li>
                </ul>
            </li>

            <li class="side-nav-item">
                <a href="javascript: void(0);" class="side-nav-link">
                    <i class="uil-box"></i>
                    <span> Sistemas </span>
                    <span class="menu-arrow"></span>
                </a>
                <ul class="side-nav-second-level" aria-expanded="false">
                    <li>
                        <a href="{{route('sistemas.index')}}">Sistemas</a>
                    </li>
                </ul>
            </li>

            <li class="side-nav-item">
                <a href="javascript: void(0);" class="side-nav-link">
                    <i class="uil-grid"></i>
                    <span> Categorias </span>
                    <span class="menu-arrow"></span>
                </a>
                <ul class="side-nav-second-level" aria-expanded="false">
                    <li>
                        <a href="{{route('categorias.index')}}">Listagem</a>
                    </li>
                    <li>
                        <a href="{{route('categorias.treeview')}}">Estrutura</a>
                    </li>
                </ul>
            </li>
            <li class="side-nav-item">
                <a href="javascript: void(0);" class="side-nav-link">
                    <i class="uil-building"></i>
                    <span> Listas</span>
                    <span class="menu-arrow"></span>
                </a>
                <ul class="side-nav-second-level" aria-expanded="false">
                    <li>
                        <a href="{{route('listas.index')}}">Lista</a>
                    </li>
                </ul>
            </li>
            <li class="side-nav-item">
                <a href="javascript: void(0);" class="side-nav-link">
                    <i class="uil-building"></i>
                    <span> Produtos</span>
                    <span class="menu-arrow"></span>
                </a>
                <ul class="side-nav-second-level" aria-expanded="false">
                    <li>
                        <a href="{{route('produtos.index')}}">Lista</a>
                    </li>
                </ul>
            </li>

        </ul>

        <div class="clearfix"></div>

    </div>
</div>
