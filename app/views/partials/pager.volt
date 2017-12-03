<nav class="pager">
    <a href="{{ url(baseUrl ~ '&page=' ~ page.before) }}"><i class="fa fa-angle-left" aria-hidden="true"></i></a>
    <span class="small">Página {{ page.current }} de {{ page.total_pages }}</span>
    <a href="{{ url(baseUrl ~ '&page=' ~ page.next) }}"><i class="fa fa-angle-right" aria-hidden="true"></i></a>
</nav>