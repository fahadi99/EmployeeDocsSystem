<table class="table">
    <thead>
      <tr>
        <th scope="col">Duration Type</th>
        <th scope="col">Shared Till</th>
        <th scope="col">Copy to Clipboard</th>
      </tr>
    </thead>
    <tbody>
        @isset($documentSharedHistory)
        @foreach ($documentSharedHistory as $dsh)
        <tr>
            <td>{{$dsh->duration_type}}</td>
            <td>{{getBasicDateFormat($dsh->shared_till)}}</td>
            <td><button type="button" data-link="{{$dsh->url}}" class="btn btn-sm btn-primary copyLinkHistoryButton">Copy</button></td>
          </tr>
        @endforeach
        @endisset
    </tbody>
  </table>
