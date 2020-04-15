$(document).ready(function(){

    $('a.remove').click(function(e){
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
                    location.reload() ;
                },
                error: function () {
                    Swal.fire('Wystąpił błąd!', 'Wystąpił błąd po stronie serwera', 'error');
                }
            })
        })
    });

    $('a.update').click(function(e){
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
                    "_token": $('meta[name="csrf-token"]').attr("content")
                },
                success: function () {
                    Swal.fire('Zrobione!', 'Akcja zakończyła się sukcesem', 'success');
                    location.reload() ;
                },
                error: function () {
                    Swal.fire('Wystąpił błąd!', 'Wystąpił błąd po stronie serwera', 'error');
                }
            })
        })
    });
});
