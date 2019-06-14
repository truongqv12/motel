@extends('frontend.layout.profile')

@section('breadcrumb')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('index')}}">Trang chủ</a></li>
        <li class="breadcrumb-item active"><a href="">Tin đã lưu</a></li>
    </ol>
@endsection

@section('profile_content')
    <div class="postcontent col_last clearfix profile_right">
        <h3 class="text-uppercase t500 text-center">Tin đã lưu</h3>
        <?php if ($items) : ?>
        <table class="table table-hover table-responsive-sm table_list_order">
            <thead>
            <tr>
                <th class="center">Tin đã lưu</th>
                <th class="center" style="width: 25%">Tác vụ</th>

            </tr>
            </thead>
            <tbody>
            <?php foreach ($items ?: [] as $item) : ?>
            <tr class="row_{{$item->get('id')}}">
                <td class=""><a href="<?= $item->get('motel')->get('url') ?>" target="_blank"
                                class="tbl_motel_title"><?= $item->get('motel')->get('title') ?></a></td>
                <td class="center">
                    <div class="">
                        <button class="btn btn-danger btn_rectangle" onclick="ajax_unsave({{$item->get('id')}})">Bỏ
                            lưu
                        </button>
                    </div>
                </td>
            </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
        <?php endif; ?>
    </div>
@endsection