<nav class="navbar">
    <ul class="menu menu-horizontal flex-grow">
        <li><a class="menu-item" href="{{ url('')}}">Inicio</a></li>
    </ul>
    <ul class="menu menu-horizontal">
        <li style="margin-right: 1rem;">
            <span>Olá, {{ loggedUser.getBag().displayName }}</span>
        </li>
        {% if loggedUser.isGuest() %}   
        <li><a class="menu-item" href="{{ url('signin') }}">Entrar</a></li>
        <li><a class="btn btn-red" href="{{ url('signup') }}">Registrar-se</a></li>
        {% else %}
        <li>
            <a class="menu-item" href="{{ url('account') }}">
                <i class="fa fa-user" aria-hidden="true"></i>                   
                Conta
            </a>
        </li>
        <li>
            <a class="menu-item" href="{{ url('history') }}">
                <i class="fa fa-history" aria-hidden="true"></i>                 
                Suas Reservas
            </a>
        </li>
        <li>
            <a class="menu-item" href="{{ url('signout') }}">
                <i class="fa fa-sign-out" aria-hidden="true"></i>                 
                Sair
            </a>
        </li> 
        {% endif %}
    </ul>
</nav>