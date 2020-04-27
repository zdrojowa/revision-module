$(document).ready(function(){

    let users       = [];
    let $card       = $('.revision--card');
    let table       = $card.data('table');
    let contentId   = $card.data('id');
    let $select     = $('#revision-per-page');
    let $body       = $('#revision-body');
    let page        = 1;
    let $pagination = $('.revision--pagination-nav');

    $select.change(function(){
        reload(1);
    });

    getUsers();

    function getUsers() {
        $.ajax({
            url: '/dashboard/users/get',
            method: "GET",
            success: function (data) {
                users = data;

                reload(page);
            },
            error: function () {
                Swal.fire('Wystąpił błąd!', 'Wystąpił błąd po stronie serwera', 'error');
            }
        })
    }

    function reload(p) {
        page = p;

        $.ajax({
            url: '/dashboard/history/get',
            method: "GET",
            data: {
                "table": table,
                "contentId": contentId,
                'limit': $select.val(),
                'page': page
            },
            success: function (data) {
                $body.html('');

                let rows = '';

                data.data.forEach((item) => {
                    if(item['_id']) {
                        item['id'] = item['_id'];
                    }

                    let row = `<tr id="${item['id']}">
                        <td>${item['table']}</td>
                        <td>${item['content_id']}</td>
                        <td>${item['action']}</td>
                        <td>${item['created_at']}</td>
                        <td>${users[item['user_id']]}</td>
                        <td>
                            <div>`;

                    if (!['deleted', 'auto'].includes(item['action'])) {
                        row += `<a href="/dashboard/history/update/${item['id']}" class="btn btn-sm btn-primary revision-update">
                                <i class="mdi mdi-history"></i>
                            </a>`;
                    }

                    row += `<a href="/dashboard/history/destroy/${item['id']}" class="btn btn-sm btn-danger revision-remove">
                                <i class="mdi mdi-delete"></i>
                            </a>
                        </div></td></tr>`;

                    rows += row;
                });

                $body.html(rows);

                let pagesButtons = '';

                for (let i = 1; i <= data.last_page; i++) {
                    pagesButtons += `<li class="page-item" data-page-id="${i}"><a class="revision-page-link" href="#">${i}</a></li>`;
                }

                $pagination.html(pagesButtons);

                $(`.page-item[data-page-id="${page}"] a`).addClass('active');
            },
            error: function () {
                Swal.fire('Wystąpił błąd!', 'Wystąpił błąd po stronie serwera', 'error');
            }
        })
    }

    $("body").on("click", ".revision-remove", function(e) {
        e.preventDefault();
        let url = $(this).attr('href');

        Swal.fire({
            title: 'Na pewno chcesz to zrobić?',
            text: 'Nie będzie można tego przywrócić!',
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d53f3a',
            confirmButtonText: 'Tak',
            cancelButtonText: 'Powrót'
        }).then(result => {
            if(!result.value) return;

            $.ajax({
                url: url,
                method: "POST",
                data: {
                    "_method": "DELETE",
                    "_token": $('meta[name="csrf-token"]').attr("content")
                },
                success: function () {
                    Swal.fire('Usunięto!', 'Akcja zakończyła się sukcesem', 'success');
                    reload(page) ;
                },
                error: function () {
                    Swal.fire('Wystąpił błąd!', 'Wystąpił błąd po stronie serwera', 'error');
                }
            })
        })
    });

    $("body").on("click", ".revision-update", function(e) {
        e.preventDefault();
        let url = $(this).attr('href');

        Swal.fire({
            title: 'Na pewno chcesz to zrobić?',
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d53f3a',
            confirmButtonText: 'Tak',
            cancelButtonText: 'Powrót'
        }).then(result => {
            if(!result.value) return;

            $.ajax({
                url: url,
                method: "POST",
                data: {
                    "_token": $('meta[name="csrf-token"]').attr("content")
                },
                success: function () {
                    Swal.fire('Zrobione!', 'Akcja zakończyła się sukcesem', 'success');
                    location.reload();
                },
                error: function () {
                    Swal.fire('Wystąpił błąd!', 'Wystąpił błąd po stronie serwera', 'error');
                }
            })
        })
    });

    $("body").on("click", ".revision-page-link:not(.active)", function(e) {
        e.preventDefault();

        page = $(this).parent().data('page-id');
        reload(page);
    });
});
