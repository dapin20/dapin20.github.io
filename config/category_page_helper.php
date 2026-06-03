<?php

function category_page_root_path($path, $prefix = '../../') {
    $path = trim((string) $path);

    if ($path === '' || $path === '#') {
        return '#';
    }

    if (preg_match('/^https?:\/\//', $path) || str_starts_with($path, '../')) {
        return $path;
    }

    return $prefix . ltrim($path, '/');
}

function category_page_favorite_path($path) {
    $path = trim((string) $path);

    if ($path === '' || $path === '#') {
        return '#';
    }

    if (preg_match('/^https?:\/\//', $path)) {
        return $path;
    }

    if (str_starts_with($path, '../../')) {
        return '../' . substr($path, 6);
    }

    if (str_starts_with($path, 'assets/') || str_starts_with($path, 'user/')) {
        return '../' . $path;
    }

    return $path;
}

function category_page_href_path($path, $prefix = '../../') {
    $path = trim((string) $path);

    if ($path === '' || $path === '#') {
        return '#';
    }

    if (preg_match('/^https?:\/\//', $path) || str_starts_with($path, '../')) {
        return $path;
    }

    if (str_starts_with($path, 'user/')) {
        return $prefix . ltrim($path, '/');
    }

    return $path;
}

function category_page_prepare_destination($destination, $prefix = '../../') {
    $prepared = normalize_destination($destination);
    $prepared['image'] = category_page_root_path($prepared['image'], $prefix);
    $prepared['href'] = category_page_href_path($prepared['href'], $prefix);
    $prepared['favorite_image'] = category_page_favorite_path($prepared['image']);
    $prepared['favorite_href'] = category_page_favorite_path($prepared['href']);

    return $prepared;
}

function category_page_destinations($category, $fallbackDestinations, $prefix = '../../') {
    $merged = [];
    $seen = [];

    foreach ($fallbackDestinations as $destination) {
        $destination['category'] = $destination['category'] ?? $category;
        $prepared = category_page_prepare_destination($destination, $prefix);
        $key = strtolower($prepared['id']);
        $seen[$key] = true;
        $merged[] = $prepared;
    }

    foreach (load_destinations() as $destination) {
        if (($destination['category'] ?? '') !== $category) {
            continue;
        }

        $key = strtolower($destination['id']);
        if (isset($seen[$key])) {
            continue;
        }

        $seen[$key] = true;
        $merged[] = category_page_prepare_destination($destination, $prefix);
    }

    return $merged;
}
