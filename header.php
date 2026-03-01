<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="<?php $this->options->charset(); ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="renderer" content="webkit">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <?php
    /* ===== Title & Description & Canonical ===== */
    $siteTitle = $this->options->title;
    $siteUrl   = rtrim($this->options->siteUrl, '/');

    if ($this->is('index')) {
        // 首页：站名 | 站点描述（截取前 60 字符，避免过长）
        $siteDesc = $this->options->description;
        $titleTag = $siteDesc
            ? $siteTitle . ' | ' . mb_strimwidth(strip_tags($siteDesc), 0, 60, '…', 'UTF-8')
            : $siteTitle;
        // description：站点描述（截取 160 字符以内）
        $metaDesc = mb_strimwidth(strip_tags($siteDesc), 0, 160, '…', 'UTF-8');
        $canonicalUrl = $siteUrl . '/';
        $ogType = 'website';
    } elseif ($this->is('single')) {
        // 文章/独立页：页面标题 | 站名
        $titleTag = $this->title . ' | ' . $siteTitle;
        // description：优先使用摘要，否则截取正文前 160 字符
        $rawDesc = $this->excerpt ? $this->excerpt : $this->content;
        $metaDesc = mb_strimwidth(strip_tags($rawDesc), 0, 160, '…', 'UTF-8');
        $canonicalUrl = $this->permalink;
        $ogType = 'article';
    } else {
        // 归档页（分类、标签、作者、搜索）
        // 归档页 description
        $metaDescArr = array(
            'category' => _t('分类 %s 下的全部文章'),
            'search'   => _t('包含关键字 %s 的全部文章'),
            'tag'      => _t('标签 %s 下的全部文章'),
            'author'   => _t('%s 发布的全部文章'),
        );
        $metaDesc = $siteTitle;
        foreach ($metaDescArr as $type => $tpl) {
            if ($this->is($type)) {
                ob_start();
                $this->archiveTitle(array($type => '%s'), '', '');
                $archiveName = ob_get_clean();
                $metaDesc = sprintf($tpl, $archiveName);
                break;
            }
        }
        $metaDesc = mb_strimwidth($metaDesc, 0, 160, '…', 'UTF-8');
        // canonical 使用当前请求 URL（去除多余参数）
        $currentPath = $_SERVER['REQUEST_URI'] ?? '/';
        $canonicalUrl = rtrim($siteUrl, '/') . strtok($currentPath, '?');
        $ogType = 'website';
    }
    ?>

    <title><?php
    if ($this->is('index')) {
        echo htmlspecialchars($titleTag);
    } elseif ($this->is('single')) {
        echo htmlspecialchars($titleTag);
    } else {
        $this->archiveTitle(array(
            'category'  => _t('分类 %s'),
            'search'    => _t('搜索：%s'),
            'tag'       => _t('标签 %s'),
            'author'    => _t('%s 的文章'),
        ), '', ' | ');
        echo htmlspecialchars($siteTitle);
    }
    ?></title>

    <?php if ($metaDesc): ?>
    <meta name="description" content="<?php echo htmlspecialchars($metaDesc); ?>">
    <?php endif; ?>

    <link rel="canonical" href="<?php echo htmlspecialchars($canonicalUrl); ?>">

    <!-- Open Graph -->
    <meta property="og:type" content="<?php echo $ogType; ?>">
    <meta property="og:site_name" content="<?php echo htmlspecialchars($siteTitle); ?>">
    <meta property="og:title" content="<?php echo htmlspecialchars($this->is('single') ? $this->title : $siteTitle); ?>">
    <meta property="og:description" content="<?php echo htmlspecialchars($metaDesc); ?>">
    <meta property="og:url" content="<?php echo htmlspecialchars($canonicalUrl); ?>">

    <?php if ($this->options->SEOOPEN): ?>
    <?php if ($this->is('index')): ?>
    <?php $this->header(); ?>
    <?php else: ?>
    <?php $this->header('xmlrpc=&wlw=&commentReply=&antiSpam=&atom'); ?>
    <?php endif; ?>
    <?php endif; ?>

    <?php if ($this->options->favicon): ?>
    <link rel="shortcut icon" type="image/x-icon" href="<?php $this->options->favicon() ?>">
    <?php endif; ?>
    <?php if ($this->options->cursor): ?>
    <link rel="stylesheet" href="<?php $this->options->themeUrl('/assets/css/cursor.css'); ?>">
    <?php endif; ?>
    <link rel="stylesheet" href="<?php $this->options->themeUrl('/assets/css/style.css'); ?>">
    <link rel="stylesheet" type="text/css" href="<?= staticUrl('androidstudio.min.css') ?>"/>
    <script src="<?= staticUrl('highlight.min.js') ?>"></script>
    <?php if ($this->options->JqueryControl): ?>
    <script src="<?= staticUrl('jquery.min.js') ?>"></script>
    <?php endif; ?>
    <script>$(document).on('pjax:complete',function(){if(typeof hljs !== 'undefined'){hljs.initHighlightingOnLoad()}});</script>
    <?php if ($this->options->fancybox): ?>
    <link href="<?= staticUrl('jquery.fancybox.min.css') ?>" rel="stylesheet">
    <script src="<?= staticUrl('jquery.fancybox.min.js') ?>"></script>
    <script src="<?= staticUrl('jquery.lazyload.min.js') ?>"></script>
    <?php endif; ?>
