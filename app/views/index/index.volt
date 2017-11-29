{% extends "base.volt" %}

{% block main %}
    <div class="row center-lg center-md center-xs">
        <div class="col-lg-8 col-xs-12 col-md-9">
            <form class="big-search-form" action="{{ url('search') }}">
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut in purus gravida mi efficitur condimentum.</p>
                <p></p>
                <input style="width: 100%" class="control text" name="search" type="text"/>
                <input class="btn btn-red" type="submit" value="Pesquisar"/>
            </form>
        </div>
    </div>
{% endblock %}