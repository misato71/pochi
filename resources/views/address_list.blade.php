@extends('layout')
@section('contents')

<div class="title m-b-md">発送元・お届け先リスト</div>

<div class ="subtitle m-b-md">
  新しく発送元・お届け先を登録する方は<a href="{{ route('address_info') }}">こちら</a>
</div>
  <ul style="display: flex;list-style:none;">
    <table border="1">
      <tr>
        <th>苗字</th>
        <th>名字</th>
        <th>郵便番号</th>
        <th>都道府県</th>
        <th>市区町村</th>
        <th>町名番地</th>
        <th>建物名</th>
        <th>電話番号</th>
      </tr>
  
      @foreach($address as $key => $value)
        <tr>
          <td>{{ $value->last_name }}</td>
          <td>{{ $value->first_name }}</td>
          <td>{{ $value->postal_code }}</td>
          <td>{{ $value->area }}</td>
          <td>{{ $value->municipalities }}</td>
          <td>{{ $value->address }}</td>
          <td>{{ $value->building_name }}</td>
          <td>{{ $value->telephone_number }}</td>

          <td><a href="{{ route('get_address', ['id'=>$value->id]) }}" class="form-control mt-2">編集</a></td>
          <td><a href="{{ route('address_remove', ['id'=>$value->id]) }}" class="form-control mt-2">削除</a></td>
        </tr>
      @endforeach
    </table>
  </ul>

@endsection