@php
    $headers = ($loanData->first());
@endphp
<table class="table table-hover text-nowrap">
    <thead>
      <tr>
        @foreach ($headers as $hKey => $header)
            <th>{{ $hKey }}</th>
        @endforeach
      </tr>
    </thead>
    <tbody>
      @forelse ($loanData as $key => $value)
          <tr>
            @foreach ($value as $key => $field)
                <td>{{ $field }}</td>
            @endforeach
          </tr>                        
      @empty
          <tr>
              <td colspan="4">No Products found</td>
          </tr>
      @endforelse
    </tbody>
  </table>