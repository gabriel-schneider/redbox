<nav class="navbar">
    <a class="navbar-item" href="#">Inicio</a>
    <div class="navbar-right">
    {% if logged != true %}
        <a class="navbar-item"  href="#">Entrar</a>
        <a class="navbar-item btn btn-red"  href="#">Registrar-se</a>
        <a class="navbar-item btn btn-green"  href="#">Registrar-se</a>
        <a class="navbar-item btn btn-blue"  href="#">Registrar-se</a>
    {% else %}
        <a class="navbar-item"  href="#">Perfil</a>
    {% endif %}
    </div>
</nav>