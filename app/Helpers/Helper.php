<?php
//đệ quy danh mục
if (!function_exists('unsset_childs_cat')) {
    function unsset_childs_cat(&$categories, $parent_id)
    {
        if ($parent_id > 0) {
            foreach ($categories as $key => $item) {
                if ($item['parent_id'] == $parent_id || $item['id'] == $parent_id) {
                    $categories->forget($key);
                    unsset_childs_cat($categories, $item['id']);
                }
            }
        }
        return $categories ?: false;
    }

}
if (!function_exists('table_category')) {
    function table_category($categories, $parent_id = 0, $char = '')
    {
        foreach ($categories as $key => $item) {
            if ($item['parent_id'] == $parent_id) {

                echo '<tr>';
                echo '<td>';
                echo $item['id'];
                echo '</td>';
                echo '<td>';
                echo $char . $item['name'];
                echo '</td>';
                echo '<td>';
                echo $item['rewrite'];
                echo '</td>';
                echo '<td>';
                if ($item['active'] == 1) {
                    echo '<label class="label label-success">Active</label>';
                } else {
                    echo ' <label class="label label-danger">Ban</label>';
                }
                echo '</td>';
                echo '<td>';
                if (Auth::guard('admin')->user()->edit == 1) {
                    echo "<a href =\"" . route('category.edit', ['id' => $item['id']]) . "\" class=\"btn btn-action label label-success\">";
                    echo "<i class=\"fa fa-pencil\"></i></a>";
                }

                if (Auth::guard('admin')->user()->delete == 1 && $item['childs']->count() == 0) {
                    echo "<form action=" . route('category.destroy', ['id' => $item['id']]) . " method='post' class = 'inline' >";
                    echo csrf_field();
                    echo method_field('DELETE');
                    echo " <button type=\"submit\" onclick=\"return confirm('Bạn có chắc muốn xóa')\"
                                                        class=\"btn btn-action label label-danger\">
                                                    <i class=\"fa fa-trash\"></i>
                                                </button>";
                    echo "</form>";
                }
                echo '</td>';
                echo '</tr>';

                $categories->forget($key);

                table_category($categories, $item['id'], $char . '|---');
            }
        }
    }

}

if (!function_exists('menu_header_cat')) {
    function menu_header_cat($categories, $parent_id = 0)
    {

        // Lấy danh sách cá danh mục con
        $cat_child = collect();
        foreach ($categories as $key => $item) {
            if ($item->parent_id == $parent_id) {
                $cat_child->push($item);
                $categories->forget($key);
            }
        }
//        dd($cat_child);
        if ($cat_child) {
            foreach ($cat_child as $key => $item) {
                if ($item->child()->count()) {
                    echo '<li class="dropdown-submenu">';
                    echo '<a class="child" href="' . route('danh-muc', ['id' => $item->id, 'slug' => $item->slug]) . '">' . $item->name . '<span class="caret"></span></a>';
                    echo '<ul class="dropdown-menu menu-child">';
                    menu_header_cat($categories, $item->id);
                    echo '</ul>';
                    echo '</li>';
                } else {
                    echo '<li>';
                    echo '<a href="' . route('danh-muc', ['id' => $item->id, 'slug' => $item->slug]) . '">' . $item->name . '</a>';
                    menu_header_cat($categories, $item->id);
                    echo '</li>';
                }
            }
        }
    }
}

if (!function_exists('format_money')) {
    function format_money($price)
    {
        return number_format($price, 0, ',', '.') . " Đ / Tháng";
    }
}

if (!function_exists('img_motel_link')) {
    function img_motel_link($img)
    {
        $link = route('index') . '/upload/motel/' . $img;
        return $link;
    }
}

if (!function_exists('get_image')) {
    function get_image($path)
    {
        $filename = basename($path);
        if (!file_exists('upload/motel')) {
            mkdir('upload/motel', 666, true);
        }
        \Image::make($path)->encode('jpg')
            ->save(public_path('upload/motel/' . $filename));
        dd(public_path());
        return $filename;
    }
}


