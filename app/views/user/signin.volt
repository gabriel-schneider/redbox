{% extends "base.volt" %}
{% block main %}
<div class="row center-lg center-md center-xs">
    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
        <form class="big-search-form" method="post">
            <input class="control text" name="email" type="text" placeholder="Email..."/>
            <input class="control text" name="password" type="password" placeholder="Senha..."/>
            <input class="btn btn-red" type="submit" value="Entrar"/>
        </form>
    </div>
</div>
{% endblock %}