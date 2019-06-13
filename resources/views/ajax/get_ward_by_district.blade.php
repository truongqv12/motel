<select title="Chọn quận huyện" id="cbWard" name="war_id"
        class="select optional form-control">
    <option value="0">Tất cả</option>
    @foreach ($items as $key => $item)
        <option value="{{$item->get('id')}}">{{$item->get('name')}}</option>
    @endforeach
</select>