if (!function_exists('total_money_order')) {
    function total_money_order($cart)
    {
        $total = 0;
        foreach ($cart as $item) {
            $total += $item['qty'] * $item['price'];
        }
        return $total;
    }
}

if (!function_exists('collect_recursive')) {
    function collect_recursive(array &$array)
    {
        foreach ($array as &$value) {
            if (is_array($value)) {
                collect_recursive($value);
            }
        }

//        if ($array == []) {
//            return [];
//        }

        return $array = collect($array);

    }
}

function transformer_item(&$item, \League\Fractal\TransformerAbstract $transformer, $includes = [], $meta = [])
{

    $manager  = new \League\Fractal\Manager();
    $resource = new \League\Fractal\Resource\Item($item, $transformer);

    $manager->setSerializer(new \Helpers\Transformer\DataArraySerializer());

    if ($includes) {
        $manager->parseIncludes($includes);
    }

    if ($meta) {
        $resource->setMeta($meta);
    }

    $vars = $manager->createData($resource)->toArray();
    return $vars;
}

function transformer_collection(&$items, \League\Fractal\TransformerAbstract $transformer, $includes = [], $meta = [])
{

    $manager  = new \League\Fractal\Manager();
    $resource = new \League\Fractal\Resource\Collection($items, $transformer);

    $manager->setSerializer(new \Helpers\Transformer\DataArraySerializer());

    if ($includes) {
        $manager->parseIncludes($includes);
    }

    if ($meta) {
        $resource->setMeta($meta);
    }

    $vars = $manager->createData($resource)->toArray();

    return $vars;
}

function transformer_collection_paginator(&$items, \League\Fractal\TransformerAbstract $transformer, $paginator, $includes = [], $meta = [])
{
    $manager = new \League\Fractal\Manager();
    $manager->setSerializer(new \Helpers\Transformer\DataArrayPaginatorSerializer());
    $resource = new \League\Fractal\Resource\Collection($items, $transformer);

    $resource->setPaginator(new \League\Fractal\Pagination\IlluminatePaginatorAdapter($paginator));

    if ($includes) {
        $manager->parseIncludes($includes);
    }

    if ($meta) {
        $resource->setMeta($meta);
    }

    $vars = $manager->createData($resource)->toArray();

    return $vars;
}

