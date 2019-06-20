@extends('frontend.layout.profile')

@section('breadcrumb')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('index')}}">Trang chủ</a></li>
        <li class="breadcrumb-item active"><a href="">Tin đã đăng</a></li>
    </ol>
@endsection

@section('profile_content')
    <div class="postcontent col_last clearfix profile_right">
        <h3 class="text-uppercase t500 text-center">Tin đã đăng</h3>
        @if(Session::has('success'))
            <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                {!! Session::get('success') !!}
            </div>
        @endif

        @if(Session::has('error'))
            <div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                {!! Session::get('error') !!}
            </div>
        @endif

        <?php if ($motels) : ?>
        <table class="table table-hover table-responsive-sm table_list_order">
            <thead>
            <tr>
                <th class="center">Tin đã đăng</th>
                <th class="center" style="width: 25%">Trạng thái</th>
                <th class="center" style="width: 25%">Tác vụ</th>

            </tr>
            </thead>
            <tbody>
            <?php foreach ($motels as $item) : ?>
            <tr>
                <td class=""><a href="<?= $item->get('url') ?>" target="_blank"
                                class="tbl_motel_title"><?= $item->get('title') ?></a></td>
                <td class="center">
                    @if($item->get('status') == 1)
                        <span class="badge badge-success text-white">active</span>
                    @elseif($item->get('status') == 0)
                        <span class="badge badge-warning text-white">Chờ phê duyệt</span>
                    @elseif($item->get('status') == 3)
                        <span class="badge badge-danger text-white">Tạm dừng cho thuê</span>
                    @endif

                </td>
                <td class="center">
                    <div class="">
                        <a href="{{ route('motel_post.post.edit',['id' => $item->get('id')]) }}"
                           class="btn btn-primary btn_rectangle text-white">Sửa tin</a>
                        @if($item->get('status') == 1)
                            <a href="{{ route('motel_post.update_status',['id' => $item->get('id'),'status' => 3]) }}"
                               class="btn btn-danger btn_rectangle text-white">Đã cho thuê</a>
                        @elseif($item->get('status') == 0)
                            <button class="btn btn-danger btn_rectangle text-white" disabled>Phòng đang ẩn</button>
                        @elseif($item->get('status') == 3)
                            <a href="{{ route('motel_post.update_status',['id' => $item->get('id'), 'status' => 1]) }}"
                               class="btn btn-success btn_rectangle text-white">Bật cho thuê</a>
                        @endif
                    </div>
                </td>
            </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
        <?php endif; ?>
    </div>
@endsection