</head>
<body>
    <?php if ($this->options->WebPjax): ?>
    <div id="pjax-load">
    <?php endif; ?>
    <nav class="navbar">
    <div class="container">
        <div class="flex">
            <div>
                <a class="brand" href="<?php $this->options->siteUrl(); ?>">
                    <?php if ($this->options->favicon): ?>
                    <img src="<?php $this->options->favicon() ?>" alt="<?php echo htmlspecialchars($siteTitle); ?>">
                    <?php endif; ?>
                    &nbsp;&nbsp;<?php $this->options->title() ?>
                </a>
            </div>
            <div class="flex">
                <?php
                $nav_raw = $this->options->nav_links;
                if ($nav_raw) {
                    $nav_lines = preg_split('/\r\n|\r|\n/', trim($nav_raw));
                    foreach ($nav_lines as $nav_line) {
                        $nav_line = trim($nav_line);
                        if (empty($nav_line)) continue;
                        $nav_parts = array_map('trim', explode('|', $nav_line, 2));
                        $nav_name = isset($nav_parts[0]) ? $nav_parts[0] : '';
                        $nav_url  = isset($nav_parts[1]) ? $nav_parts[1] : '#';
                        if (empty($nav_name)) continue;
                        echo '<a href="' . htmlspecialchars($nav_url) . '">' . htmlspecialchars($nav_name) . '</a>' . "\n";
                    }
                }
                ?>

                <?php if ($this->options->The_Dark_Mode): ?>
                <button id="dark-mode-button">
                    <svg class="light" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true" focusable="false" width="1em" height="1em" style="-ms-transform:rotate(360deg);-webkit-transform:rotate(360deg);transform:rotate(360deg)" viewBox="0 0 36 36"><path fill="#ffd983" d="M30.312.776C32 19 20 32 .776 30.312c8.199 7.717 21.091 7.588 29.107-.429C37.9 21.867 38.03 8.975 30.312.776z"></path><path d="M30.705 15.915a1.163 1.163.0 101.643 1.641 1.163 1.163.0 00-1.643-1.641zm-16.022 14.38a1.74 1.74.0 000 2.465 1.742 1.742.0 100-2.465zm13.968-2.147a2.904 2.904.0 01-4.108.0 2.902 2.902.0 010-4.107 2.902 2.902.0 014.108.0 2.902 2.902.0 010 4.107z" fill="#ffcc4d"></path><rect x="0" y="0" width="36" height="36" fill="rgba(0, 0, 0, 0)"></rect></svg>
                    <svg class="dark" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true" focusable="false" width="1em" height="1em" style="-ms-transform:rotate(360deg);-webkit-transform:rotate(360deg);transform:rotate(360deg)" viewBox="0 0 36 36"><path fill="#ffd983" d="M16 2s0-2 2-2 2 2 2 2v2s0 2-2 2-2-2-2-2V2zm18 14s2 0 2 2-2 2-2 2h-2s-2 0-2-2 2-2 2-2h2zM4 16s2 0 2 2-2 2-2 2H2s-2 0-2-2 2-2 2-2h2zm5.121-8.707s1.414 1.414.0 2.828-2.828.0-2.828.0L4.878 8.708s-1.414-1.414.0-2.829c1.415-1.414 2.829.0 2.829.0l1.414 1.414zm21 21s1.414 1.414.0 2.828-2.828.0-2.828.0l-1.414-1.414s-1.414-1.414.0-2.828 2.828.0 2.828.0l1.414 1.414zm-.413-18.172s-1.414 1.414-2.828.0.0-2.828.0-2.828l1.414-1.414s1.414-1.414 2.828.0.0 2.828.0 2.828l-1.414 1.414zm-21 21s-1.414 1.414-2.828.0.0-2.828.0-2.828l1.414-1.414s1.414-1.414 2.828.0.0 2.828.0 2.828l-1.414 1.414zM16 32s0-2 2-2 2 2 2 2v2s0 2-2 2-2-2-2-2v-2z"></path><circle fill="#ffd983" cx="18" cy="18" r="10"></circle><rect x="0" y="0" width="36" height="36" fill="rgba(0, 0, 0, 0)"></rect></svg>
                </button>
                <?php endif; ?>
        </div>
        </div>
    </div>
    </nav>

