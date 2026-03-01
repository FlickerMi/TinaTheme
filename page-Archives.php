<?php 
/**
 * 文章归档
 * 
 * @package custom 
 * 
 */
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
$this->need('header.php');
?>

<main>
    <header>
        <div class="container">
            <h1><?php $this->title() ?></h1>
            <p class="subtitle">文章归档</p>
        </div>
    </header>
    <div class="container">
        <style>
            /* 分类列表 */
            .archive-categories {
                display: flex;
                flex-wrap: wrap;
                gap: 10px;
                list-style: none;
                padding: 0;
                margin: 10px 0 2rem;
            }
            .archive-categories li a {
                display: inline-block;
                padding: 5px 14px;
                border-radius: 20px;
                font-size: 0.9rem;
                background: var(--light-background);
                color: var(--font-color);
                text-decoration: none;
                border: 1px solid var(--border);
                transition: all 0.25s ease;
                box-shadow: none;
            }
            .archive-categories li a:hover {
                background: var(--link-color);
                color: #fff;
                border-color: var(--link-color);
                transform: translateY(-2px);
                box-shadow: none;
            }
            /* 时间线区域 */
            .archive-section {
                margin-bottom: 2rem;
            }
            .archive-year {
                font-size: 1.5rem;
                font-weight: 700;
                color: var(--h1-color);
                margin: 2rem 0 1rem;
                padding-bottom: 0.5rem;
                border-bottom: 2px solid var(--link-color);
                display: inline-block;
            }
            .timeline {
                list-style: none;
                padding: 0;
                margin: 0 0 1rem;
                border-left: 2px solid var(--border);
                padding-left: 1.5rem;
            }
            .timeline-item {
                position: relative;
                padding: 6px 0;
                display: flex;
                align-items: baseline;
                gap: 1rem;
            }
            .timeline-item::before {
                content: '';
                position: absolute;
                left: -1.65rem;
                top: 50%;
                transform: translateY(-50%);
                width: 8px;
                height: 8px;
                border-radius: 50%;
                background: var(--link-color);
                border: 2px solid var(--background);
                flex-shrink: 0;
            }
            .timeline-item time {
                font-size: 0.85rem;
                color: var(--light-font-color);
                white-space: nowrap;
                min-width: 48px;
                flex-shrink: 0;
            }
            .timeline-item a {
                font-size: 0.95rem;
                color: var(--font-color);
                text-decoration: none;
                box-shadow: none;
                transition: color 0.2s;
            }
            .timeline-item a:hover {
                color: var(--link-color);
                box-shadow: none;
            }
        </style>

        <div class="article-post">

            <h2>分类</h2>
            <ul class="archive-categories">
                <?php $this->widget('Widget_Metas_Category_List')->parse('<li><a href="{permalink}">{name} ({count})</a></li>'); ?>
            </ul>

            <h2>时间归档</h2>
            <?php
            $this->widget('Widget_Contents_Post_Recent', 'pageSize=10000')->to($archives);
            $year = 0;
            $output = '<div class="archive-section">';
            while ($archives->next()) {
                $year_tmp = date('Y', $archives->created);
                if ($year != $year_tmp) {
                    if ($year > 0) $output .= '</ul>';
                    $year = $year_tmp;
                    $output .= '<div class="archive-year">' . $year . ' 年</div>';
                    $output .= '<ul class="timeline">';
                }
                $output .= '<li class="timeline-item">';
                $output .= '<time>' . date('n/d', $archives->created) . '</time>';
                $output .= '<a href="' . $archives->permalink . '">' . htmlspecialchars($archives->title) . '</a>';
                $output .= '</li>';
            }
            if ($year > 0) $output .= '</ul>';
            $output .= '</div>';
            echo $output;
            ?>

        </div>
    </div>
</main>

<?php $this->need('footer.php'); ?>
