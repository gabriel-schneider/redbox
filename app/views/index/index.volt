{% extends "base.volt" %}
{% block main %}
<div class="row center-lg center-md center-xs">
    <div class="col-lg-8 col-xs-12 col-md-9">
        <div class="logo-wrapper">
            <h1 class="logo">RedBox</h1>
            <h3>Pesquise, encontre, reserve.</h3>
        </div>
    
        <form class="big-search-form" action="{{ url('item/search') }}">        
            <input style="width: 100%" class="control text" name="q" type="text"/>
            <input class="btn btn-red" type="submit" value="Pesquisar"/>
        </form>
    </div>
</div>
{% endblock %}