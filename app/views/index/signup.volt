{% extends "base.volt" %}
{% block main %}
<div class="row center-lg center-md center-xs">
    <div class="col-lg-4 col-xs-6 col-md-4">
        <form>
            <label class="control label" for="email">E-mail:</label>
            <input class="control text" name="email" type="email"/>

            <label class="control label" for="password">Senha:</label>
            <input class="control text" name="password" type="password"/>

            <label class="control label" for="password-confirm">Confirmação da senha:</label>
            <input class="control text" name="password-confirm" type="password"/>
            
            <input class="btn btn-red" type="submit" value="Entrar"/>
            <a style="margin-top: 0.5rem; font-size: small;" class="link" href="#">Esqueci minha senha</a>
        </form>
    </div>
</div>

{% endblock %}