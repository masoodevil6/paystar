@extends("emails.layouts.master")

@section("content")
    <tr style="display: block">
        <td style="display: block; text-align: center">
            موضوع:
            <b style="margin: 0 10px">
                {{$details["title"]}}
            </b>
        </td>
        <td style="display: block; text-align: center; background-color: white; border-radius: 5px; margin: 0 20px">
            {!! $details["body"] !!}
        </td>
    </tr>

@endsection
