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
        <?php if ($motels) : ?>
        <table class="table table-hover table-responsive-sm table_list_order">
            <thead>
            <tr>
                <th class="center">Tin đã đăng</th>
                <th class="center" style="width: 25%">Tác vụ</th>

            </tr>
            </thead>
            <tbody>
            <?php foreach ($motels as $item) : ?>
            <tr>
                <td class=""><a href="<?= $item->get('url') ?>" target="_blank" class="tbl_motel_title"><?= $item->get('title') ?></a></td>
                <td class="center">
                    <div class="">
                        <button class="btn btn-primary btn_rectangle">Sửa tin</button>
                        <button class="btn btn-danger btn_rectangle">Đã cho thuê</button>
                    </div>
                </td>
            </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
        <?php endif; ?>
    </div>
@endsection