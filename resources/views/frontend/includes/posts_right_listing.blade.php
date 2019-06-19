<?php if ($items) : ?>
    <div class="widget widget-twitter-feed news-feed clearfix">
        <h4>{{ $title }}</h4>
        <ul class="iconlist">
            @foreach ($items ?: [] as $item)
                <li>
                    <i class="icon-news"></i>
                    <a href="{{ $item->get('url') }}"
                       class="mini-desc"><span>{{ limit_text($item->get('title'), 10) }}</span></a>
                    <small><a href="javascript:;" target="_blank">
                            Đăng lúc: {{ $item->get('created_at')->format('d/m/Y') }}
                        </a>
                    </small>
                </li>
            @endforeach;
        </ul>
    </div>
<?php endif; ?>