if (!function_exists('show_paginate')) {
    /**
     * Tao ra môt doan phan trang
     *
     * @param array $data : mảng truyền vào để kiểm tra phân trang
     * @param array $append
     * @return string
     * @throws Exception
     */
    function show_paginate($data = array (), $append = array ())
    {
        $lastPage    = $data['vars']['lastPage'];
        $currentPage = $data['vars']['currentPage'];
        $adjacents   = 2;
        $next        = $currentPage + 1;
        $previous    = $currentPage - 1;

        $pagination = '';
        if ($lastPage > 6) {
            $pagination .= "<ul class='pagination'>";
            if ($currentPage > 1) {
                $pagination .= "<li class='page-item'><a class='page-link current' title='Về trang đầu' href='" . append_url($append,
                        ['page' => 1]) . "'><i class='icon-double-angle-left' aria-hidden='true'></i></a></li>";
                $pagination .= "<li class='page-item'><a class='page-link' href='" . append_url($append,
                        ['page' => $previous]) . "'><i class='icon-angle-left' aria-hidden='true'></i></a></li>";
            }

            if ($lastPage < 3 + ($adjacents * 2)) {
                for ($counter = 1; $counter <= $lastPage; $counter++) {
                    $pagination .= ($counter == $currentPage)
                        ? "<li class='active page-item'><a class='page-link'>$counter</a></li>"
                        : "<li class='page-item'><a class='page-link' href='" . append_url($append,
                            ['page' => $counter]) . "'>$counter</a></li>";
                }
            } elseif ($lastPage > 3 + ($adjacents * 2)) {
                // trường hợp dành cho việc phân trang lúc đầu nhỏ hơn 5
                if ($currentPage < 1 + ($adjacents * 2)) {
                    for ($counter = 1; $counter < 2 + ($adjacents * 2); $counter++) {
                        $pagination .= ($counter == $currentPage)
                            ? "<li class='active page-item'><a class='page-link'>$counter</a></li>"
                            : "<li class='page-item'><a class='page-link' href='" . append_url($append,
                                ['page' => $counter]) . "'>$counter</a></li>";
                    }
                } //trường hợp dành cho page cuối cùng -4 lớn hơn page đang click
                elseif ($lastPage - ($adjacents * 2) > $currentPage && $currentPage > ($adjacents * 2)) {

                    for ($counter = $currentPage - $adjacents; $counter <= $currentPage + $adjacents; $counter++) {
                        $pagination .= ($counter == $currentPage)
                            ? "<li class='active page-item'><a class='page-link'>$counter</a></li>"
                            : "<li class='page-item'><a class='page-link' href='" . append_url($append,
                                ['page' => $counter]) . "'>$counter</a></li>";
                    }
                } // trường hợp click vào các page cuối cùng
                else {

                    for ($counter = $lastPage - (2 + ($adjacents * 2)); $counter <= $lastPage; $counter++) {
                        $pagination .= ($counter == $currentPage)
                            ? "<li class='active page-item'><a class='page-link'>$counter</a></li>"
                            : "<li class='page-item'><a class='page-link' href='" . append_url($append, ['page' => $counter]) . "'>$counter</a></li>";
                    }
                }
            }

            if ($currentPage < $lastPage - 2) {
                $pagination .= "<li class='page-item'><a class='page-link' title='>' href='" . append_url($append, ['page' => $next]) . "'><i class='icon-angle-right' aria-hidden='true'></i></a></li>";
                $pagination .= "<li class='page-item'><a class='page-link' title='>>' href='" . append_url($append, ['page' => $lastPage]) . "'><i class='icon-double-angle-right' aria-hidden='true'></i></a></li>";
            }
            $pagination .= "</ul>";
        } elseif ($lastPage > 1) {
            $pagination .= "<ul class='pagination'>";
            for ($counter = 1; $counter <= $lastPage; $counter++) {
                $pagination .= ($counter == $currentPage)
                    ? "<li class='active page-item'><a class='page-link'>$counter</a></li>"
                    : "<li class='page-item'><a class='page-link' href='" . append_url($append, ['page' => $counter]) . "'>$counter</a></li>";
            }
        } else {
            $pagination = '';
        }

        return $pagination;
    }
}

if (!function_exists('append_url')) {
    function append_url($append = array (), $page = array ())
    {
        $r           = null;
        $urlUri      = getQueryUri();
        $dataUrl     = explode('?', $urlUri);
        $redirectUrl = $dataUrl[0] && $dataUrl[0] != '/' ? $dataUrl[0] : '';
        $urlQuerry   = isset($dataUrl[1]) ? $dataUrl[1] : '';
        parse_str($urlQuerry, $data);

        // check mảng append link để xuất ra link
        $appendLink = array ();
        $append     = $page ? array_merge($append, $page) : $append;

        foreach ($append as $ka => $va) {
            if (preg_match('/^\d+$/', $ka)) {
                throw new Exception('Giá trị ' . $va . ' gán link có key= ' . $ka . ' phải là một chuoi');
            }

            if ($va) {
                $appendLink[urlencode($ka)] = urlencode($ka) . '=' . urlencode($va);
            }
        }

        // check mang param query để thay đổi nếu có k
        if ($data) {
            foreach ($data as $k => $value) {
                if ($appendLink) {
                    foreach ($appendLink as $ka => $va) {
                        //nếu trùng key thì đổi value
                        if ($k == $ka) {
                            $r[$k] = $appendLink[$ka];
                        } // khác key thì thêm value
                        else {
                            $r[$ka] = $appendLink[$ka];
                        }
                    }
                }
            }
        }
        $r = $r ? $r : $appendLink;

        return $redirectUrl . '?' . implode('&', $r);
    }
}

if (!function_exists('getQueryUri')) {
    /**
     * Tra ve cac tham so query tren url
     *
     * @return string
     */
    function getQueryUri()
    {
        return $_SERVER['REQUEST_URI'];
    }
}