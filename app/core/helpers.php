<?php
/**
 * Trả về chữ cái đầu (viết hoa) lấy từ từ cuối cùng của tên,
 * phù hợp với cách đặt tên tiếng Việt (tên gọi nằm ở cuối).
 */
function initials_from_name($name)
{
    $name = trim((string)$name);
    if ($name === '') {
        return '?';
    }
    $parts = preg_split('/\s+/u', $name);
    $last = end($parts);
    return mb_strtoupper(mb_substr($last, 0, 1, 'UTF-8'), 'UTF-8');
}

/**
 * Sinh ra một cặp màu (nền nhạt + chữ) ổn định dựa trên chuỗi đầu vào,
 * dùng để tô màu avatar/badge cho từng dòng dữ liệu khác nhau.
 */
function avatar_palette_color($seed)
{
    static $palette = [
        ['bg' => '#EAEEFC', 'fg' => '#3454D1'],
        ['bg' => '#E8F8EE', 'fg' => '#15803D'],
        ['bg' => '#FEF3E2', 'fg' => '#B45309'],
        ['bg' => '#F0E9FC', 'fg' => '#7C3AED'],
        ['bg' => '#E2F4F6', 'fg' => '#0E7490'],
        ['bg' => '#FCE7F3', 'fg' => '#BE185D'],
    ];
    $index = abs(crc32((string)$seed)) % count($palette);
    return $palette[$index];
}
