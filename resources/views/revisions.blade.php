@isset($revisions)
    <div class="card">
        <div class="card-header clearfix">
            <h4 class="card-title float-left"><i class="mdi mdi-history"></i> History</h4>
        </div>
        <div class="card-body">
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
                <tbody>
                @foreach($revisions as $revision)
                    <tr>
                        <td>{{ $revision->table }}</td>
                        <td>{{ $revision->content_id }}</td>
                        <td>{{ $revision->action }}</td>
                        <td>{{ $revision->created_at }}</td>
                        <td>{{ $revision->user->name }}</td>
                        <td>
                            <div>
                                @if (!in_array($revision->action, ['deleted', 'auto']))
                                    <a href="{{ route('RevisionModule::update', ['revision' => $revision->_id]) }}" class="btn btn-sm btn-primary update">
                                        <i class="mdi mdi-history"></i>
                                    </a>
                                @endif
                                <a href="{{ route('RevisionModule::destroy', ['revision' => $revision->_id]) }}" class="btn btn-sm btn-danger remove">
                                    <i class="mdi mdi-delete"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endisset
