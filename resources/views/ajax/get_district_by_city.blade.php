<select title="Chọn quận huyện" id="cbDistrict" name="district"
        class="select optional form-control fct-profile-edit">
    <option value="0">Tất cả</option>
    @foreach ($items as $key => $item)
        <option value="{{$item->get('id')}}">{{$item->get('name')}}</option>
    @endforeach
</select>