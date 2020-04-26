<div class="card revision--card" data-table="{{ $table }}" data-id="{{ $content_id }}">
    <div class="card-header clearfix">
        <h4 class="card-title float-left"><i class="mdi mdi-history"></i> History</h4>
    </div>
    <div class="card-body">
        <div class="revision--per-page">
            Wyników na stronę
            <select id="revision-per-page">
                <option value="5">5</option>
                <option value="10">10</option>
                <option value="20">20</option>
            </select>
        </div>
        <table class="table table-striped">
            <thead>
            <tr>
                <td>Tablica</td>
                <td>Wartość</td>
                <td>Akcja</td>
                <td>Updated</td>
                <td>Użytkownik</td>
                <td>Akcje</td>
            </tr>
            </thead>
            <tbody id="revision-body">
            </tbody>
        </table>

        <div class="revision--pagination">
            <span class="revision--pagination-span">Strony:</span>
            <ul class="revision--pagination-nav pagination">
            </ul>
        </div>
    </div>
</div>
