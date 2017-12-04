<nav class="navbar">
    <ul class="menu menu-horizontal flex-grow">
        <li><a class="menu-item" href="{{ url('')}}">Inicio</a></li>
    </ul>
    <ul class="menu menu-horizontal">
        <li style="margin-right: 1rem;">
            <span>Olá, {{ loggedUser.getBag().displayName }}</span>
        </li>
        {% if loggedUser.isGuest() %}   
        <li><a class="menu-item" href="{{ url('user/signin') }}">Entrar</a></li>
        <li><a class="btn btn-red" href="{{ url('user/signup') }}">Registrar-se</a></li>
        {% else %}
        <li>
            <a class="menu-item" href="{{ url('user/account') }}">
                <i class="fa fa-user" aria-hidden="true"></i>                   
                Conta
            </a>
        </li>
        <li>
            <a class="menu-item" href="{{ url('user/history') }}">
                <i class="fa fa-history" aria-hidden="true"></i>                 
                Suas Reservas
            </a>
        </li>
        {% if loggedUser.isAdmin() %}  
        <li>
            <a class="menu-item" href="{{ url('admin') }}">
                <i class="fa fa-lock" aria-hidden="true"></i>                 
                Administração
            </a>
        </li>
        {% endif %}
        <li>
            <a class="menu-item" href="{{ url('user/signout') }}">
                <i class="fa fa-sign-out" aria-hidden="true"></i>                 
                Sair
            </a>
        </li> 
        {% endif %}
    </ul>
</nav>