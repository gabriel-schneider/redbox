{% extends "base.volt" %}
{% block main %}
<div class="row center-lg center-md center-xs">
    <div class="col-lg-4 col-xs-6 col-md-4">
        <form class="big-search-form" action="{{ url('search') }}">
            <input class="control text" name="username" type="text" placeholder="Usuário..."/>
            <input class="control text" name="password" type="password" placeholder="Senha..."/>
            <input class="btn btn-red" type="submit" value="Entrar"/>
            <a style="margin-top: 0.5rem; font-size: small;" class="link" href="#">Esqueci minha senha</a>
        </form>
    </div>
</div>

{% endblock %}